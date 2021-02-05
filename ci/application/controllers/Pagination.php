<?php
 defined('BASEPATH') OR exit('No direct script access allowed');

class Pagination extends CI_Controller {

  //Pagination

public function __construct() {
    parent:: __construct();

    $this->load->helper('url');
    $this->load->model('ProduitsModel');
    $this->load->library("pagination");
}

public function index() {
    $aViewHeader = ["title" => "Produits"];
    $config = array();
    $config["base_url"] = site_url() . "/pagination/";
    $config["total_rows"] = $this->ProduitsModel->get_counter();
    $config["per_page"] = 5;
    $config["uri_segment"] = 2;

    //Pour pagination liens
    $config['attributes'] = array('class' => 'page-link');

        $config['full_tag_open'] = '<ul class="pagination">';        
        $config['full_tag_close'] = '</ul>';        
        $config['first_link'] = 'First';        
        $config['last_link'] = 'Last';        
        $config['first_tag_open'] = '<li>';        
        $config['first_tag_close'] = '</li>';        
        $config['prev_link'] = '&laquo';        
        $config['prev_tag_open'] = '<li>';        
        $config['prev_tag_close'] = '</li>';        
        $config['next_link'] = '&raquo';        
        $config['next_tag_open'] = '<li>';        
        $config['next_tag_close'] = '</li>';        
        $config['last_tag_open'] = '<li>';        
        $config['last_tag_close'] = '</li>';        
        $config['cur_tag_open'] = ' <li class="page-item active"><a class="page-link" href="#">';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li class="page-item">';        
        $config['num_tag_close'] = '</li>';


        
    $this->pagination->initialize($config);

    $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

    $data["links"] = $this->pagination->create_links();

    $data['pagination'] = $this->ProduitsModel->get_prod($config["per_page"], $page);

    $this->load->view('jarditou/header/headerTableau',$aViewHeader );
         // Appel de la vue avec transmission du tableau  
        if (isset($_SESSION['status']) and $_SESSION['status'] == 1){
            $this->load->view('jarditou/tableauadmin', $data);
        }
        else{
            $this->load->view('jarditou/tableau', $data);
        }
       
        $this->load->view('jarditou/footer/footer');
}
}

?>