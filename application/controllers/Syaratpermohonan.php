<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Syaratpermohonan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('infopegawai');
		$this->load->model('mpermohonan','permohonan');
		$this->load->model('msyaratpermohonan','mdl');

		$this->modul = "syaratpermohonan";

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
		$data['ref_permohonan'] = $this->permohonan->get_permohonan();

		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'syaratpermohonan',0);
		$data['menu_select'] = $this->mdl->get_syarat_wajib();

		$this->load->view('head/header',$this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('ref/ref_syaratpermohonan',$data);
		$this->load->view('head/footer');
	}

	function getPermohonan(){
		$rs = $this->mdl->dataPermohonan();

		// Make sure we have a result
		if(count($rs) > 0){
			foreach($rs as $r)
			{
				$data[] = array('id' => $r->ID_PERMOHONAN, 'text' => $r->KET_PERMOHONAN);
			}
		} else {
			$data[] = array('id' => '', 'text' => 'Hasil Kosong');
		}

		// return the result in json
		echo json_encode($data);
	}

	public function getJnsPermohonan(){

		$id_permohonan = $_REQUEST['id_permohonan'];
		$requestsrc=null;
		if(isset($_REQUEST['q']))
		{
			$requestsrc = $_REQUEST['q'];

			$rs = $this->mdl->dataJnsPermohonan($id_permohonan,$requestsrc);	
		}
		else
		{
			$rs = $this->mdl->dataJnsPermohonan($id_permohonan,$requestsrc);
		}
		

		

		// Make sure we have a result
		if(count($rs) > 0){
			foreach($rs as $r)
			{
				$data[] = array('id' => $r->ID_JENIS_PERMOHONAN, 'text' => $r->KET_JENIS_PERMOHONAN);
			}
		} else {
			$data[] = array('id' => '', 'text' => 'Hasil Kosong');
		}

		// return the result in json
		echo json_encode($data);
	}

	function getJabFung(){
		$rs = $this->mdl->dataJabFung();

		// Make sure we have a result
		if(count($rs) > 0){
			foreach($rs as $r)
			{
				$data[] = array('id' => "{$r->KOJAB}@{$r->GOLRU}", 'text' => $r->NAJABL." ({$r->GOL})");
			}
		} else {
			$data[] = array('id' => '', 'text' => 'Hasil Kosong');
		}

		// return the result in json
		echo json_encode($data);
	}

	public function getHdr(){
		$rdata = $this->input->post();
		// var_dump($rdata);exit;
		$id_permohonan = $rdata['id_permohonan'];
		$id_jenis_permohonan = $rdata['id_jenis_permohonan'];
		$id_kojabf = $rdata['id_kojabf'];

		$rs=$this->mdl->dataHdr($id_permohonan, $id_jenis_permohonan, $id_kojabf);

		echo json_encode($rs);
	}

	public function getPersyaratan()
	{
		$rdata = $this->input->post();
		$id_permohonan = $rdata['id_permohonan'];
		$id_jenis_permohonan = $rdata['id_jenis_permohonan'];
		$golru = $rdata['golru'];
		$id_kojabf = $rdata['id_kojabf'];

		$totalData = $this->mdl->totPersyaratan($id_permohonan, $id_jenis_permohonan, $id_kojabf);
		$totalFiltered = $totalData;
		$temp =$rdata['start']+$rdata['length'];
		$rs = $this->mdl->dataPersyaratan($id_permohonan, $id_jenis_permohonan, $id_kojabf, $golru, $rdata['start'], $temp, $rdata['length']);

		$data = array();

		foreach($rs as $row){
			$nestedData=array();
			$nestedData[] = $row->NO_SYARAT;
			$nestedData[] = $row->KET_SYARAT;
			$nestedData[] = $row->INIT_SYARAT;
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										<div class='col-sm-12' align='center'>
											<button class='btn btn-outline btn-xs btn-success' title='edit' onclick='editSyarat(".$row->NO_SYARAT.",".$row->ID_SYARAT_DTL.",$(this).parents(\"tr\"))'><i class='fa fa-pencil-square'></i></button>
											<button class='btn btn-outline btn-xs btn-danger' title='hapus' onclick='delSyarat(".$row->ID_SYARAT_DTL.")'><i class='fa fa-pencil-square'></i></button>
										</div>
									</div>
								</div>
							</div>
							";
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

	public function validInitSyarat(){
		$post = $this->input->post();
		if(is_null($post['id_syarat_hdr'])){
			// $init_syarat=$this->input->post('init_syarat');
			$rs=$this->mdl->dataInitSyarat($post['init_syarat']);
			if ($rs==0){
				$result_msg = array(
					'success'=>true,
					'msg' => "Next"
				);
			} else {
				$result_msg = array(
					'success'=>false,
					'msg' => "Inisial Nama File sudah digunakan. Harap ganti dengan nama lain."
				);
			}
		}else{
			$result_msg = array(
				'success'=>true,
				'msg' => "Next"
			);
		}
		echo json_encode($result_msg);
	}

	public function getForm(){
		$fdata=$this->input->post();
		$id_syarat_hdr=isset($fdata['id_syarat_hdr']) ? $fdata['id_syarat_hdr'] : $fdata['id_syarat_hdr1'];
		$id_syarat_dtl=isset($fdata['id_syarat_dtl']) ? $fdata['id_syarat_dtl'] : $fdata['id_syarat_dtl1'];
		//var_dump(substr($fdata['id_kojabf1'],0,6));exit;
		$dataHdr=array(
			"ID_SYARAT_HDR" => $id_syarat_hdr,
			"ID_PERMOHONAN" => isset($fdata['id_permohonan']) ? $fdata['id_permohonan'] : $fdata['id_permohonan1'],
			"ID_JENIS_PERMOHONAN" => isset($fdata['id_jenis_permohonan']) ? $fdata['id_jenis_permohonan'] : $fdata['id_jenis_permohonan1'],
			//"ID_KOJABF" => isset($fdata['id_kojabf']) ? $fdata['id_kojabf'] : $fdata['id_kojabf1'],
			"ID_KOJABF" => isset($fdata['id_kojabf']) ? $fdata['id_kojabf'] : substr($fdata['id_kojabf1'],0,6),
			"DASAR_HUKUM"	=> isset($fdata['dasar_hukum']) ? $fdata['dasar_hukum'] : $fdata['dasar_hukum1'],
			"MEKANISME"	=>	isset($fdata['mekanisme']) ? $fdata['mekanisme'] : $fdata['mekanisme1']
		);
		if(isset($fdata['syarat_wajib'])){
			$dataDtl=array(
				"ID_SYARAT_HDR" => $id_syarat_hdr,
				"ID_SYARAT_DTL" => $id_syarat_dtl,
				// "SYARAT_WAJIB" => $fdata['syarat_wajib']
			);
		}else{
			$dataDtl=array(
				"ID_SYARAT_HDR" => $id_syarat_hdr,
				"ID_SYARAT_DTL" => $id_syarat_dtl,
				"NO_SYARAT" => $fdata['no_syarat'],
				// "NO_SYARAT" => 7,
				"KET_SYARAT" => $fdata['ket_syarat'],
				"INIT_SYARAT"	=> $fdata['init_syarat']
			);
		}
		// var_dump(count($dataDtl['SYARAT_WAJIB']));exit;
		//cek ID header
		if ($id_syarat_hdr == ""){//tambah data header
			$new_id_hdr=$this->mdl->newIdHdr();

			//masukan id header di header detail
			$dataHdr['ID_SYARAT_HDR']=$new_id_hdr;
			
			$dataDtl['ID_SYARAT_HDR']=$new_id_hdr;
			//tambah header
			$affected_rowh=$this->mdl->tambah('PERS_SYARAT_HDR',$dataHdr);
			//jika tambah header berhasil
			if ($affected_rowh>0){
				if ($id_syarat_dtl == ""){
					// $new_id_dtl=$this->mdl->newIdDtl();
					// $dataDtl['ID_SYARAT_DTL']=$new_id_dtl;
					if(isset($fdata['syarat_wajib'])){
						for ($i=0; $i < count($fdata['syarat_wajib']); $i++) { 
							//tambah detil
							$key = $fdata['syarat_wajib'][$i];
							$ket_syarat = $this->mdl->get_master_syarat($key);
							// var_dump($ket_syarat);exit;
							$new_id_dtl=$this->mdl->newIdDtl();
							$dataDtl['ID_SYARAT_DTL']=$new_id_dtl;
							$data = array(
								"ID_SYARAT_HDR" => $dataDtl['ID_SYARAT_HDR'],
								"ID_SYARAT_DTL" => $dataDtl['ID_SYARAT_DTL'],
								"NO_SYARAT" => $i+1,
								"KET_SYARAT" => $ket_syarat->KET_SYARAT_WAJIB,
								"INIT_SYARAT" => $ket_syarat->INIT_SYARAT_WAJIB
							);
							// var_dump($data);exit;
							$affected_rowd=$this->mdl->tambah('PERS_SYARAT_DTL',$data);
						}	
					}else{
						//tambah detil
						$affected_rowd=$this->mdl->tambah('PERS_SYARAT_DTL',$dataDtl);	
					}
				} else {
					//set pk detil
					$pkd=array('ID_SYARAT_DTL'=>$id_syarat_dtl);
					//ubah detil
					$affected_rowd=$this->mdl->ubah('PERS_SYARAT_DTL',$dataDtl,$pkd);
				}

			}
		} else {//ubah data header
			//set id header
			$pkh=array('ID_SYARAT_HDR'=>$id_syarat_hdr);
			//ubah header
			$affected_rowh=$this->mdl->ubah('PERS_SYARAT_HDR',$dataHdr,$pkh);
			//jika tambah header berhasil
			if ($affected_rowh > 0){
				if ($id_syarat_dtl == ""){
					$new_id_dtl=$this->mdl->newIdDtl();
					$dataDtl['ID_SYARAT_DTL']=$new_id_dtl;
					//tambah detil
					$affected_rowd=$this->mdl->tambah('PERS_SYARAT_DTL',$dataDtl);
				} else {
					//set pk detil
					$pkd=array('ID_SYARAT_DTL'=>$id_syarat_dtl);
					//ubah detil
					$affected_rowd=$this->mdl->ubah('PERS_SYARAT_DTL',$dataDtl,$pkd);
				}

			}
		}

		if ($affected_rowh>0 || $affected_rowd>0){
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

	public function simpanHdr(){
		$fdata=$this->input->post();
		
		$id_kojabf = explode('@', $fdata['id_kojabf']);
		// var_dump($id_kojabf[0]);exit;
		$id_syarat_hdr=$fdata['id_syarat_hdr'];

		$dataHdr=array(
			"ID_SYARAT_HDR" => $id_syarat_hdr,
			"ID_PERMOHONAN" => $fdata['id_permohonan'],
			"ID_JENIS_PERMOHONAN" => $fdata['id_jenis_permohonan'],
			"ID_KOJABF" => $id_kojabf[0],
			"DASAR_HUKUM"	=> $fdata['dasar_hukum'],
			"MEKANISME"	=>	$fdata['mekanisme']
		);
		
		if(!is_null($id_syarat_hdr)){
			//set id header

			$pkh=array('ID_SYARAT_HDR'=>$id_syarat_hdr);
			//ubah header
			var_dump($pkh);exit;
			$affected_row=$this->mdl->ubah('PERS_SYARAT_HDR',$dataHdr,$pkh);
			var_dump($affected_row);exit;
		}
		
		if ($affected_row>0){
			$result_msg = array(
				'success'=>true,
				'msg' => "Simpan berhasil.",
				'id' => $id_syarat_hdr
			);
		} else {
			$result_msg = array(
				'success'=>false,
				'msg' => "Simpan gagal."
			);
		}


		echo json_encode($result_msg);
	}

	public function hapusSyarat(){
		$id_syarat_dtl=$this->input->post('id_syarat_dtl');
		//set id header
		$pkh=array('ID_SYARAT_DTL'=>$id_syarat_dtl);
		//ubah header
		$rs=$this->mdl->hapus('PERS_SYARAT_DTL',$pkh);

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
		

