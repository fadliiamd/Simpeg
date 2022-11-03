<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between">
            <h4>Pengajuan Mutasi <?= $this->session->userdata("nama_jabatan") ?></h4>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#staticBackdrop">
                <i class="mdi mdi-information"></i> Persyaratan
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Berkas Persyaratan Mutasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ol>
                                <li>SK CPNS</li>
                                <li>SK PNS</li>
                                <li>SK Pangkat</li>
                                <li>Dp3 Akhir</li>
                                <li>Ijazah</li>
                                <li>Kartu Pegawai</li>
                                <li>Daftar Riwayat Hidup</li>
                            </ol>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Large modal -->
        <?php foreach ($users as $key => $value) { ?>
            <?php if (($this->session->userdata("role") == "pegawai" && !$mutasi) || (findObjectBy('status_pengajuan', 'tolak', $mutasi) != false && findObjectBy('status_pengajuan', 'pending', $mutasi) == false)) { ?>
                <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Mutasi</button>
            <?php } ?>
        <?php } ?>

        <?php if ($this->session->userdata("role") == "admin") { ?>
            <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Mutasi</button>
        <?php } ?>

        <a href="<?= base_url() . 'assets/pdf/pengajuan_mutasi.docx' ?>" download class="my-3 btn btn-secondary">Surat Pengajuan Mutasi</a>
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
                            <div class="form-group">
                                <label for="instansi_tujuan">Instansi Tujuan</label>
                                <input type="text" class="form-control" id="instansi_tujuan" name="instansi_tujuan" required />
                            </div>
                            <div class="form-group">
                                <label for="jabatan_tujuan">Jabatan Tujuan</label>
                                <input type="text" class="form-control" id="jabatan_tujuan" name="jabatan_tujuan" required />
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
                        <th>Institusi Tujuan</th>
                        <th>Jabatan Tujuan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Persetujuan 1</th>
                        <th>Persetujuan 2</th>
                        <th>Persetujuan 3</th>
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
                            <td><?= $value->jenis_mutasi ?></td>
                            <td><?= $value->alasan; ?></td>
                            <td><?= $value->instansi_tujuan; ?></td>
                            <td><?= $value->jabatan_tujuan; ?></td>
                            <td><?= $value->tgl_pengajuan; ?></td>
                            <!-- Persetujuan 1-->
                            <td>
                                <?php if ($value->persetujuan_1 == "pending") { ?>
                                    <span class="badge badge-warning"><?= $value->persetujuan_1; ?></span>
                                    <?php if (isset($this->session->userdata("user")->jabatan_id)) {
                                        if (
                                            ($this->session->userdata("user")->jabatan_id == 12
                                                && $value->jenis_jabatan == "fungsional"
                                                && $this->session->userdata("user")->jurusan_id == $value->jurusan_id)
                                            ||
                                            ($this->session->userdata("nama_jabatan") == "Kepala Bagian Umum"
                                                && $value->jenis_jabatan == "struktural")
                                        ) { ?>
                                            <div class="mt-3">
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetablepersetujuan_1<?= $i ?>">
                                                    Setujui
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="approvetablepersetujuan_1<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noapprovetablepersetujuan_1<?= $i ?>">
                                                    Tolak
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="noapprovetablepersetujuan_1<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <?php }
                                    };
                                } else { ?>
                                    <?php if ($value->persetujuan_1 == "setujui") { ?>
                                        <span class="badge badge-success"><?= $value->persetujuan_1; ?></span>
                                    <?php }; ?>
                                    <?php if ($value->persetujuan_1 == "tolak") { ?>
                                        <span class="badge badge-danger"><?= $value->persetujuan_1; ?></span>
                                        <p class="mt-3"><?= $value->alasan_tolak ?></p>
                                    <?php }; ?>
                                <?php }; ?>
                            </td>
                            <!-- Persetujuan 2-->
                            <td>
                                <?php if ($value->persetujuan_2 == "pending") { ?>
                                    <span class="badge badge-warning"><?= $value->persetujuan_2; ?></span>
                                    <?php if (($this->session->userdata("nama_jabatan") == "Wakil Direktur I" && $value->jenis_jabatan == "fungsional") || ($this->session->userdata("nama_jabatan") == "Wakil Direktur II" && $value->jenis_jabatan == "struktural") && $value->persetujuan_1 == "setujui") { ?>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetablepersetujuan_2<?= $i ?>">
                                                Setujui
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="approvetablepersetujuan_2<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noapprovetablepersetujuan_2<?= $i ?>">
                                                Tolak
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="noapprovetablepersetujuan_2<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <?php if ($value->persetujuan_2 == "setujui") { ?>
                                        <span class="badge badge-success"><?= $value->persetujuan_2; ?></span>
                                    <?php }; ?>
                                    <?php if ($value->persetujuan_2 == "tolak") { ?>
                                        <span class="badge badge-danger"><?= $value->persetujuan_2; ?></span>
                                        <?php if ($value->persetujuan_1 != "tolak") { ?>
                                            <p class="mt-3"><?= $value->alasan_tolak ?></p>
                                        <?php }; ?>
                                    <?php }; ?>
                                <?php }; ?>
                            </td>
                            <!-- Persetujuan 3-->
                            <td>
                                <?php if ($value->persetujuan_3 == "pending") { ?>
                                    <span class="badge badge-warning"><?= $value->persetujuan_3; ?></span>
                                    <?php if ($this->session->userdata("role") == "admin" && $value->persetujuan_1 == "setujui" && $value->persetujuan_2 == "setujui") { ?>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetablepersetujuan_3<?= $i ?>">
                                                Setujui
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="approvetablepersetujuan_3<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noapprovetablepersetujuan_3<?= $i ?>">
                                                Tolak
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="noapprovetablepersetujuan_3<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <?php if ($value->persetujuan_3 == "setujui") { ?>
                                        <span class="badge badge-success"><?= $value->persetujuan_3; ?></span>
                                    <?php }; ?>
                                    <?php if ($value->persetujuan_3 == "tolak") { ?>
                                        <span class="badge badge-danger"><?= $value->persetujuan_3; ?></span>
                                        <?php if ($value->persetujuan_2 != "tolak") { ?>
                                            <p class="mt-3"><?= $value->alasan_tolak ?></p>
                                        <?php }; ?>
                                    <?php }; ?>
                                <?php }; ?>
                            </td>
                            <td><?= ($value->tgl_persetujuan == null) ? "-" : $value->tgl_persetujuan; ?></td>
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
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edittable<?= $i ?>">Edit</button>
                                <!-- Modal -->
                                <div class="modal fade" id="edittable<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form class="forms-sample" action="<?= base_url("mutasi/update_data_mutasi/" . $value->id_mutasi); ?>" method="POST">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Pengajuan Mutasi No : <b><?= $i ?></b></h5>
                                                    <input type="hidden" name="id" value="<?= $value->id_mutasi ?>">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="pegawai_nip">NIP</label>
                                                                <input type="text" class="form-control" disabled value="<?= $value->pegawai_nip ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="jenis_mutasi">Jenis Mutasi</label>
                                                                <select class="custom-select" id="jenis_mutasi" name="jenis_mutasi">
                                                                    <option value="Satu instansi" <?php if ($value->jenis_mutasi == 'Satu instansi') echo "selected"; ?>>Satu instansi</option>
                                                                    <option value="Kabupaten/kota satu provinsi" <?php if ($value->jenis_mutasi == 'Kabupaten/kota satu provinsi') echo "selected"; ?>>Kabupaten/kota satu provinsi</option>
                                                                    <option value="Kabupaten/kota antar provinsi" <?php if ($value->jenis_mutasi == 'Kabupaten/kota antar provinsi') echo "selected"; ?>>Kabupaten/kota antar provinsi</option>
                                                                    <option value="Provinsi/kabupaten/kota ke instansi pusat" <?php if ($value->jenis_mutasi == 'Provinsi/kabupaten/kota ke instansi pusat') echo "selected"; ?>>Provinsi/kabupaten/kota ke instansi pusat</option>
                                                                    <option value="Antar instansi pusat" <?php if ($value->jenis_mutasi == 'Antar instansi pusat') echo "selected"; ?>>Antar instansi pusat</option>
                                                                    <option value="Perwakilan NKRI di luar negeri" <?php if ($value->jenis_mutasi == 'Perwakilan NKRI di luar negeri') echo "selected"; ?>>Perwakilan NKRI di luar negeri</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alasan">Alasan</label>
                                                        <textarea class="form-control" id="alasan" rows="4" name="alasan"><?= $value->alasan ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="instansi_tujuan">Instansi Tujuan</label>
                                                        <input type="text" class="form-control" id="instansi_tujuan" name="instansi_tujuan" value="<?= $value->instansi_tujuan ?>" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jabatan_tujuan">Jabatan Tujuan</label>
                                                        <input type="text" class="form-control" id="jabatan_tujuan" name="jabatan_tujuan" value="<?= $value->jabatan_tujuan ?>" required />
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

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable<?= $i ?>">
                                    Hapus
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="deletetable<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <?php $i++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>