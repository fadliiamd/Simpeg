<h3 class="text-center">Validasi Formulir Usulan Penilaian Angka Kredit Ke-<?= $id ?></h3>

<h5>Usulan Ke-<?= $number_usulan ?></h5>
<h5>Nama Pengusul : <?= $pegawai->nama ?></h5>
<h5>Jabatan : <?= $pegawai->nama_jabatan ?></h5>

<?php if ($this->session->flashdata('message_success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('message_success') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif ?>
<?php if ($this->session->flashdata('message_error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('message_error') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif ?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <form>
                <table class="table table-bordered mb-3">
                    <thead>
                        <tr class="text-center">
                            <th style="text-align:center">No</th>
                            <th colspan="2">Komponen Kegiatan</th>
                            <th>Batas Maksimal Diakui</th>
                            <th>Bukti Kegiatan</th>
                            <th style="word-wrap: break-word;min-width: 120px;max-width: 120px;white-space:normal;">Angka Kredit Tertinggi</th>
                            <th> Angka Kredit </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        function findObjectByUkId($id, $arr)
                        {
                            if (!(empty($arr))) {
                                foreach ($arr as $element) {
                                    if ($id == $element->unsur_kegiatan_id) {
                                        return $element;
                                    }
                                }
                            }

                            return false;
                        }
                        $current_u = '';
                        // if unsur = 'penelitian'
                        if($unsur[0]->unsur == 'penelitian'){
                            $inc_char = 67;
                        }else{
                            $inc_char = 65;
                        }
                        
                        $modals = array();
                        foreach ($unsur as $k => $u) {
                            if ($u->unsur != $current_u) { ?>
                                <tr>
                                    <td><?= chr($k + $inc_char) ?></td>
                                    <td colspan="5"><?= $u->unsur ?></td>
                                </tr>
                            <?php
                                $current_u = $u->unsur;
                            } else {
                                $inc_char--;
                            }

                            $jmlh_sub_kegiatan = 1;
                            $format_unsur_kegiatan = '';
                            foreach ($unsur_kegiatan as $key => $uk) {
                                $val = findObjectByUkId($uk->id, $nilai);
                                $file = '';
                                $nilai_akk = 0;
                                if ($val !== FALSE) {
                                    if(is_null($val->tanggal_validasi)){
                                        $read_only = "";
                                        $type_button = "btn-warning";
                                        $disabled = "";
                                        $check_setuju = '';
                                        $check_tolak = '';
                                        $tgl_format = '';
                                    }else{
                                        $tgl_format = '
                                            <div class="form-group">
                                                Waktu Validasi : '.$val->tanggal_validasi.'
                                            </div>
                                        ';                                        
                                        $read_only = "readonly";
                                        $disabled = "disabled";
                                        if($val->status === 'disetujui'){
                                            $type_button = "btn-success";
                                            $check_setuju = 'checked';
                                            $check_tolak = '';
                                        }else{
                                            $type_button = "btn-danger";
                                            $check_setuju = '';
                                            $check_tolak = 'checked';
                                        }
                                    }                                    
                                    $file = '
                                    <div class="text-center">
                                    <a href="' . base_url('uploads/' . $val->file) . '" target="_blank">Lihat File Bukti</a>
                                    </div>
                                    <div class="persetujuan mt-2">
                                        <button type="button" class="btn btn-sm '.$type_button.'" data-toggle="modal" data-target="#validasi-' . $val->id . '" >Validasi</button>                                       
                                    </div>';
                                    array_push(
                                        $modals,
                                        '<div class="modal fade" id="validasi-' . $val->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Validasi Kode Kegiatan : <b>' . $uk->kode . '</b></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="forms-sample" action="' . base_url('dupak/pemberkasan/do_validasi_nilai/' . $val->id . '/' . $val->rekap_nilai_id) . '" method="POST" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                '.$tgl_format.'
                                                                <div class="form-group">
                                                                    <label for="alasan">Alasan</label>
                                                                    <textarea type="text" class="form-control" rows="3" name="alasan" required '.$read_only.'>'.$val->alasan.'</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="saran">Saran</label>
                                                                    <textarea type="text" class="form-control" rows="3" name="saran" required '.$read_only.'>'.$val->saran.'</textarea>
                                                                </div>
                                                                <div class="form-group d-flex justify-content-center">
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="validasi'.$val->id.'" name="validasi" value="ditolak" class="custom-control-input" '.$check_tolak.'>
                                                                        <label class="custom-control-label" for="validasi'.$val->id.'">Tolak</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="validasi'.($val->id+1000).'" name="validasi" value="disetujui" class="custom-control-input" '.$check_setuju.' required>
                                                                        <label class="custom-control-label" for="validasi'.($val->id+1000).'">Setujui</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="">
                                                                    <button type="submit" class="btn btn-primary" '.$disabled.'>Validasi</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>'
                                    );
                                    $nilai_akk = $val->nilai;
                                } else {
                                    $file = 'Tidak ada';
                                    $nilai_akk = 0;
                                }
                                if ($u->id == $uk->unsur_id) {
                                    $format_unsur_kegiatan .= '
                                <tr>
                                    <td>' . $uk->kode . '. ' . $uk->kegiatan . '</td>
                                    <td>' . $uk->satuan . '</td>
                                    <td>
                                        ' . $file . '
                                    </td>
                                    <td>' . $uk->angka_kredit . '</td>
                                    <td><input class="form-control" type="number" step="any" name="nilai-' . $uk->id . '" value="' . $nilai_akk . '" disabled></td>
                                </tr>';
                                    $jmlh_sub_kegiatan++;
                                }
                            }
                            $format_sub_unsur = '
                        <tr>
                            <td rowspan="' . $jmlh_sub_kegiatan . '"></td>
                            <td rowspan="' . $jmlh_sub_kegiatan . '">' . ($k + 1) . '</td>
                            <td  style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;">' . $u->sub_unsur . ':</td>
                            <td></td>
                            <td></td>
                            <td></td>                            
                        </tr>';
                            echo $format_sub_unsur;
                            echo $format_unsur_kegiatan;
                            ?>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
            <div>
                <?php
                foreach ($modals as $modal) {
                    echo $modal;
                }
                ?>
            </div>
        </div>
    </div>
</div>