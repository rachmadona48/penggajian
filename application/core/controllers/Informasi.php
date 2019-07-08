<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends CI_Controller {

	private $user = array();

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('minformasi', 'info');
		$this->load->library('inforeferensi');
		$this->load->library('infopegawai');
		$this->load->library('convert');

		if ($this->session->userdata('logged_in')) {

			$session_data = $this->session->userdata('logged_in');
			$this->user['id'] = $session_data['id'];
			$this->user['username'] = $session_data['username'];
			$this->user['user_group'] = $session_data['user_group'];
		} else {
			redirect(base_url() . 'index.php/login', 'refresh');
		}
	}

	public function index() {

		// START THBL
		if (isset($_POST['thbl'])) {
			$bulantahun = $_POST['thbl'];
		} else {
			$bulantahun = date('M Y');
		}
		$thbl = $this->convert->convertNamaBulanTahun($bulantahun);
		// END THBL

		// START Inisial Active Menu
		//$datam['activeMenu'] = "6521";
		$datam['activeMenu'] = "1476";
		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'], 'informasi', 0);
		$datam['inisial'] = 'informasi';
		// END Inisial Active Menu

		$nrk = $this->user['id'];

		//$data['menu_select'] = $this->inforeferensi->getMenuSelectRef();
		$data['menu_select'] = $this->inforeferensi->getMenuSelectInfoNew($this->user['user_group']);
		$data['nrk'] = $nrk;
		$datam['nrk'] = $nrk;
		$datam['user_group'] = $this->user['user_group'];
		$data['user_id'] = $this->user['id'];
		$data['user_group'] = $this->user['user_group'];

		$this->load->view('head/header', $this->user);
		$this->load->view('head/menu', $datam);
		$this->load->view('informasi', $data);
		$this->load->view('head/footer');

	}

	public function generateInformasi() {
		// START REQUEST REFERENSI
		if (isset($_POST['id_informasi'])) {
			$id = $_POST['id_informasi'];
		} else {
			$id = 1;
		}
		// END REQUEST REFERENSI

		$option = "";

		switch ($id) {
		case 'info': //Lokasi Kerja
			$hasil = $this->info->getInformasi();
			break;
		case 'news': //Lokasi Penempatan
			$hasil = $this->info->getNews();
			break;

		default:
			$hasil = "<small class='text-danger'>Tidak Ada Referensi Yang Ditampilkan</small>";
			break;
		}

		$param = array('response' => 'SUKSES', 'result' => $hasil, 'option' => $option);

		echo json_encode($param);
	}

	public function generateForm() {

		if (isset($_POST['form'])) {
			$form = $this->input->post('form');
			$action = $this->input->post('action');
			$key = $this->input->post('key');
		} else {
			$return = array('response' => 'GAGAL', 'err' => 'No Form');
			echo json_encode($return);
			exit();
		}

		$data = $this->generateDataForm($action, $form, $key);
		$widthForm = $data['widthForm'];

		$msg = $this->load->view('admin/form_ref/form_' . $form, $data, true);

		$return = array('response' => 'SUKSES', 'result' => $msg, 'widthForm' => $widthForm, 'action' => $action);
		echo json_encode($return);
		//var_dump($key);
	}

	public function generateDataForm($action, $form, $key = "", $key2 = "", $key3 = "") {
		$data['empty'] = "";
		$data['widthForm'] = "two";
		switch ($form) {
		//case 'info': //Lokasi Kerja
		//$hasil = $this->info->getInformasi();
		//break;
		//case 'news': //Lokasi Penempatan
		//$hasil = $this->info->getNews();
		//break;

		//default:
		//$hasil = "<small class='text-danger'>Tidak Ada Referensi Yang Ditampilkan</small>";
		//break;
		case 'ref_informasi':
			$data['widthForm'] = "two";

			if ($key != "" || $action == "edit") {
				$data['isian'] = $this->info->getDataInfo($key);
			}
			//$data['listKopang'] = $this->infopegawai->getMasterPangkat($key);
			break;

		case 'ref_news':
			$data['widthForm'] = "two";

			if ($key != "" || $action == "edit") {
				$data['isian'] = $this->info->getDataNews($key);
			}
			//$data['listEselon'] = $this->infopegawai->getHistEselon($eselon);
			break;

		default:
			$data['empty'] = "";
			break;
		}

		return $data;
		//var_dump($data);
	}

	function simpanInformasi() {
		$destination = $this->input->post('destination');
		$action = $this->input->post('action');
		$response = false;
		$key = $this->input->post('key');
		$data['user_id'] = $this->user['id'];

		switch ($destination) {
		case 'info':
			if ($action == 'tambah') {
				$response = $this->info->simpan_info($data);
			}
			if ($action == 'edit') {
				$response = $this->info->update_info($data);
			}
			if ($action == 'hapus') {

				$response = $this->info->delete_info($key);
			}
			break;

		case 'news':
			if ($action == 'tambah') {
				$response = $this->info->simpan_news($data);
			}
			if ($action == 'edit') {
				$response = $this->info->update_news($data);
			}
			if ($action == 'hapus') {
				$response = $this->info->delete_news($key);
			}
			break;

		default:
			# code...
			break;
		}
		//var_dump($response);
		if ($response) {
			$return = array('response' => 'SUKSES');
		} else {
			$return = array('response' => 'GAGAL', 'hasil' => 'Key Sudah digunakan');
		}

		echo json_encode($return);
	}

	function getGolByPangkat() {
		$kopang = $this->input->post('kopang');

		$rs = $this->referensi->getMasterPangkat($kopang);

		echo $rs[0]->GOL;
	}

	public function getKocam() {
		$kowil = $this->input->post('kowil');

		$listKocam = $this->inforeferensi->getMasterKocam($kowil);
		$arr = array('response' => 'SUKSES', 'listKocam' => $listKocam);
		echo json_encode($arr);
	}

	public function tesJasper() {
		require "http://10.15.34.33:8080/JavaBridge/java/Java.inc";

		$system = new Java('java.lang.System');
		$class = new JavaClass("java.lang.Class");
		$class->forName("oracle.jdbc.driver.OracleDriver");
		$driverManager = new JavaClass("java.sql.DriverManager");
		$conn = $driverManager->getConnection("jdbc:oracle:thin:@//10.15.34.60:1521/asetdev", "aset", "aset");
		$compileManager = new JavaClass("net.sf.jasperreports.engine.JasperCompileManager");
		// <*untuk menghilangkan Undefined property: java_Client::$cancelProxyCreationTag
		// $compileManager->__client->cancelProxyCreationTag = 0;
		// *>
		$viewer = new JavaClass("net.sf.jasperreports.view.JasperViewer");
		$folderPath = realpath(".") . "/public/report/";
		$report = $compileManager->compileReport($folderPath . "tes2.jrxml");

		$fillManager = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");
		$params = new Java("java.util.HashMap");
		$emptyDataSource = new Java("net.sf.jasperreports.engine.JREmptyDataSource");

		$runmanager = new Java("net.sf.jasperreports.engine.JasperRunManager");

		$jasperPrint = $fillManager->fillReport($report, $params, $conn);
		// echo 1;

		$filename = "tes.pdf";
		$outputPath = realpath(".") . "/assets/pdf/" . $filename;

		$exporter = new Java("net.sf.jasperreports.engine.export.JRPdfExporter");

		$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
		$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);

		$exportManager = new JavaClass("net.sf.jasperreports.engine.JasperExportManager");

		$exporter->exportReport();
		// $path = './path/to/file.pdf';

		if (file_exists($outputPath)) {
			// echo "Create PDF berhasil." . $outputPath;
			// if ($dwl == 1) {
			// 	$this->load->helper('download');
			// 	force_download($outputPath, NULL);
			// } else {
			header('Content-Type: application/pdf');
			header('Content-Disposition: inline; filename=' . $filename);
			header('Content-Transfer-Encoding: binary');
			header('Accept-Ranges: bytes');

			readfile($outputPath);
			//unlink($outputPath);
			// }

		} else {
			echo "Create PDF gagal.";
		}

	}

}
