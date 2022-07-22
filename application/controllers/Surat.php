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
                    $detail_tujuan = $this->surat_model->get_all_where_subjek([
                        "surat_id" => $value->id
                    ]);
                    foreach($detail_tujuan as $item) {
                        $get_data = $this->jurusan_model->get_one([
                            "id" => $item->subjek
                        ]);
                        array_push($list_detail, $get_data);
                    }
                } else if($value->tujuan == 'bagian') {
                    $detail_tujuan = $this->surat_model->get_all_where_subjek([
                        "surat_id" => $value->id
                    ]);
                    foreach($detail_tujuan as $item) {
                        $get_data = $this->bagian_model->get_one([
                            "id" => $item->subjek
                        ]);
                        array_push($list_detail, $get_data);
                    }
                } else if($value->tujuan == 'unit') {
                    $detail_tujuan = $this->surat_model->get_all_where_subjek([
                        "surat_id" => $value->id
                    ]);
                    foreach($detail_tujuan as $item) {
                        $get_data = $this->unit_model->get_one([
                            "id" => $item->subjek
                        ]);
                        array_push($list_detail, $get_data);
                    }
                }
                $list_detail_tujuan[$value->id] = $list_detail;

            } else if($value->jenis_tujuan == 'perorangan') {
                $detail_tujuan = $this->surat_model->get_all_where_subjek([
                    "surat_id" => $value->id
                ]);
                foreach($detail_tujuan as $item) {
                    $get_data = $this->pegawai_model->get_one([
                        "account_nip" => $item->subjek
                    ]);
                    array_push($list_detail, $get_data);
                }
                $list_detail_tujuan[$value->id] = $list_detail;
            }
        }

        // Get List Jabatan
        $jabatan = $this->jabatan_model->get_all();
        $list_jabatan = [];
        foreach($jabatan as $value) {
            $list_jabatan[$value->id] = $value; 
        }

		$this->load->view('partials/main-header', [
            "title" => " | Surat"
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

    public function upload()
    {
        // Load Model
        $this->load->model('surat_model');

        // Form Validation Rules
        $rules = $this->surat_model->upload_rules();
        $this->form_validation->set_rules($rules);

        // Check Form Validation
        if($this->form_validation->run() == FALSE) {
            echo "Error";
            $this->session->set_flashdata('message_error', validation_errors());
            redirect("surat");
        }

        // POST Method Form
        $no = $this->input->post('no_surat');

        // Uploading File Surat
        $file_name = $this->do_upload("pdf", "file_surat");
        if(is_null($file_name)) {
            $this->session->set_flashdata('message_error', 'Kesalahan dalam mengunggah surat!');
            redirect("surat");
        }

        // Preparing Data for Insert
        $data = array(
            "no" => $no,
            "file_name" => $file_name,
            "admin_nip" => $this->session->userdata('nip'),
            "tgl_upload" => date("Y/m/d h:i:s"),
            "status" => "need to fill"
        );

        // Insert Surat
        $add = $this->surat_model->insert_one($data);
        if($add) {
            $this->session->set_flashdata('message_success', 'Berhasil mengunggah surat!');
            redirect("surat");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal mengunggah surat!');
            redirect("surat");
        }
    }

	public function create()
    {
        // Load Model
        $this->load->model('surat_model');
        $this->load->model('pegawai_model');

        // Form Validation Rules
        $rules = $this->surat_model->create_rules();
        $this->form_validation->set_rules($rules);

        // Check Form Validation
        if($this->form_validation->run() == FALSE) {
            echo "Error";
            $this->session->set_flashdata('message_error', validation_errors());
            redirect("surat");
        }

        $data_additional = [];
        // POST Method Form
        $no = $this->input->post('no_surat');
        $jenis_kegiatan = $this->input->post('jenis_kegiatan');
        if($jenis_kegiatan == 'diklat') {
            $jenis_diklat = $this->input->post('jenis_diklat');
            $data_additional = array_merge($data_additional, [
                "jenis_diklat" => $jenis_diklat
            ]);
        }
        $tema = $this->input->post('tema');
        $subjek = $this->input->post('subjek');
        $jenis_tujuan = NULL;
        $detail_tujuan = NULL;

        // Jenis Tujuan Surat Pertama: Subjek Jelas
        if($subjek == 'spesifik') {
            $surat_status = "ready to send";
            $jenis_tujuan = $this->input->post('jenis_tujuan');
            if ($jenis_tujuan == 'divisi') {
                $data_additional = array_merge($data_additional, [
                    "tujuan" => $this->input->post('divisi')
                ]); 
            } else if ($jenis_tujuan == 'perorangan') {
                $data_additional = array_merge($data_additional, [
                    "tujuan" => $this->input->post('jenis_pegawai')
                ]);
            }
            $detail_tujuan = $this->input->post('tujuan');
        
        // Jenis Tujuan Surat Kedua: Semua Subjek
        } else if($subjek == 'semua') {
            $jenis_tujuan = "semua";
            $surat_status = "ready to send";
            $detail_tujuan = $this->pegawai_model->get_all_column('*', [
                "status_kerja" => "aktif"
            ]);
        } else {
            $jenis_tujuan = "tidak ada";
            $surat_status = "need ranking";
            $data_additional = array_merge($data_additional, [
                "kriteria" => $this->input->post('kriteria')
            ]);
        }

        // Uploading File Surat
        $file_name = $this->do_upload("pdf", "file_surat");
        if(is_null($file_name)) {
            $this->session->set_flashdata('message_error', 'Kesalahan dalam mengunggah surat!');
            redirect("surat");
        }

        // Preparing Data for Insert
        $data = array(
            "no" => $no,
            "jenis_kegiatan" => $jenis_kegiatan,
            "tema" => $tema,
            "jenis_tujuan" => $jenis_tujuan,
            "file_name" => $file_name,
            "admin_nip" => $this->session->userdata('nip'),
            "tgl_upload" => date("Y/m/d h:i:s"),
            "status" => $surat_status
        );
        $data = array_merge($data, $data_additional);
        
        // Insert Surat
        if($detail_tujuan != NULL) {
            $add = $this->surat_model->insert_one_with_subjek($data, $detail_tujuan);
        } else {
            $add = $this->surat_model->insert_one_with_subjek($data);
        }
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
        if(isset($_POST['delete_tujuan'])) {
            $id = $this->input->post('id_surat');
            $checked_tujuan = $this->input->post('checked_subjek_id');

            $delete = $this->surat_model->delete_multi_subjek($id, $checked_tujuan);
            if($delete) {
                $this->session->set_flashdata('message_success', 'Berhasil menghapus tujuan yang dipilih');
                redirect("surat");
            } else {
                $this->session->set_flashdata('message_error', 'Gagal menghapus tujuan yang dipilih');
                redirect("surat");
            }
        } else {
            // Form Validation Rules
            $rules = $this->surat_model->update_rules();
            $this->form_validation->set_rules($rules);
            if ($this->input->post('no_surat') != $this->input->post('no_surat_old')) {
                $is_unique = '|is_unique[surat.no]';
            } else {
                $is_unique = '';
            }
            $this->form_validation->set_rules(
                'no_surat',
                'no_surat',
                'required' . $is_unique,
                array(
                    'required' => 'Anda perlu mengisi %s.',
                    'is_unique' => '%s sudah digunakan.'
                )
            );

            // Check Form Validation
            if($this->form_validation->run() == FALSE) {
                echo "Error";
                $this->session->set_flashdata('message_error', validation_errors());
                redirect("surat");
            }

            $data_additional = [];
            // POST Request
            $id = $this->input->post('id_surat');
            $no = $this->input->post('no_surat');
            $jenis_kegiatan = $this->input->post('jenis_kegiatan');
            if($jenis_kegiatan == 'diklat') {
                $jenis_diklat = $this->input->post('jenis_diklat');
                $data_additional = array_merge($data_additional, [
                    "jenis_diklat" => $jenis_diklat
                ]);
            }
            $tema = $this->input->post('tema');
            $subjek = $this->input->post('subjek');
            $detail_tujuan = NULL;

            if($subjek == 'spesifik') {
                $jenis_tujuan = $this->input->post('jenis_tujuan');
                if ($jenis_tujuan == 'divisi') {
                    $data_additional = array_merge($data_additional, [
                        "tujuan" => $this->input->post('divisi'),
                        "status" => "ready to send"
                    ]);
                } else if ($jenis_tujuan == 'perorangan') {
                    $data_additional = array_merge($data_additional, [
                        "tujuan" => $this->input->post('jenis_pegawai'),
                        "status" => "ready to send"
                    ]);
                }
                $detail_tujuan = $this->input->post('tujuan');  
            } else if($subjek == 'semua') {
                $jenis_tujuan = "semua";
                $data_additional = array_merge($data_additional, [
                    "status" => "ready to send"
                ]);
            } else {
                $jenis_tujuan = "tidak ada";
                $data_additional = array_merge($data_additional, [
                    "status" => "need ranking",
                    "kriteria" => $this->input->post('kriteria')
                ]);
            }

            // Preparing Data for Update
            if(!(empty($_FILES['file_surat']['name']))) {
                $file_name = $this->do_upload("pdf", "file_surat");   
                $data = array(
                    "no" => $no,
                    "jenis_kegiatan" => $jenis_kegiatan,
                    "tema" => $tema,
                    "jenis_tujuan" => $jenis_tujuan,
                    "file_name" => $file_name,
                    "admin_nip" => $this->session->userdata('nip'),
                    "tgl_upload" => date("Y/m/d h:i:s"),
                );
            } else {
                $data = array(
                    "no" => $no,
                    "jenis_kegiatan" => $jenis_kegiatan,
                    "tema" => $tema,
                    "jenis_tujuan" => $jenis_tujuan,
                    "admin_nip" => $this->session->userdata('nip'),
                );
            }
            $data = array_merge($data, $data_additional);

            // Compare Before and After
            $get_surat = $this->surat_model->get_one([
                "id" => $id
            ]);
            
            if($get_surat->jenis_tujuan != $jenis_tujuan) {
                $this->surat_model->delete_multi_subjek($id);
            }

            // Updating Surat
            if($detail_tujuan != NULL) {
                $update = $this->surat_model->update_one($id, $data, $detail_tujuan);
            } else {
                $update = $this->surat_model->update_one($id, $data);
            }
            if($update) {
                $this->session->set_flashdata('message_success', 'Berhasil mengupdate data surat dengan nomor '.$no.'!');
                redirect("surat");
            } else {
                $this->session->set_flashdata('message_error', 'Gagal mengupdate data surat dengan nomor '.$no.'!');
                redirect("surat");
            }
        }
    }
    
    public function delete()
    {        
        // Load Model
        $this->load->model('surat_model');

        // POST Method Form
        $id = $this->input->post('id_surat');

        // Get Rows
        $get = $this->surat_model->get_one(array(
            "id" => $id
        ));
        
        // Deleting Surat
        $delete_subjek = $this->surat_model->delete_multi_subjek($id);
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

    public function send_to_subjek()
    {
        // Load Model
        $this->load->model('surat_model');
        $this->load->model('notifikasi_model');

        // POST Method Form
        $id = $this->input->post('surat_id');

        $this->db->trans_start();

        // Update Surat Status to 'sent'
        $this->surat_model->update_one($id, [
            "status" => "sent"
        ]);

        // Get Surat Data
        $surat_data = $this->surat_model->get_one([
            "id" => $id
        ]);

        // Insert Notification
        $create_notif = $this->notifikasi_model->create_notification(array(
            "judul" => "Undangan ".ucwords($surat_data->jenis_kegiatan),
            "pesan" => "Anda mendapatkan undangan kegiatan ".ucwords($surat_data->jenis_kegiatan).". Silahkan segera melakukan proses pemberkasan pada laman kegiatan ".$surat_data->jenis_kegiatan,
            "redirect_to" => $surat_data->jenis_kegiatan
        ));

        // Get Subjek by Surat
        $subjek_data = $this->surat_model->get_all_where_subjek([
            "surat_id" => $id
        ]);

        // Pair Notification with Account
        foreach($subjek_data as $target) {
            $this->notifikasi_model->pair_notification(array(
                "account_nip" => $target->subjek,
                "notifikasi_id" => $create_notif,
                "status" => "Unseen",
                "created_at" => date("Y-m-d h:i:s")
            ));
        }

        $this->db->trans_complete();
        if($this->db->trans_status()) {
            $this->session->set_flashdata('message_success', 'Berhasil mengirim surat kepada subjek');
            redirect("surat");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal mengirim surat kepada subjek');
            redirect("surat");
        }
    }
}