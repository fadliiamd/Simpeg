<div class="row">
    <div class="col-lg-12">
        <h4>Pengajuan Mutasi <?= $this->session->userdata("nama_jabatan") ?></h4>

        <!-- Large modal -->
        <?php foreach ($users as $key => $value) { ?>
            <?php if ($this->session->userdata("role") == "pegawai" && !$mutasi){ ?>
                <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Mutasi</button>
            <?php } ?>
        <?php } ?>
                
        <?php if  ($this->session->userdata("role") == "admin"){ ?>
            <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Mutasi</button>
        <?php } ?>

        <a href="<?= base_url().'assets/pdf/pengajuan_mutasi.docx'?>" download class="my-3 btn btn-secondary">Surat Pengajuan Mutasi</a>    
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
                    <form class="forms-sample" action="<?= base_url("mutasi/create_data_mutasi"); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <?php if ($this->session->userdata("role") == "pegawai") { ?>
                                    <input type="hidden" name="pegawai_nip" value="<?= $this->session->userdata("nip") ?>">
                                <?php } else { ?>
                                    <label for="pegawai_nip">NIP</label>
                                    <select class="custom-select" id="pegawai_nip" name="pegawai_nip">
                                        <?php foreach ($pegawai as $key => $value) { ?>
                                            <option value="<?= $value->account_nip ?> - <?= $value->email ?>"><?= $value->account_nip ?> - <?= $value->nama ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="alasan">Alasan</label>
                                <textarea class="form-control" id="alasan" rows="4" name="alasan" required></textarea>
                            </div>
                            <!-- <div class="form-group">
                                <label for="surat_pengajuan">Surat Pengajuan</label>
                                <input type="file" class="form-control" id="surat_pengajuan" name="surat_pengajuan" required = 'required'/>
                            </div> -->
                            <div class="form-group">
                                <label for="jenis_mutasi">Jenis Mutasi</label>
                                <select class="custom-select" id="jenis_mutasi" name="jenis_mutasi">
                                    <option value="Satu instansi">Satu instansi</option>
                                    <option value="Kabupaten/kota satu provinsi">Kabupaten/kota satu provinsi</option>
                                    <option value="Kabupaten/kota antar provinsi">Kabupaten/kota antar provinsi</option>
                                    <option value="Provinsi/kabupaten/kota ke instansi pusat">Provinsi/kabupaten/kota ke instansi pusat</option>
                                    <option value="Antar instansi pusat">Antar instansi pusat</option>
                                    <option value="Perwakilan NKRI di luar negeri">Perwakilan NKRI di luar negeri</option>
                                </select>
                            </div>
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
            <table class="table text-center table-striped table-bordered table-datatable">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Pegawai</th>
                        <th>Jenis Mutasi</th>
                        <th>Alasan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Persetujuan 1</th>
                        <th>Persetujuan 2</th>
                        <th>Persetujuan 3</th>
                        <th>Status Pengajuan</th>
                        <th>Tanggal Persetujuan</th>
                        <th>Bukti Pengajuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    foreach ($mutasi as $key => $value) { ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $value->pegawai_nip ?> - <?= $value->nama ?></td>  
                        <td><?= $value->jenis_mutasi?></td>
                        <td><?= $value->alasan; ?></td>
                        <td><?= $value->tgl_pengajuan; ?></td>
                        <td>
                            <?php if($value->persetujuan_1 == "pending") {?>
                                <span class="badge badge-warning"><?= $value->persetujuan_1; ?></span>
                                <?php if(($this->session->userdata("nama_jabatan") == "kajur" && $value->jenis_jabatan == "fungsional") || ($this->session->userdata("nama_jabatan") == "Kepala Bagian Umum" && $value->jenis_jabatan == "struktural")){ ?>
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetablepersetujuan_1<?=$i?>">
                                            Setujui
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="approvetablepersetujuan_1<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" action="<?= base_url("mutasi/status_mutasi_1"); ?>" method="POST">
                                                        <div class="modal-header">
                                                            <input type="hidden" name="id" value="<?= $value->id_mutasi ?>">
                                                            <input type="hidden" name="email" value="<?= $value->email ?>">
                                                            <input type="hidden" name="status" value="setujui">
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

                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noapprovetablepersetujuan_1<?=$i?>">
                                            Tolak
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="noapprovetablepersetujuan_1<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" action="<?= base_url("mutasi/status_mutasi_1"); ?>" method="POST">
                                                        <div class="modal-header">
                                                        <input type="hidden" name="id" value="<?= $value->id_mutasi ?>">
                                                        <input type="hidden" name="status" value="tolak">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan Mutasi NIP : <b><?= $value->pegawai_nip ?></b> </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="alasan">Alasan</label>
                                                            <textarea class="form-control" id="alasan" rows="4" name="alasan_tolak" required></textarea>
                                                        </div>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Tolak Mutasi</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <?php }; ?>
                            <?php } else { ?>
                                <?php if($value->persetujuan_1 == "setujui") {?>
                                    <span class="badge badge-success"><?= $value->persetujuan_1; ?></span>
                                <?php }; ?>
                                <?php if($value->persetujuan_1 == "tolak") {?>
                                    <span class="badge badge-danger"><?= $value->persetujuan_1; ?></span>
                                <?php }; ?>
                            <?php }; ?>
                        </td>
                        <td>
                            <?php if($value->persetujuan_2 == "pending") {?>
                                <span class="badge badge-warning"><?= $value->persetujuan_2; ?></span>
                                <?php if(($this->session->userdata("nama_jabatan") == "Wakil Direktur I" && $value->jenis_jabatan == "fungsional") || ($this->session->userdata("nama_jabatan") == "Wakil Direktur II" && $value->jenis_jabatan == "struktural") && $value->persetujuan_1 == "setujui"){ ?>
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetablepersetujuan_2<?=$i?>">
                                            Setujui
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="approvetablepersetujuan_2<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" action="<?= base_url("mutasi/status_mutasi_2"); ?>" method="POST">
                                                        <div class="modal-header">
                                                            <input type="hidden" name="id" value="<?= $value->id_mutasi ?>">
                                                            <input type="hidden" name="email" value="<?= $value->email ?>">
                                                            <input type="hidden" name="status" value="setujui">
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

                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noapprovetablepersetujuan_2<?=$i?>">
                                            Tolak
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="noapprovetablepersetujuan_2<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" action="<?= base_url("mutasi/status_mutasi_2"); ?>" method="POST">
                                                        <div class="modal-header">
                                                        <input type="hidden" name="id" value="<?= $value->id_mutasi ?>">
                                                        <input type="hidden" name="status" value="tolak">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan Mutasi NIP : <b><?= $value->pegawai_nip ?></b> </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="alasan">Alasan</label>
                                                            <textarea class="form-control" id="alasan" rows="4" name="alasan_tolak" required></textarea>
                                                        </div>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Tolak Mutasi</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <?php }; ?>
                            <?php } else { ?>
                                <?php if($value->persetujuan_2 == "setujui") {?>
                                    <span class="badge badge-success"><?= $value->persetujuan_2; ?></span>
                                <?php }; ?>
                                <?php if($value->persetujuan_2 == "tolak") {?>
                                    <span class="badge badge-danger"><?= $value->persetujuan_2; ?></span>
                                <?php }; ?>
                            <?php }; ?>
                        </td>
                        <td>
                            <?php if($value->persetujuan_3 == "pending") {?>
                                <span class="badge badge-warning"><?= $value->persetujuan_3; ?></span>
                                <?php if($this->session->userdata("role") == "admin" && $value->persetujuan_1 == "setujui" && $value->persetujuan_2 == "setujui"){ ?>
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetablepersetujuan_3<?=$i?>">
                                            Setujui
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="approvetablepersetujuan_3<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" action="<?= base_url("mutasi/status_mutasi_3"); ?>" method="POST">
                                                        <div class="modal-header">
                                                            <input type="hidden" name="id" value="<?= $value->id_mutasi ?>">
                                                            <input type="hidden" name="email" value="<?= $value->email ?>">
                                                            <input type="hidden" name="status" value="setujui">
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

                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noapprovetablepersetujuan_3<?=$i?>">
                                            Tolak
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="noapprovetablepersetujuan_3<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" action="<?= base_url("mutasi/status_mutasi_3"); ?>" method="POST">
                                                        <div class="modal-header">
                                                        <input type="hidden" name="id" value="<?= $value->id_mutasi ?>">
                                                        <input type="hidden" name="status" value="tolak">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan Mutasi NIP : <b><?= $value->pegawai_nip ?></b> </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="alasan">Alasan</label>
                                                            <textarea class="form-control" id="alasan" rows="4" name="alasan_tolak" required></textarea>
                                                        </div>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Tolak Mutasi</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <?php }; ?>
                            <?php } else { ?>
                                <?php if($value->persetujuan_3 == "setujui") {?>
                                    <span class="badge badge-success"><?= $value->persetujuan_3; ?></span>
                                <?php }; ?>
                                <?php if($value->persetujuan_3 == "tolak") {?>
                                    <span class="badge badge-danger"><?= $value->persetujuan_3; ?></span>
                                <?php }; ?>
                            <?php }; ?>
                        </td>
                        <td>
                            <?php if($value->status_pengajuan == "pending") {?>
                                <span class="badge badge-warning"><?= $value->status_pengajuan; ?></span>
                                <?php if($this->session->userdata("role") == "direktur" && $value->persetujuan_1 == "setujui" && $value->persetujuan_2 == "setujui" && $value->persetujuan_3 == "setujui"){ ?>
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetable<?=$i?>">
                                            Setujui
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="approvetable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" action="<?= base_url("mutasi/status_mutasi"); ?>" method="POST">
                                                        <div class="modal-header">
                                                            <input type="hidden" name="id" value="<?= $value->id_mutasi ?>">
                                                            <input type="hidden" name="email" value="<?= $value->email ?>">
                                                            <input type="hidden" name="status" value="setujui">
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

                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noapprovetable<?=$i?>">
                                            Tolak
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="noapprovetable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" action="<?= base_url("mutasi/status_mutasi"); ?>" method="POST">
                                                        <div class="modal-header">
                                                        <input type="hidden" name="id" value="<?= $value->id_mutasi ?>">
                                                        <input type="hidden" name="status" value="tolak">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan Mutasi NIP : <b><?= $value->pegawai_nip ?></b> </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="alasan">Alasan</label>
                                                            <textarea class="form-control" id="alasan" rows="4" name="alasan_tolak" required></textarea>
                                                        </div>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Tolak Mutasi</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <?php }; ?>
                            <?php } else { ?>
                                <?php if($value->status_pengajuan == "setujui") {?>
                                    <span class="badge badge-success"><?= $value->status_pengajuan; ?></span>
                                <?php }; ?>
                                <?php if($value->status_pengajuan == "tolak") {?>
                                    <span class="badge badge-danger"><?= $value->status_pengajuan; ?></span>
                                    <p class="mt-3"><?= $value->alasan_tolak ?></p>
                                <?php }; ?>
                            <?php }; ?>
                        </td>
                        <td><?= ($value->tgl_persetujuan == null) ? "-" : $value->tgl_persetujuan ; ?></td>
                        <td>
                            <form action="<?= base_url("mutasi/surat_pengajuan"); ?>" method="POST">                            
                                <input type="hidden" name="nip" value="<?= $value->pegawai_nip ?>">
                                <input type="hidden" name="nama" value="<?= $value->nama ?>">
                                <input type="hidden" name="ttl" value="<?= $value->tempat_lahir ?>, <?= $value->tgl_lahir ?>">
                                <input type="hidden" name="pangkat" value="<?= $value->pangkat ?>">
                                <input type="hidden" name="jabatan" value="<?= $value->nama_jabatan ?>">
                                <input type="hidden" name="jenis" value="<?= $value->jenis_mutasi ?>">
                                <input type="hidden" name="alasan" value="<?= $value->alasan ?>">
                                <button type="submit" class="btn btn-secondary">Unduh</button>
                            </form>
                        </td>
                        <td>
                            <!-- Large modal -->
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edittable">Edit</button>
                            <!-- Modal -->
                            <div class="modal fade" id="edittable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form class="forms-sample" action="<?= base_url("mutasi/update_data_mutasi"); ?>" method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Pengajuan Mutasi No : <b><?= $i ?><b></h5>
                                                <input type="hidden" name="id" value="<?= $value->id ?>">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="pegawai_nip">NIP</label>
                                                    <input type="text" class="form-control" disabled value="<?= $value->pegawai_nip ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="alasan">Alasan</label>
                                                    <textarea class="form-control" id="alasan" rows="4" name="alasan"><?= $value->alasan ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="surat_pengajuan">Surat Pengajuan</label>
                                                    <input type="file" class="form-control" id="surat_pengajuan" name="surat_pengajuan">
                                                    <a href="<?= base_url().'uploads/'.$value->surat_pengajuan ?>" download>Download Surat Pengajuan</a>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_mutasi">Jenis Mutasi</label>
                                                    <select class="custom-select" id="jenis_mutasi" name="jenis_mutasi">
                                                        <option value="Satu instansi" <?php if($value->jenis_mutasi == 'Satu instansi') echo "selected"; ?> >Satu instansi</option>
                                                        <option value="Kabupaten/kota satu provinsi" <?php if($value->jenis_mutasi == 'Kabupaten/kota satu provinsi') echo "selected"; ?> >Kabupaten/kota satu provinsi</option>
                                                        <option value="Kabupaten/kota antar provinsi" <?php if($value->jenis_mutasi == 'Kabupaten/kota antar provinsi') echo "selected"; ?> >Kabupaten/kota antar provinsi</option>
                                                        <option value="Provinsi/kabupaten/kota ke instansi pusat" <?php if($value->jenis_mutasi == 'Provinsi/kabupaten/kota ke instansi pusat') echo "selected"; ?> >Provinsi/kabupaten/kota ke instansi pusat</option>
                                                        <option value="Antar instansi pusat" <?php if($value->jenis_mutasi == 'Antar instansi pusat') echo "selected"; ?> >Antar instansi pusat</option>
                                                        <option value="Perwakilan NKRI di luar negeri" <?php if($value->jenis_mutasi == 'Perwakilan NKRI di luar negeri') echo "selected"; ?> >Perwakilan NKRI di luar negeri</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                <button type="submit" class="btn btn-primary">Edit Mutasi</button>
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
                                        <form class="forms-sample" action="<?= base_url("mutasi/delete_data_mutasi"); ?>" method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Mutasi No : <b><?= $i ?></b> </h5>
                                                <input type="hidden" name="id" value="<?= $value->id ?>">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Hapus Mutasi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                    <?php $i++; } ?>
                </tbody>                            
            </table>
        </div>
    </div>
</div>