<div class="row">
    <div class="col-lg-12">
        <h4>Pengajuan Pemberhentian</h4>

        <!-- Large modal -->
        <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Pemberhentian</button>

        <a href="<?= base_url().'assets/pdf/template-surat-pengunduran-diri.pdf'?>" download class="btn btn-secondary">Surat Pengunduran Diri</a>    
        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengajuan Pemberhentian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>                    
                    <form class="forms-sample" action="<?= base_url("pemberhentian/create_data_pemberhentian"); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="jenis_berhenti">Jenis Berhenti</label>
                                <select class="form-control" id="jenis_berhenti" name="jenis_berhenti">
                                    <option value="Pengunduran diri">Pengunduran diri</option>
                                    <option value="Pensiun">Pensiun</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alasan">Alasan</label>
                                <textarea class="form-control" id="alasan" rows="4" name="alasan"></textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-1">
                                    <label for="mpp">MPP</label>
                                </div>
                                <div class="col-lg-11">
                                    <div class="mx-3">
                                        <input class="form-check-input" type="radio" name="mpp" id="exampleRadios1" value="Ya" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="mx-3">
                                        <input class="form-check-input" type="radio" name="mpp" id="exampleRadios2" value="Tidak">
                                        <label class="form-check-label" for="exampleRadios2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="surat_pengunduran_diri">Surat Pengajuan</label>
                                <input type="file" class="form-control" id="surat_pengunduran_diri" name="surat_pengunduran_diri">
                            </div>
                            <div class="form-group">
                                <label for="pegawai_nip">Pegawai</label>
                                <select class="form-control" id="pegawai_nip" name="pegawai_nip">
                                    <?php foreach ($pegawai as $key => $value) { ?>
                                        <option value="<?= $value->account_nip ?>"><?= $value->account_nip ?> - <?= $value->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Tambah Pengajuan Pemberhentian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal -->

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
                <thead>
                    <tr class="thead-dark">
                        <th>No</th>
                        <th>Jenis Berhenti</th>
                        <th>Alasan</th>
                        <th>Status Pengajuan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Tanggal Persetujuan</th>
                        <th>MPP</th>
                        <th>Tunjangan</th>
                        <?php if($this->session->userdata("role") == "pegawai"){ ?>   
                            <th>Surat Pengunduran Diri</th>
                        <?php } ?>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    foreach ($pemberhentian as $key => $value) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value->jenis_berhenti ?></td>
                            <td><?= $value->alasan ?></td>
                            <td>
                                <?php if($value->status_pengajuan == "pending") {?>
                                    <span class="badge badge-warning"><?= $value->status_pengajuan; ?></span>
                                    <?php if($this->session->userdata("role") == "admin"){ ?>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetable">
                                                Setujui
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="approvetable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="forms-sample" action="<?= base_url("pemberhentian/status_pemberhentian"); ?>" method="POST">
                                                            <div class="modal-header">
                                                                <input type="hidden" name="id" value="<?= $value->id ?>">
                                                                <input type="hidden" name="status" value="setuju">
                                                                <h5 class="modal-title" id="exampleModalLabel">Setujui Pengajuan Mutasi NIP : <b><?= $value->pegawai_nip ?></b> </h5>
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
                                                        <form class="forms-sample" action="<?= base_url("pemberhentian/status_pemberhentian"); ?>" method="POST">
                                                            <div class="modal-header">
                                                            <input type="hidden" name="id" value="<?= $value->id ?>">
                                                            <input type="hidden" name="status" value="ditolak">
                                                            <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan Mutasi NIP : <b><?= $value->pegawai_nip ?></b> </h5>
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
                                    <?php if($value->status_pengajuan == "setuju") {?>
                                        <span class="badge badge-success"><?= $value->status_pengajuan; ?></span>
                                    <?php }; ?>
                                    <?php if($value->status_pengajuan == "ditolak") {?>
                                        <span class="badge badge-danger"><?= $value->status_pengajuan; ?></span>
                                    <?php }; ?>
                                <?php }; ?>
                            </td>
                            <td><?= $value->tgl_pengajuan ?></td>
                            <td><?= ($value->tgl_persetujuan == null) ? "-" : $value->tgl_persetujuan ; ?></td>
                            <td><?= $value->mpp ?></td>
                            <td><?= $value->tunjangan ?></td>
                            <td>
                                <!-- Large modal -->
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target=".edittable">Edit</button>
                                <!-- Modal -->
                                <div class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Pengajuan Pemberhentian Id : <b>2<b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("pemberhentian/update_data_pemberhentian"); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" value="<?= $value->id ?>">
                                                        <label for="jenis_berhenti">Jenis Berhenti</label>
                                                        <select class="form-control" id="jenis_berhenti" name="jenis_berhenti">
                                                            <option <?= ($value->jenis_berhenti == "Pengunduran diri ") ? "selected" : "" ?> value="Pengunduran diri">Pengunduran diri</option>
                                                            <option <?= ($value->jenis_berhenti == "Pensiun") ? "selected" : "" ?> value="Pensiun">Pensiun</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alasan">Alasan</label>
                                                        <textarea class="form-control" id="alasan" rows="4" name="alasan"><?= $value->alasan ?></textarea>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-1">
                                                            <label for="mpp">MPP</label>
                                                        </div>
                                                        <div class="col-lg-11">
                                                            <div class="mx-3">
                                                                <input class="form-check-input" type="radio" name="mpp" id="exampleRadios1" value="Ya" <?= ($value->mpp == "Ya") ? "selected" : "" ?>>
                                                                <label class="form-check-label" for="exampleRadios1">
                                                                    Ya
                                                                </label>
                                                            </div>
                                                            <div class="mx-3">
                                                                <input class="form-check-input" type="radio" name="mpp" id="exampleRadios2" value="Tidak" <?= ($value->mpp == "Tidak") ? "selected" : "" ?>>
                                                                <label class="form-check-label" for="exampleRadios2">
                                                                    Tidak
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pegawai_nip">Pegawai</label>
                                                        <select class="form-control" id="pegawai_nip" name="pegawai_nip">
                                                            <?php foreach ($pegawai as $key => $p) { ?>
                                                                <option <?= ($value->pegawai_nip == $p->account_nip) ? "selected" : "" ?>  value="<?= $p->account_nip ?>"><?= $p->account_nip ?> - <?= $p->nama ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-primary">Edit Pengajuan Pemberhentian</button>
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
                                            <form class="forms-sample" action="<?= base_url("pemberhentian/delete_data_pemberhentian"); ?>" method="POST">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus pemberhentian No : <b><?= $i ?></b> </h5>
                                                    <input type="hidden" name="id" value="<?= $value->id ?>">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Hapus Pemberhentian</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <a href="<?= base_url().'uploads/'.$value->surat_pengunduran_diri ?>" download class="btn btn-secondary">Unduh</a>
                            </td>
                        </tr>
                    <?php $i++; } ?>
                </tbody>           
                <tfoot>
                    <tr class="thead-dark">
                        <th>No</th>
                        <th>Jenis Berhenti</th>
                        <th>Alasan</th>
                        <th>Status Pengajuan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Tanggal Persetujuan</th>
                        <th>MPP</th>
                        <th>Tunjangan</th>
                        <?php if($this->session->userdata("role") == "pegawai"){ ?>   
                            <th>Surat Pengunduran Diri</th>
                        <?php } ?>
                        <th>Action</th>
                    </tr>
                </tfoot> 
            </table>
        </div>
    </div>
</div>