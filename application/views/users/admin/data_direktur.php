<div class="row">
    <div class="col-lg-12">
        <h3>Data Direktur</h3>

        <!-- Large modal -->
        <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Data Direktur</button>
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
        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Direktur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url("account/create_data_direktur"); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="email">Email (*)</label>
                                    <input class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="password">Password (*)</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="nip">NIP (*)</label>
                                    <input class="form-control" id="nip" name="nip" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="nama">Nama Lengkap (*)</label>
                                    <input class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="jenis_kelamin">Jenis Kelamin (*)</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="" selected disabled hidden>-- Pilih Jenis Kelamin --</option>
                                        <option value="l">Laki-laki</option>
                                        <option value="p">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="agama">Agama (*)</label>
                                    <select class="form-control" id="agama" name="agama" required>
                                    <option value="" selected disabled hidden>-- Pilih Agama --</option>
                                        <option value="islam">Islam</option>
                                        <option value="protestan">Protestan</option>
                                        <option value="katholik">Katholik</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="budha">Budha</option>
                                        <option value="konghucu">Konghucu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="tempat_lahir">Tempat Lahir (*)</label>
                                    <input class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="tgl_lahir">Tanggal Lahir (*)</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="alamat">Alamat (*)</label>
                                    <input class="form-control" id="alamat" name="alamat" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan">
                                </div>      
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control-file" id="foto" name="foto">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Tambah Direktur</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <div class="table-responsive">
            <table id="tbl-data-pegawai" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>TTL</th>          
                        <th>Alamat</th>          
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($direktur as $key => $value) { ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $value->account_nip ?></td>
                            <td><?= $value->jabatan ?></td>
                            <td><?= $value->nama ?></td>
                            <td><?= $value->email ?></td>                            
                            <td><?= $value->tempat_lahir.', '.date('d-m-Y', strtotime($value->tgl_lahir)) ?></td>
                            <td><?= $value->alamat ?></td>
                            <td>
                                <!-- Large modal -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".edittable-<?= $no ?>">Edit</button>

                                <!-- Modal -->
                                <div class="modal fade edittable-<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Direktur NIP : <b><?= $value->account_nip ?><b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url("account/update_data_direktur"); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="email">Email (*)</label>
                                                            <input class="form-control" id="email" name="email" value="<?= $value->email ?>" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="password">Password</label>
                                                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password baru">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <label for="nip">NIP (*)</label>
                                                            <input class="form-control" id="nip" name="nip" value="<?= $value->account_nip ?>">
                                                            <input type="hidden" class="form-control" id="nip_old" name="nip_old" value="<?= $value->account_nip ?>">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="nama">Nama Lengkap (*)</label>
                                                            <input class="form-control" id="nama" name="nama" value="<?= $value->nama ?>">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="jenis_kelamin">Jenis Kelamin (*)</label>
                                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                                                <option value="">-- Pilih Jenis Kelamin --</option>                                                                
                                                                <option value="l" <?php if ($value->jenis_kelamin === 'l')  echo "selected"; ?> >Laki-laki</option>
                                                                <option value="p" <?php if ($value->jenis_kelamin ==='p')  echo "selected"; ?>>Perempuan</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="agama">Agama (*)</label>
                                                            <select class="form-control" id="agama" name="agama">
                                                                <option value="">-- Pilih Agama --</option>
                                                                <option value="islam" <?php if ($value->agama === 'islam')  echo "selected"; ?>>Islam</option>
                                                                <option value="protestan" <?php if ($value->agama === 'protestan')  echo "selected"; ?>>Protestan</option>
                                                                <option value="katholik" <?php if ($value->agama === 'katholik')  echo "selected"; ?>>Katholik</option>
                                                                <option value="hindu" <?php if ($value->agama === 'hindu')  echo "selected"; ?>>Hindu</option>
                                                                <option value="budha" <?php if ($value->agama === 'budha')  echo "selected"; ?>>Budha</option>
                                                                <option value="konghucu" <?php if ($value->agama === 'konghucu')  echo "selected"; ?>>Konghucu</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <label for="tempat_lahir">Tempat Lahir (*)</label>
                                                            <input class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $value->tempat_lahir ?>">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="tgl_lahir">Tanggal Lahir (*)</label>
                                                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= date('Y-m-d',strtotime($value->tgl_lahir)) ?>">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="alamat">Alamat (*)</label>
                                                            <input class="form-control" id="alamat" name="alamat" value="<?= $value->alamat ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="jabatan">Jabatan</label>
                                                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $value->jabatan ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <label for="foto">Foto</label>
                                                            <input type="file" class="form-control-file" id="foto" name="foto">
                                                            <?php if( ! is_null($value->foto)) {?>
                                                                <a href="<?= base_url().'uploads/'.$value->foto ?>" download>Download Foto</a>
                                                            <?php
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-primary">Update Pegawai</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable-<?= $no ?>">Hapus</button>

                                <!-- Modal -->
                                <div class="modal fade" id="deletetable-<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Direktur NIP : <b><?= $value->account_nip ?></b> </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url("account/delete_data_direktur"); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    Apakah anda yakin untuk menghapus data pegawai ini?
                                                    <input type="hidden" name="nip" value="<?= $value->account_nip ?>">
                                                </div>                                            
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                    <button type="submit" class="btn btn-danger">Ya</button>
                                                </div>
                                            </form>                                            
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#deletetable">Detail</button>
                            </td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tbl-data-pegawai').DataTable();
    });
</script>