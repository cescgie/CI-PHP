<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File extends CI_Controller {

    // num of records per page
    private $limit = 10;
    
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
    
    function index($offset = 0)
    {
        $data['title'] = "Title";
        $data['sub_title'] ="Sub Title";
        $data['sum_cf'] = $this->File_model->count_cf();
        $this->load->view('header',array('data' => $data));
        $this->load->view('file',array('data' => $data));
    }
    
}
?>