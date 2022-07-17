<h2 class="text-center mb-3">Perhitungan Rangking Pegawai</h2>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="#" data-target="#mbp">Matriks Perbandingan Berpasangan</a></li>
        <li class="page-item"><a class="page-link" href="#" data-target="#mnk">Matriks Nilai Kriteria</a></li>
        <li class="page-item"><a class="page-link" href="#" data-target="#mptb">Matriks Penjumlahan Tiap Baris</a></li>
        <li class="page-item"><a class="page-link" href="#" data-target="#rk">Rasio Konsistensi</a></li>
    </ul>
</nav>

<div class="row">
    <div class="col-lg-12">
        <?php 
        function get_label_skala($val){
            switch($val){
                case 1:
                    $label_skala = "Kedua elemen sama pentingnya";
                    break;
                case 3:
                    $label_skala = "Elemen yang satu lebih sedikit penting dari pada elemen yang lainnya";
                    break;
                case 5:
                    $label_skala = "Elemen yang satu lebih penting dari pada elemen yang lainnya";
                    break;
                case 7:
                    $label_skala = "Satu elemen jelas lebih mutlak penting dari pada elemen yang lainnya";
                    break;
                case 9:
                    $label_skala = "Satu elemen mutlak penting dari pada elemen yang lainnya";
                    break;
                default:
                    $label_skala = "Nilai-nilai antara dua pertimbangan yang berdekatan";
                    break;

            }
            return $label_skala;
        }
        if ($this->session->flashdata('message_success')) : ?>
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
        <?php 
        if(isset($_GET["jenis_hitung"])){
            if(isset($_GET["kriteria"]))
            {
                if($_GET["jenis_hitung"]=='subkriteria'){
                    $select_kriteria = '
                    <form id="form-kriteria" method="GET" action="'.base_url('perhitungan').'" enctype="multipart/form-data">
                        <select class="form-control" id="kriteria" name="kriteria" required>';                            
                    $options ='';
                    foreach ($only_kriteria as $key => $val){
                        if($_GET["kriteria"] == $val->id){
                            $option = '<option value="' . $val->id . '" selected>'.$val->nama.'</option>';
                        }else{
                            $option = '<option value="' . $val->id . '">'.$val->nama.'</option>';
                        }
                        $options .= $option;
                    }
                    $select_kriteria .= $options.'</select>
                        <input type="hidden" name="jenis_hitung" value="subkriteria">
                    </form>';
                    echo $select_kriteria;
                }                
            }else{
                if($_GET["jenis_hitung"]=='subkriteria'){
                    $select_kriteria = '
                    <form id="form-kriteria" method="GET" action="'.base_url('perhitungan').'" enctype="multipart/form-data">
                        <select class="form-control" id="kriteria" name="kriteria" required>
                            <option value="" selected disabled hidden>-- Pilih Kriteria --</option>';
                    $option ='';
                    foreach ($only_kriteria as $key => $val){
                        $option .= '<option value="' . $val->id . '">'.$val->nama.'</option>';
                    }
                    $select_kriteria .= $option.'</select>
                        <input type="hidden" name="jenis_hitung" value="subkriteria">
                    </form>';
                    echo $select_kriteria;
                } 
            }       
        }?>
        <div class="table-responsive pt-3 text-dark">
            <form id="mbp" class="forms-sample matriks d-none" action="<?= base_url('perhitungan/simpan_mpb') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="kriteria_id" value="<?php if(isset($_GET["kriteria"])) echo $_GET["kriteria"]?>">
                <div class="form-group">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th colspan="5">
                                    Matriks Perbandingan Berpasangan
                                </th>
                            </tr>
                            <tr style="text-align: center;">
                                <th>
                                    Kriteria
                                </th>
                                <?php foreach ($kriteria as $key => $value) {
                                    echo "<th>" . $value->nama . "</th>";
                                } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $baris = 1;                            
                            foreach ($kriteria as $key => $b) {
                                $kolom = 1;
                            ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <?= $b->nama ?>
                                    </td>
                                    <?php foreach ($kriteria as $key => $k) { ?>
                                        <td>
                                            <div class="form-group" style="margin-bottom: 0;">
                                                <?php
                                                if ($kolom > $baris) {
                                                    $option_format = '';
                                                    for ($val = 1; $val <= 9; $val++) {
                                                        $label_skala = get_label_skala($val);
                                                        $option_format .= '<option value="' . $val . '">' . $val .' - ' . $label_skala .'</option>';
                                                    }
                                                    $format = '<select 
                                                        id="' . $baris . '-' . $kolom . '" 
                                                        name="' . $b->id . '-' . $k->id . '" class="select-skala form-control form-control-sm text-dark">                          
                                                        ' . $option_format . '</select>';
                                                } else {
                                                    $option_format = '';
                                                    for ($val = 1; $val <= 9; $val++) {                                                        
                                                        $option_format .= '<option value="' . $val . '">' . $val . '</option>';
                                                    }
                                                    $format = '<select 
                                                        id="' . $baris . '-' . $kolom . '" 
                                                        name="' . $b->id . '-' . $k->id . '" class="select-skala form-control form-control-sm text-dark" disabled>
                                                        ' . $option_format . '
                                                        </select>';
                                                }
                                                echo $format;
                                                ?>
                                            </div>
                                        </td>
                                    <?php
                                        $kolom++;
                                    } ?>
                                    </th>
                                </tr>
                            <?php
                                $baris++;
                            } ?>
                        </tbody>
                        <thead>
                            <tr style="text-align: center;">
                                <th style="vertical-align: middle;">
                                    Jumlah
                                </th>
                                <?php foreach (range(1, count($kriteria)) as $i) { ?>
                                    <th>
                                       <input id="jmlh-<?= $i ?>" class="form-control" value="1" disabled>
                                    </th>
                                <?php } ?>
                            </tr>
                        </thead>
                    </table>
                    <div class="mt-3">
                        <button id="load" type="button" class="btn btn-warning">Load Matriks</button>
                        <button id="simpan_skala" type="submit" name="jenis" value="<?= $_GET["jenis_hitung"]?>" class="btn btn-primary">Simpan Matriks</button>
                    </div>
                </div>
            </form>
            <div id="mnk" class="matriks form-group d-none">
                <table class="table table-bordered">
                    <thead>
                        <tr style="text-align: center;">
                            <th colspan="7">
                                Matriks Nilai Kriteria
                            </th>
                        </tr>
                        <tr style="text-align: center;">
                            <th>
                                Kriteria
                            </th>
                            <?php foreach ($kriteria as $key => $value) {
                                    echo "<th>" . $value->nama . "</th>";
                                } ?>
                            <th>
                                Jumlah
                            </th>
                            <th>
                                Prioritas
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php   
                        $baris = 1;                                            
                        foreach ($kriteria as $key => $b) {
                            $kolom = 1;  
                            $format = "<tr>";
                            $format .= "<td style='text-align: center;'>" . $b->nama . "</td>";
                            foreach ($kriteria as $key => $k){
                                $format .= '<td><input 
                                    id="mnk-'.$baris.'-'.$kolom.'" 
                                    type="text" class="form-control" value="1" disabled></td>';
                                $kolom++;
                            }
                            $format .= '<td><input 
                                id="mnk_jmlh-'.$baris.'" 
                                type="text" class="form-control" value="1" disabled></td>';
                            $format .= '<td><input 
                                id="mnk_prior-'.$baris.'"
                                type="text" class="form-control" value="1" disabled></td>';
                            $format .="</tr>";
                            $baris++;
                            echo $format;
                        }                         
                        ?>
                    </tbody>
                </table>
                <div class="mt-3">
                        <button id="hitung_mnk" type="button" class="btn btn-warning">Hitung</button>
                </div>
            </div>
            <div id="mptb" class="matriks form-group d-none">
                <table class="table table-bordered">
                    <thead>
                        <tr style="text-align: center;">
                            <th colspan="7">
                                Matriks Penjumlahan Tiap Baris
                            </th>
                        </tr>
                        <tr style="text-align: center;">
                            <th>
                                Kriteria
                            </th>
                            <?php foreach ($kriteria as $key => $value) {
                                    echo "<th>" . $value->nama . "</th>";
                                } ?>
                            <th>
                                Jumlah
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php   
                        $baris = 1;                                            
                        foreach ($kriteria as $key => $b) {
                            $kolom = 1;  
                            $format = "<tr>";
                            $format .= "<td style='text-align: center;'>" . $b->nama . "</td>";
                            foreach ($kriteria as $key => $k){
                                $format .= '<td><input 
                                    id="mptb-'.$baris.'-'.$kolom.'" 
                                    type="text" class="form-control" value="1" disabled></td>';
                                $kolom++;
                            }
                            $format .= '<td><input 
                                id="mptb_jmlh-'.$baris.'" 
                                type="text" class="form-control" value="1" disabled></td>';                            
                            $format .="</tr>";
                            $baris++;
                            echo $format;
                        }                         
                        ?>
                    </tbody>
                </table>
                <div class="mt-3">
                        <button id="hitung_mptb" type="button" class="btn btn-warning">Hitung</button>
                </div>
            </div>
            <form  id="rk" class="forms-sample matriks d-none" action="<?= base_url('perhitungan/simpan_nilai_prior') ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group ">
                    <table class="table table-bordered">
                        <thead>
                        <tr style="text-align: center;">
                            <th colspan="7">
                            Rasio Konsistensi
                            </th>
                        </tr>
                        <tr style="text-align: center;">
                            <th>
                            Kriteria
                            </th>
                            <th>
                            Jumlah Per Baris
                            </th>
                            <th>
                            Prioritas
                            </th>
                            <th>
                            Hasil
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php   
                            $baris = 1;                                            
                            foreach ($kriteria as $key => $b) {                            
                                $format = "<tr>";
                                $format .= "<td style='text-align: center;'>" . $b->nama . "</td>";
                                foreach (range(1, 2) as $kolom){
                                    $format .= '<td>
                                            <input type="text" 
                                            class="form-control rk-'.$baris.'-'.$kolom.'" value="1" disabled>
                                            <input name="'.$b->id.'-'.$kolom.'" type="hidden" 
                                            class="form-control rk-'.$baris.'-'.$kolom.'" value="1">
                                        </td>';                                
                                }    
                                $format .= '<td><input 
                                        id="rk_jmlh-'.$baris.'" 
                                        type="text" class="form-control" value="1" disabled></td>';                       
                                $format .="</tr>";
                                $baris++;
                                echo $format;
                            }                         
                            ?>
                        </tbody>
                        <thead>
                        <tr style="text-align: center;">
                            <th style="vertical-align: middle;" colspan="3">
                                Total
                            </th>
                            <th>
                                <input class="form-control" id="total_rk" value="3" disabled>
                            </th>
                        </tr>
                        </thead>
                    </table>
                    <div class="hasil mt-3">
                        <h3>Hasil Lanjutan</h3>
                        <ul>
                            <li>
                                Jumlah (jumlah kolom hasil) = <span id="jmlh_kolom_hasil">?</span>
                            </li>
                            <li>
                                Jumlah kriteria n = <span id="jmlh_kriteria">?</span>
                            </li>
                            <li>
                                lamda maks (Jumlah / n) = <span id="lamda_maks">?</span>
                            </li>
                            <li>
                                Nilai CI ((lamda maks - n)/(n-1)) = <span id="nilai_ci">?</span>
                            </li>
                            <li>
                                Nilai CR (CI / IR) = <span id="nilai_cr">?</span>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-3">
                        <button id="hitung_rk" type="button" class="btn btn-warning">Hitung</button>
                        <button id="simpan_hasil" type="submit" name="jenis" value="<?= $_GET["jenis_hitung"]?>"  class="btn btn-primary" disabled>Simpan Nilai</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    var max_mtx = <?= count($kriteria) ?>;
    var current = "";

    $('.select-skala').on('change', function() {        
        var idx_mtx = this.id;
        var idx_mtx_bar = this.id.split('-')[0];
        var idx_mtx_col = this.id.split('-')[1];       

        var nilai_invers = 1 / parseInt(this.value);
        var jmlh = 0;

        $('#' + idx_mtx_col + '-' + idx_mtx_bar).append('<option value="' + nilai_invers + '" selected>' + nilai_invers + '</option>');
        $('#' + idx_mtx_col + '-' + idx_mtx_bar).val(nilai_invers);

        for (j = 1; j <= max_mtx; j++) {
            jmlh = 0;
            for (i = 1; i <= max_mtx; i++) {
                jmlh += parseFloat($('#' + i + '-' + j).val());
            }
            $('#jmlh-' + j).val(jmlh);
        }
    });

    $('#kriteria').on('change', function() {
        $("#form-kriteria").submit();
    });

    $("#load").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: "<?= base_url('perhitungan/get_nilai_mbp'); ?>",
            data: {                
                jenis :  $('button[name="jenis"]').val()
            },
            error: function() {
                console.log("error");
            },
            beforeSend: function() {
                console.log("bentar lagi before send");
            },
            success: function(x) {
                console.log(x);
                if (x.status == "ok") {
                    $.each(x.data, function(key, d) {
                        // $('select[name="' + d.dari_kriteria + '-' + d.ke_kriteria + '"] option[value="' + d.nilai + '"]').attr('selected', true);
                        $('select[name="' + d.dari_kriteria + '-' + d.ke_kriteria + '"]').val(d.nilai);
                        $('select[name="' + d.dari_kriteria + '-' + d.ke_kriteria + '"]').trigger("change");
                        $('#hitung_mnk').trigger("click");
                        $('#hitung_mptb').trigger("click");
                        $('#hitung_rk').trigger("click");
                    });
                } else {
                    console.log("error tapi ya gitu lah success");
                }
            },
        });
    });

    $(".page-link").click(function(){
        target = $(this).data("target");
        if(target != current){
            $(".matriks").addClass( "d-none" );      
            $(".page-item").removeClass( "active" );
            $(this).parent().addClass( "active" );
            $(target).removeClass( "d-none" );   
            current = target;   
        }        
    })

    $("#hitung_mnk").click(function(){        
        // menghitung item kriteria
        for(i=1; i<=max_mtx; i++){
            jmlh = 0;
            prior = 0;
            for(j=1; j<=max_mtx; j++){
                item = parseFloat($("#"+i+"-"+j).val());
                jmlh_item = parseFloat($("#jmlh-"+j).val());                
                nilai_kriteria = item / jmlh_item;
                $("#mnk-"+i+"-"+j).val(nilai_kriteria);

                // menghitung jumlah
                jmlh += nilai_kriteria;                                                                            
            }            
            $("#mnk_jmlh-"+i).val(jmlh);
            
            // menghitung prioritas
            prior = jmlh/max_mtx;
            $("#mnk_prior-"+i).val(prior);
        }        
    })
    
    $("#hitung_mptb").click(function(){        
        // menghitung item kriteria
        for(i=1; i<=max_mtx; i++){
            jmlh = 0;            
            prior = parseFloat($("#mnk_prior-"+i).val());
            for(j=1; j<=max_mtx; j++){
                item = parseFloat($("#"+i+"-"+j).val());                             
                nilai_kriteria = item * prior;
                $("#mptb-"+i+"-"+j).val(nilai_kriteria);

                // menghitung jumlah
                jmlh += nilai_kriteria;                                                                            
            }            
            $("#mptb_jmlh-"+i).val(jmlh);        
        }        
    })
    
    $("#hitung_rk").click(function(){    
        arr = ["#mptb_jmlh-", "#mnk_prior-"];        
        // menghitung item kriteria
        hasil = 0;
        for(i=1; i<=max_mtx; i++){                                                           
            jmlh = 0;
            for(j=0; j<2; j++){  
                value = parseFloat($(arr[j]+i).val());               
                $(".rk-"+i+"-"+(j+1)).val(value);
                jmlh += value;
            }             
            $("#rk_jmlh-"+i).val(jmlh);     
            hasil += jmlh;   
        }       
        $("#total_rk").val(hasil);
        $("#jmlh_kolom_hasil").html(hasil);

        let n = max_mtx;
        $("#jmlh_kriteria").html(n);

        let lamda_maks = hasil/max_mtx
        $("#lamda_maks").html(lamda_maks);

        let nilai_ci = (lamda_maks-n)/(n-1);
        $("#nilai_ci").html(nilai_ci);

        let nilai_ir = [
            0, 0, 0.58, 1.90, 1.12, 1.24, 1.32, 
            1.41, 1.45, 1.49, 1.51, 1.48, 1.56,
            1.57, 1.59
        ];

        let nilai_cr = nilai_ci / (nilai_ir[n-1]);

        if(nilai_cr < 0.1)
        {
            $("#nilai_cr").html(nilai_cr + " <span class='badge badge-success'>DITERIMA!</span> ");
            $("#simpan_hasil").attr("disabled", false);
        }else{
            $("#nilai_cr").html(nilai_cr + " <span class='badge badge-danger'>DITOLAK!</span>");
            $("#simpan_hasil").attr("disabled", true);
        }

    })


</script>