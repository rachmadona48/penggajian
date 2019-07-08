<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan_inproses extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('infopegawai');
		$this->load->model('mpermohonan','permohonan');
		$this->load->model('mpermohonan_inproses','mdl');

		$this->modul = "permohonan_inproses";

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
		$data['kojab'] = $this->mdl->dataJabfungref();

		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'pip',0);

		$this->load->view('head/header',$this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('permohonan_inproses',$data);
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
		$totalData = $this->mdl->totPermohonan();
		$totalFiltered = $totalData;
		$temp =$rdata['start']+$rdata['length'];
		$search =$rdata['search']['value'];
		$rs = $this->mdl->dataPermohonan($rdata['start'], $temp, $rdata['length'], $search);

		$data = array();

		foreach($rs as $row){
			$nestedData=array();
			$nestedData[] = $row->ROWNUM;
			$nestedData[] = $row->KET_PERMOHONAN;
			$nestedData[] = $row->KET_JENIS_PERMOHONAN;
			$nestedData[] = $row->NO_SURAT_PERMOHONAN;
			$nestedData[] = $row->TGL_SURAT_PERMOHONAN;
			$nestedData[] = $row->NRK;
			$nestedData[] = $row->NAMA;
			$nestedData[] = $row->NRK;
			$nestedData[] = $row->NAJABL;
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										<div class='col-sm-12' align='center'>
											<button class='btn btn-outline btn-xs btn-info' onclick='lihatStatus(".$row->ID_TRX.",".$row->ID_TRX_HDR.",$(this).parents(\"tr\"))'>Lihat</button>
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

	// public function trackingPermohonan(){
	// 	$id_trx = $this->input->post('id_trx');
	// 	$id_trx_hdr = $this->input->post('id_trx_hdr');

	// 	// var_dump($id_trx_hdr);
	// 	// var_dump($id_trx);exit();

	// 	$trs = $this->mdl->dataTracking($id_trx)->row();
	// 	$rts = $this->mdl->dataTracking2($id_trx_hdr)->row();

	// 	if($trs && $rts){
	// 		$respone = "SUKSES";

	// 		$return = array('respone' => $respone, 'NRK' => $trs->NRK, 'NO_SURAT_PERMOHONAN' => $rts->NO_SURAT_PERMOHONAN);

	// 	}else{
	// 		$respone = "GAGAL";

	// 		$return = array('respone' => $respone);
	// 	}
	
	// 	echo json_encode($return);
		

	// }

	public function trackingPermohonan(){
		$id_trx = $this->input->post('id_trx');
		$id_trx_hdr = $this->input->post('id_trx_hdr');

		// var_dump($id_trx_hdr);
		// var_dump($id_trx);exit();

		$trs = $this->mdl->dataTracking($id_trx);
		$rts = $this->mdl->dataTracking2($id_trx_hdr);
		$detail = $this->mdl->detail($id_trx_hdr);

		// if($trs && $rts){
			

		// 	$return = array('NRK' => $trs->NRK, 'NO_SURAT_PERMOHONAN' => $rts->NO_SURAT_PERMOHONAN);

		// }else{

		// 	$return = array();
		// }
	
		// echo json_encode($return);
		echo $trs->NRK;
		echo '
			
					<div class="modal-content animated fadeIn" id="tracking">
						<div class="modal-header">
							
						<p class="m-b-xs"><strong class="pull-left">NRK : ';  echo $trs->NRK;  echo ' </strong>
						<strong class="pull-right">No Surat Permohonan : '; echo $rts->NO_SURAT_PERMOHONAN;  echo ' </strong></p> <br/>
						<p class="m-b-xs"><strong>Nama : ';  echo $trs->NAMA;  echo ' </strong></p>
						</div>
						<div class="modal-body">';

						foreach ($detail as $key){
													
						echo '	
									<div class="timeline-item">
										<div class="row">
											<div class="col-xs-3 date">';
											if($key->STATUS == 1){
												echo '<i class="fa fa-check"></i>';
											}elseif($key->STATUS == 2){
												echo '<i class="fa fa-bullseye"></i>';
											}else{
												echo '<i class="fa fa-times"></i>';
											}
									echo '  </div>
											<div class="col-xs-7 content no-top-border">
												<p class="m-b-xs"><strong>'; echo $key->DESKRIPSI_SOP; echo '</strong></p>';
												if($key->NO_SURAT == null){
													echo '<p></p>';
												}else{
													echo '<p> No Surat : '; echo $key->NO_SURAT; echo'</p>';	
												}

												if ($key->TGL_SURAT == null) {
													echo '<p></p>';
												}else{
													echo '<p> Tanggal Surat : '; echo $key->TGL_SURAT; echo'</p>';
												}
										
												if($key->STATUS == null){
													echo '<p></p>';
												}elseif($key->STATUS == 1){
													echo '<p>Status : <label class="badge badge-success">Approve</label></p>';
												}elseif ($key->STATUS == 2) {
													echo '<p>Status : <label class="badge badge-warning">Proses</label></p>';
												}else{
													echo '<p>Status : <label class="badge badge-danger">Tolak</label></p>';
												}

												if ($key->KETERANGAN == null ) {
													echo '<p></p>';
												}else{
													echo '<p>Keterangan : '; echo $key->KETERANGAN; echo'</p>';
												}
								

							echo '			</div>
										</div>
									</div>';
						}

				echo '	</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				
		';
		

	}


	public function EditBadan(){
		$BadanID = $this->input->post('BadanID');

		$result = $this->model_bu->get_badan_usaha($BadanID)->row();

		if($result){
			$respone = "SUKSES";

			$return = array('respone' => $respone, 'BadanID' => $result->BadanID, 'NamaPT' => $result->NamaPT, 'no_siup' => $result->no_siup, 'no_tdp' => $result->no_tdp,'jenis' => $result->jenis,'provinsi' => $result->ProvinsiID,'KabupatenID' => $result->KabupatenID,'alamat' => $result->Alamat,'nama_kontak' => $result->nama_kontak,'No_tlp' => $result->No_tlp,'email' => $result->Email,'usergroup' => $result->Id_KategoriBU);

		}else{
			$respone = "GAGAL";

			$return = array('respone' => $respone);
		}
	
		echo json_encode($return);	

	}

}
		

