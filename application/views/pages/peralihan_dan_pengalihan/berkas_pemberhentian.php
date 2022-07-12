<div class="row">
	<div class="col-lg-12">
        <h3>Berkas Persyaratan</h3>

        <?php if($this->session->userdata("role") == "pegawai"){ ?>       
            <!-- Large modal -->
            <?php if (($this->session->userdata("role") == "pegawai" && !$berkas_pemberhentian)) { ?>
                <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Berkas Persyaratan</button>
            <?php } ?>

            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Berkas Persyaratan NIP : <b><?= $this->session->userdata("nip") ?></b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="forms-sample" action="<?= base_url("pemberhentian/create_data_berkas"); ?>" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                            <?php foreach ($pemberhentian as $key => $value) { ?>
                                <input type="hidden" name="pemberhentian_id" value="<?= $value->id ?>">
                            <?php } ?>
                                <!-- <div class="form-group">
                                    <label for="pemberhentian_id">NIP</label>
                                    <select class="form-control" id="pemberhentian_id" name="pemberhentian_id">
                                        <?php foreach ($pemberhentian as $key => $value) { ?>
                                            <option value="<?= $value->id ?>"><?= $value->pegawai_nip ?> - <?= $value->alasan ?></option>
                                        <?php } ?>
                                    </select>
                                </div> -->
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="sk_cpns">SK CPNS</label>
                                        <input type="file" class="form-control-file" id="sk_cpns" name="sk_cpns">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="sk_pns">SK PNS</label>
                                        <input type="file" class="form-control-file" id="sk_pns" name="sk_pns">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="sk_kgb">SK KGB</label>
                                        <input type="file" class="form-control-file" id="sk_kgb" name="sk_kgb">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="sk_kp">SK KP</label>
                                        <input type="file" class="form-control-file" id="sk_kp" name="sk_kp">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="dp3_akhir">DP3 Akhir</label>
                                        <input type="file" class="form-control-file" id="dp3_akhir" name="dp3_akhir">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="pangkat_akhir">Pangkat Akhir</label>
                                        <input type="file" class="form-control-file" id="pangkat_akhir" name="pangkat_akhir">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="kartu_keluarga">Kartu Keluarga</label>
                                        <input type="file" class="form-control-file" id="kartu_keluarga" name="kartu_keluarga">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="pas_foto">Pas Photo</label>
                                        <input type="file" class="form-control-file" id="pas_foto" name="pas_foto">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Tambah Berkas Pesyaratan</button>
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
                        <th>NIP</th>
                        <th>SK CPNS</th>
                        <th>SK PNS</th>
                        <th>SK KGB</th>
                        <th>SK KP</th>
                        <th>DP3 Akhir</th>
                        <th>Pangkat Akhir</th>
                        <th>Kartu Keluarga</th>
                        <th>Pas Photo</th>
                        <th>Status Pertujuan</th>
                        <?php if($this->session->userdata("role") == "pegawai"){ ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        foreach ($berkas_pemberhentian as $key => $value) { 
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value->pegawai_nip ?> - <?= $value->alasan ?></td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->sk_cpns ?>" download class="btn btn-secondary">Unduh</a>    
                            </td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->sk_pns ?>" download class="btn btn-secondary">Unduh</a>    
                            </td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->sk_kgb ?>" download class="btn btn-secondary">Unduh</a>    
                            </td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->sk_kp ?>" download class="btn btn-secondary">Unduh</a>    
                            </td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->dp3_akhir ?>" download class="btn btn-secondary">Unduh</a>    
                            </td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->pangkat_akhir ?>" download class="btn btn-secondary">Unduh</a>    
                            </td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->kartu_keluarga ?>" download class="btn btn-secondary">Unduh</a>    
                            </td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->pas_foto ?>" download class="btn btn-secondary">Unduh</a>    
                            </td>
                            <td>

                                <?php if($value->status_persetujuan == "pending") {?>
                                    <span class="badge badge-warning"><?= $value->status_persetujuan; ?></span>
                                    <?php if($this->session->userdata("role") == "admin"){ ?>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetable">
                                                Setujui
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="approvetable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="forms-sample" action="<?= base_url("pemberhentian/status_berkas"); ?>" method="POST">
                                                            <div class="modal-header">
                                                                <input type="hidden" name="id" value="<?= $value->id ?>">
                                                                <input type="hidden" name="pemberhentian_id" value="<?= $value->id_pemberhentian ?>">
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
                                                        <form class="forms-sample" action="<?= base_url("pemberhentian/status_berkas"); ?>" method="POST">
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
                            <?php if($this->session->userdata("role") == "pegawai"){ ?>
                                <td>
                                <!-- Large modal -->
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target=".edittable">Edit</button>

                                <!-- Modal -->
                                <div class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Berkas Persyaratan NIP : <b>2<b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("pemberhentian/update_data_berkas"); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="pemberhentian_id">NIP</label>
                                                        <input type="hidden" name="id" value="<?= $value->id ?>">
                                                        <input type="hidden" name="pemberhentian_id" value="<?= $value->id_pemberhentian ?>">
                                                        <input type="text" class="form-control" id="id" value="<?= $value->pegawai_nip ?> - <?= $value->alasan ?>" disabled>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <label for="sk_cpns">SK CPNS</label>
                                                            <input type="file" class="form-control-file" id="sk_cpns" name="sk_cpns">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="sk_pns">SK PNS</label>
                                                            <input type="file" class="form-control-file" id="sk_pns" name="sk_pns">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="sk_kgb">SK KGB</label>
                                                            <input type="file" class="form-control-file" id="sk_kgb" name="sk_kgb">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="sk_kp">SK KP</label>
                                                            <input type="file" class="form-control-file" id="sk_kp" name="sk_kp">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <label for="dp3_akhir">DP3 Akhir</label>
                                                            <input type="file" class="form-control-file" id="dp3_akhir" name="dp3_akhir">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="pangkat_akhir">Pangkat Akhir</label>
                                                            <input type="file" class="form-control-file" id="pangkat_akhir" name="pangkat_akhir">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="kartu_keluarga">Kartu Keluarga</label>
                                                            <input type="file" class="form-control-file" id="kartu_keluarga" name="kartu_keluarga">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="pas_foto">Pas Photo</label>
                                                            <input type="file" class="form-control-file" id="pas_foto" name="pas_foto">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-primary">Edit Berkas Pesyaratan</button>
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
                                            <form class="forms-sample" action="<?= base_url("pemberhentian/delete_data_berkas"); ?>" method="POST">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Berkas Id No : <b><?= $i ?></b> </h5>
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
            </table>
        </div>
    </div>
</div>