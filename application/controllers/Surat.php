<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends Roles {
	public function __construct()
	{
		parent::__construct(['admin']);
	}

	public function index()
	{
        $this->load->model('surat_model');
        $surat = $this->surat_model->get_all();

		$this->load->view('partials/main-header');
		$this->load->view('surat/surat', [
            "surat" => $surat
        ]);
		$this->load->view('partials/main-footer');
	}

    public function do_upload($file_type, $post_name)
    {
        // File
        $config['upload_path']          = './uploads';
        $config['allowed_types']        = $file_type;
        $config['max_size']             = 2048;
        $this->load->library('upload');

        $this->upload->initialize($config);
        $data = null;

        if (($this->upload->do_upload($post_name))) {
            $data = $this->upload->data();
            $data = $data['file_name'];
        }

        return $data;
    }

	public function create()
    {
        $this->load->model('surat_model');

        $no = $this->input->post('no_surat');
        $jenis_tujuan = $this->input->post('jenis_tujuan');
        $data_additional = array();
        if ($jenis_tujuan == 'divisi') {
            $data_additional = array(
                "tujuan" => $this->input->post('divisi'),
                "detail_tujuan" => implode(',', $this->input->post('tujuan'))
            );
        } else if ($jenis_tujuan == 'perorangan') {
            $data_additional = array(
                "tujuan" => $this->input->post('jenis_pegawai'),
                "detail_tujuan" => implode(',', $this->input->post('pegawai'))
            );
        }

        $jenis = $this->input->post('jenis');
        $jenis_kegiatan = $this->input->post('jenis_kegiatan');
        if($jenis_kegiatan == 'diklat') {
            $jenis_diklat = $this->input->post('jenis_diklat');
        }

        $file_name = $this->do_upload("pdf", "file_surat");

        if(is_null($file_name)) {
            echo $this->input->post('file_surat');
            die();
        }

        $admin_nip = $this->session->userdata('nip');
        date_default_timezone_set('Asia/Jakarta');
        $date =  date("Y/m/d h:i:s");
        $tgl_upload =  $date;

        $data = array(
            "no" => $no,
            "jenis_tujuan" => $jenis_tujuan,
            "tgl_upload" => $tgl_upload,
            "jenis" => $jenis,
            "jenis_kegiatan" => $jenis_kegiatan,
            "jenis_diklat" => $jenis_diklat,
            "admin_nip" => $admin_nip,
            "file_name" => $file_name
        );
        $data = array_merge($data, $data_additional);

        $add = $this->surat_model->insert_one($data);

        if($add) {
            $this->session->set_flashdata('message_success', 'Berhasil menambahkan data surat!');
            redirect("surat");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data surat!');
            redirect("surat");
        }
    }
    
    public function update()
    {        
        $this->load->model('surat_model');
        $id = $this->input->post('id_surat');
        $no = $this->input->post('no_surat');
        $jenis_tujuan = $this->input->post('jenis_tujuan');
        $tujuan = $this->input->post('tujuan');
        $jenis = $this->input->post('jenis');
        $jenis_kegiatan = $this->input->post('jenis_kegiatan');

        $admin_nip = $this->session->userdata('nip');        

        if(!(empty($_FILES['file_surat']['name']))) {
            $file_name = $this->do_upload("pdf", "file_surat");   
            date_default_timezone_set('Asia/Jakarta');
            $date =  date("Y/m/d h:i:s");
            $tgl_upload =  $date;

            $data = array(
                "no" => $no,
                "jenis_tujuan" => $jenis_tujuan,
                "tujuan" => $tujuan,
                "tgl_upload" => $tgl_upload,
                "jenis" => $jenis,
                "jenis_kegiatan" => $jenis_kegiatan,
                "admin_nip" => $admin_nip,
                "file_name" => $file_name
            );
        } else {
            $data = array(
                "no" => $no,
                "jenis_tujuan" => $jenis_tujuan,
                "tujuan" => $tujuan,        
                "jenis" => $jenis,
                "jenis_kegiatan" => $jenis_kegiatan,
                "admin_nip" => $admin_nip              
            );
        }
        $update = $this->surat_model->update_one($id, $data);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data surat J-'.$id.'!');
            redirect("surat");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data surat J-'.$id.'!');
            redirect("surat");
        }
    }
    
    public function delete()
    {        
        $this->load->model('surat_model');
        $id = $this->input->post('id_surat');
        $update = $this->surat_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data surat J-'.$id.'!');
            redirect("surat");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data surat J-'.$id.'!');
            redirect("surat");
        }
    }

    public function get_pegawai($jenis)
    {
        $this->load->model("pegawai_model");
        $where = array('jenis_pegawai' => $jenis);
        echo json_encode($this->pegawai_model->get_all_where($where));
    }

    public function get_divisi($divisi)
    {
        if($divisi == "jurusan") {
            $this->load->model("jurusan_model");
            echo json_encode($this->jurusan_model->get_all());
        } else if($divisi == "bagian") {
            $this->load->model("bagian_model");
            echo json_encode($this->bagian_model->get_all());
        } else if($divisi == "unit") {
            $this->load->model("unit_model");
            echo json_encode($this->unit_model->get_all());
        }
    }
}