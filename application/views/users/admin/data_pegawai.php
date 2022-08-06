<div class="row">
    <div class="col-lg-12">
        <h3>Data Pegawai</h3>

        <!-- Large modal -->
        <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Data Pegawai</button>
        <!-- <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".createPending">Tambah Data Pegawai Penerimaan</button> -->

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
                        <h5 class="modal-title" id="exampleModalLabel">Data Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url("account/create_data_pegawai"); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input class="form-control" id="email" name="email">
                                </div>
                                <div class="col-md-6">
                                    <label for="password">Password (*)</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="nip">NIP (*)</label>
                                    <input type="number" class="form-control" id="nip" name="nip" required>
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
                                    <label for="alamat">Alamat</label>
                                    <input class="form-control" id="alamat" name="alamat">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="tgl_masuk">Tanggal Masuk (*)</label>
                                    <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk">
                                </div>
                                <div class="col-md-4">
                                    <label for="pendidikan">Pendidikan (*)</label>
                                    <select class="form-control" id="pendidikan" name="pendidikan" required>
                                        <option value="" selected hidden>-- Pilih Pendidikan --</option>
                                        <option value="SMA">SMA</option>
                                        <option value="D2">D2</option>
                                        <option value="D3">D3</option>
                                        <option value="D4">D4</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="gaji">Gaji</label>
                                    <input type="number" class="form-control" id="gaji" name="gaji" placeholder="Rp.">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="golongan_id">Golongan/Pangkat</label>
                                    <select class="form-control" id="golongan_id" name="golongan_id">
                                        <option value="">-- Pilih Golongan/Pangkat --</option>
                                        <?php foreach ($golpang as $key => $value) { ?>
                                            <option value="<?= $value->golongan ?>">
                                                <?= $value->golongan . " / " . $value->pangkat ?>
                                            </option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="status_pegawai">Status Pegawai (*)</label>
                                    <select class="form-control" id="status_pegawai" name="status_pegawai" required>
                                        <option value="" selected hidden>-- Pilih Status Pegawai --</option>
                                        <option value="1">PNS</option>
                                        <option value="2">Honorer</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="jabatan">Jabatan</label>
                                    <select class="form-control" id="jabatan" name="jabatan">
                                        <option value="" selected>-- Pilih Jabatan --</option>
                                        <?php
                                        $option = '';
                                        foreach ($jabatan as $key => $value) {
                                            $option .= '<option value="' . $value->id . '">' . $value->nama_jabatan . ' - ' . $value->jenis_jabatan . '</option>';
                                        }
                                        echo $option;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="jurusan_id">Jurusan</label>
                                    <select class="form-control" id="jurusan_id" name="jurusan_id">
                                        <option value="">-- Pilih Jurusan --</option>
                                        <?php foreach ($jurusan as $key => $value) { ?>
                                            <option value="<?= $value->id ?>">
                                                <?= $value->nama ?>
                                            </option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">

                                    <label for="bagian_id">Bagian</label>
                                    <select class="form-control" id="bagian_id" name="bagian_id">
                                        <option value="">-- Pilih Bagian --</option>
                                        <?php foreach ($bagian as $key => $value) { ?>
                                            <option value="<?= $value->id ?>">
                                                <?= $value->nama ?>
                                            </option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="unit_id">Unit</label>
                                    <select class="form-control" id="unit_id" name="unit_id">
                                        <option value="">-- Pilih Unit --</option>
                                        <?php foreach ($unit as $key => $value) { ?>
                                            <option value="<?= $value->id ?>">
                                                <?= $value->nama ?>
                                            </option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control-file" id="foto" name="foto">
                                </div>
                                <div class="col-md-4">
                                    <label for="ijazah">Ijazah (*)</label>
                                    <input type="file" class="form-control-file" id="ijazah" name="ijazah" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="karpeg">Kartu Pegawai</label>
                                    <input type="file" class="form-control-file" id="karpeg" name="karpeg">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="tgl_menjabat">Tanggal Menjabat</label>
                                    <input type="date" class="form-control" id="tgl_menjabat" name="tgl_menjabat">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Tambah Pegawai</button>
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
                        <th>Nama</th>
                        <th>Atasan</th>
                        <th>Email</th>
                        <th>Status Kepegawaian</th>
                        <th>Pangkat Golongan</th>
                        <th>Jurusan</th>
                        <th>Unit</th>
                        <th>Bagian</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($pegawai as $key => $value) { ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $value->account_nip ?></td>
                            <td><?= $value->nama_pegawai ?></td>
                            <td><?= $value->atasan_nip . ' - ' . $value->nama_atasan ?></td>
                            <td><?= $value->email ?></td>
                            <td><?= $value->status ?></td>
                            <td><?= $value->golongan_id ?></td>
                            <td><?= $value->nama_jurusan ?></td>
                            <td><?= $value->nama_unit ?></td>
                            <td><?= $value->nama_bagian ?></td>
                            <td>
                                <!-- Large modal -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".edittable-<?= $no ?>">Edit</button>

                                <!-- Modal -->
                                <div class="modal fade edittable-<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pegawai NIP : <b><?= $value->account_nip ?><b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url("account/update_data_pegawai"); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="email">Email</label>
                                                            <input class="form-control" id="email" name="email" value="<?= $value->email ?>">
                                                            <input type="hidden" class="form-control" id="email_old" name="email_old" value="<?= $value->email ?>">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="password">Password</label>
                                                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password baru">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <label for="nip">NIP (*)</label>
                                                            <input type="number" class="form-control" id="nip" name="nip" value="<?= $value->account_nip ?>">
                                                            <input type="hidden" class="form-control" id="nip_old" name="nip_old" value="<?= $value->account_nip ?>">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="nama">Nama Lengkap (*)</label>
                                                            <input class="form-control" id="nama" name="nama" value="<?= $value->nama_pegawai ?>">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="jenis_kelamin">Jenis Kelamin (*)</label>
                                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                                <option value="l" <?php if ($value->jenis_kelamin === 'l')  echo "selected"; ?>>Laki-laki</option>
                                                                <option value="p" <?php if ($value->jenis_kelamin === 'p')  echo "selected"; ?>>Perempuan</option>
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
                                                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= date('Y-m-d', strtotime($value->tgl_lahir)) ?>">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="alamat">Alamat</label>
                                                            <input class="form-control" id="alamat" name="alamat" value="<?= $value->alamat ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <label for="tgl_masuk">Tanggal Masuk (*)</label>
                                                            <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?= date('Y-m-d', strtotime($value->tgl_masuk)) ?>">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="pendidikan">Pendidikan (*)</label>
                                                            <select class="form-control" id="pendidikan" name="pendidikan" required>
                                                                <option value="<?= $value->pendidikan ?>" selected hidden><?= $value->pendidikan ?></option>
                                                                <option value="SMA">SMA</option>
                                                                <option value="D2">D2</option>
                                                                <option value="D3">D3</option>
                                                                <option value="D4">D4</option>
                                                                <option value="S1">S1</option>
                                                                <option value="S2">S2</option>
                                                                <option value="S3">S3</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="gaji">Gaji</label>
                                                            <input type="number" class="form-control" id="gaji" name="gaji" value="<?= $value->gaji ?>" placeholder="Rp.">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <label for="golongan_id">Golongan/Pangkat</label>
                                                            <select class="form-control" id="golongan_id" name="golongan_id">
                                                                <option value="">-- Pilih Golongan/Pangkat --</option>
                                                                <?php foreach ($golpang as $k => $v) { ?>
                                                                    <option value="<?= $v->golongan ?>" <?php if ($value->golongan_id === $v->golongan)  echo "selected"; ?>>
                                                                        <?= $v->golongan . " / " . $v->pangkat ?>
                                                                    </option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="status_pegawai">Status Pegawai (*)</label>
                                                            <select class="form-control" id="status_pegawai" name="status_pegawai" required>
                                                                <option value="PNS" <?php if ($value->status === 'PNS')  echo "selected"; ?>>PNS</option>
                                                                <option value="Honorer" <?php if ($value->status === 'Honorer')  echo "selected"; ?>>Honorer</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="jabatan">Jabatan</label>
                                                            <select class="form-control" id="jabatan" name="jabatan">
                                                                <option value="">-- Pilih Jabatan --</option>
                                                                <?php
                                                                $option = '';
                                                                foreach ($jabatan as $k => $v) {
                                                                    if ($value->jabatan_id == $v->id) {
                                                                        $selected = 'selected';
                                                                    } else {
                                                                        $selected = '';
                                                                    }
                                                                    $option .= '<option value="' . $v->id . '" ' . $selected . '>' . $v->nama_jabatan . ' - ' . $v->jenis_jabatan . '</option>';
                                                                }
                                                                echo $option;
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <label for="jurusan_id">Jurusan</label>
                                                            <select class="form-control" id="jurusan_id" name="jurusan_id">
                                                                <option value="">-- Pilih Jurusan --</option>
                                                                <?php foreach ($jurusan as $k => $v) { ?>
                                                                    <option value="<?= $v->id ?>" <?php if ($value->jurusan_id === $v->id)  echo "selected"; ?>>
                                                                        <?= $v->nama ?>
                                                                    </option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="bagian_id">Bagian</label>
                                                            <select class="form-control" id="bagian_id" name="bagian_id">
                                                                <option value="">-- Pilih Bagian --</option>
                                                                <?php foreach ($bagian as $k => $v) { ?>
                                                                    <option value="<?= $v->id ?>" <?php if ($value->bagian_id === $v->id)  echo "selected"; ?>>
                                                                        <?= $v->nama ?>
                                                                    </option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="unit_id">Unit</label>
                                                            <select class="form-control" id="unit_id" name="unit_id">
                                                                <option value="">-- Pilih Unit --</option>
                                                                <?php foreach ($unit as $k => $v) { ?>
                                                                    <option value="<?= $v->id ?>" <?php if ($value->unit_id === $v->id)  echo "selected"; ?>>
                                                                        <?= $v->nama ?>
                                                                    </option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <label for="foto">Foto</label>
                                                            <input type="file" class="form-control-file" id="foto" name="foto">
                                                            <?php if (!is_null($value->foto)) { ?>
                                                                <a href="<?= base_url() . 'uploads/' . $value->foto ?>" target="_blank">Lihat Foto</a>
                                                            <?php
                                                            } ?>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="ijazah">Ijazah (*)</label>
                                                            <input type="file" class="form-control-file" id="ijazah" name="ijazah">
                                                            <a href="<?= base_url() . 'uploads/' . $value->ijazah ?>" target="_blank">Lihat Ijazah</a>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="karpeg">Kartu Pegawai</label>
                                                            <input type="file" class="form-control-file" id="karpeg" name="karpeg">
                                                            <?php if (!is_null($value->karpeg)) { ?>
                                                                <a href="<?= base_url() . 'uploads/' . $value->karpeg ?>" target="_blank">Lihat Kartu Pegawai</a>
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
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pegawai NIP : <b><?= $value->account_nip ?></b> </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url("account/delete_data_pegawai"); ?>" method="POST" enctype="multipart/form-data">
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

                                <a href="<?= base_url('account/profile_pegawai/' . $value->account_nip) ?>"><button type="button" class="btn btn-info">Detail</button></a>
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