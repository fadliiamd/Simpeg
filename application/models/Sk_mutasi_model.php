<?php

class Sk_mutasi_model extends CI_Model
{

    public $table = "skmutasi";

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

    public function get_all()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_all_with_join()
    {
        $this->db->select(
            'skmutasi.*,
            penerimaanmutasi.id AS id_penerimaan, penerimaanmutasi.pegawai_nip AS penerimaan_nip, usulanmutasi.*,
            usulanmutasi.id AS id_usulan,
            berkasmutasi.id As id_berkas, berkasmutasi.sk_cpns, berkasmutasi.sk_pns, berkasmutasi.karpeg, berkasmutasi.dp3_akhir, berkasmutasi.ijazah, berkasmutasi.riwayat_hidup, 
            mutasi.*, mutasi.id AS id_mutasi,
            pegawai.bagian_id, pegawai.nama AS pegawai_nama,
            skmutasi.id as id,'
        );
        $this->db->from($this->table);
        $this->db->join('penerimaanmutasi', 'penerimaanmutasi.id = skmutasi.penerimaan_id','LEFT');
        $this->db->join('usulanmutasi', 'usulanmutasi.id = skmutasi.usulanmutasi_id','LEFT');
        $this->db->join('berkasmutasi', 'berkasmutasi.id = usulanmutasi.berkasmutasi_id','LEFT');
        $this->db->join('mutasi', 'mutasi.id = usulanmutasi.mutasi_id','LEFT');
        $this->db->join('pegawai', 'pegawai.account_nip = mutasi.pegawai_nip','LEFT');

        $query = $this->db->get();

        return $query->result();
    }

    public function get_one_with_join()
    {
        $this->db->select(
            'skmutasi.id, skmutasi.jenis_mutasi, skmutasi.tgl_mutasi, skmutasi.file_mutasi, skmutasi.nomor_surat,
            penerimaanmutasi.id AS id_penerimaan, penerimaanmutasi.pegawai_nip AS penerimaan_nip,
            usulanmutasi.id AS id_usulan,usulanmutasi.tgl_usulan,usulanmutasi.status_persetujuan,usulanmutasi.tgl_persetujuan,
            berkasmutasi.id As id_berkas, berkasmutasi.sk_cpns, berkasmutasi.sk_pns, berkasmutasi.karpeg, berkasmutasi.dp3_akhir, berkasmutasi.ijazah, berkasmutasi.riwayat_hidup, 
            mutasi.pegawai_nip, mutasi.alasan, mutasi.id AS id_mutasi,
            pegawai.bagian_id, pegawai.nama AS pegawai_nama'
        );
        $this->db->from($this->table);
        $this->db->join('penerimaanmutasi', 'penerimaanmutasi.id = skmutasi.penerimaan_id','LEFT');
        $this->db->join('usulanmutasi', 'usulanmutasi.id = skmutasi.usulanmutasi_id','LEFT');
        $this->db->join('berkasmutasi', 'berkasmutasi.id = usulanmutasi.berkasmutasi_id','LEFT');
        $this->db->join('mutasi', 'mutasi.id = usulanmutasi.mutasi_id','LEFT');
        $this->db->join('pegawai', 'pegawai.account_nip = mutasi.pegawai_nip','LEFT');

        $query = $this->db->where('pegawai.account_nip', $this->session->userdata('nip'));
        $query = $this->db->get();

        return $query->row();
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
        $date = date("Y-m-d H:i:s");
        $jenis_mutasi = $this->input->post('jenis_mutasi');
        $tgl_mutasi = $this->input->post('tgl_mutasi');
        
        if ($jenis_mutasi == "Mutasi Masuk") {
            $penerimaan_id = $this->input->post('penerimaan_id');
            $data_sk_mutasi = array(
                "id" => "",
                "jenis_mutasi" => $jenis_mutasi,
                "tgl_mutasi" => $date,
                "penerimaan_id" => $penerimaan_id,
            );
        }else {
            $usulanmutasi_id = $this->input->post('usulanmutasi_id');
            $data_sk_mutasi = array(
                "id" => "",
                "jenis_mutasi" => $jenis_mutasi,
                "tgl_mutasi" => $tgl_mutasi,
                "usulanmutasi_id" => $usulanmutasi_id,
            );
        }
    
        $this->db->insert($this->table, $data_sk_mutasi);
    
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

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $jenis_mutasi = $this->input->post('jenis_mutasi');
        $file_mutasi = $this->do_upload("jpg|png|pdf", "file_mutasi");
        $usulanmutasi_id = $this->input->post('usulanmutasi_id');

        $data_sk_mutasi = array(
            "jenis_mutasi" => $jenis_mutasi,
            "tgl_mutasi" => $date,
            "file_mutasi" => $file_mutasi,
            "usulanmutasi_id" => $usulanmutasi_id,
        );

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_sk_mutasi);
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

    public function status_usulan_mutasi($id)
    {        

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        if ($this->input->post('status') == "tolak") {
            $data_sk_mutasi = array(
                "status_persetujuan" => $this->input->post('status')
            ); 
        }else{
            $data_sk_mutasi = array(
                "status_persetujuan" => $this->input->post('status'),
                "tgl_persetujuan" => $date
            ); 
        }

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_sk_mutasi);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }

    public function upload_surat($id)
    {                
         //check empty string for nullable
        foreach( $this->input->post() as $key => $value) {
            if($value === ""){
                $value = null;
            }
            $_POST[$key] = $value;            
        }

        $nomor_surat = $this->input->post('nomor_surat');
        $surat_mutasi = $this->do_upload("pdf", "file_mutasi");

        $data_mutasi_mutasi = array(
            "nomor_surat" => $nomor_surat,
            "file_mutasi" => $surat_mutasi,
        );

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_mutasi_mutasi);
        $this->db->trans_complete();        

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        // send email surat keputusan
        $this->email_sk_mutasi($nomor_surat, $surat_mutasi);    

        return true;
    }

    public function email_sk_mutasi($nomor, $sk_mutasi)
    {
        $this->load->config('email');
        $this->load->library('email');

        $pegawai = $this->db->get_where('pegawai', array('account_nip' => $this->input->post('account_nip')))->row();        
        $from = $this->config->item('smtp_user');        
        $subject = 'Surat Keputusan Mutasi';        
        $message = "<strong>Surat Keputusan Mutasi</strong><br><br>

        Yth, ".$pegawai->nama."<br><br>
        Berikut kami lampirkan surat keputusan mutasi dengan nomor surat ".$nomor."<br> 
        Terima Kasih<br><br>";
        
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($pegawai->email);
        $this->email->subject($subject);    
        $this->email->attach(base_url('uploads/'.$sk_mutasi));                 
        $this->email->message($message);

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }
}