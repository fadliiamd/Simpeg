<div class="row">
	<div class="col-lg-12">
        <h4>Usulan Mutasi Mutasi</h4>

        <?php if($this->session->userdata("role") == "admin"){ ?>       
            <!-- Large modal -->
            <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Usulan Mutasi Mutasi</button>
            <!-- <a type="button" class="my-3 btn btn-primary" href="<?= base_url("send_email") ?>" >Coba</a> -->

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
                        <form class="forms-sample" action="<?= base_url("mutasi/create_data_usulan"); ?>" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="mutasi_id">NIP</label>
                                    <select class="form-control custom-select" id="mutasi_id" name="mutasi_id">
                                        <?php foreach ($berkas_mutasi as $key => $value) { ?>
                                            <option value="<?= $value->id ?> - <?= $value->id_mutasi?>"><?= $value->pegawai_nip ?> - <?= $value->alasan ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="id_berkas_mutasi">Berkas Mutasi</label>
                                    <select class="form-control" id="id_berkas_mutasi" name="id_berkas_mutasi">
                                        <option>1</option>
                                        <option>2</option>
                                    </select>
                                </div> -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Tambah Mutasi</button>
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
                        <th>NIP</th>
                        <th>Berkas Mutasi</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status Pengajuan</th>
                        <th>Tanggal Persetujuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        foreach ($usulan_mutasi as $key => $value) { 
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value->pegawai_nip ?> - <?= $value->alasan ?></td>
                            <td>
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#lookable">
                                    Lihat
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="lookable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="sk_cpns">SK CPNS</label>
                                                        <a href="<?= base_url().'uploads/'.$value->sk_cpns ?>" download class="btn btn-secondary" id="sk_cpns" >Unduh</a>    
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="sk_pns">SK PNS</label>
                                                        <a href="<?= base_url().'uploads/'.$value->sk_pns ?>" download class="btn btn-secondary" id="sk_pns" >Unduh</a>    
                                                    </div>
                                                <div class="form-group row">
                                                </div>
                                                    <div class="col-md-6">
                                                        <label for="pangkat_akhir">Pangkat Akhir</label>
                                                        <a href="<?= base_url().'uploads/'.$value->pangkat_akhir ?>" download class="btn btn-secondary" id="pangkat_akhir" >Unduh</a>    
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="karpeg">Karpeg</label>
                                                        <a href="<?= base_url().'uploads/'.$value->karpeg ?>" download class="btn btn-secondary" id="karpeg" >Unduh</a>    
                                                    </div>
                                                <div class="form-group row">
                                                </div>
                                                    <div class="col-md-6">
                                                        <label for="dp3_akhir">DP3 Akhir</label>
                                                        <a href="<?= base_url().'uploads/'.$value->dp3_akhir ?>" download class="btn btn-secondary" id="dp3_akhir" >Unduh</a>    
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="ijazah">Ijazah</label>
                                                        <a href="<?= base_url().'uploads/'.$value->ijazah ?>" download class="btn btn-secondary" id="ijazah" >Unduh</a>    
                                                    </div>
                                                <div class="form-group row">
                                                </div>
                                                    <div class="col-md-6">
                                                        <label for="riwayat_hidup">Riwayat Hidup</label>
                                                        <a href="<?= base_url().'uploads/'.$value->riwayat_hidup ?>" download class="btn btn-secondary" id="riwayat_hidup" >Unduh</a>    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><?= $value->tgl_usulan ?></td>
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
                                                        <form class="forms-sample" action="<?= base_url("mutasi/status_usulan"); ?>" method="POST">
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
                                                        <form class="forms-sample" action="<?= base_url("mutasi/status_usulan"); ?>" method="POST">
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
                                
                            <?php if($this->session->userdata("role") == "admin"){ ?>   
                                <!-- Large modal -->
                                <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target=".edittable">Edit</button> -->

                                <!-- Modal -->
                                <div class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Pengajuan Mutasi Id : <b>2<b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="nip">NIP</label>
                                                        <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alasan">Alasan</label>
                                                        <textarea class="form-control" id="alasan" rows="4" name="alasan"></textarea>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                                                            <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="tgl_persetujuan">Tanggal Persetujuan</label>
                                                            <input type="date" class="form-control" id="tgl_persetujuan" name="tgl_persetujuan">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status_pengajuan">Status</label>
                                                        <select class="form-control" id="status_pengajuan" name="status_pengajuan">
                                                            <option>Diterima</option>
                                                            <option>Ditolak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                    <button type="button" class="btn btn-primary">Edit Mutasi</button>
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
                                                <form class="forms-sample" action="<?= base_url("mutasi/delete_data_mutasi"); ?>" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Mutasi Id : <b><?= $value->id ?><b></h5>
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

                            <button type="button" class="btn btn-secondary" data-toggle="modal">
                            Unduh
                            </button>

                            </td>
                        </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>