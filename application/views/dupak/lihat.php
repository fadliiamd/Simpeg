<h3 class="text-center">Formulir Usulan Penilaian Angka Kredit</h3>

<h5>Usulan Ke-<?= $number_usulan ?></h5>
<h5>Nama Pengusul : <?= $pegawai->nama ?></h5>
<h5>Jabatan : <?= $pegawai->nama_jabatan ?></h5>

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
                        $inc_char = 65;
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
                                if($val !== FALSE ){        
                                    $file = '<a href="' . base_url('uploads/' . $val->file) . '" target="_blank">Lihat File Bukti</a>';
                                    $nilai_akk=$val->nilai;
                                }else{
                                    $file = 'Tidak ada';
                                    $nilai_akk = 0;
                                }
                                if ($u->id == $uk->unsur_id) {
                                    $format_unsur_kegiatan .= '
                                <tr>
                                    <td>' . $uk->kode . '. ' . $uk->kegiatan . '</td>
                                    <td>' . $uk->satuan . '</td>
                                    <td>
                                        '. $file .'
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
        </div>
    </div>
</div>