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
        /*
        *This will be used as page title.
        */
        $data['title'] = 'Adserverdaten';

        /*
        *Query for intialize records in database.
        */
        $data['sum_cf'] = $this->File_model->count_cf();
        $data['sum_ga'] = $this->File_model->count_ga();
        $data['sum_gl'] = $this->File_model->count_gl();
        $data['sum_ir'] = $this->File_model->count_ir();
        $data['sum_kv'] = $this->File_model->count_kv();
        $data['sum_kw'] = $this->File_model->count_kw();
        $data['sum_tc'] = $this->File_model->count_tc();

        /*
        *Call all views that will be show as index 
        */
        $this->load->view('header',array('data' => $data));
        $this->load->view('file',array('data' => $data));
    }
}
?>