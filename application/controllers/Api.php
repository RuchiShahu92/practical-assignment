<?php 
 
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load the Rest Controller library
//require APPPATH.'libraries/REST_Controller.php';

class Api extends CI_Controller {

    public function __construct() { 
        parent::__construct();
          
    }
 	

     public function insert_router_detail() {
			
 		$HostName = $this->input->post('HostName');
 		$Loopback = $this->input->post('Loopback');
 		$SapId = $this->input->post('SapId');
 		$MacAddress = $this->input->post('MacAddress');

		if(!empty($HostName) && !empty($Loopback))
		{
			$data_array = array(
			 
			'HostName' 	=> $HostName,
			'Loopback' 	=> $Loopback,
			'SapId' 	=> $SapId,
			'MacAddress' 	=> $MacAddress,
			  
			);
  
			$result =  $this->general_model->insert_data('router',$data_array);
				
			if($result){
				$data = array(
					 
					 'status' => 1,
                    'message' => 'Router created Successfully.',
                    'data' => $result);
			}else{
				$data = array('status' => 0,
                    'message' => 'something went wrong.',
                    'data' => '');

			}  

		}else{
				$data = array(
					'status' => 1,
                    'message' => 'HostName & Loopback is required',
                    'data' => $result
                    );
		 }
		 
		echo json_encode($data); 
		exit;

    }

    public function update_router_detail() {
			

 		$HostName = $this->input->post('HostName');
 		$Loopback = $this->input->post('Loopback');
 		$SapId = $this->input->post('SapId');
 		$MacAddress = $this->input->post('MacAddress');

		if(!empty($MacAddress))
		{
			$data_array = array(
			 
			'HostName' 	=> $HostName,
			'Loopback' 	=> $Loopback,
			'SapId' 	=> $SapId,
			'MacAddress' 	=> $MacAddress,
			  
			);
  
			$where = array('MacAddress' => $MacAddress);

			$result = $this->general_model->update_data('router',$data_array,$where);
				
			if($result){
				$data = array(
					 
					 'status' => 1,
                    'message' => 'Router detail updated Successfully.',
                    'data' => $result);
			}else{
				$data = array('status' => 0,
                    'message' => 'something went wrong.',
                    'data' => '');

			}  

		}else{
				$data = array(
					'status' => 1,
                    'message' => 'MacAddress is required',
                    'data' => $result
                    );
		 }
		 
		echo json_encode($data); 
		exit;

    }

    public function router_details_get() {
			 	
			$SapId = $this->input->post('SapId');
			$where = array('SapId' => $SapId);  
			$data = 'data';
			$result = $this->general_model->get_data('router',$data,$where) ;
			 echo $this->db->last_query();
			if($result){
				$data = array(
					 	'status'  => 1,
                    	'message' => 'get router details Successfully.',
                    	'data' 	  => $result
                       );
			}else{
				$data = array('status' => 0,
                    'message' => 'wrong SapId.',
                    'data' => '');

			}  
			echo json_encode($data); 
		exit;

    }

    public function delete_router() {
			 	
			$MacAddress = $this->input->post('MacAddress');
			$where = array('MacAddress' => $MacAddress);  
			$result = $this->general_model->delete_record('router', $where); 
			 
			if($result){
				$data = array(
					 
					 'status' => 1,
                    'message' => 'Delete router Successfully.',
                    'data' => $result);
			}else{
				$data = array('status' => 0,
                    'message' => 'Wrong MacAddress.',
                    'data' => '');

			}  
			echo json_encode($data); 
		exit;

    }
}
?>