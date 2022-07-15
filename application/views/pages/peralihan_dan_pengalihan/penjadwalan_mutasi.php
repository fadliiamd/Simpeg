<div class="row">
	<div class="col-lg-12">
        <h4>Penjadwalan Mutasi</h4>

        
        <?php if($this->session->userdata("role") == "admin"){ ?>   
            <!-- Large modal -->
            <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Penjadwalan Mutasi</button>

            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Penjadwalan Mutasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="forms-sample" action="<?= base_url("mutasi/create_data_penjadwalan"); ?>" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="tgl_diskusi">Tanggal Diskusi</label>
                                    <input required type="date" class="form-control" id="tgl_diskusi" name="tgl_diskusi">
                                </div>
                                <div class="form-group">
                                    <label for="waktu">Waktu</label>
                                    <input required type="text" class="form-control" id="waktu" name="waktu">
                                </div>
                                <div class="form-group">
                                    <label for="hal">Hal</label>
                                    <textarea class="form-control" id="hal" rows="4" name="hal"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tempat">Tempat</label>
                                    <input required type="text" class="form-control" id="tempat" name="tempat">
                                </div>
                                <div class="form-group">
                                    <label for="nip">Pegawai</label>
                                    <select class="form-control" id="nip" name="nip">
                                        <?php foreach ($pegawai as $key => $value) { ?>
                                            <option value="<?= $value->account_nip ?>"><?= $value->account_nip ?> - <?= $value->nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Tambah Penjadwalan Mutasi</button>
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
                        <th>Pegawai</th>
                        <th>Tanggal Diskusi</th>
                        <th>Waktu</th>
                        <th>Hal</th>
                        <th>Tempat</th>
                        <th>Status</th>
                        <?php if($this->session->userdata("role") == "admin"){ ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        foreach ($penjadwalan as $key => $value) { 
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <?php if  ($this->session->userdata("role") == "admin" || $this->session->userdata("role") == "direktur"){ ?>
                                <td><?= $value->account_nip ?> - <?= $value->nama ?></td>  
                            <?php } else { ?>
                                <td><?= $value->account_nip ?></td>  
                            <?php } ?>
                            <td><?= $value->tgl_diskusi ?></td>
                            <td><?= $value->waktu ?></td>
                            <td><?= $value->hal ?></td>
                            <td><?= $value->tempat ?></td>
                            <td>
                                <?php if($value->status == "belum terlaksana") {?>
                                    <span class="badge badge-secondary"><?= $value->status; ?></span>
                                    <?php if($this->session->userdata("role") == "direktur"){ ?>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetable<?=$i?>">
                                                Laksanakan
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="approvetable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="forms-sample" action="<?= base_url("mutasi/status_penjadwalan"); ?>" method="POST">
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
                                                                <button type="submit" class="btn btn-success">Laksanakan Penjadwalan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }; ?>
                                <?php } else { ?>
                                    <?php if($value->status == "terlaksana") {?>
                                        <span class="badge badge-success"><?= $value->status; ?></span>
                                    <?php }; ?>
                                    <?php if($value->status == "belum terlaksana") {?>
                                        <span class="badge badge-secondary"><?= $value->status; ?></span>
                                    <?php }; ?>
                                <?php }; ?>
                            </td>
                            <?php if($this->session->userdata("role") == "admin"){ ?>   
                                <td>
                                    <!-- Large modal -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edittable<?=$i?>">Edit</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="edittable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Penjadwalan Mutasi No : <b><?= $value->id ?><b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="forms-sample" action="<?= base_url("mutasi/update_data_penjadwalan"); ?>" method="POST">
                                                <input type="hidden" name="id" value="<?= $value->id ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="nip">Pegawai</label>
                                                            <input type="text" class="form-control" disabled value="<?= $value->account_nip ?> ">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tgl_diskusi">Tanggal Diskusi</label>
                                                            <input required type="date" class="form-control" id="tgl_diskusi" name="tgl_diskusi" value="<?= $value->tgl_diskusi ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="waktu">Waktu</label>
                                                            <input required type="text" class="form-control" id="waktu" name="waktu" value="<?= $value->waktu ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="hal">Hal</label>
                                                            <textarea class="form-control" id="hal" rows="4" name="hal"><?= $value->hal ?>"</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tempat">Tempat</label>
                                                            <input required type="text" class="form-control" id="tempat" name="tempat" value="<?= $value->tempat ?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-primary">Edit Penjadwalan Mutasi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable<?=$i?>">
                                    Hapus
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deletetable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form class="forms-sample" action="<?= base_url("mutasi/delete_data_penjadwalan"); ?>" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Penjadwalan Mutasi No : <b><?= $i ?></b> </h5>
                                                        <input type="hidden" name="id" value="<?= $value->id ?>">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Hapus Penjadwalan</button>
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