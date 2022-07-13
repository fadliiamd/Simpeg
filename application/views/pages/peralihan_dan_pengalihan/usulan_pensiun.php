<div class="row">
	<div class="col-lg-12">
        <h4>Usulan Pensiun</h4>

        <!-- <a href="<?= base_url().'assets/pdf/template-surat-pengunduran-diri.pdf'?>" download class="my-3 btn btn-secondary">Surat Usulan Pensiun</a>     -->

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
                        <th>Tanggal Pensiun</th>
                        <th>Tanggal Usulan</th>
                        <th>Status Persetujuan</th>
                        <th>Tanggal Persetujuan</th>
                        <th>Surat Usulan</th>
                        <?php if($this->session->userdata("role") == "admin"){ ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        foreach ($usulan_pensiun as $key => $value) { 
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value->tgl_pensiun ?></td>
                            <td><?= $value->tgl_usulan ?></td> 
                            <td>
                                <?php if($value->status_persetujuan == "pending") {?>
                                    <span class="badge badge-warning"><?= $value->status_persetujuan; ?></span>
                                    <?php if($this->session->userdata("role") == "direktur" && $value->tgl_pensiun != null && $value->surat_usulan != null){ ?>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetable">
                                                Setujui
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="approvetable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="forms-sample" action="<?= base_url("pemberhentian/status_usulan"); ?>" method="POST">
                                                            <div class="modal-header">
                                                                <input type="hidden" name="usulanpensiun_id" value="<?= $value->id ?>">
                                                                <input type="hidden" name="id" value="<?= $value->id ?>">
                                                                <input type="hidden" name="tgl_pensiun" value="<?= $value->tgl_pensiun ?>">
                                                                <input type="hidden" name="status" value="setujui">
                                                                <h5 class="modal-title" id="exampleModalLabel">Setujui Pengajuan Mutasi No : <b><?= $i ?></b> </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Setujui Mutasi</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noapprovetable">
                                                Tolak
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="noapprovetable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="forms-sample" action="<?= base_url("pemberhentian/status_usulan"); ?>" method="POST">
                                                            <div class="modal-header">
                                                                <input type="hidden" name="usulanpensiun_id" value="<?= $value->id ?>">
                                                                <input type="hidden" name="id" value="<?= $value->id ?>">
                                                                <input type="hidden" name="status" value="tolak">
                                                                <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan Mutasi No : <b><?= $i ?></b> </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Tolak Mutasi</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <?php }; ?>
                                <?php } else { ?>
                                    <?php if($value->status_persetujuan == "setujui") {?>
                                        <span class="badge badge-success"><?= $value->status_persetujuan; ?></span>
                                    <?php }; ?>
                                    <?php if($value->status_persetujuan == "tolak") {?>
                                        <span class="badge badge-danger"><?= $value->status_persetujuan; ?></span>
                                    <?php }; ?>
                                <?php }; ?>

                            </td>
                            <td><?= ($value->tgl_persetujuan == null) ? "-" : $value->tgl_persetujuan ; ?></td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->surat_usulan ?>" download class="btn btn-secondary">Unduh</a>    
                                <?php if($this->session->userdata("role") == "admin"){ ?>  
                                    <!-- Large modal -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target=".uploadtable">Upload</button>

                                    <!-- Modal -->
                                    <div class="modal fade uploadtable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Upload Surat Usulan Pensiun No : <b><?= $i; ?><b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="forms-sample" action="<?= base_url("pemberhentian/upload_data_usulan"); ?>" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?= $value->id ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="nip">NIP</label>
                                                            <input type="text" class="form-control" id="nip" value="<?= $value->pegawai_nip ?> - <?= $value->alasan ?>" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="surat_usulan">Surat Usulan</label>
                                                            <input type="file" class="form-control-file" id="surat_usulan" name="surat_usulan">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-primary">Upload File Usulan</button>
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
                                    <!-- Large modal -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target=".edittable">Edit</button>

                                    <!-- Modal -->
                                    <div class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Usulan Pensiun No : <b><?= $i; ?><b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="forms-sample" action="<?= base_url("pemberhentian/update_data_usulan"); ?>" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?= $value->id ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="nip">NIP</label>
                                                            <input type="text" class="form-control" id="nip" value="<?= $value->pegawai_nip ?> - <?= $value->alasan ?>" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tgl_pensiun">Tanggal Pensiun</label>
                                                            <input type="date" class="form-control" id="tgl_pensiun" name="tgl_pensiun">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-primary">Edit Usulan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable<?= $value->id ?>">
                                    Hapus
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deletetable<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form class="forms-sample" action="<?= base_url("pemberhentian/delete_data_usulan"); ?>" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Usulan Mutasi Id : <b><?= $value->id ?><b></h5>
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
                            <?php } ?>
                        </tr>
                    <?php $i++; } ?>
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pensiun</th>
                        <th>Tanggal Usulan</th>
                        <th>Status Persetujuan</th>
                        <th>Tanggal Persetujuan</th>
                        <th>Surat Usulan</th>
                        <?php if($this->session->userdata("role") == "admin"){ ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>