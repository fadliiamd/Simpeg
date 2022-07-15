<div class="row">
	<div class="col-lg-12">
        <h4>Usulan Mutasi Mutasi</h4>

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
                        <th>Berkas Mutasi</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status Pengajuan</th>
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
                        foreach ($usulan_mutasi as $key => $value) { 
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value->pegawai_nip ?> - <?= $value->pegawai_nama ?></td>
                            <td>
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#lookable<?=$i?>">
                                    Lihat
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="lookable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <?php if($this->session->userdata("role") == "direktur" && $value->tgl_usulan != null && $value->surat_usulan != null){ ?>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetable<?=$i?>">
                                                Setujui
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="approvetable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="forms-sample" action="<?= base_url("mutasi/status_usulan"); ?>" method="POST">
                                                            <div class="modal-header">
                                                                <input type="hidden" name="usulanmutasi_id" value="<?= $value->id ?>">
                                                                <input type="hidden" name="pegawai_nip" value="<?= $value->pegawai_nip ?>">
                                                                <input type="hidden" name="id" value="<?= $value->id ?>">
                                                                <input type="hidden" name="jenis_mutasi" value="Mutasi Keluar">
                                                                <input type="hidden" name="tgl_mutasi" value="<?= $value->tgl_usulan?>">
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

                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noapprovetable<?=$i?>">
                                                Tolak
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="noapprovetable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <?php if($value->surat_usulan != ""){ ?>
                                    <a href="<?= base_url().'uploads/'.$value->surat_usulan ?>" download class="btn btn-secondary">Unduh</a>    
                                <?php } ?>
                                <?php if($this->session->userdata("role") == "admin"){ ?>  
                                    <!-- Large modal -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadtable<?=$i?>">Upload</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="uploadtable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Upload Surat Usulan Pensiun No : <b><?= $i; ?><b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="forms-sample" action="<?= base_url("mutasi/upload_data_usulan"); ?>" method="POST" enctype="multipart/form-data">
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
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edittable<?=$i?>">Edit</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="edittable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Usulan Mutasi No : <b><?= $i; ?><b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="forms-sample" action="<?= base_url("mutasi/update_data_usulan"); ?>" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?= $value->id ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="nip">NIP</label>
                                                            <input type="text" class="form-control" id="nip" value="<?= $value->pegawai_nip ?> - <?= $value->alasan ?>" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tgl_usulan">Tanggal Usulan</label>
                                                            <input type="date" class="form-control" id="tgl_usulan" name="tgl_usulan">
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
                                                <form class="forms-sample" action="<?= base_url("mutasi/delete_data_usulan"); ?>" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Mutasi No : <b><?= $i ?><b></h5>
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