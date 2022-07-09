<div class="row">
    <div class="col-lg-12">
        <h3>Data Pengajuan Kenaikan Jabatan</h3>

        <!-- Large modal -->
        <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Tambah Data Pengajuan Kenaikan Jabatan</button>
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
        <!-- Modal -->
        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Pengajuan Kenaikan Jabatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="<?= base_url("kenaikan_jabatan/create_pengajuan"); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="accpunt_nip">Pegawai</label>        
                                    <select name="account_nip" class="form-control text-dark" required>
                                        <option value="" selected hidden>---Pilih Pegawai---</option>
                                        <?php 
                                        $option = '';
                                            foreach($pegawai as $p){
                                                $option .= '<option value="'.$p->account_nip.'">'.$p->account_nip.' - '.$p->nama.'</option>';
                                            }
                                        echo $option;
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="nama">Jabatan</label>        
                                    <select name="jabatan" class="form-control text-dark" required>
                                        <option value="" selected hidden>---Pilih Jabatan Yang Dituju---</option>
                                        <option value="asisten ahli">Asisten Ahli</option>
                                        <option value="lektor">Lektor</option>
                                    </select>
                                </div>
                            </div>
                            <div id="container-file-upload" class="row">
                            </div>                                                                               
                            <div class="form-group">
                                <label for="nama">Bukti Jurnal Nasional</label>
                                <input type="file" name="bukti_jurnal" class="form-control" required>
                            </div>                        
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <div class="table-responsive">
            <table id="tbl-data-pegawai" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>NIP</th>
                        <th>Jabatan Tujuan</th>
                        <th>Bukti 1</th>
                        <th>Bukti 2</th>
                        <th>Bukti Jurnal Nasional</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php
                    $label_bukti_1 = [
                        'asisten ahli' => 'Ijazah Magister',
                        'lektor' => 'Bukti PKM'                        
                    ];
                    $label_bukti_2 = [
                        'asisten ahli' => 'Bukti SKP',
                        'lektor' => 'Bukti Asisten Ahli'                        
                    ];
                    foreach ($pengajuan as $key => $value) { ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $value->id; ?></td>
                            <td><?php echo $value->account_nip; ?></td>
                            <td><?= $value->jabatan_tujuan ?></td>
                            <td>
                                <a target="_blank" href="<?=base_url('uploads/'.$value->bukti_1) ?>">
                                    Lihat <?= $label_bukti_1[$value->jabatan_tujuan] ?>
                                </a>
                            </td>
                            <td>
                                <a target="_blank" href="<?=base_url('uploads/'.$value->bukti_2) ?>">
                                    Lihat <?= $label_bukti_2[$value->jabatan_tujuan] ?>
                                </a>
                            </td>
                            <td>
                                <a target="_blank" href="<?=base_url('uploads/'.$value->bukti_jurnal) ?>">
                                    Lihat Jurnal
                                </a>
                            </td>  
                            <td><?= $value->status ?></td>                         
                            <td>
                                <!-- Large modal -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".edittable-<?= $value->id ?>">Edit</button>

                                <!-- Modal -->
                                <div class="modal fade edittable-<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pengajuan Kenaikan Jabatan ID : <b><?php echo "J-" . $value->id ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("pengajuan/update"); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="hidden" id="id_pengajuan" name="id_pengajuan" value="<?= $value->id ?>">

                                                        <label for="nama">Nama</label>
                                                        <input class="form-control" id="nama" name="nama" value="<?php echo $value->account_nip ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="submit" class="btn btn-primary">Edit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable-<?= $value->id ?>">Hapus</button>

                                <!-- Modal -->
                                <div class="modal fade" id="deletetable-<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pengajuan Kenaikan Jabatan ID : <b><?php echo "J-" . $value->id ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("pengajuan/delete"); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus pengajuan ini?</p>
                                                    <input type="hidden" id="id_pengajuan" name="id_pengajuan" value="<?= $value->id ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="submit" class="btn btn-danger">Ya, hapus aja</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>                                            
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php $no++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tbl-data-pegawai').DataTable();
        $('select[name="jabatan"]').on('change', function() {
            if(this.value == 'asisten ahli'){
                $("#container-file-upload").html(`
                    <div class="form-group col-md-6">
                        <label for="nama">Ijazah Magister</label>
                        <input type="file" name="bukti_1" class="form-control" required>
                        </div>
                    <div class="form-group col-md-6">
                        <label for="nama">Bukti SKP/Nilai Prestasi Kerja Selama 1 Tahun</label>
                        <input type="file" name="bukti_2" class="form-control" required>
                    </div>     
                `);
            }else{
                $("#container-file-upload").html(`
                    <div class="form-group col-md-6">
                        <label for="nama">Bukti Pengabdian Kepada Masyarakat</label>
                        <input type="file" name="bukti_1" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama">Bukti Menjabat Asisten Ahli (2 Tahun)</label>
                        <input type="file" name="bukti_2" class="form-control" required>
                    </div>      
                `);
            }
        });
    });    
</script>