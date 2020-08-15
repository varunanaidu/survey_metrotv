<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Report extends CI_Controller
{

	public function index()
	{
		$total_province_complete	= 0;
		$data['answer'] 			= array();
		$data['conclude']			= array();

		$data['temp_resp']			= $this->sitemodel->custom_query('
			SELECT tr.resp_id, tr.resp_ph, tr.resp_email, tr.resp_name, tp.prov_title
			FROM tab_responden tr 
			LEFT JOIN tab_province tp ON tr.prov_id = tp.prov_id
			WHERE tr.resp_id NOT IN(
			SELECT resp_id
			FROM tr_transaction
			GROUP BY resp_id
			)
			');

		$data['fix_resp'] 			= $this->sitemodel->custom_query('
			SELECT tt.resp_id, resp_name, prov_title
			FROM tr_transaction tt
			LEFT JOIN tab_responden tr ON tt.resp_id=tr.resp_id
			LEFT JOIN tab_province tp ON tr.prov_id=tp.prov_id
			GROUP BY tr.resp_id
			');

		$data['responden']			= $this->sitemodel->view('tab_responden', '*');
		$data['province']			= $this->sitemodel->view('tab_province', '*');
		$data['responden_complete'] = $this->sitemodel->custom_query('
			SELECT resp_id
			FROM tr_transaction tt
			GROUP BY (resp_id)
			');

		$data['responden_male']		= $this->sitemodel->custom_query('
			SELECT tr.resp_id, resp_name, resp_gender
			FROM tr_transaction tt 
			LEFT JOIN tab_responden tr ON tt.resp_id = tr.resp_id
			WHERE resp_gender LIKE "M"
			GROUP BY (resp_id)
			');

		$data['responden_female']		= $this->sitemodel->custom_query('
			SELECT tr.resp_id, resp_name, resp_gender
			FROM tr_transaction tt 
			LEFT JOIN tab_responden tr ON tt.resp_id = tr.resp_id
			WHERE resp_gender LIKE "F"
			GROUP BY (resp_id)
			');


		$data['per_province']		= 0;
		$check_province  			= $this->sitemodel->custom_query('
			SELECT tp.prov_id, tp.prov_title, COUNT(tr.resp_id) AS Total
			FROM tab_responden tr
			LEFT JOIN tab_province tp ON tr.prov_id=tp.prov_id
			GROUP BY tp.prov_id
			');

		for ($i=0; $i < sizeof($check_province); $i++) {
			if ( $check_province[$i]->prov_id !== NULL ) {
				$query = $this->sitemodel->custom_query('
					SELECT tp.prov_id, tp.prov_title, tr.resp_name
					FROM tr_transaction tt
					LEFT JOIN tab_responden tr ON tt.resp_id=tr.resp_id
					LEFT JOIN tab_province tp ON tr.prov_id=tp.prov_id
					WHERE tp.prov_id = ' . $check_province[$i]->prov_id . ' GROUP BY tr.resp_id HAVING COUNT(quest_id) = 88');
				if ($query != 0) {
					if (sizeof($query) == $check_province[$i]->Total) {
						$data['per_province']++;
					}
				}
			}
		}


		/*$list_quest 	= $this->sitemodel->view('tab_question', '*');
		$temp_quest 	= array();
		$temp_answer	= array();
		$temp_data		= array();


		for ($i=0; $i < sizeof($list_quest); $i++) { 

			if ($i < 87) {

				for ($j = 1; $j <= 10 ; $j++) { 

					$query = $this->sitemodel->custom_query('
						SELECT quest_id, answer, COUNT(resp_id) AS Total
						FROM tr_transaction
						WHERE quest_id = '.$list_quest[$i]->quest_id .' AND answer = '. $j .' ');

					foreach ($query as $row) {
						if ($row->quest_id != '') {
							$temp = array();
							$temp['Answer'] = $row->answer;
							$temp['Total'] = $row->Total;
							$temp_answer[$row->answer] = $temp;
						}
					}
					$temp_quest['Answer']		= $temp_answer;
					$temp_quest['Question']		= $list_quest[$i]->quest_title;
				}
			}
			$temp_data[]				= $temp_quest;
		}
		$data['answer'] = $temp_data;*/

		$check_responden = $this->sitemodel->custom_query('
			SELECT *
			FROM tab_responden
			WHERE resp_id IN (
			SELECT resp_id
			FROM tr_transaction
			GROUP BY resp_id
		)
		');
		$temp_conclude = array();
		$temp_resp = array();
		$temp_resp2 = array();

		for ($i = 0; $i < sizeof($check_responden); $i++) {

			$data1 = $this->sitemodel->custom_query('
				SELECT resp_id, resp_name, resp_email, age_range, resp_ph, prof_title, resp_gender, resp_address, edu_title, expense_range, prov_title
				FROM tab_responden tr
				LEFT JOIN tab_age_range ta ON tr.range_id = ta.range_id
				LEFT JOIN tab_profession tp ON tr.prof_id = tp.prof_id
				LEFT JOIN tab_edu te ON tr.edu_id = te.edu_id
				LEFT JOIN tab_expense te2 ON tr.expense_id = te2.expense_id
				LEFT JOIN tab_province tp2 ON tr.prov_id = tp2.prov_id
				WHERE resp_id = '. $check_responden[$i]->resp_id .' ');

			$data2 = $this->sitemodel->custom_query('
				SELECT *
				FROM tr_transaction
				WHERE resp_id = '.$check_responden[$i]->resp_id.' ORDER BY quest_id ASC ');

			foreach ($data1 as $row) {
				$temp = array();
				$temp['resp_id']		= $row->resp_id; 
				$temp['resp_name']		= $row->resp_name; 
				$temp['resp_email']		= $row->resp_email; 
				$temp['age_range']		= $row->age_range; 
				$temp['resp_ph']		= $row->resp_ph; 
				$temp['prof_title']		= $row->prof_title; 
				$temp['resp_gender']	= $row->resp_gender; 
				$temp['resp_address']	= $row->resp_address; 
				$temp['edu_title']		= $row->edu_title; 
				$temp['expense_range']	= $row->expense_range; 
				$temp['prov_title']		= $row->prov_title;
				if ($data2 != 0) {
					foreach ($data2 as $row2) {
						$temp[$row2->quest_id] = $row2->answer;
						if ($row2->reason != '') {
							$temp['reason_'.$row2->quest_id] = $row2->reason;
						}
					}
				}
				$temp_resp[]			= $temp;
			}

		}

		$data['conclude'] = $temp_resp;

		// echo json_encode($data['conclude']);die;

		$this->load->view('report', $data);
	}

	public function view_details()
	{
		$msg = array();

		$result = $this->sitemodel->custom_query('
			SELECT tt.resp_id, tr.resp_name, tp.prov_title, tt.quest_id, tq.quest_title, tt.answer, tt.reason
			FROM tr_transaction tt
			LEFT JOIN tab_question tq ON tt.quest_id = tq.quest_id
			LEFT JOIN tab_responden tr ON tt.resp_id = tr.resp_id
			LEFT JOIN tab_province tp ON tr.prov_id = tp.prov_id
			WHERE tt.resp_id = '.$this->input->post("resp_id").'
			');

		$msg['resp_id'] = $result[0]->resp_id;
		$msg['resp_name'] = $result[0]->resp_name;
		$msg['prov_title'] = $result[0]->prov_title;
		foreach ($result as $row) {
			$subdata = array();
			$subdata['id'] = $row->quest_id;
			$subdata['question'] = $row->quest_title;
			$subdata['answer'] = $row->answer;
			$subdata['reason'] = $row->reason;
			$msg['data'][] = $subdata;
		}

		echo json_encode($msg);

	}
}