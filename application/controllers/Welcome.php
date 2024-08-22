<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{	
		$this->load->helper('url');
		$this->load->view('login');
	}
	public function dashboard()
	{
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->view('navbar');
		$this->load->view('customerOrderMetrics');
		$this->load->view('customerListing');
		$this->load->view('ordersList');
		$this->load->view('ProductMetrics');
		$this->load->view('footer');
	}
	public function test()
	{
		$this->load->library('session');
		
		$this->load->view('invoiceTemplate');
		$this->load->view('footer');
	}
} 
