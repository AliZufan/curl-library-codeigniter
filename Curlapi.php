<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curlapi {
	/**
	 * PHP version in 7.1.25
	 * Authors : AliZufan cek in github
	 * 
	 * Params :
	 * $url => insert API url
	 * $headers => array("nameHeader:valueHeader\r\n"."nameHeader2 : valueHeader") if use file_getcontent
	 * $headers => array("nameHeader:valueHeader","nameHeader2 : valueHeader") OR array("nameHeader" => "valueHeader","nameHeader2" => "valueHeader") if use CURL
	 * $params  => array("name" => "myname", "password" => "mypassword") this will to converted to html query/params url
	 * 
	 * Method :
	 * You can use this method => GET, POST, PUT , AND DELETE
	 * 
	 * Data Retrun type:
	 * Retrun this Library ready to array
	 */

	/**
	 * How to Call API
	 * //URL API
		$url      = 'http://localhost:8000/login';

		//API HEADERS
		$header = array(
			'Content-Type' => 'application/json',
			'Accept'       => 'application/json'
		);
	 * $params = array(
				'email'    => $email, => $_post / input post
				'password' => $password => $_post / input post
			);

			//GET DATA FORM FUNCTION POST
			$resp    = $this->curlapi->POST($url, $header, $params); => this is very Easy
	 *
	 */
	

	/**
	 *
	 * API Configuration
	 * Use Connection => 1. file_get_contents -> (stream_context)
	 * 		  			 2. CURL Connections
	 * 
	 * With METHOD : GET, POST, PUT , AND DELETE
	 *
	 */
	/*=======================================================
	=            file_get_contents STREAM METHOD            =
	=======================================================*/

	public function getContents($url='', $headers=array(), $method='GET')
	{
		//Example GET
		// $url     = 'http://localhost:8000/api/posts/';

		// $headers = "Authorization: bearer ".$this->session->userdata('api_token')."\r\n"."Content-Type: application/json\r\n"."Accept: application/json\r\n";
		// $resp    = $this->getContents($url, $headers, 'GET');

		//Http Options
		$opts = array(
			'http'=> array(
				'method' => $method,
				'header' => $headers
			)
		);

		$context = stream_context_create($opts);

		// Open the file using the HTTP headers set above
		$file = file_get_contents($url, false, $context);

		// Convert to Array
		$data_array = json_decode($file, TRUE);

		return $data_array;
	}

	/*=====  End of file_get_contents STREAM METHOD  ======*/

	/*===================================
	=            CURL METHOD            =
	===================================*/
	
	public function GET($url='', $header=array())
	{
		// Example GET
		// $resp = $this->GET($url, array('Authorization: bearer '.$this->session->userdata('api_token').'', 'Content-Type: application/json', 'Accept: application/json'));
		
		$ch = curl_init();
		$options = array(
			CURLOPT_URL => $url,
			CURLOPT_HTTPGET => TRUE,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HTTPHEADER => $header,
			CURLINFO_HEADER_OUT => TRUE
		);
		curl_setopt_array($ch, $options);
		$output = curl_exec($ch);
		curl_close($ch);

		$data_array = json_decode($output, TRUE);
		return $data_array;
	}

	public function POST($url='', $header=array(), $params=array())
	{
		//Convert array to params post
		$data = http_build_query($params);
		
		//inisialisasi
		$ch = curl_init();

		//pengaturan cURL
		$options = array(
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_RETURNTRANSFER => true,
			CURLINFO_HEADER_OUT => true,
		);
		curl_setopt_array($ch, $options);
		
		//Output
		$output = curl_exec($ch);

		//tutup curl
		curl_close($ch);

		//menampilkan hasil ke array
		$data_array = json_decode($output, TRUE);
		return $data_array;
	}

	public function PUT($url='', $header=array(), $params=array())
	{
		//Convert array to params post
		$data = http_build_query($params);
		
		//inisialisasi
		$ch = curl_init();

		//pengaturan cURL
		$options = array(
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_RETURNTRANSFER => true,
			CURLINFO_HEADER_OUT => true,
		);
		curl_setopt_array($ch, $options);
		
		//Output
		$output = curl_exec($ch);

		//tutup curl
		curl_close($ch);

		//menampilkan hasil ke array
		$data_array = json_decode($output, TRUE);
		return $data_array;
	}

	public function DELETE($url='', $header=array())
	{	
		//inisialisasi
		$ch = curl_init();

		//pengaturan cURL
		$options = array(
			CURLOPT_URL => $url,
			CURLOPT_CUSTOMREQUEST => 'DELETE',
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_RETURNTRANSFER => true,
			CURLINFO_HEADER_OUT => true,
		);
		curl_setopt_array($ch, $options);
		
		//Output
		$output = curl_exec($ch);

		//tutup curl
		curl_close($ch);

		//menampilkan hasil ke array
		$data_array = json_decode($output, TRUE);
		return $data_array;
	}

	/*=====  End of CURL METHOD  ======*/

	/**
	 *
	 * END CONFIGURATION
	 *
	 */
}
