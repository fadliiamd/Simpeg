<?php

class Pemberhentian_model extends CI_Model
{

    public $table = "pemberhentian";

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
        $query = $this->db->where($query, $search)->get("pemberhentian");

        return $query->result();
    }

    public function get_all_with_join_pegawai()
    {
        $this->db->select(
            '*'
        );
        
        $this->db->from($this->table);
        $this->db->join('pegawai', 'pegawai.account_nip = pemberhentian.pegawai_nip','LEFT');

        $query = $this->db->where("status_kerja", "aktif");
        $query = $this->db->get();

        return $query->result();
    }

    public function get_pegawai_berkas()
    {
        $query = $this->db->where("status_pengajuan", "setuju");
        $query = $this->db->where("pegawai_nip", $this->session->userdata("nip"));
        $query = $this->db->where("jenis_berhenti !=", "Pengunduran diri");
        $query = $this->db->get("pemberhentian");

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
        
        $mpp = $this->input->post('mpp');
        $tunjangan = ($mpp == "Ya") ?  "Tidak" : "Ya";
        
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $jenis_berhenti = $this->input->post('jenis_berhenti');
        $alasan = $this->input->post('alasan');
        list($pegawai_nip, $email) = explode(' - ', $this->input->post('pegawai_nip'));
        $surat_pengunduran_diri = $this->do_upload("pdf", "surat_pengunduran_diri");

        if ($this->session->userdata("role") == "admin") {
            if ($jenis_berhenti == "Pengunduran diri") {
                $status_pengajuan = "pending";
                $tgl_persetujuan = null;
            }else{
                $this->email_pengajuan_pemberhentian($email);
                $status_pengajuan = "setuju";
                $tgl_persetujuan = $date;
            }
        }else {
            $status_pengajuan = "pending";
            $tgl_persetujuan = null;
        }

        $data_pemberhentian = array(
            "id" => "",
            "jenis_berhenti" => $jenis_berhenti,
            "alasan" => $alasan,
            "tgl_pengajuan" => $date,
            "status_pengajuan" => $status_pengajuan,
            "tgl_persetujuan" => $tgl_persetujuan,
            "mpp" => $mpp,
            "tunjangan" => $tunjangan,
            "pegawai_nip" => $pegawai_nip,
            "surat_pengunduran_diri" => $surat_pengunduran_diri,
        );
    
        $this->db->insert($this->table, $data_pemberhentian);
    
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
        
        $mpp = $this->input->post('mpp');
        $tunjangan = ($mpp == "Ya") ?  "Tidak" : "Ya";

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $jenis_berhenti = $this->input->post('jenis_berhenti');
        $alasan = $this->input->post('alasan');
        $mpp = $this->input->post('mpp');
        $tunjangan = $this->input->post('tunjangan');
        $pegawai_nip = $this->input->post('pegawai_nip');
        $surat_pengajuan = $this->do_upload("pdf", "surat_pengajuan");


        $data_pemberhentian = array(
            "jenis_berhenti" => $jenis_berhenti,
            "alasan" => $alasan,
            "tgl_pengajuan" => $date,
            "status_pengajuan" => "pending",
            "mpp" => $mpp,
            "tunjangan" => $tunjangan,
            "pegawai_nip" => $pegawai_nip,
            "surat_pengunduran_diri" => $surat_pengajuan,
        );

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_pemberhentian);
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

    public function status_pemberhentian($id)
    {        
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        if ($this->input->post('status') == "ditolak") {
            $data_pemberhentian = array(
                "status_pengajuan" => $this->input->post('status')
            ); 
        }else{
            $data_pemberhentian = array(
                "status_pengajuan" => $this->input->post('status'),
                "tgl_persetujuan" => $date
            ); 
            if ($this->input->post('jenis_berhenti') != "Pengunduran diri") {
                $this->email_pengajuan_pemberhentian($this->input->post('email'));
            }else {

                $data_pegawai = array(
                    "status_kerja" => "nonaktif"
                );
        
                $pegawai_nip = $this->input->post('pegawai_nip');
    
                $this->db->trans_start();
                $this->db->where('account_nip', $pegawai_nip);
                $this->db->update('pegawai', $data_pegawai);
                $this->db->trans_complete();

                $this->email_pengajuan_pensiun($this->input->post('email'));
            }
        }


        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_pemberhentian);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }

    public function email_pengajuan_pemberhentian($email)
    {
        $this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');        
        $subject = 'Pengajuan Pemberhentian';        
        $message = "<strong>Pengajuan Pemberhentian</strong><br><br>

        Status persetujuan telah dirubah oleh Bagan Kepegawaian. Untuk lebih jelasnya dapat dilihat pada Sistem Informasi Kepegawaian.<br><br>
        Berkas Persyaratan yang dibutuhkan untuk pemberhentian dengan jenis Pensiun dini dan Pensiun batas usia:<br>
        <ol>
            <li>Fotocopy SK PNS</li>
            <li>Fotocopy SK CPNS</li>
            <li>Fotocopy SK Pangkat</li>
            <li>Fotocopy SK Kenaikan Gaji Berkala</li>
            <li>Fotocopy Kartu Pegawai</li>
            <li>Fotocopy Kartu Keluarga</li>
            <li>DP3 Terakhir</li>
            <li>Pas foto 3x4 Latar merah</li>
        </ol><br>
        
        Untuk Pemberhentian dengan jenis pengunduran diri diharapkan untuk menunggu informasi lebih lanjut.";

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }

    public function email_pengajuan_pensiun($email)
    {
        $this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');        
        $subject = 'Pemberitahuan pensiun';        
        $message = "<strong>Pemberitahuan pensiun</strong><br><br>

        Diberitahukan kepada pegawai yang bersangkutan, masa jabatan yang anda miliki kurang lebih 1 (satu) tahun dari pemberitahuan ini disampaikan. Untuk itu diharapkan agar segera mengkonfirmasi pengambilan Masa Persiapan Pensiun (MPP).<br>
        Berkas persyaratan yang diperlukan:<br>
        <ol>
            <li>Fotocopy SK PNS</li>
            <li>Fotocopy SK CPNS</li>
            <li>Fotocopy SK Pangkat</li>
            <li>Fotocopy SK Kenaikan Gaji Berkala</li>
            <li>Fotocopy Kartu Pegawai</li>
            <li>Fotocopy Kartu Keluarga</li>
            <li>DP3 Terakhir</li>
            <li>Pas foto 3x4 Latar merah</li>
        </ol>";

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }
}