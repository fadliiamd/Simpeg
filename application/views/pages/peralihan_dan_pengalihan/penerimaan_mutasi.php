<div class="row">
	<div class="col-lg-12">
        <h4>Penerimaan Mutasi</h4>

        
        <?php if($this->session->userdata("role") == "admin"){ ?>   
            <!-- Large modal -->
            <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Penerimaan Mutasi</button>

            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pengajuan Mutasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="forms-sample" action="<?= base_url("mutasi/create_data_penerimaan"); ?>" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="daerah_asal">Daerah Asal</label>
                                    <input type="text" class="form-control" id="daerah_asal" name="daerah_asal" placeholder="Daerah Asal">
                                </div>
                                <div class="form-group">
                                    <label for="instansi_asal">Instansi Asal</label>
                                    <input type="text" class="form-control" id="instansi_asal" name="instansi_asal" placeholder="Instansi Asal">
                                </div>
                                <div class="form-group">
                                    <label for="alasan">Alasan</label>
                                    <textarea class="form-control" id="alasan" rows="4" name="alasan"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="bagian_id">Bagian</label>
                                    <select class="form-control" id="bagian_id" name="bagian_id">
                                        <?php foreach ($bagian as $key => $value) {
                                            $banyak = 0;
                                            if ($value->id == 1) $banyak = $b_keuangan;
                                            if ($value->id == 2) $banyak = $b_kepegawaian; ?>
                                            <option value="<?= $value->id ?>"><?=$banyak?>/<?= $value->jmlh_maksimal ?> - <?= $value->nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Tambah Penerimaan Mutasi</button>
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
            <table id="tbl-pengajuan-mutasi" class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Instantsi Asal</th>
                        <th>Daerah Asal</th>
                        <th>Alasan</th>
                        <th>Bagian</th>
                        <th>Status</th>
                        <th>Nama Direktur</th>
                        <?php if($this->session->userdata("role") == "admin"){ ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        foreach ($penerimaan_mutasi as $key => $value) { 
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value->instansi_asal ?></td>
                            <td><?= $value->daerah_asal ?></td>
                            <td><?= $value->alasan ?></td>
                            <td><?= $value->bagian_id ?></td>
                            <td>

                                <?php if($value->status_persetujuan == "pending") {?>
                                    <span class="badge badge-warning"><?= $value->status_persetujuan; ?></span>
                                    <?php if($this->session->userdata("role") == "direktur"){ ?>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetable">
                                                Setujui
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="approvetable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="forms-sample" action="<?= base_url("mutasi/status_penerimaan"); ?>" method="POST">
                                                            <div class="modal-header">
                                                                <input type="hidden" name="id" value="<?= $value->id ?>">
                                                                <input type="hidden" name="status" value="setujui">
                                                                <h5 class="modal-title" id="exampleModalLabel">Setujui Pengajuan Mutasi Id : <b><?= $value->id ?></b> </h5>
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
                                                        <form class="forms-sample" action="<?= base_url("mutasi/status_penerimaan"); ?>" method="POST">
                                                            <div class="modal-header">
                                                            <input type="hidden" name="id" value="<?= $value->id ?>">
                                                            <input type="hidden" name="status" value="tolak">
                                                            <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan Mutasi Id : <b><?= $value->id ?></b> </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Tolak Mutasi</button>
                                                        </div>
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
                            <td><?= $value->direktur_nip ?></td>
                            
                            <?php if($this->session->userdata("role") == "admin"){ ?>   
                                <td>
                                    <!-- Large modal -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target=".edittable">Edit</button>

                                    <!-- Modal -->
                                    <div class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Penerimaan Mutasi Id : <b><?= $value->id ?><b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="forms-sample" action="<?= base_url("mutasi/update_data_penerimaan"); ?>" method="POST">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="<?= $value->id ?>">
                                                        <div class="form-group">
                                                            <label for="daerah_asal">Daerah Asal</label>
                                                            <input type="text" class="form-control" id="daerah_asal" name="daerah_asal" value="<?= $value->daerah_asal ?>"  required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="instansi_asal">Instansi Asal</label>
                                                            <input type="text" class="form-control" id="instansi_asal" name="instansi_asal" value="<?= $value->instansi_asal ?>"  required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="alasan">Alasan</label>
                                                            <textarea class="form-control" id="alasan" rows="4" name="alasan" required><?= $value->alasan ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="bagian">Bagian <?= $value->bagian_id ?></label>
                                                            <select class="form-control" id="bagian_id" name="bagian_id">
                                                                <?php foreach ($bagian as $key => $b) { 
                                                                    if ($value->bagian_id == $b->id) { ?>
                                                                        <option selected value="<?= $b->id ?>"><?= $b->jmlh_maksimal ?> - <?= $b->nama ?></option>
                                                                    <?php } else {?>
                                                                        <option value="<?= $b->id ?>"><?= $b->jmlh_maksimal ?> - <?= $b->nama ?></option>

                                                                    <?php } 
                                                                } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-primary">Edit Penerimaan Mutasi</button>
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
                                                <form class="forms-sample" action="<?= base_url("mutasi/delete_data_penerimaan"); ?>" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Penerimaan Mutasi Id No : <b><?= $i ?></b> </h5>
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

                    <?php } ?>
                </tbody>                
            </table>
        </div>
    </div>
</div>