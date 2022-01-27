<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller{
    
    function  __construct(){
        parent::__construct();
        // Load paypal library & product model
        $this->load->library('paypal_lib');
        $this->load->model('product');
    }
    
    function index(){
        $data = array();
        
        // Get products data from the database
        $data['products'] = $this->product->getRows();
        
        // Pass products data to the view
        $this->load->view('products/index', $data);
    }
    
    function buy(){
    	

        // Set variables for paypal form
        $returnURL = base_url().'admin/paypal/success';
        $cancelURL = base_url().'admin/paypal/cancel';
        $notifyURL = base_url().'admin/paypal/ipn';
        
        // Get product data from the database
        $product = $this->product->getRows($id);
        
        // Get current user ID from the session
        //$userID = $_SESSION['userID'];
        $userID = $_REQUEST['user_id'];
        
        // Add fields to paypal form
        $aa=$this->paypal_lib->add_field('return', $returnURL);
        $b=$this->paypal_lib->add_field('cancel_return', $cancelURL);
        $a=$this->paypal_lib->add_field('notify_url', $notifyURL);
        $c=$this->paypal_lib->add_field('item_name', $_REQUEST['levels']);
        $d=$this->paypal_lib->add_field('custom', $userID);
        $e=$this->paypal_lib->add_field('item_number',  $_REQUEST['user_id']);
        $f=$this->paypal_lib->add_field('amount',  $_REQUEST['payment']);
/*      print_r($a);
        print_r($aa);
        print_r($b);
        print_r($c);
        print_r($d);
        print_r($e);
        print_r($f);*/
       
        // Render paypal form
        $s=$this->paypal_lib->paypal_auto_form();
 

    }
}