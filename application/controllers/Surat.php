<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends Roles {
	public function __construct()
	{
		parent::__construct(['admin']);
	}

	public function index()
	{
        // Load Model
        $this->load->model('surat_model');
        $this->load->model('pegawai_model');
        $this->load->model('jurusan_model');
        $this->load->model('bagian_model');
        $this->load->model('unit_model');
        $this->load->model('jabatan_model');

        // Get All Surat
        $surat = $this->surat_model->get_all();

        // Get All Pegawai
        $pegawai = $this->pegawai_model->get_all();
        $jurusan = $this->jurusan_model->get_all();
        $bagian = $this->bagian_model->get_all();
        $unit = $this->unit_model->get_all();

        // Get Detail from Detail Tujuan
        $list_detail_tujuan = [];
        foreach($surat as $key => $value) {
            $list_detail = [];
            if($value->jenis_tujuan == 'divisi') {
                if($value->tujuan == 'jurusan') {
                    $detail_tujuan = explode(',', $value->detail_tujuan);
                    foreach($detail_tujuan as $item) {
                        $get_data = $this->jurusan_model->get_one([
                            "id" => $item
                        ]);
                        array_push($list_detail, $get_data);
                    }
                } else if($value->tujuan == 'bagian') {
                    $detail_tujuan = explode(',', $value->detail_tujuan);
                    foreach($detail_tujuan as $item) {
                        $get_data = $this->bagian_model->get_one([
                            "id" => $item
                        ]);
                        array_push($list_detail, $get_data);
                    }
                } else if($value->tujuan == 'unit') {
                    $detail_tujuan = explode(',', $value->detail_tujuan);
                    foreach($detail_tujuan as $item) {
                        $get_data = $this->unit_model->get_one([
                            "id" => $item
                        ]);
                        array_push($list_detail, $get_data);
                    }
                }
                $list_detail_tujuan[$key] = $list_detail;
            } else if($value->jenis_tujuan == 'perorangan') {
                $detail_tujuan = explode(',', $value->detail_tujuan);
                foreach($detail_tujuan as $item) {
                    $get_data = $this->pegawai_model->get_one([
                        "account_nip" => $item
                    ]);
                    array_push($list_detail, $get_data);
                }
                $list_detail_tujuan[$key] = $list_detail;
            }
        }

        $jabatan = $this->jabatan_model->get_all();

        $list_jabatan = [];
        foreach($jabatan as $value) {
            $list_jabatan[$value->id] = $value; 
        }

		$this->load->view('partials/main-header', [
            "title" => "Surat"
        ]);
		$this->load->view('surat/surat', [
            "list_detail_tujuan" => $list_detail_tujuan,
            "surat" => $surat,
            "pegawai" => $pegawai,
            "jurusan" => $jurusan,
            "bagian" => $bagian,
            "unit" => $unit,
            "list_jabatan" => $list_jabatan
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
        $tema = $this->input->post('tema');

        $file_name = $this->do_upload("pdf", "file_surat");

        if(is_null($file_name)) {
            $this->session->set_flashdata('message_error', 'Kesalahan dalam mengunggah surat!');
            redirect("surat");
        }

        $admin_nip = $this->session->userdata('nip');

        // Preparing Data for Insert
        $data = array(
            "no" => $no,
            "jenis_tujuan" => $jenis_tujuan,
            "tgl_upload" => date("Y/m/d h:i:s"),
            "jenis" => $jenis,
            "jenis_kegiatan" => $jenis_kegiatan,
            "jenis_diklat" => $jenis_diklat,
            "tema" => $tema,
            "admin_nip" => $admin_nip,
            "file_name" => $file_name
        );
        $data = array_merge($data, $data_additional);

        // Insert Surat to Database
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
        // Load Model
        $this->load->model('surat_model');

        // POST Request
        $id = $this->input->post('id_surat');
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
        $tema = $this->input->post('tema');

        $admin_nip = $this->session->userdata('nip');       

        if(!(empty($_FILES['file_surat']['name']))) {
            $file_name = $this->do_upload("pdf", "file_surat");   

            $data = array(
                "no" => $no,
                "jenis_tujuan" => $jenis_tujuan,
                "tgl_upload" => date("Y/m/d h:i:s"),
                "jenis" => $jenis,
                "jenis_kegiatan" => $jenis_kegiatan,
                "jenis_diklat" => $jenis_diklat,
                "tema" => $tema,
                "admin_nip" => $admin_nip,
                "file_name" => $file_name
            );
        } else {
            $data = array(
                "no" => $no,
                "jenis_tujuan" => $jenis_tujuan,       
                "jenis" => $jenis,
                "jenis_kegiatan" => $jenis_kegiatan,
                "jenis_diklat" => $jenis_diklat,
                "tema" => $tema,
                "admin_nip" => $admin_nip              
            );
        }
        $data = array_merge($data, $data_additional);

        $update = $this->surat_model->update_one($id, $data);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data surat J-'.$id.'!');
            redirect("surat");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data surat J-'.$id.'!');
            redirect("surat");
        }
    }
    
    public function delete()
    {        
        // Load Model
        $this->load->model('surat_model');

        $id = $this->input->post('id_surat');
        // Get Rows
        $get = $this->surat_model->get_one(array(
            "id" => $id
        ));
        
        $delete = $this->surat_model->delete_one($id);
        if($delete) {
            unlink("./uploads/".$get->file_name);
            $this->session->set_flashdata('message_success', 'Berhasil menhapus data surat '.$get->no.'!');
            redirect("surat");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data surat '.$get->no.'!');
            redirect("surat");
        }
    }

    public function get_pegawai($jenis)
    {
        // Load Model
        $this->load->model("pegawai_model");

        // Printout Output
        echo json_encode($this->pegawai_model->get_all_where_join([
            "jenis_jabatan" => $jenis
        ], 'jabatan', 'pegawai.jabatan_id = jabatan.id'));
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