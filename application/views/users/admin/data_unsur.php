<div class="row">
    <div class="col-lg-12">
        <h3>Data Unsur</h3>

        <!-- Large modal -->
        <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Tambah Data Unsur</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Data Unsur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="<?= base_url("pak/unsur/create"); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Unsur</label>
                                <select class="form-control" name="unsur" required>
                                    <option value="" selected hidden>--- Pilih Unsur ---</option>
                                    <option value="pendidikan">Pendidikan</option>
                                    <option value="pelaksanaan pendidikan">Pelaksanaan Pendidikan</option>
                                    <option value="pkm">Pendabdian Kepada Masyarakat</option>
                                    <option value="penelitian">Penilitan</option>
                                    <option value="unsur penunjang">Unsur Penunjang</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_unsur">Sub Unsur</label>
                                <input class="form-control" id="sub_unsur" name="sub_unsur">
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
            <table id="tbl-data-Unsur" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Unsur</th>
                        <th>Sub Unsur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php
                    foreach ($unsur as $key => $value) { ?>
                        <tr>
                            <td><?php echo $key+1 ?></td>
                            <td><?php echo $value->unsur; ?></td>
                            <td><?php echo $value->sub_unsur; ?></td>
                            <td>
                                <!-- Large modal -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".edittable-<?= $value->id ?>">Edit</button>

                                <!-- Modal -->
                                <div class="modal fade edittable-<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Unsur ID : <b><?php echo "U-" . $value->id ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("pak/unsur/update/".$value->id); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nama">Unsur</label>
                                                    <select class="form-control" name="unsur" required>
                                                        <option value="<?= $value->unsur ?>" selected hidden><?= $value->unsur ?></option>
                                                        <option value="pendidikan">Pendidikan</option>
                                                        <option value="pelaksanaan pendidikan">Pelaksanaan Pendidikan</option>
                                                        <option value="pkm">Pengabdian Kepada Masyarakat</option>
                                                        <option value="penelitian">Penilitan</option>
                                                        <option value="unsur penunjang">Unsur Penunjang</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sub_unsur">Sub Unsur</label>
                                                    <input class="form-control" id="sub_unsur" name="sub_unsur" value="<?= $value->sub_unsur ?>" required>
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
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Unsur ID : <b><?php echo "U-" . $value->id ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("pak/unsur/delete/".$value->id); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus Unsur ini?</p>                                                    
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
        $('#tbl-data-Unsur').DataTable();
    });
</script>