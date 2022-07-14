<h3 class="text-center">Formulir Penilaian Angka Kredit</h3>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <form action="<?php echo base_url('dupak/pemberkasan/do_create/'); ?>" method="POST" enctype="multipart/form-data">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th style="text-align:center">No</th>
                            <th colspan="2">Komponen Kegiatan</th>
                            <th>Batas Maksimal Diakui</th>
                            <th>Bukti Kegiatan</th>
                            <th style="word-wrap: break-word;min-width: 120px;max-width: 120px;white-space:normal;">Angka Kredit Tertinggi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
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
                            } ?>
                            <?php
                            $jmlh_sub_kegiatan = 1;
                            $format_unsur_kegiatan = '';
                            foreach ($unsur_kegiatan as $key => $uk) {
                                if ($u->id == $uk->unsur_id) {
                                    $format_unsur_kegiatan .= '
                                <tr>
                                    <td>' . $uk->kode . '. ' . $uk->kegiatan . '</td>
                                    <td>' . $uk->satuan . '</td>
                                    <td>
                                        <input type="file"  name="file_bukti-' . $uk->kode . '">
                                    </td>
                                    <td>' . $uk->angka_kredit . '</td>
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
                <div class="my-3">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>                
            </form>
        </div>
    </div>
</div>