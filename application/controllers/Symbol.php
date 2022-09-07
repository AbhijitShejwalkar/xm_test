<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
* Symbol class created for fetch symbol details in table and graph format
*/
class Symbol extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','mailer', 'session'));
    }
	
	/*
	@param : no param
	@descirption : to display fetch symbol details form
	*/ 
	public function index() {
		$this->load->view('symbol');
	}


	/*
	@param : no param
	@descirption : used for handle server side validation and fetch symbol record from Rapid API
	*/ 
	public function details() {

		$this->form_validation->set_rules('company_symbol', 'Company symbol', 'required');
		$this->form_validation->set_rules('company_name', 'Company name', 'required');
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules('end_date', 'End Date', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() == FALSE)
		{
				$this->load->view('symbol');
		}
		else
		{
			$company_symbol = $this->input->post('company_symbol');
			$data['response'] = $this->cUrlGetData($company_symbol);
			$this->sendMail($this->input->post('email'), $this->input->post('start_date'), $this->input->post('end_date'), $this->input->post('company_name'));			
		
			$this->load->view('symbol_details', $data);
		}

	}
	
	/*
	@param : email,start date, end date,company name
	@descirption : used for send mail 
	*/
	public function sendMail($email,$start_date,$end_date,$company_name) {

		$templateData = ['start_date' => $start_date, 'end_date' => $end_date ]; 
		$this->mailer->to($email)->subject($company_name);
        $this->mailer->send("email.php", compact('templateData'));
		$this->session->set_flashdata('success', 'Mail sent successfully');
	}

	/*
	@param : company name
	@descirption : crul connection to rapid API and fetch symbol details 
	*/
	public function cUrlGetData($company_name) {

		$url = $this->config->item('rapid_url').'?symbol='.$company_name;
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, [
			"X-RapidAPI-Host:  ".$this->config->item('rapid_host'),
			"X-RapidAPI-Key: ".$this->config->item('rapid_api_key'),
			'Content-Type: application/json'
		  ]);
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
}
