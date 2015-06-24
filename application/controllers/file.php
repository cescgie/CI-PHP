<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
        // load library
        $this->load->library(array('table','form_validation'));
        
        // load helper
        $this->load->helper('url');
        
        // load model
        $this->load->model('File_model','',TRUE);
    }
    
    public function index()
    {
        $data['title'] = "Title";
        $data['sub_title'] ="Sub Title";
        $this->all_connection();
        $data['sum_cf'] = $this->File_model->count_cf();
        $this->load->view('header',array('data' => $data));
        $this->load->view('file',array('data' => $data));
    }

    public function all_connection(){
      /*
      *Connect to each server file
      */
      $this->connect('cf');
    }

    public function get_web_page( $url )
    {
        $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
        $username = ADS_USER;
        $password = ADS_PASS;  
        $options = array(

            CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
            CURLOPT_POST           =>false,        //set to GET
            CURLOPT_USERAGENT      => $user_agent, //set user agent
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 0,      // timeout on connect
            CURLOPT_TIMEOUT        => 0,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
                CURLOPT_HTTPAUTH       => CURLAUTH_ANY,
                CURLOPT_USERPWD        => "$username:$password",
            );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;
    }

    public function convert($file_in)
    {
        //This input should be from somewhere else, hard-coded in this example
        $file_name = $file_in;
        // Raising this value may increase performance
        $buffer_size = 4096; // read 4kb at a time
        $out_file_name = str_replace('.gz', '', $file_name); 
        // Open our files (in binary mode)
        $file = gzopen($file_name, 'rb');
        $out_file = fopen($out_file_name, 'wb'); 
        // Keep repeating until the end of the input file
        while(!gzeof($file)) {
          // Read buffer-size bytes
          // Both fwrite and gzread and binary-safe
          fwrite($out_file, gzread($file, $buffer_size));
        } 
        // Files are done, close files
        fclose($out_file);
        gzclose($file);
        echo $out_file;
      }

    public function download_remote_file_with_curl($files_url, $save_to)
    {
      $username = ADS_USER;
      $password = ADS_PASS;
      $che = curl_init();
      curl_setopt($che, CURLOPT_POST, 0); 
      curl_setopt($che, CURLOPT_URL,$files_url); 
      curl_setopt($che, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($che, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
      curl_setopt($che, CURLOPT_USERPWD, "$username:$password");

      $content = curl_exec($che);
                              
      $download = fopen($save_to, 'w');
      fwrite($download, $content);
      fclose($download);
      curl_close( $che );
    }
    public function connect($table)
      {
          //Read a web page and check for errors:
          $url = "http://sgsdata.adtech.de/59.1/0/".$table."/";
          $result = $this->get_web_page( $url );

          if ( $result['errno'] != 0 )
              Message::set("error: bad url | timeout | redirect loop ...");

          if ( $result['http_code'] != 200 )
              Message::set("error: no page | no permissions | no service ");

          $page = $result['content'];

          if($result==TRUE){  
              //explode
              $str = $page;
              $preg=preg_match_all('#<li><a.*?>(.*?)<\/a></li>#', $str, $parts);
              if($preg==TRUE){
                  
                  //get the highest available array key          
                  $maxIndex = array_search(max($parts[0]), $parts[0]);
                  //rename value from $maxIndex. Before : "(1 space)value"
                  $subValue = substr($parts[1][$maxIndex], 1);
                  $newurl=$url.$subValue."";

                  $result2 = $this->get_web_page( $newurl );

                  if ( $result2['errno'] != 0 )
                      Message::set("error: bad url | timeout | redirect loop ...");

                  if ( $result2['http_code'] != 200 )
                      Message::set("error: no page | no permissions | no service ");

                  $page2 = $result2['content'];

                  if($result2==TRUE){
                      $str2 = $page2;
                      $preg2=preg_match_all('#<li><a.*?>(.*?)<\/a></li>#', $str2, $parts2);
                      if($preg2==TRUE){
                          
                          //get the highest available array key          
                          $maxIndex2 = array_search(max($parts2[0]), $parts2[0]);
                          //rename value from $maxIndex. Before : "(1 space)value"
                          $subValue2 = substr($parts2[1][$maxIndex2], 1);
                          $newurl2=$newurl.$subValue2."";
                          $result3 = $this->get_web_page( $newurl2 );

                          if ( $result3['errno'] != 0 )
                              Message::set("error: bad url | timeout | redirect loop ...");

                          if ( $result3['http_code'] != 200 )
                              Message::set("error: no page | no permissions | no service ");

                          $page3 = $result3['content'];
                          if($result3==TRUE){
                              //create folder 
                              $dir = null;
                              if(!is_dir($dir .= "uploads/".$table."/".$subValue)){ 
                                mkdir($dir, 0777, true);
                                chmod($dir, 0777);
                              }
                              $dir2 = null;
                              if(!is_dir($dir2 .= 'uploads/'.$table.'/'.$subValue.$subValue2)){  
                                  mkdir($dir2, 0777, true);
                                  chmod($dir2, 0777);
                              }
                              //create index file
                              $myfile = fopen($dir2."index.txt", "w") or die("Unable to open file!");

                              $str3 = $page3;
                              $preg3=preg_match_all('#<li><a.*?>(.*?)<\/a></li>#', $str3, $parts3);
                              if($preg3==TRUE){
                                  //count summe of all files with array key
                                  $countArray = count($parts3[1]);
                                  for ($i = 1; $i < $countArray; $i++) {
                                      //rename file. Before : "(1 space)filename"
                                      $subValue3 = substr($parts3[1][$i], 1);
                                      //upload files to storage
                                      //url to files
                                      $newurl3=$newurl2.$subValue3."";
                                      $subName = substr($subValue3,0,-3);
                                      //check if files already exist
                                      if(!is_file(getcwd()."/".$dir2.$subName)){
                                        //check if files had been already parsed
                                        if(!is_file(getcwd()."/".$dir2.$subName.".done")){
                                          //download remote files
                                          $this->download_remote_file_with_curl($newurl3, getcwd()."/".$dir2.$subValue3);
                                          //check if uploaded file extention is gz
                                          if (substr(getcwd()."/".$dir2.$subValue3, -3) !== '.gz') {
                                                //rename
                                                $filenames = $subValue3;
                                          }else{
                                                //Convert files(gz) to bin directly after put them in uploads directory
                                                $this->convert(getcwd()."/".$dir2.$subValue3);
                                                //rename
                                                $filenames = substr($subValue3, 0, -3);
                                                //delete gz file
                                                unlink(getcwd()."/".$dir2.$subValue3);
                                          }
                                      }else{
                                        $filenames = substr($subValue3, 0, -3);
                                      } 
                                      //overwrite index.txt
                                      $txt = $filenames."\n";
                                      fwrite($myfile, $txt);
                                    }
                                  }
                                  //Parse files into Database
                                  //$parse='parse_'.$table;
                                  //$this->$parse($dir2);
                              } // end of 'if($preg3==TRUE)'
                          } // enc of 'if($result3==TRUE)'
                      } // end of 'if($preg2==TRUE)'
                  } // end of 'if($result2==TRUE)'
              } // end of 'if($preg==TRUE)'
          } // end of 'if($result==TRUE)'
      } // end of function
}
?>