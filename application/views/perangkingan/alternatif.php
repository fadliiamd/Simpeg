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
        <div class="table-responsive pt-3 text-dark">
            <form id="mbp" class="forms-sample" action="<?= base_url('perhitungan/simpan_mpb') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="kriteria_id" value="<?php if(isset($_GET["kriteria"])) echo $_GET["kriteria"]?>">
                <div class="form-group">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th colspan="5">
                                    Matriks Alternatif
                                </th>
                            </tr>
                            <tr style="text-align: center;">
                                <th>
                                    Pegawai
                                </th>
                                <?php foreach ($kriteria as $key => $value) {
                                    echo "<th>" . $value->nama . "</th>";
                                } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $baris = 1;
                            foreach ($pegawai as $key => $b) {
                                $kolom = 1;
                            ?>
                                <tr>
                                    <td style="text-align: center;">
                                    <?= $b->account_nip ?><br>
                                        <?= $b->nama ?>                                     
                                    </td>
                                    <?php foreach ($kriteria as $key => $k) { ?>
                                        <td>
                                            <div class="form-group" style="margin-bottom: 0;">                                            
                                                <?php                                                
                                                $option_format = '<option value="5">Baik</option>
                                                <option value="3">Cukup</option>
                                                <option value="1">Kurang</option>';                                              
                                                $format = '<select 
                                                        id="' . $baris . '-' . $kolom . '" 
                                                        name="' . $b->account_nip . '-' . $k->id . '" class="select-skala form-control form-control-sm text-dark">                          
                                                        ' . $option_format . '</select>';                                                
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
                    </table>
                    <div class="mt-3">
                        <button id="load" type="button" class="btn btn-warning">Load Matriks</button>
                        <button id="simpan_skala" type="submit" name="jenis" value="" class="btn btn-primary">Simpan Matriks</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>