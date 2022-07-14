<h3 class="text-center">Form Penilaian Angka Kredit</h3>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
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
                    foreach ($unsur as $k => $u){ 
                        if($u->unsur != $current_u){ ?>
                            <tr>
                                <td><?= chr($k+$inc_char) ?></td>
                                <td colspan="5"><?= $u->unsur ?></td>
                            </tr>
                    <?php 
                            $current_u = $u->unsur;
                        }else{
                            $inc_char--;
                        } ?>                        
                        <?php
                        $jmlh_sub_kegiatan = 1;    
                        $format_unsur_kegiatan = '';                     
                        foreach ($unsur_kegiatan as $key => $uk){ 
                            if($u->id == $uk->unsur_id) {
                                $format_unsur_kegiatan .= '
                                <tr>
                                    <td>'.$uk->kode.'. '.$uk->kegiatan.'</td>
                                    <td>'.$uk->satuan.'</td>
                                    <td>
                                        <input type="file"  name="file_bukti-'.$uk->kode.'">
                                    </td>
                                    <td>'.$uk->angka_kredit.'</td>
                                </tr>';   
                                $jmlh_sub_kegiatan++;                   
                            }
                        } 
                        $format_sub_unsur = '
                        <tr>
                            <td rowspan="'.$jmlh_sub_kegiatan.'"></td>
                            <td rowspan="'.$jmlh_sub_kegiatan.'">'.($k+1).'</td>
                            <td  style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;">'.$u->sub_unsur.':</td>
                            <td></td>
                            <td></td>
                            <td></td>                            
                        </tr>';
                        echo $format_sub_unsur;
                        echo $format_unsur_kegiatan;
                        ?>
                    <?php } ?>
                    <!-- <tr>
                        <td>A</td>
                        <td colspan="5">Pedidikan</td>
                    </tr>
                    <tr>
                        <td rowspan="3"></td>
                        <td rowspan="3">1</td>
                        <td>Mengikuti pendidikan formal dan meperoleh gelar/sebutan/ijazah:</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>a. Dokter/sederajat</td>
                        <td>1/periode penilaian</td>
                        <td>
                            <input type="file"  name="xxxxx">
                        </td>
                        <td>200</td>
                    </tr>
                    <tr>
                        <td>b. Dokter/sederajat</td>
                        <td>1/periode penilaian</td>
                        <td><input type="file"  name="xxxxx"></td>
                        <td>200</td>
                    </tr>
                    <tr>
                        <td>B</td>
                        <td colspan="5">Pelaksanaan Pedidikan</td>
                    </tr>
                    <tr>
                        <td rowspan="3"></td>
                        <td rowspan="3">2</td>
                        <td>Mengikuti pendidikan formal dan meperoleh gelar/sebutan/ijazah:</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>a. Dokter/sederajat</td>
                        <td>1/periode penilaian</td>
                        <td><input type="file"  name="xxxxx"></td>
                        <td>200</td>
                    </tr>
                    <tr>
                        <td>b. Dokter/sederajat</td>
                        <td>1/periode penilaian</td>
                        <td><input type="file"  name="xxxxx"></td>
                        <td>200</td>
                    </tr>
                    <tr>
                        <td>C</td>
                        <td colspan="5">Penilitian</td>
                    </tr>
                    <tr>
                        <td rowspan="3"></td>
                        <td rowspan="3">2</td>
                        <td>Mengikuti pendidikan formal dan meperoleh gelar/sebutan/ijazah:</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>a. Dokter/sederajat</td>
                        <td><input type="file"  name="xxxxx"></td>
                        <td>1/periode penilaian</td>
                        <td>200</td>
                    </tr>
                    <tr>
                        <td>b. Dokter/sederajat</td>
                        <td><input type="file"  name="xxxxx"></td>
                        <td>1/periode penilaian</td>
                        <td>200</td>
                    </tr>
                    <tr>
                        <td>D</td>
                        <td colspan="5">Pengabdian Kepada Masyarakat</td>
                    </tr>
                    <tr>
                        <td rowspan="3"></td>
                        <td rowspan="3">2</td>
                        <td>Mengikuti pendidikan formal dan meperoleh gelar/sebutan/ijazah:</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>a. Dokter/sederajat</td>
                        <td><input type="file"  name="xxxxx"></td>
                        <td>1/periode penilaian</td>
                        <td>200</td>
                    </tr>
                    <tr>
                        <td>b. Dokter/sederajat</td>
                        <td><input type="file"  name="xxxxx"></td>
                        <td>1/periode penilaian</td>
                        <td>200</td>
                    </tr>
                    <tr>
                        <td>E</td>
                        <td colspan="5">Unsur Penunjang</td>
                    </tr>
                    <tr>
                        <td rowspan="3"></td>
                        <td rowspan="3">2</td>
                        <td>Mengikuti pendidikan formal dan meperoleh gelar/sebutan/ijazah:</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>a. Dokter/sederajat</td>
                        <td><input type="file"  name="xxxxx"></td>
                        <td>1/periode penilaian</td>
                        <td>200</td>
                    </tr>
                    <tr>
                        <td>b. Dokter/sederajat</td>
                        <td><input type="file"  name="xxxxx"></td>
                        <td>1/periode penilaian</td>
                        <td>200</td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</div>