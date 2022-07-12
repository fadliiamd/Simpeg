<div class="row">
	<div class="col-lg-12">
        <h4>Surat Keputusan Mutasi</h4>

        
        <?php if($this->session->userdata("role") == "admin"){ ?>   
            <!-- Large modal -->
            <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Surat Keputusan Mutasi</button>

            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Surat Keputusan Mutasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="forms-sample" action="<?= base_url("mutasi/create_data_sk_mutasi"); ?>" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="jenis_mutasi">Jenis Mutasi</label>
                                    <select class="form-control" id="jenis_mutasi" name="jenis_mutasi">
                                        <option value="Mutasi Masuk">Mutasi Masuk</option>
                                        <option value="Mutasi Keluar">Mutasi Keluar</option>
                                    </select>
                                </div>  
                                <div class="form-group">
                                    <label for="file_mutasi">File Mutasi</label>
                                    <input type="file" class="form-control-file" id="file_mutasi" name="file_mutasi">
                                </div>
                                <div class="form-group">
                                    <label for="usulanmutasi_id">Usulan Mutasi</label>
                                    <select class="form-control" id="usulanmutasi_id" name="usulanmutasi_id">
                                        <?php foreach ($usulan as $key => $value) { ?>
                                            <option value="<?= $value->id ?>"><?= $value->pegawai_nip ?> - <?= $value->alasan ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Tambah Surat Keputusan Mutasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal -->
        <?php } ?>

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
            <table class="table table-striped table-bordered table-datatable">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Jenis Mutasi</th>
                        <th>Tanggal Mutasi</th>
                        <th>File Mutasi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        foreach ($sk_mutasi as $key => $value) { 
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <?php if($value->jenis_mutasi == "Mutasi Masuk") {?>
                                    <span class="badge badge-success"><?= $value->jenis_mutasi ?></span>
                                <?php }else{ ?>
                                    <span class="badge badge-danger"><?= $value->jenis_mutasi ?></span>
                                <?php } ?>
                            </td>
                            <td><?= $value->tgl_mutasi ?></td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->file_mutasi ?>" download class="btn btn-secondary">Unduh</a>    
                            </td>
                            <td>
                                <?php if($this->session->userdata("role") == "admin"){ ?>   
                                    <!-- Large modal -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target=".edittable">Edit</button>

                                    <!-- Modal -->
                                    <div class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Surat Keputusan Mutasi Id : <b><?= $value->id ?><b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="forms-sample" action="<?= base_url("mutasi/update_data_sk_mutasi"); ?>" method="POST" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <input type="hidden" name="id" value="<?= $value->id ?>">
                                                            <label for="jenis_mutasi">Jenis Mutasi</label>
                                                            <select class="form-control" id="jenis_mutasi" name="jenis_mutasi">
                                                                <?php if($value->jenis_mutasi == "Mutasi Masuk") {?>
                                                                    <option selected>Mutasi Masuk</option>
                                                                <?php }else { ?>
                                                                    <option>Mutasi Masuk</option>
                                                                <?php } ?>
                                                                <?php if($value->jenis_mutasi == "Mutasi Keluar") {?>
                                                                    <option selected>Mutasi Keluar</option>
                                                                <?php }else { ?>
                                                                    <option>Mutasi Keluar</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="file_mutasi">File Mutasi</label>
                                                            <input type="file" class="form-control-file" id="file_mutasi" name="file_mutasi">
                                                            <a href="<?= base_url().'uploads/'.$value->file_mutasi ?>" download>Download File Mutasi</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="usulan_mutasi">Usulan Mutasi</label>
                                                            <select class="form-control" id="usulanmutasi_id" name="usulanmutasi_id">
                                                                <?php foreach ($usulan as $key => $b) {  
                                                                    if($value->usulanmutasi_id == $b->id)?>
                                                                    <option value="<?= $b->id ?>"><?= $b->pegawai_nip ?> - <?= $b->alasan ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-primary">Edit Surat Keputusan Mutasi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable">
                                    Hapus
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deletetable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form class="forms-sample" action="<?= base_url("mutasi/delete_data_sk_mutasi"); ?>" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Surat Keputusan Mutasi Id : <b><?= $value->id ?><b></h5>
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

                                    
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>