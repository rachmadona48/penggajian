<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mst_permohonanjabfung extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('infopegawai');
		$this->load->model('mpermohonan','permohonan');
		$this->load->model('mmst_permohonanjabfung','mdl');

		$this->modul = "mst_permohonanjabfung";

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

		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'mpg',0);

		$this->load->view('head/header',$this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('ref/ref_permohonanjabfung',$data);
		$this->load->view('head/footer');
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
		$rs = $this->mdl->dataPermohonan($rdata['start'], $temp, $rdata['length'], $search);

		$data = array();

		foreach($rs as $row){
			$nestedData=array();
			$nestedData[] = $row->ROWNUM;
			$nestedData[] = $row->KET_PERMOHONAN;
			$nestedData[] = "<button class='btn btn-outline btn-xs btn-success' title='edit' onclick='setT2(".$row->ID_PERMOHONAN.",\"".$row->KET_PERMOHONAN."\")'>Lihat</button>";
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										<div class='col-sm-12' align='center'>
											<button class='btn btn-outline btn-xs btn-success' title='edit' onclick='edit(".$row->ID_PERMOHONAN.",$(this).parents(\"tr\"))'><i class='fa fa-pencil-square'></i></button>
										</div>
									</div>
								</div>
							</div>
							";
//			<button class='btn btn-outline btn-xs btn-danger' title='hapus' onclick='del(".$row->ID_PERMOHONAN.")'><i class='fa fa-trash'></i></button>
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

	public function getFormDtl(){
		$fdata=$this->input->post();
		$id_permohonan=$fdata['id_permohonan2'];
		$id_jenis_permohonan=$fdata['id_jenis_permohonan'];
		$ket_jenis_permohonan=$fdata['ket_jenis_permohonan'];

		$data=array(
			"ID_PERMOHONAN" => $id_permohonan,
			"KET_JENIS_PERMOHONAN" => $ket_jenis_permohonan
		);

		//cek ID header
		if ($id_jenis_permohonan == ""){//tambah data
			$nid_jenis_permohonan=$this->mdl->newIdDtl();
			$data["ID_JENIS_PERMOHONAN"]=$nid_jenis_permohonan;
			//tambah header
			$affected_row=$this->mdl->tambah('PERS_JENIS_PERMOHONAN',$data);
		} else {//ubah data
			//set id header
			$pk = array(
				"ID_JENIS_PERMOHONAN" => $id_jenis_permohonan,
			);
			//ubah header
			$affected_row=$this->mdl->ubah('PERS_JENIS_PERMOHONAN',$data,$pk);
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

	public function getForm(){
		$fdata=$this->input->post();
		$id_permohonan=$fdata['id_permohonan'];
		$ket_permohonan=$fdata['ket_permohonan'];

		$data=array(
			"KET_PERMOHONAN" => $ket_permohonan
		);

		//cek ID header
		if ($id_permohonan == ""){//tambah data
			$new_id_permohonan=$this->mdl->newIdHdr();
			$data["ID_PERMOHONAN"]=$new_id_permohonan;
			//tambah header
			$affected_row=$this->mdl->tambah('PERS_REF_PERMOHONAN',$data);
		} else {//ubah data
			//set id header
			$pk = array(
				"ID_PERMOHONAN" => $id_permohonan,
			);
			//ubah header
			$affected_row=$this->mdl->ubah('PERS_REF_PERMOHONAN',$data,$pk);
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
		$id=$this->input->post('id');
		//set id header
		$pkh=array('ID_PERMOHONAN'=>$id);
		//ubah header
		$rs=$this->mdl->hapus('PERS_REF_PERMOHONAN',$pkh);

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

	public function getDataTrxDtl(){
		$result = $this->mdl->dataTrxDtl();

		echo $result;
	}
}