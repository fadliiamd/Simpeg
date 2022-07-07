<h2 class="text-center mb-3">Perhitungan Alternatif Pegawai</h2>

<div class="row">
    <div class="col-lg-12">
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
        <div class="matriks-reference">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header p-0" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Nilai Prioritas Kriteria
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div id="mnk" class="matriks form-group mb-0">
                                <table class="table table-bordered">
                                    <thead>      
                                        <tr style="text-align: center;">           
                                            <?php foreach ($kriteria as $key => $value) {
                                                echo "<th>" . $value->nama . "</th>";
                                            } ?>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php         
                                            $data_kriteria = [];
                                            foreach ($kriteria as $key => $b) {                                            
                                                $format = "";
                                                $format .= "<td id='".$b->id."' style='text-align: center;'>" . $b->nilai_prioritas . "</td>";
                                                $data_kriteria += array($b->id => $b->nilai_prioritas);
                                                echo $format;
                                            }                         
                                        ?>
                                        </tr>                                        
                                    </tbody>
                                </table>
                                <!-- <div class="mt-3">
                                        <button id="hitung_mnk" type="button" class="btn btn-warning">Hitung</button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header p-0" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Nilai Prioritas Sub-Kriteria
                        </button>
                    </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                    <div id="mnk" class="matriks form-group mb-0">
                                <table class="table table-responsive table-bordered">
                                    <thead>      
                                        <tr style="text-align: center;">           
                                            <?php foreach ($subkriteria as $key => $value) {
                                                echo "<th>" . $value->sub_nama . "<br>(".
                                                    $value->nama.")</th>";
                                            } ?>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php         
                                            $data_subkriteria = [];
                                            foreach ($subkriteria as $key => $b) {
                                                $format = "<td id='".$b->sub_id."-".$b->id."' style='text-align: center;'>" . $b->nilai_prioritas . "</td>";
                                                $data_subkriteria += array($b->sub_id => $b->nilai_prioritas);
                                                echo $format;
                                            }                         
                                        ?>
                                        </tr>                                        
                                    </tbody>
                                </table>
                                <!-- <div class="mt-3">
                                        <button id="hitung_mnk" type="button" class="btn btn-warning">Hitung</button>
                                </div> -->
                            </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive pt-3 text-dark">
            <form id="mna" class="forms-sample" action="<?= base_url('perhitungan/simpan_mna') ?>" method="post" enctype="multipart/form-data">                
                <div class="form-group">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th colspan="5">
                                    Matriks Nilai Alternatif
                                </th>
                            </tr>
                            <tr style="text-align: center;">
                                <th>
                                    Pegawai
                                </th>
                                <?php 
                                $arr_kriteria = [];
                                foreach ($kriteria as $key => $value) {
                                    echo "<th>" . $value->nama . "</th>";
                                    array_push($arr_kriteria, $value->id);
                                } ?>
                                <th>
                                    Total Nilai Rank
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $baris = 1;
                            $label = [
                                "1" => "Kurang",
                                "3" => "Cukup",
                                "5" => "Baik"
                            ];
                            foreach ($pegawai as $key => $b) {
                                $kolom = 1;
                                $jumlah = 0;
                            ?>
                                <tr>
                                    <td style="text-align: center;">
                                    <?= $b->account_nip ?><br>
                                        <?= $b->nama ?>                                     
                                    </td>
                                    <td> 
                                        <?php 
                                            $d1 = new DateTime($b->tgl_masuk);
                                            $d2 = new DateTime();
                                            $interval = $d1->diff($d2);
                                            $diffInMonths  = $interval->y*12 + $interval->m;
                                            
                                            echo $diffInMonths." Bulan";
                                            $id_sub = 0;
                                            $id_kriteria = 0;
                                            foreach ($subkriteria as $key => $value) {
                                                if($value->kriteria_id == $arr_kriteria[0]){
                                                    if($value->greater_than <= $diffInMonths  && $diffInMonths <= $value->less_than){
                                                        echo '<input type="hidden" name="'.$b->account_nip.'-'.$value->kriteria_id.'" value="'.$value->sub_id.'-'.$value->kriteria_id.'">';
                                                        echo '<br>('.$label[$value->nilai].')';
                                                        $id_sub = $value->sub_id;
                                                        $id_kriteria = $value->kriteria_id;
                                                        break;
                                                    } else if($value->greater_than <= $diffInMonths && $value->tipe=="greater-than")                                           {
                                                        echo '<input type="hidden" name="'.$b->account_nip.'-'.$value->kriteria_id.'" value="'.$value->sub_id.'-'.
                                                        $value->kriteria_id.'">';
                                                        echo '<br>('.$label[$value->nilai].')';
                                                        $id_sub = $value->sub_id;
                                                        $id_kriteria = $value->kriteria_id;
                                                        break;
                                                    }else if( $diffInMonths <= $value->less_than && $value->tipe=="less-than"){
                                                        echo '<input type="hidden" name="'.$b->account_nip.'-'.$value->kriteria_id.'" value="'.$value->sub_id.'-'.$value->kriteria_id.'">';
                                                        echo '<br>('.$label[$value->nilai].')';
                                                        $id_sub = $value->sub_id;
                                                        $id_kriteria = $value->kriteria_id;
                                                        break;
                                                    }
                                                }                                                
                                            }   
                                            
                                            $nilai_sub = $data_subkriteria[$id_sub];
                                            $nilai_kriteria = $data_kriteria[$id_kriteria];
                                            $jumlah += $nilai_sub*$nilai_kriteria;
                                        ?> 
                                    </td>
                                    <td> <?php 
                                            echo $b->pendidikan;
                                            $id_sub = 0;
                                            $id_kriteria = 0;                        
                                            foreach ($subkriteria as $key => $value) {
                                                if($value->kriteria_id == $arr_kriteria[1]){
                                                    if($b->pendidikan == $value->sub_nama){
                                                        echo '<input type="hidden" name="'.$b->account_nip.'-'.$value->kriteria_id.'" value="'.$value->sub_id.'-'.$value->kriteria_id.'">';
                                                        echo '<br>('.$label[$value->nilai].')';
                                                        $id_sub = $value->sub_id;
                                                        $id_kriteria = $value->kriteria_id;
                                                        break;
                                                    }else if(strpos($value->sub_nama, $b->pendidikan) !== false && $value->tipe=='in-text'){
                                                        echo '<input type="hidden" name="'.$b->account_nip.'-'.$value->kriteria_id.'" value="'.$value->sub_id.'-'.$value->kriteria_id.'">';
                                                        echo '<br>('.$label[$value->nilai].')';
                                                        $id_sub = $value->sub_id;
                                                        $id_kriteria = $value->kriteria_id;
                                                        break;
                                                    }
                                                }                                                
                                            }
                                            $nilai_sub = $data_subkriteria[$id_sub];
                                            $nilai_kriteria = $data_kriteria[$id_kriteria];
                                            $jumlah += $nilai_sub*$nilai_kriteria;

                                        ?>  </td>
                                    <td>
                                        <?php 
                                            if(is_null($b->nama_serti)){
                                                echo 0;
                                                $b->jmlh_serti = 0;
                                            }else{
                                                echo $b->jmlh_serti;
                                            }                                            
                                            $id_sub = 0;
                                            $id_kriteria = 0;               
                                            foreach ($subkriteria as $key => $value) {
                                                if($value->kriteria_id == $arr_kriteria[2]){
                                                    if($b->jmlh_serti == $value->equal && $value->tipe=="equal"){
                                                        echo '<input type="hidden" name="'.$b->account_nip.'-'.$value->kriteria_id.'" value="'.$value->sub_id.'-'.$value->kriteria_id.'">';
                                                        echo '<br>('.$label[$value->nilai].')';
                                                        $id_sub = $value->sub_id;
                                                        $id_kriteria = $value->kriteria_id;
                                                        break;
                                                    }
                                                    else if($value->greater_than <=  $b->jmlh_serti  && $b->jmlh_serti <= $value->less_than){
                                                        echo '<input type="hidden" name="'.$b->account_nip.'-'.$value->kriteria_id.'" value="'.$value->sub_id.'-'.$value->kriteria_id.'">';
                                                        echo '<br>('.$label[$value->nilai].')';
                                                        $id_sub = $value->sub_id;
                                                        $id_kriteria = $value->kriteria_id;
                                                        break;
                                                    } else if($value->greater_than <=  $b->jmlh_serti && $value->tipe=="greater-than")                                           {
                                                        echo '<input type="hidden" name="'.$b->account_nip.'-'.$value->kriteria_id.'" value="'.$value->sub_id.'-'.
                                                        $value->kriteria_id.'">';
                                                        echo '<br>('.$label[$value->nilai].')';
                                                        $id_sub = $value->sub_id;
                                                        $id_kriteria = $value->kriteria_id;
                                                        break;
                                                    }else if($b->jmlh_serti <= $value->less_than && $value->tipe=="less-than"){
                                                        echo '<input type="hidden" name="'.$b->account_nip.'-'.$value->kriteria_id.'" value="'.$value->sub_id.'-'.$value->kriteria_id.'">';
                                                        echo '<br>('.$label[$value->nilai].')';
                                                        $id_sub = $value->sub_id;
                                                        $id_kriteria = $value->kriteria_id;
                                                        break;
                                                    }
                                                }                                                
                                            }  
                                            $nilai_sub = $data_subkriteria[$id_sub];
                                            $nilai_kriteria = $data_kriteria[$id_kriteria];
                                            $jumlah += $nilai_sub*$nilai_kriteria;           
                                        ?>
                                    </td>
                                    <td id="<?= $b->account_nip ?>-jmlh" class="text-center">
                                        <?= $jumlah ?>                                       
                                    </td>
                                    <input type="hidden" name="<?= $b->account_nip ?>-jmlh" value="<?= $jumlah ?>">
                                    </th>
                                </tr>
                            <?php
                                $baris++;
                            } ?>
                        </tbody>
                    </table>
                    <div class="mt-3">                        
                        <button id="simpan_hasil" type="submit" class="btn btn-primary">Simpan Hasil</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>    
    let total = 0;

    $('select').on('change', function(){    
        sub_id = this.value.split('-')[0];
        c_id = this.value.split('-')[1];
        nip = this.name.split('-')[0];

        nilai_sub = $('#'+this.value).html();
        nilai_kriteria = $('#'+c_id).html();        

        jumlah = parseFloat($('#'+nip+'-jmlh').html());
        jumlah = total + nilai_sub * nilai_kriteria;
        total = jumlah;

        $('#'+nip+'-jmlh').html(jumlah);        
        $('input[name="'+nip+'-jmlh"').val(jumlah);        
    });
</script>