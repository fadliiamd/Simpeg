<div class="row">
	<div class="col-lg-12">
        <h3>Berkas Persyaratan</h3>

        <?php if($this->session->userdata("role") == "pegawai"){ ?>
            <!-- Large modal -->
            <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Berkas Persyaratan</button>

            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Berkas Persyaratan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="forms-sample" action="<?= base_url("mutasi/create_data_berkas"); ?>" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="mutasi_id">NIP</label>
                                    <select class="custom-select" id="mutasi_id" name="mutasi_id">
                                    <?php foreach ($mutasi as $key => $value) { ?>
                                        <option value="<?= $value->id ?>"><?= $value->pegawai_nip ?> - <?= $value->alasan ?></option>
                                    <?php } ?>
                                </select>
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
                                        <label for="pangkat_akhir">Pangkat Akhir</label>
                                        <input type="file" class="form-control-file" id="pangkat_akhir" name="pangkat_akhir">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="karpeg">Karpeg</label>
                                        <input type="file" class="form-control-file" id="karpeg" name="karpeg">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="dp3_akhir">DP3 Akhir</label>
                                        <input type="file" class="form-control-file" id="dp3_akhir" name="dp3_akhir">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="ijazah">Ijazah</label>
                                        <input type="file" class="form-control-file" id="ijazah" name="ijazah">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="riwayat_hidup">Riwayat Hidup</label>
                                        <input type="file" class="form-control-file" id="riwayat_hidup" name="riwayat_hidup">
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
            <table id="tbl-pengajuan-mutasi" class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>SK CPNS</th>
                        <th>SK PNS</th>
                        <th>Pangkat Akhir</th>
                        <th>Karpeg</th>
                        <th>DP3 Akhir</th>
                        <th>Ijazah</th>
                        <th>Riwayat Hidup</th>
                        <th>Status Persetujuan</th>
                        <?php if($this->session->userdata("role") == "pegawai"){ ?>   
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        foreach ($berkas_mutasi as $key => $value) { 
                    ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $value->pegawai_nip ?> - <?= $value->alasan ?></td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->sk_cpns ?>" download class="btn btn-secondary">Unduh</a>    
                            </td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->sk_pns ?>" download class="btn btn-secondary">Unduh</a>    
                            </td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->pangkat_akhir ?>" download class="btn btn-secondary">Unduh</a>    
                            </td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->karpeg ?>" download class="btn btn-secondary">Unduh</a>    
                            </td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->dp3_akhir ?>" download class="btn btn-secondary">Unduh</a>    
                            </td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->ijazah ?>" download class="btn btn-secondary">Unduh</a>    
                            </td>
                            <td>
                                <a href="<?= base_url().'uploads/'.$value->riwayat_hidup ?>" download class="btn btn-secondary">Unduh</a>    
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
                                                        <form class="forms-sample" action="<?= base_url("mutasi/status_berkas"); ?>" method="POST">
                                                            <div class="modal-header">
                                                                <input type="hidden" name="id" value="<?= $value->id ?>">
                                                                <input type="hidden" name="id_mutasi" value="<?= $value->id_mutasi ?>">
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
                                                        <form class="forms-sample" action="<?= base_url("mutasi/status_berkas"); ?>" method="POST">
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Berkas Persyaratan NIP : <b><?= $value->id ?><b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="forms-sample" action="<?= base_url("mutasi/update_data_berkas"); ?>" method="POST" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="id">NIP</label>
                                                            <input type="hidden" name="id" value="<?= $value->id ?>">
                                                            <input type="text" class="form-control" id="id" value="<?= $value->id ?>" disabled>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-3">
                                                                <label for="sk_cpns">SK CPNS</label>
                                                                <input type="file" class="form-control-file" id="sk_cpns" name="sk_cpns" required>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="sk_pns">SK PNS</label>
                                                                <input type="file" class="form-control-file" id="sk_pns" name="sk_pns" required>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="pangkat_akhir">Pangkat Akhir</label>
                                                                <input type="file" class="form-control-file" id="pangkat_akhir" name="pangkat_akhir" required>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="karpeg">Karpeg</label>
                                                                <input type="file" class="form-control-file" id="karpeg" name="karpeg" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-3">
                                                                <label for="dp3_akhir">DP3 Akhir</label>
                                                                <input type="file" class="form-control-file" id="dp3_akhir" name="dp3_akhir" required>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="ijazah">Ijazah</label>
                                                                <input type="file" class="form-control-file" id="ijazah" name="ijazah" required>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="riwayat_hidup">Riwayat Hidup</label>
                                                                <input type="file" class="form-control-file" id="riwayat_hidup" name="riwayat_hidup" required>
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
                                                <form class="forms-sample" action="<?= base_url("mutasi/delete_data_berkas"); ?>" method="POST">
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