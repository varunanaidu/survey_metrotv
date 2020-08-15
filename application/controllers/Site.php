<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
		parent::__construct();
		$resp_id;
	}

	public function index()
	{
		$this->load->view('validation');
		
		/*$timeout = '2020-01-20 23:59:59';

		if (date('Y-m-d H:i:d') > $timeout) {
			$this->load->view('timeout');
		}else{
			$this->load->view('validation');
		}*/

	}

	public function thanks()
	{
		$this->load->view('thanks');
	}

	public function close()
	{
		$this->load->view('failed');
	}

	public function survey()
	{
		if ($this->input->get('rsp')) {
			$this->resp_id = $this->input->get('rsp');
			$data['resp_id'] = $this->resp_id;
			$data['responden'] = $this->sitemodel->view('tab_responden', '*', array('resp_id' => $this->resp_id));
			$data['transaction'] = $this->sitemodel->view('tr_transaction', '*', array('resp_id' => $this->resp_id));
		}

		$data['range_age'] = $this->sitemodel->view('tab_age_range', '*');
		$data['profession'] = $this->sitemodel->view('tab_profession', '*');
		$data['province'] = $this->sitemodel->view('tab_province', '*');
		$data['edu'] = $this->sitemodel->view('tab_edu', '*');
		$data['expense'] = $this->sitemodel->view('tab_expense', '*');
		$data['question'] = $this->sitemodel->view('tab_question', '*');
		$this->load->view('design', $data);
	}

	public function validate_responder()
	{
		$msg = array();
		$resp_id;

		$check = $this->sitemodel->view('tab_responden', '*', array('resp_email' => $this->input->post('resp_email'), 'resp_ph' => $this->input->post('resp_ph') ) );

		if($check == 0){
			$msg['type'] = 'failed';
			$msg['msg'] = "Maaf anda tidak terdaftar sebagai responden.";
		}else{
			$resp_id = $check[0]->resp_id;

			$check2 = $this->sitemodel->view('tr_transaction', array('resp_id' => $resp_id));

			if ($check2 == 0) {
				$msg['type'] = 'done';
				$msg['msg']	 = 'Silahkan melakukan mengisi data anda dan kuisoner';
				$msg['resp_id'] = $check[0]->resp_id;
			}else{
				$msg['type'] = 'done_complete';
				$msg['msg']	 = 'Anda sudah pernah melakukan pengisian kuisoner sebelumnya';
				$msg['resp_id'] = $check[0]->resp_id;
			}
		}

		echo json_encode($msg);
	}

	public function inputed()
	{
		$msg = array();
		// echo json_encode($this->input->post());die;

		$check = $this->sitemodel->view('tr_transaction', '*', array('resp_id' => $this->input->post('resp_id')));
		$question = $this->sitemodel->view('tab_question', '*');

		for ($i = 0; $i <= sizeof($question) ; $i++) { 
			if ($this->input->post($i)) {

				$check_tr = $this->sitemodel->view('tr_transaction', '*', array('resp_id' => $this->input->post('resp_id'), 'quest_id' => $question[$i-1]->quest_id));

				if ($check_tr != 0) {
					$reason = 'reason_'.$i;

					$data_tr = array(
						'answer'		=> $this->input->post($i),
						'reason'		=> $this->input->post($reason),
						'update_date'	=> date("Y-m-d H:i:s")
					);

					$update_tr = $this->sitemodel->update('tr_transaction', $data_tr, array('resp_id' => $this->input->post('resp_id'), 'quest_id' => $question[$i-1]->quest_id) );
				}else{
					$reason = 'reason_'.$i;

					$data_tr = array(
						'resp_id'		=> $this->input->post('resp_id'),
						'quest_id'		=> $question[$i-1]->quest_id,
						'answer'		=> $this->input->post($i),
						'reason'		=> $this->input->post($reason),
						'create_date'	=> date("Y-m-d H:i:s")
					);

					$insert_tr = $this->sitemodel->insert('tr_transaction', $data_tr);
				}
			}
		}

		$responden = array(
			'resp_name' 	=> $this->input->post('resp_name'),
			'resp_email' 	=> $this->input->post('resp_email'),
			'resp_ph' 		=> $this->input->post('resp_ph'),
			'resp_address' 	=> $this->input->post('resp_address'),
			'resp_gender' 	=> $this->input->post('resp_gender'),
			'prof_id'		=> $this->input->post('profession'),
			'range_id'		=> $this->input->post('range_age'),
			'edu_id'		=> $this->input->post('edu'),
			'expense_id'	=> $this->input->post('expense'),
			'prov_id'		=> $this->input->post('province'),
		);

		$update = $this->sitemodel->update('tab_responden', $responden, array('resp_id' => $this->input->post('resp_id')) );

		$msg['type'] = 'done';

		echo json_encode($msg);
	}

	public function check_transaction()
	{
		$check = $this->sitemodel->view('tr_transaction', '*', array('resp_id' => $this->input->post('resp_id')));

		echo json_encode($check);

	}
}
