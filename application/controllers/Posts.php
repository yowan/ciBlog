<?php

class Posts extends CI_Controller {


	public function index()
	{
		
		$data['title'] = 'Latest Posts';

		$data['posts'] = $this->post_model->get_posts();

		//print_r($data['posts']);

		$this->load->view('templates/header', $data);
		$this->load->view('posts/index', $data);
		$this->load->view('templates/footer', $data);

	}

	public function view($slug = NULL)
	{
		
		$data['post'] = $this->post_model->get_posts($slug);

		if (empty($data['post'])) {
			# code...
			show_404();
		}

		$data['title'] = $data['post']['title'];

		$this->load->view('templates/header', $data);
		$this->load->view('posts/view', $data);
		$this->load->view('templates/footer', $data);


	}

	public function create()
	{
		
		$data['title'] = 'Create Posts';
		// rules for validation
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('body', 'Body', 'required');

		if ($this->form_validation->run() === FALSE) {
			# code...
			$this->load->view('templates/header', $data);
			$this->load->view('posts/create', $data);
			$this->load->view('templates/footer', $data);
		}else {
			# code...
			$this->post_model->create_post();
			//$this->load->view('posts/success');
			redirect('posts');
		}

	}

	public function delete($id){
		$this->post_model->delete_post($id);
		redirect('posts');
	}




}