<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Router extends CI_Controller {

	 function __construct() {

        parent::__construct();
        
        $this->viewname   = $this->router->uri->segments[1];
       
    }

/*
    @Description: get List of router, pagination
    @Author: Ruchi Shahu
    @Output: 
*/

	public function index()
	{
		$perpage = $this->input->post('perpage');
        $search_keyword = $this->input->post('search_keyword');
        $search_field = $this->input->post('search_field');
        $config['per_page'] = '5';
        $perpage = '5';
        $uri_segment = $this->uri->segment(2);
        $config['uri_segment'] = 2;
        $config['base_url'] = site_url($this->viewname);
		$data['datalist']	=	$this->general_model->get_router_list($perpage,$uri_segment,'',$search_field,$search_keyword);
 	//	echo $this->db->last_query();  
        $config['total_rows'] = $this->general_model->get_router_list('','',1,$search_field,$search_keyword);
		$this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        if($this->input->post('ajax_type') == '')

	 if ($this->input->post('result_type') == 'ajax') {
	 		$data['search_field'] = $search_field;
	 		$data['search_keyword'] = $search_keyword;

            $this->load->view($this->viewname . '/ajax_list', $data);
        } else {
            $data['main_content'] =  $this->viewname . "/list";
			$this->load->view('router/list',$data);
        }
	}

/*
    @Description: Add Data of router
    @Author: Ruchi Shahu
    @Output: 
   
    */

	public function add()
	{
		//Fetch department data
		$data['sapid_list']	=	$this->general_model->get_data('sapid_data'); 
		
		  
		$this->load->view('router/add',$data);
	}
 


/*
    @Description: Insert Data of router
    @Author: Ruchi Shahu
    @Output: Insert data into router table
    
    */

	public function insert_data()
	{
		
		$data = array(
			'SapId'		=>	$this->input->post('SapId'),
			'HostName' 	=> $this->input->post('HostName'),
			'Loopback' 	=> $this->input->post('Loopback'),
			'MacAddress' 	=> $this->input->post('MacAddress'), 
			 
			);

		$this->general_model->insert_data('router',$data);
		redirect('router');
	}
/*
    @Description: edit Data of router
    @Author: Ruchi Shahu
    @Input:routerid 
    
    */

	public function edit_data()
	{
		$id = $this->uri->segment(3);
		//Fetch department data
		$data['sapid_list']	=	$this->general_model->get_data('sapid_data'); 
		 
		//Fetch router data by id 
		$where = array('Id' => $id);
		$data['editRecord']	=	$this->general_model->get_data('router','data', $where); 
		
		$this->load->view('router/add',$data);
	}

	/*
    @Description: Insert Data of router
    @Author: Ruchi Shahu
    @Output: Insert data into router table
   
    */

	public function update_data()
	{
		
		$data = array(
			'SapId'		=>	$this->input->post('SapId'),
			'HostName' 	=> $this->input->post('HostName'),
			'Loopback' 	=> $this->input->post('Loopback'),
			'MacAddress' 	=> $this->input->post('MacAddress'),
			);
		$where = array('Id' => $this->input->post('id'));

		$this->general_model->update_data('router',$data,$where);
		redirect('router');
	}
	
/*
    @Description: Delete Data of router
    @Author: Ruchi Shahu
    @Output: 
   
    */

	public function delete_data()
	{
		$where  = array('Id' => $this->input->post('id'));


		$this->general_model->update_data('router',array('status' => 0),$where);
		//Delete router data
		//$this->general_model->delete_record('router',$where); 
		
	}
}
