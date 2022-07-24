<?php

class Mutasi_model extends CI_Model
{

    public $table = "mutasi";

    public function do_upload($file_type, $post_name)
    {
         // File
            $config['upload_path']          = './uploads';
            $config['allowed_types']        = $file_type;
            $config['max_size']             = 2048;
            $this->load->library('upload');
    
            $this->upload->initialize($config);

            if (($this->upload->do_upload($post_name)))
            {
                $data = $this->upload->data();
                $data = $data['file_name'];
            }

            return $data;
    }

    public function get_num_rows()
    {
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function get_all()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_condition($query,$search)
    {
        $query = $this->db->where($query, $search)->get("mutasi");

        return $query->result();
    }

    public function get_all_with_join_pegawai()
    {
        $this->db->select(
            '*,mutasi.id AS id_mutasi'
        );
        $this->db->from($this->table);
        $this->db->join('pegawai', 'pegawai.account_nip = mutasi.pegawai_nip','LEFT');
        $this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.id','LEFT');
        $this->db->join('pangkatgolongan', 'pegawai.golongan_id  = pangkatgolongan.golongan','LEFT');

        $query = $this->db->where("status_kerja", "aktif");
        $query = $this->db->get();

        return $query->result();
    }

    public function get_all_with_join_one_pegawai()
    {
        $this->db->select(
            '*,mutasi.id AS id_mutasi'
        );
        $this->db->from($this->table);
        $this->db->join('pegawai', 'pegawai.account_nip = mutasi.pegawai_nip','LEFT');
        $this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.id','LEFT');
        $this->db->join('pangkatgolongan', 'pegawai.golongan_id  = pangkatgolongan.golongan','LEFT');

        $query = $this->db->where("status_kerja", "aktif");
        $query = $this->db->where("pegawai_nip",$this->session->userdata("nip"));
        $query = $this->db->get();

        return $query->result();
    }

    public function get_pegawai_berkas()
    {
        $query = $this->db->where("status_pengajuan", "setujui");
        $query = $this->db->where("pegawai_nip", $this->session->userdata("nip"));
        $query = $this->db->get("mutasi");

        return $query->result();
    }

    public function insert_one()
    {
        
        //check empty string for nullable
        foreach( $this->input->post() as $key => $value) {
            if($value === ""){
                $value = null;
            }
            $_POST[$key] = $value;            
        }
        
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d");
        $alasan = $this->input->post('alasan');
        list($pegawai_nip, $email) = explode(' - ', $this->input->post('pegawai_nip'));
        $jenis_mutasi = $this->input->post('jenis_mutasi');
        // $surat_pengajuan = $this->do_upload("pdf", "surat_pengajuan");

        if ($this->session->userdata("role") == "admin") {
            $this->email_pengajuan_mutasi($email);
            $status_pengajuan = "setujui";
            $tgl_persetujuan = $date;
        }else {
            $status_pengajuan = "pending";
            $tgl_persetujuan = null;
        }


        $data_mutasi = array(
            "id" => "",
            "alasan" => $alasan,
            "tgl_pengajuan" => $date,
            "status_pengajuan" => $status_pengajuan,
            "tgl_persetujuan" => $tgl_persetujuan,
            "pegawai_nip" => $pegawai_nip,
            "surat_pengajuan" => $surat_pengajuan,
            "jenis_mutasi" => $jenis_mutasi
        );
    
        $this->db->insert($this->table, $data_mutasi);
    
        return ($this->db->affected_rows() != 1) ? false : true;
    
    }

    public function update_one($id)
    {        
         //check empty string for nullable
         foreach( $this->input->post() as $key => $value) {
            if($value === ""){
                $value = null;
            }
            $_POST[$key] = $value;            
        }

        $alasan = $this->input->post('alasan');
        $surat_pengajuan = $this->do_upload("pdf|jpg|png", "surat_pengajuan");                    
        $jenis_mutasi = $this->input->post('jenis_mutasi');

        $data_mutasi = array(
            "alasan" => $alasan,
            "surat_pengajuan" => $surat_pengajuan,
            "jenis_mutasi" => $jenis_mutasi
        );

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_mutasi);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }

    public function delete_one($id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }

    public function status_mutasi($id)
    {        
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d");

        if ($this->input->post('status') == "tolak") {
            $data_mutasi = array(
                "status_pengajuan" => $this->input->post('status')
            ); 
        }else{
            $data_mutasi = array(
                "status_pengajuan" => $this->input->post('status'),
                "tgl_persetujuan" => $date
            ); 
            $this->email_pengajuan_mutasi($this->input->post('email'));
        }


        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_mutasi);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }

    public function email_pengajuan_mutasi($email)
    {
        $this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');        
        $subject = 'Pengajuan mutasi';        
        $message = "<strong>Pengajuan mutasi</strong><br><br>

        Status persetujuan telah dirubah oleh Bagan Kepegawaian. Untuk lebih jelasnya dapat dilihat pada Sistem Informasi Kepegawaian.<br>
        Format semua berkas persyaratan yang diajukan adalah pdf.<br>
        Berikut merupakan daftar berkas persyaratan yang dibutuhkan: <br>       
        <ol>
            <li>Fotocopy SK PNS</li>
            <li>Fotocopy SK CPNS</li>
            <li>Fotocopy SK Pangkat</li>
            <li>Fotocopy DP3 Terakhir</li>
            <li>Fotocopy Ijazah</li>
            <li>Fotocopy Kartu Pegawai</li>
            <li>Riwayat Hidup</li>
        </ol><br><br>
        Lampiran Contoh Berkas : ";

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->attach(base_url('assets/pdf/SK Pangkat.pdf'));
        $this->email->attach(base_url('assets/pdf/dp3.pdf'));
        $this->email->attach(base_url('assets/pdf/karpeg.pdf'));
        $this->email->attach(base_url('assets/pdf/Riwayat_hidup.docx'));

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }

    public function surat_pengajuan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d");

        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $ttl = $this->input->post('ttl');
        $pangkat = $this->input->post('pangkat');
        $jabatan = $this->input->post('jabatan');
        $jenis = $this->input->post('jenis');
        $alasan = $this->input->post('alasan');

        $document = file_get_contents(base_url('assets/pdf/pengajuan_mutasi.rtf'));
        // isi dokumen dinyatakan dalam bentuk string
        $document = str_replace("#TGL", $date, $document);
        $document = str_replace("#NIP", $nip, $document);
        $document = str_replace("#NAMA", $nama, $document);
        $document = str_replace("#TTL", $ttl, $document);
        $document = str_replace("#PANGKAT", $pangkat , $document);
        $document = str_replace("#JABATAN", $jabatan , $document);
        $document = str_replace("#JENIS", $jenis , $document);
        $document = str_replace("#ALASAN", $alasan , $document);
        // header untuk membuka file output RTF dengan MS. Word

        header("Content-type: application/msword");
        header("Content-disposition: inline; filename=Pengajuan_Mutasi_".$nama.".doc");
        header("Content-length: ".strlen($document));

        echo $document;
    }
}