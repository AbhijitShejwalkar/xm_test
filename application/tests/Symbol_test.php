<?php
use phpmock\phpunit\PHPMock;

class Symbol_test extends TestCase
{
    public function test_index()
    {
        $output = $this->request('GET', 'symbol/index');
        $this->assertStringContainsString(
            '<h2>Fetch Company Symbol Details</h2>', $output
        );
    }

    public function test_details()
    {
        $this->resetInstance();
		$this->CI->load->library('form_validation');
		$this->obj = $this->CI->form_validation;
        $this->obj->run();

        $output = $this->request('GET', 'symbol/details');
        $this->assertStringContainsString(
            '<label for="end_date">End Date:</label>', $output
        );
    }

    public function test_sendMail()
    {
        $this->resetInstance();
		$this->CI->load->library('mailer');
		$this->obj = $this->CI->mailer;
        $email = "xyz@gmail.com";
        $this->assertObjectHasAttribute('to', $this->obj->to($email));
       
    }


    public function test_cUrlGetData() {
        $url = 'https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data?symbol=AMRN&region=US';
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, [
			"X-RapidAPI-Host:  ttttt",
			"X-RapidAPI-Key: ZZZZ",
			'Content-Type: application/json'
		  ]);
		$response = curl_exec($curl);
		
        $this->assertStringContainsString(
            'provided is invalid', $response
        );
    }

    public function setUp(): void {
		$this->resetInstance();
		$this->CI->load->library('form_validation');
		$this->obj = $this->CI->form_validation;
	}
}