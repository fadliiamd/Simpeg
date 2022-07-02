<div class="row">
    <div class="col-lg-12">
        <h3>Data Golongan dan Pangkat</h3>

        <!-- Large modal -->
        <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Tambah Data Golongan dan Pangkat</button>
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
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Golongan dan Pangkat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="<?= base_url("golpang/create"); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="golongan">Golongan</label>
                                <input class="form-control" id="golongan" name="golongan">
                                <label for="pangkat">Pangkat</label>
                                <input class="form-control" id="pangkat" name="pangkat">
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
            <table id="tbl-data-golpang" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Golongan</th>
                        <th>Pangkat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php
                    foreach ($golpang as $key => $value) { ?>
                        <tr>

                            <td><?php echo $no ?></td>
                            <td><?php echo $value->golongan; ?></td>
                            <td><?php echo $value->pangkat; ?></td>
                            <td>
                                <!-- Large modal -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".edittable-<?= $value->golongan ?>">Edit</button>

                                <!-- Modal -->
                                <div class="modal fade edittable-<?= $value->golongan ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Golongan dan Pangkat ID : <b><?php echo $value->golongan ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("golpang/update"); ?>" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" class="form-control" id="golongan" name="id_golpang" value="<?= $value->golongan ?>">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="pangkat">Golongan</label>
                                                        <input class="form-control" id="golongan" name="golongan" value="<?= $value->golongan ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pangkat">Pangkat</label>
                                                        <input class="form-control" id="pangkat" name="pangkat" value="<?php echo $value->pangkat ?>">
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

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable-<?= $value->golongan ?>">Hapus</button>

                                <!-- Modal -->
                                <div class="modal fade" id="deletetable-<?= $value->golongan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Golongan : <b><?php echo $value->golongan ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("golpang/delete"); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus Golongan dan Pangkat ini?</p>
                                                    <input type="hidden" id="id_golpang" name="id_golpang" value="<?= $value->golongan ?>">
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
        $('#tbl-data-golpang').DataTable();
    });
</script>