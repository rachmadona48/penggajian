<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mst_jabfung extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('infopegawai');
		$this->load->model('mpermohonan','permohonan');
		$this->load->model('mmst_jabfung','mdl');

		$this->modul = "mst_jabfung";

		if ($this->session->userdata('logged_in')) {

			$session_data       = $this->session->userdata('logged_in');
			$this->user['id']     	= $session_data['id'];
			$this->user['username']  	= $session_data['username'];
			$this->user['user_group']     = $session_data['user_group'];
		}else{
			redirect(base_url().'index.php/login', 'refresh');
		}
	}

	public function index()
	{
		$tgl_sekarang = date("Y-m-d");
		$tgl = date('Y-m-d', strtotime($tgl_sekarang));
		$tglproses = date('Y-m-d', strtotime($tgl_sekarang));

		//var_dump($koloks);
		$data = array(
			'tgl' => $tgl,
			'tglproses' => $tglproses
		);

		$data['tingkat'] = $this->mdl->dataTingkat();
		$data['jenjab'] = $this->mdl->dataJenjab();
		$data['golru'] = $this->mdl->dataGolru();
		$data['kojab'] = $this->mdl->dataJabfungref();

		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'mpg',0);

		$this->load->view('head/header',$this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('ref/ref_jabfung144',$data);
		$this->load->view('head/footer');
	}

	function getJenjab(){
		$tingkat = $this->input->post('tingkat');
		$jenjab=$this->mdl->dataJenjab1($tingkat);
		$html = "";
		foreach($jenjab as $row):
			$html .= '<option value="'.$row->ID_JENJAB.'">'.$row->NM_JENJAB.'</option>';
		endforeach;

		echo $html;
	}

	function getGolru(){
		$jenjab = $this->input->post('jenjab');
		$golru=$this->mdl->dataGolru1($jenjab);
		$html = "";
		foreach($golru as $row):
			$html .= '<option value="'.$row->KOPANG.'">'.$row->GOL.'</option>';
		endforeach;

		echo $html;
	}

	function getJabFungref(){
		$rs = $this->mdl->dataJabfungref();

		// Make sure we have a result
		if(count($rs) > 0){
			foreach($rs as $r)
			{
				$data[] = array('id' => $r->KOJAB, 'text' => $r->NAJABL);
			}
		} else {
			$data[] = array('id' => '', 'text' => 'Hasil Kosong');
		}

		// return the result in json
		echo $data;
	}

	public function getAll()
	{
		$rdata = $this->input->post();
		$totalData = $this->mdl->totJabFung();
		$totalFiltered = $totalData;
		$temp =$rdata['start']+$rdata['length'];
		$search =$rdata['search']['value'];
		$rs = $this->mdl->dataJabfung($rdata['start'], $temp, $rdata['length'], $search);

		$data = array();

		foreach($rs as $row){
			$nestedData=array();
			$nestedData[] = $row->ROWNUM;
			$nestedData[] = $row->NAJABL;
			$nestedData[] = $row->NM_TINGKAT;
			$nestedData[] = $row->NM_JENJAB;
			$nestedData[] = $row->USIA_PENSIUN." th";
			$nestedData[] = $row->USIA_PENGANGKATAN." th";
			$nestedData[] = $row->GOL;
			$nestedData[] = $row->NM_JAB;

			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										<div class='col-sm-12' align='center'>
											<button class='btn btn-outline btn-xs btn-success' title='edit' onclick='edit(".$row->KOJAB.",".$row->TINGKAT.",".$row->JENJAB.",".$row->GOLRU.",\"".$row->NAJABL."\",\"".$row->USIA_PENSIUN."\",\"".$row->USIA_PENGANGKATAN."\")'><i class='fa fa-pencil-square'></i></button>
										</div>
									</div>
								</div>
							</div>
							";
//			<button class='btn btn-outline btn-xs btn-danger' title='hapus' onclick='del(".$row->KOJAB.")'><i class='fa fa-pencil-square'></i></button>
//			$nestedData[] = $row->ID_SYARAT_DTL;
			$data[] = $nestedData;
		}

		$json_data = array(
			"draw"            => intval( $rdata['draw'] ),
			"recordsTotal"    => intval( $totalData ),
			"recordsFiltered" => intval( $totalFiltered ),
			"data"            => $data
		);

		echo json_encode($json_data);
	}

	public function getForm(){
		$fdata=$this->input->post();
		$kojab0=$fdata['kojab0'];
		$kojab=$fdata['kojab'];
		$najabl=$fdata['najabl'];
		$tingkat=$fdata['tingkat'];
		$jenjab=$fdata['jenjab'];
		$usia_pensiun=$fdata['usia_pensiun'];
		$usia_pengangkatan=$fdata['usia_pengangkatan'];
		$golru=$fdata['golru'];


		$data=array(
			"KOJAB" => $kojab,
			"NAJABL" => $najabl,
			"TINGKAT" => $tingkat,
			"JENJAB" => $jenjab,
			"USIA_PENSIUN" => $usia_pensiun,
			"USIA_PENGANGKATAN" => $usia_pengangkatan,
			"GOLRU" => $golru
		);

		//cek ID header
		if ($kojab0 == ""){//tambah data
			//tambah header
			$affected_row=$this->mdl->tambah('PERS_MASTER_KOJABF',$data);
		} else {//ubah data
			//set id header
			$pk = array(
				"KOJAB" => $kojab0,
			);
			//ubah header
			$affected_row=$this->mdl->ubah('PERS_MASTER_KOJABF',$data,$pk);
		}

		if ($affected_row>0){
			$result_msg = array(
				'success'=>true,
				'msg' => "Simpan berhasil."
			);
		} else {
			$result_msg = array(
				'success'=>false,
				'msg' => "Simpan gagal."
			);
		}


		echo json_encode($result_msg);
	}

	public function hapus(){
		$kojab=$this->input->post('id');
		//set id header
		$pkh=array('KOJAB'=>$kojab);
		//ubah header
		$rs=$this->mdl->hapus('PERS_MASTER_KOJABF',$pkh);

		if ($rs>0){
			$result_msg = array(
				'success'=>true,
				'msg' => "Hapus berhasil."
			);
		} else {
			$result_msg = array(
				'success'=>false,
				'msg' => "Hapus gagal."
			);
		}

		echo json_encode($result_msg);
	}
}
		

