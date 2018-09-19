<?php
/**
 * PHP 5
 * Static content controller for PayPal - PAyout Implementation.
 * This file will render views to View\Paypal\
 */
 
App::uses('AppController', 'Controller');
//importing the paypal batch file
App::import('Vendor', 'paypal_payout_batch_file');

class PaypalController  extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */

	public function index() {
		/*
		* Using my sandbox account for testing
		* PP Sandbox Account  : vim_payout_us@gmail.com
		* Client id : AWqDW98qfqzsEW81pfcAEh_dZY0o6j8V9zMvgDkRDyiLC4vIFJ7c-5V-T9s7yQxtaqw-W1xk3CQ8WGac
		* Password  : EEvQ1GRey_hyqxo2mTrX-O0zVOqUtAwdC0uoflNhlTgV20LCmSPAve3im7iHCKxFMxJzRuRVtRRoR4PD
		*/	

		/* $paypal_batch_data = $_POST['paypal_payout_textarea'];// you can use this variable too in run time , commenting this for your use case.*/
		
		//Step 1: Create Paypal access token to initiate the payment 
		$paypal_access_token = $this->createAccessToken();
		
		//Step 2 :Execute the Payout 
		$result_create_payout = $this->createPayout($paypal_access_token);
		
		//setting the result values to views
		$this->set('payout_batch_id', $result_create_payout->batch_header->payout_batch_id);
		$this->set('sender_batch_id', $result_create_payout->batch_header->sender_batch_header->sender_batch_id);
		$this->set('batch_status', $result_create_payout->batch_header->batch_status);
		$this->set('email_subject', $result_create_payout->batch_header->sender_batch_header->email_subject);
		$this->set('email_message', $result_create_payout->batch_header->sender_batch_header->email_message);
		$this->render("paypal");
		
		}
		public function home() {
			$this->render("home");
		}

	/*
	* Function to initiate the Payment by retreiving the access token.
	*/
	public function createAccessToken() {
		$data = "response_type=token&grant_type=client_credentials";
		//Setup the headers
		$headers_arr = array();
		$headers_arr[]="Accept-Encoding:application/json";
		$headers_arr[]="Accept-Language:en_US";
		
		//Call the curl to run the get the paypal access token.
		$access_token = $this->runApi($op="create_token",CLIENT_SECRET, ACCESS_TOKEN_URL, $data, $headers_arr);
		return $access_token;
	}
	
	/*
	* Function to create&execute the Payment 
	*/
	public function createPayout($paypal_access_token) {
		//Setup the headers
		$headers_arr   = array();
		$headers_arr[] ="Content-Type:application/json";
		$headers_arr[] ="Authorization:Bearer $paypal_access_token";
		$result_payout = $this->runApi($op="create_payout",CLIENT_SECRET, PAYOUT_URL, PAYPAL_BATCH_DATA, $headers_arr);
		return $result_payout;
		
	}
	/*
	* Common function to run the API calls to the Payout endpoint
	*/
	public function runApi($op,$client_secret, $endpoint_url,$data, $headers_arr){
			$ch = curl_init();
			if($op == "create_token") { 
				curl_setopt($ch, CURLOPT_USERPWD,$client_secret);
			}
			curl_setopt($ch, CURLOPT_URL, $endpoint_url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch, CURLOPT_TIMEOUT, 45);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_arr);
			$result = curl_exec($ch);
			
			
			if (curl_error($ch)) {
				$error_msg = curl_error($ch);
				echo $error_msg;
			}
			$res = json_decode($result);
			if($op == "create_token") { 
				$access_token = $res->access_token;
				return $access_token;
			} 
			if($op == "create_payout") {
				return $res;
			}
			
			
		}
}

