<div class="row">
	<div class="col-lg-12">
        <h4>Surat Keputusan Mutasi</h4>

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

        <div class="table-responsive">
            <table class="table text-center table-striped table-bordered table-datatable">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Pegawai</th>
                        <th>Jenis Mutasi</th>
                        <th>Instansi Tujuan</th>
                        <th>Jabatan Tujuan</th>
                        <th>Tanggal Mutasi</th>
                        <th>Tanggal Persetujuan</th>
                        <th>No Surat</th>
                        <th>File Mutasi</th>
                        <?php if($this->session->userdata("role") == "admin"){ ?>  
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        foreach ($sk_mutasi as $key => $value) { 
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <?php if($value->jenis_mutasi == "Mutasi Masuk") {?>
                                <td><?= $value->penerimaan_nip ?></td>
                            <?php }else{ ?>
                                <td><?= $value->pegawai_nip ?></td>
                            <?php } ?>
                            <td>
                                <?php if($value->jenis_mutasi == "Mutasi Masuk") {?>
                                    <span class="badge badge-success"><?= $value->jenis_mutasi ?></span>
                                <?php }else{ ?>
                                    <span class="badge badge-danger"><?= $value->jenis_mutasi ?></span>
                                <?php } ?>
                            </td>
                            <td><?= $value->instansi_tujuan ?></td>
                            <td><?= $value->jabatan_tujuan ?></td>
                            <td><?= $value->tgl_mutasi ?></td>
                            <td><?= $value->tgl_persetujuan ?></td>
                            <td><?= $value->nomor_surat ?></td>
                            <td>
                                <?php if($value->file_mutasi != null){ ?>  
                                    <a href="<?= base_url().'uploads/'.$value->file_mutasi ?>" download class="btn btn-secondary">Unduh</a>    
                                <?php } ?>
                                <?php if($this->session->userdata("role") == "admin"){ ?>  
                                    <!-- Large modal -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadtable<?=$i?>">Upload</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="uploadtable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Upload File Mutasi No : <b><?= $i; ?><b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="forms-sample" action="<?= base_url("mutasi/upload_data_sk"); ?>" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?= $value->id ?>">
                                                    <input type="hidden" name="account_nip" value="<?= $value->pegawai_nip ?>">
                                                    <div class="modal-body">
                                                        <?php if($value->jenis_mutasi == "Mutasi Keluar") { ?>
                                                            <div class="form-group">
                                                                <label for="nip">NIP</label>
                                                                <input type="text" class="form-control" id="nip" value="<?= $value->pegawai_nip ?> - <?= $value->alasan ?>" disabled>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="form-group">
                                                            <label for="nomor_surat">Nomor Surat</label>
                                                            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="file_mutasi">File Mutasi</label>
                                                            <input type="file" class="form-control-file" id="file_mutasi" name="file_mutasi">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-primary">Upload File Keputusan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                <?php } ?>
                            </td>
                            <?php if($this->session->userdata("role") == "admin"){ ?>   
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable<?=$i?>">
                                    Hapus
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deletetable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form class="forms-sample" action="<?= base_url("mutasi/delete_data_sk_mutasi"); ?>" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Surat Keputusan Mutasi No : <b><?= $i ?><b></h5>
                                                        <input type="hidden" name="id" value="<?= $value->id ?>">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Hapus Berkas</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </td>
                            <?php $i++; } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>