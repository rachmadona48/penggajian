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

		$menuid='1476';  
        $cekaksesmenu = $this->infopegawai->cekaksesmenu($menuid,$this->user['user_group']);

        if($cekaksesmenu == '1')
        {
			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu', $datam);
			$this->load->view('informasi', $data);
			$this->load->view('head/footer');
		}
        else
        {
            $this->load->view('403');
        } 

	}

	public function generateInformasi() {
		// echo 'gen gaji';
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
		 // case 'banner': //Berita
   //          $hasil = $this->info->getBanner();
   //          break;
            

		default:
			$hasil = "<small class='text-danger'>Tidak Ada Referensi Yang Ditampilkan</small>";
			break;
		}

		$param = array('response' => 'SUKSES', 'result' => $hasil, 'option' => $option);

		echo json_encode($param);
	}

	public function generateForm() {
		// echo 'gen form gaji';exit();
		if (isset($_POST['form'])) {
			$form = $this->input->post('form');
			$action = $this->input->post('action');
			$key = $this->input->post('key');
		} else {
			$return = array('response' => 'GAGAL', 'err' => 'No Form');
			echo json_encode($return);
			exit();
		}

		// echo '111';

		$data = $this->generateDataForm($action, $form, $key);

		// echo '222';
		$data['action'] = $action;
		$widthForm = $data['widthForm'];

		// echo '3333 '.$form;
		$msg = $this->load->view('admin/form_ref/form_' . $form, $data, true);
		// echo '444';exit();
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
			$data['newid'] = $this->info->generatenewID()->NEWID;
			//$data['listKopang'] = $this->infopegawai->getMasterPangkat($key);
			break;

		case 'ref_news':
			$data['widthForm'] = "two";

			if ($key != "" || $action == "edit") {
				$data['isian'] = $this->info->getDataNews($key);
			}
			//$data['listEselon'] = $this->infopegawai->getHistEselon($eselon);
			break;
		case 'ref_banner':
                $data['widthForm'] = "one";
                
                if($key != "" || $action == "edit"){
                    $data['isian'] = $this->info->getDataBanner($key);
                    
                } 
                
                $data['newid'] = $this->info->generatenewID()->NEWID;
                 break;

		default:
			$data['empty'] = "";
			break;
		}

		return $data;
		//var_dump($data);
	}

	function simpanInformasi_penggajian() {
		// echo 'simpan gaji';exit();
		$destination = $this->input->post('destination');
		$action = $this->input->post('action');
		$response = false;
		$key = $this->input->post('key');
		$data['id_user'] = $this->user['id'];

		switch ($destination) {
		case 'info':
			if ($action == 'tambah') {
				$response = $this->info->simpan_info($data);
			}
			if ($action == 'edit') {
				$response = $this->info->update_info($data);
			}
			if ($action == 'hapus') {
				// echo 'hapus';exit();
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

		// case 'banner':
  //               if ($action == 'tambah') {
  //                   $response = $this->info->simpan_banner($data);
  //               }
  //               if ($action == 'edit') {
  //                   $response = $this->info->update_banner($data);
  //               }
  //               if ($action == 'hapus') {
  //                   $response = $this->info->delete_banner($key);
  //               }
  //               break;

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

	function cekFileServer() {
        
        if ($this->input->post()) {
            $post = $this->input->post();
            $id = $post['id'];
            $ext = $post['ext'];
            

            $uploads_dir = 'assets/img/banner/' . $id.'.'.$ext;

            
            $check_file = glob($uploads_dir);
            //var_dump($check_file);exit;

            echo json_encode($check_file);
        }

    }

     function cekFileServerinfo() {
        
        if ($this->input->post()) {
            $post = $this->input->post();
            $id = $post['id'];
            $ext = $post['ext'];
            

            $uploads_dir = 'assets/img/informasi/' . $id.'.'.$ext;

            
            $check_file = glob($uploads_dir);
            //var_dump($check_file);exit;

            echo json_encode($check_file);
        }

    }



    public function doaddaction($id) {

        $tmp_file = pathinfo($_FILES['file']['name']);

        $filename = $id. '.' . $tmp_file['extension'];

        /*Upload Code*/

        $uploads_dir = 'assets/img/banner';

        $tmp_name = $_FILES["file"]["tmp_name"];

        if (file_exists("$uploads_dir/$filename")) {
            unlink("$uploads_dir/$filename");
        }
        //delete file jika file ada
        clearstatcache();
        move_uploaded_file($tmp_name, "$uploads_dir/$filename"); //upload file ke server
        chmod("$uploads_dir/$filename", 0777); //setting permission

        echo $filename;

    }

    public function doaddactioninfo($id) {

        $tmp_file = pathinfo($_FILES['file']['name']);

        $filename = $id. '.' . $tmp_file['extension'];

        /*Upload Code*/

        $uploads_dir = 'assets/img/informasi';

        $tmp_name = $_FILES["file"]["tmp_name"];

        if (file_exists("$uploads_dir/$filename")) {
            unlink("$uploads_dir/$filename");
        }
        //delete file jika file ada
        clearstatcache();
        move_uploaded_file($tmp_name, "$uploads_dir/$filename"); //upload file ke server
        chmod("$uploads_dir/$filename", 0777); //setting permission

        echo $filename;

    }


    /*START UPLOAD PHOTO*/
    public function upload_file(){
        if (isset($_POST['nrk'])){
            $nrk = $_POST['nrk'];
        } else {            
            $nrk = "empty";
            //$nrk = $this->user['id'];
        }

        $config = array(
            'upload_path' => 'assets/img/banner/',
            'allowed_types' => 'jpeg|jpg|png',
            'file_name' => ''.$nrk.'.jpg',
            'file_ext_tolower' => TRUE,
            'overwrite' => TRUE,
            'max_size' => 1024,
            // 'max_width' => 1024,
            // 'max_height' => 768,           
            // 'min_width' => 10,
            // 'min_height' => 7,     
            'max_filename' => 0,
            'remove_spaces' => TRUE
        );
 
        $this->load->library('upload', $config);         
        
 
        if ( ! $this->upload->do_upload())
        {
            $hasil = $this->upload->display_errors();            
        }
        else
        {
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
            $config2['create_thumb'] = TRUE;
            $config2['maintain_ratio'] = FALSE;
            $config2['width'] = 68; //40
            $config2['height'] = 68; //40

            $this->load->library('image_lib', $config2);

            if ( ! $this->image_lib->resize()){                
                $result = $this->image_lib->display_errors();
            }else{
                $result = 'SUKSES';
            }

            // $hasil = $this->upload->data();
            $hasil = array('result' => $result);
        }

        echo json_encode($hasil);
    }
/*END UPLOAD PHOTO*/

/*START UPLOAD PHOTO*/
    public function upload_filebanner(){
       var_dump($_POST);exit;

        $config = array(
            'upload_path' => 'assets/img/banner/',
            'allowed_types' => 'jpeg|jpg|png',
            'file_name' => ''.$nrk.'.jpg',
            'file_ext_tolower' => TRUE,
            'overwrite' => TRUE,
            'max_size' => 1024,
            // 'max_width' => 1024,
            // 'max_height' => 768,           
            // 'min_width' => 10,
            // 'min_height' => 7,     
            'max_filename' => 0,
            'remove_spaces' => TRUE
        );
 
        $this->load->library('upload', $config);         
        
 
        if ( ! $this->upload->do_upload())
        {
            $hasil = $this->upload->display_errors();            
        }
        else
        {
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
            $config2['create_thumb'] = TRUE;
            $config2['maintain_ratio'] = FALSE;
            $config2['width'] = 68; //40
            $config2['height'] = 68; //40

            $this->load->library('image_lib', $config2);

            if ( ! $this->image_lib->resize()){                
                $result = $this->image_lib->display_errors();
            }else{
                $result = 'SUKSES';
            }

            // $hasil = $this->upload->data();
            $hasil = array('result' => $result);
        }

        echo json_encode($hasil);
    }
/*END UPLOAD PHOTO*/

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
