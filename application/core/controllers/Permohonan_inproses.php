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
		//$totalFiltered = count($rs);
		//var_dump(count($rs));exit;
		$data = array();

		foreach($rs as $row){
			$nestedData=array();
			$nestedData[] = $row->ROWNUM;
			$nestedData[] = $row->KET_PERMOHONAN;
			$nestedData[] = $row->KET_JENIS_PERMOHONAN;
			$nestedData[] = $row->NO_SURAT_PERMOHONAN;
			$nestedData[] = $row->TGL_SURAT_PERMOHONAN;
			$nestedData[] = $row->TGL_PERMOHONAN;
			$nestedData[] = $row->NRK;
			$nestedData[] = $row->NAMA;
			$nestedData[] = $row->GOL;
//			$nestedData[] = $row->NAJABL;
			$nestedData[] = $row->NEW_JAB;
			if($row->STATUS_BERJALAN == 1){
				$nestedData[] = "<div class='row'>
									<div class='col-sm-12' align='center'>
										<small class='label label-primary'>Disetujui
										".$row->KET_USER_PRIORITY."
										</small>
									</div>
								</div>";
			}elseif($row->STATUS_BERJALAN == 2){
				$nestedData[] = "<div class='row'>
									<div class='col-sm-12' align='center'>
										<small class='label label-warning'>Diproses ".$row->KET_USER_PRIORITY."</small>
									</div>
								</div>";

			}elseif($row->STATUS_BERJALAN == 3){
				if($row->KET_USER_PRIORITY == ""){
					$nestedData[] = "<div class='row'>
										<div class='col-sm-12' align='center'>
											<small class='label label-danger'>Ditolak SKPD</small>
										</div>
									</div>";
				}else{
					$nestedData[] = "<div class='row'>
										<div class='col-sm-12' align='center'>
											<small class='label label-danger'>Ditolak ".$row->KET_USER_PRIORITY."</small>
										</div>
									</div>";
				}
			}elseif($row->STATUS_BERJALAN == ""){
				// $nestedData[] = $row->STATUS_APPROVAL;
				if($row->STATUS_APPROVAL == 1){
					$nestedData[] = "<div class='row'>
									<div class='col-sm-12' align='center'>
										<small class='label label-primary'>Disetujui SKPD</small>
									</div>
								</div>";
				}elseif($row->STATUS_APPROVAL == 2){
					$nestedData[] = "<div class='row'>
									<div class='col-sm-12' align='center'>
										<small class='label label-warning'>Diproses SKPD</small>
									</div>
								</div>";
				}else{
					$nestedData[] = "<div class='row'>
									<div class='col-sm-12' align='center'>
										<small class='label label-danger'>Ditolak SKPD</small>
									</div>
								</div>";
				}
			}
			if($row->ID_TRX_HDR == "")
			{
				$temp_id_trx_hdr = 0;
 			}
			else
			{
				$temp_id_trx_hdr = $row->ID_TRX_HDR;
			}
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										<div class='col-sm-12' align='center'>
											<button class='btn btn-outline btn-xs btn-info' onclick='lihatStatus(".$row->ID_TRX.",".$temp_id_trx_hdr.",$(this).parents(\"tr\"))'>Lacak</button>
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

		// var_dump($id_trx_hdr);exit;	
		// var_dump($id_trx);exit();


		$trs = $this->mdl->dataTracking($id_trx);
		

		if ($id_trx_hdr==0) {
			$NO_SURAT_PERMOHONAN="";
			$detail = $this->mdl->detailPgw($id_trx);
		} else {
			$rts = $this->mdl->dataTracking2($id_trx_hdr);
			$NO_SURAT_PERMOHONAN=	$rts->NO_SURAT_PERMOHONAN;
			$detail = $this->mdl->detail($id_trx_hdr);
		}

		$KET_SRT_PERMOHONAN = '<strong class="pull-right">';
		if ($NO_SURAT_PERMOHONAN != ""){
			$KET_SRT_PERMOHONAN .= 'No Surat Permohonan : ';
		}

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
							
						<p class="m-b-xs"><strong class="pull-left">NRK : ';
		echo $trs->NRK;
		echo ' </strong>';
		echo $KET_SRT_PERMOHONAN;
		echo $NO_SURAT_PERMOHONAN;
		echo ' </strong></p> <br/>
						<p class="m-b-xs"><strong>Nama : ';  echo $trs->NAMA;  echo ' </strong></p>
						</div>
						<div class="modal-body">';

							$pointbreak = 1;
							foreach ($detail as $key){
							// echo $key->STATUS;
							// ECHO $key->URUTAN;

							$cek_sts = $this->mdl->cek_status($id_trx);
							$URUTAN_TOLAK = 0;
								$KET_TOLAK = 0;
							if($cek_sts){
								$URUTAN_TOLAK = $cek_sts->URUTAN_TOLAK;
								$KET_TOLAK =  $cek_sts->KETERANGAN;
							}

							// echo $URUTAN_TOLAK;

													
						echo '	
									<div class="timeline-item">
										<div class="row">
											<div class="col-xs-3 date">';
											if($id_trx_hdr == 0)
											{	
												if($key->URUTAN == $URUTAN_TOLAK){
													echo '<i class="fa fa-times"></i>';
												}elseif($key->URUTAN < $URUTAN_TOLAK){
													echo '<i class="fa fa-circle-o"></i>';
													if($pointbreak == 1)
													{
														echo '<i class="fa fa-bullseye"></i>';
													}
												}elseif($key->URUTAN > $URUTAN_TOLAK){
													if($pointbreak == 1)
													{
														echo '<i class="fa fa-bullseye"></i>';
													 } else {
														echo '<i class="fa fa-circle-o"></i>';
													}
												}
											}
											else
											{	
												if($key->URUTAN == $URUTAN_TOLAK){
													echo '<i class="fa fa-times"></i>';
												}elseif($key->URUTAN < $URUTAN_TOLAK){
													if($key->STATUS == 1)
													{
														echo '<i class="fa fa-check"></i>';
													}
													elseif($key->STATUS == 2)
													{
														echo '<i class="fa fa-bullseye"></i>';
													}
													// elseif($key->STATUS == 3)
													// {
													// 	// echo $key->STATUS;
													// 	echo '<i class="fa fa-times"></i>';
													// }
													else
													{
														echo '<i class="fa fa-circle-o"></i>';
													}
												}elseif($key->URUTAN > $URUTAN_TOLAK){
													if ($URUTAN_TOLAK==0){
														if($key->STATUS == 1)
														{
															echo '<i class="fa fa-check"></i>';
														}
														elseif($key->STATUS == 2)
														{
															echo '<i class="fa fa-bullseye"></i>';
														}
//													// elseif($key->STATUS == 3)
//													// {
//													// 	// echo $key->STATUS;
//													// 	echo '<i class="fa fa-times"></i>';
//													// }
														else
														{
															echo '<i class="fa fa-circle-o"></i>';
														}
													} else {
														echo '<i class="fa fa-circle-o"></i>';
													}

												}
												
											}
									echo '  </div>
											<div class="col-xs-7 content no-top-border">
												<p class="m-b-xs"><strong>'; echo $key->DESKRIPSI_SOP; echo '</strong></p>';

												


												if($id_trx_hdr == 0){
													echo '<p></p>';
												}else{
													if($key->NO_SURAT == ""){
														echo '<p></p>';
													}else {
														if($key->URUTAN > $URUTAN_TOLAK){
															if ($URUTAN_TOLAK==0){
																echo '<p> No Surat : '; echo $key->NO_SURAT; echo'</p>';
															} else {
																echo '<p></p>';
															}

														} else {
															echo '<p> No Surat : '; echo $key->NO_SURAT; echo'</p>';
														}

													}
														
												}

												if ($id_trx_hdr == 0) {
													echo '<p></p>';
												}else{
													if($key->TGL_SURAT == ""){
														echo '<p></p>';
													}else{
														if($key->URUTAN > $URUTAN_TOLAK){
															if ($URUTAN_TOLAK==0){
																echo '<p> Tanggal Surat : '; echo $key->TGL_SURAT; echo'</p>';
															} else {
																echo '<p></p>';
															}

														} else {
															echo '<p> Tanggal Surat : '; echo $key->TGL_SURAT; echo'</p>';
														}

													}
													
												}
										
												if($id_trx_hdr == 0 ){
													if($pointbreak == 1)
													{	
														if($key->URUTAN == $URUTAN_TOLAK){
															echo '<p>Status : <label class="badge badge-danger">Tolak</label></p>';
															echo '<p>Keterangan : '; echo $KET_TOLAK; echo'</p>';
														}elseif($key->URUTAN < $URUTAN_TOLAK){
															if($key->STATUS == 1){
															echo '<p>Status : <label class="badge badge-success">Disetujui</label></p>';
															}elseif ($key->STATUS == 2) {
															echo '<p>Status : <label class="badge badge-warning">Proses</label></p>';
															// }elseif($key->STATUS == 3){
															// echo '<p>Status : <label class="badge badge-danger">Tolak</label></p>';
															}else{
															echo '<p></p>';
															}
														}elseif($key->URUTAN > $URUTAN_TOLAK){
															if($key->URUTAN > $URUTAN_TOLAK){
																if ($URUTAN_TOLAK==0){
																echo '<p>Status : <label class="badge badge-warning">Proses</label></p>';
																	} else {
																		echo '<p></p>';
																	}

																} else {
																	echo '<p>Status : <label class="badge badge-warning">Proses</label></p>';
																}
//															if($key->STATUS == 1){
//															echo '<p>Status : <label class="badge badge-success">Approve1</label></p>';
//															}elseif ($key->STATUS == 2) {
//															echo '<p>Status : <label class="badge badge-warning">Proses</label></p>';
//															// }elseif($key->STATUS == 3){
//															// echo '<p>Status : <label class="badge badge-danger">Tolak</label></p>';
//															}else{
															echo '<p></p>';
//															}
														}
														
													}
													else
													{
														echo '<p></p>';
													}
													
													
												}
												else
												{
													if($key->URUTAN == $URUTAN_TOLAK){
															echo '<p>Status : <label class="badge badge-danger">Tolak</label></p>';
															echo '<p>Keterangan : '; echo $KET_TOLAK; echo'</p>';
														}elseif($key->URUTAN < $URUTAN_TOLAK){
															if($key->STATUS == 1){
															echo '<p>Status : <label class="badge badge-success">Disetujui</label></p>';
															}elseif ($key->STATUS == 2) {
															echo '<p>Status : <label class="badge badge-warning">Proses</label></p>';
															// }elseif($key->STATUS == 3){
															// echo '<p>Status : <label class="badge badge-danger">Tolak</label></p>';
															}else{
															echo '<p></p>';
															}
														}elseif($key->URUTAN > $URUTAN_TOLAK){
															if ($URUTAN_TOLAK==0){
																if($key->STATUS == 1){
																	echo '<p>Status : <label class="badge badge-success">Disetujui</label></p>';
																}elseif ($key->STATUS == 2) {
																	echo '<p>Status : <label class="badge badge-warning">Proses</label></p>';
																	// }elseif($key->STATUS == 3){
																	// echo '<p>Status : <label class="badge badge-danger">Tolak</label></p>';
																}else{
																	echo '<p></p>';
																}
															} else {
																echo '<p></p>';
															}

														}
												}


												if ($id_trx_hdr == 0 ) {
													echo '<p></p>';
												}else{
//													if($key->KETERANGAN == ""){
//														echo '<p></p>';
//													}else{
														if($key->URUTAN == $URUTAN_TOLAK){
															echo '<p>Keterangan : '; echo $KET_TOLAK; echo'</p>';
														}elseif($key->URUTAN < $URUTAN_TOLAK){
															if ($key->KETERANGAN ==""){
																echo '<p></p>';
															} else {
																echo '<p>Keterangan : '; echo $key->KETERANGAN; echo'</p>';
															}
														}elseif($key->URUTAN > $URUTAN_TOLAK){
															if ($key->KETERANGAN ==""){
																echo '<p></p>';
															} else {
																echo '<p>Keterangan : '; echo $key->KETERANGAN; echo'</p>';
															}

														}

//													}
													
												}
								

							echo '			</div>
										</div>
									</div>';
									$pointbreak ++;
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
		

