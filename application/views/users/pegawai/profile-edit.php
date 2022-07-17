<div class="container">
    <div class="main-body">
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
        <h1><?php echo ($id === $_SESSION['nip'] ? 'My' : 'Detail'); ?> Profile</h1>
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?= base_url('uploads/' . $profiles->foto) ?>" alt="FOTO PROFILE" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4><?= explode(' ', $profiles->nama)[0] ?></h4>
                                <p class="text-secondary mb-1 text-capitalize"><?= $profiles->role ?> SPK POLSUB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <h6>Dokumen :</h6>
                    <ul class="list-group list-group-flush">
                        <?php
                        if (!is_null($profiles->ijazah)) { ?>
                            <li class="list-group-item d-flex align-items-center flex-wrap">
                                <i class="mdi mdi-file mr-3"></i>
                                <h6 class="mb-0"><a href="<?= base_url('uploads/' . $profiles->ijazah) ?>" target="_blank">Ijazah</a></h6>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if (!is_null($profiles->karpeg)) { ?>
                            <li class="list-group-item d-flex align-items-center flex-wrap">
                                <i class="mdi mdi-file mr-3"></i>
                                <h6 class="mb-0"><a href="<?= base_url('uploads/' . $profiles->karpeg) ?>" target="_blank">Kartu Pegawai</a></h6>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <form id="form-profile" class="forms-sample" action="<?= base_url('account/update_data_pegawai') ?>" enctype="multipart/form-data" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">NIP</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input id="nip" class="form-control" type="number" name="nip" value="<?= $profiles->account_nip ?>">
                                    <input class="form-control" type="hidden" name="nip_old" value="<?= $profiles->account_nip ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nama Lengkap</h6>
                                </div>
                                <div class="col-sm-9 text-secondary text-capitalize">
                                    <input class="form-control" name="nama" value="<?= $profiles->nama ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Jenis Kelamin</h6>
                                </div>
                                <div class="col-sm-9 text-secondary text-capitalize">
                                    <?php $label_kelamin = [
                                        'p' => 'Perempuan',
                                        'l' => 'Laki-Laki'
                                    ]; ?>
                                    <select class="form-control" name="jenis_kelamin">
                                        <option value="<?= $profiles->jenis_kelamin ?>" selected hidden><?= $label_kelamin[$profiles->jenis_kelamin] ?></option>
                                        <option value="l">Laki-laki</option>
                                        <option value="p">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input class="form-control" id="email" name="email" value="<?= $profiles->email ?>">
                                    <input type="hidden" class="form-control" id="email_old" name="email_old" value="<?= $profiles->email ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Tempat, Tanggal Lahir</h6>
                                </div>
                                <div class="col-sm-9 text-secondary text-capitalize">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" name="tempat_lahir" value="<?= $profiles->tempat_lahir ?>">
                                        </div>
                                        <div class="col">
                                            <input type="date" class="form-control" name="tgl_lahir" value="<?= $profiles->tgl_lahir ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Agama</h6>
                                </div>
                                <div class="col-sm-9 text-secondary text-capitalize">
                                    <select class="form-control" name="agama">
                                        <option value="<?= $profiles->agama ?>" selected hidden><?= $profiles->agama ?></option>
                                        <option value="islam">Islam</option>
                                        <option value="protestan">Protestan</option>
                                        <option value="katholik">Katholik</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="budha">Budha</option>
                                        <option value="konghucu">Konghucu</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Alamat</h6>
                                </div>
                                <div class="col-sm-9 text-secondary text-capitalize">
                                    <input type="text" class="form-control" value="<?= $profiles->alamat ?>" name="alamat">
                                </div>
                            </div>
                            <hr>
                            <?php
                            function get_format_jabatan($jabatan, $profiles)
                            {
                                $option = '';
                                foreach ($jabatan as $k => $v) {
                                    if ($profiles->jabatan_id == $v->id) {
                                        $selected = 'selected';
                                    } else {
                                        $selected = '';
                                    }
                                    $option .= '<option value="' . $v->id . '" ' . $selected . '>' . $v->nama_jabatan . ' - ' . $v->jenis_jabatan . '</option>';
                                }
                                return $option;
                            }

                            if (!is_null($profiles->jabatan_id)) {
                                echo '<div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Jabatan</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <select class="form-control" id="jabatan" name="jabatan">
                                    <option value="">-- Pilih Jabatan --</option>
                            ' . get_format_jabatan($jabatan, $profiles) . '
                                </select>
                            </div>
                            </div>
                            <hr>';
                            } ?>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Gaji</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="number" class="form-control" id="gaji" name="gaji" value="<?= $profiles->gaji ?>" placeholder="Rp.">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Status Kepegawaian</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select class="form-control" id="status_pegawai" name="status_pegawai" required>
                                        <option value="PNS" <?php if ($profiles->status === 'PNS')  echo "selected"; ?>>PNS</option>
                                        <option value="Honorer" <?php if ($profiles->status === 'Honorer')  echo "selected"; ?>>Honorer</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <?php
                            if (!is_null($profiles->jurusan_id)) { ?>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Jurusan</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary text-capitalize">
                                        <select class="form-control" id="jurusan_id" name="jurusan_id">
                                            <option value="">-- Pilih Jurusan --</option>
                                            <?php foreach ($jurusan as $k => $v) { ?>
                                                <option value="<?= $v->id ?>" <?php if ($profiles->jurusan_id === $v->id)  echo "selected"; ?>>
                                                    <?= $v->nama ?>
                                                </option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                            <?php
                            } ?>
                            <?php if (!is_null($profiles->bagian_id)) { ?>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Bagian</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary text-capitalize">
                                        <select class="form-control" id="bagian_id" name="bagian_id">
                                            <option value="">-- Pilih Bagian --</option>
                                            <?php foreach ($bagian as $k => $v) { ?>
                                                <option value="<?= $v->id ?>" <?php if ($profiles->bagian_id === $v->id)  echo "selected"; ?>>
                                                    <?= $v->nama ?>
                                                </option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                            <?php
                            } ?>
                            <?php if (!is_null($profiles->unit_id)) { ?>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Unit</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary text-capitalize">
                                        <select class="form-control" id="unit_id" name="unit_id">
                                            <option value="">-- Pilih Unit --</option>
                                            <?php foreach ($unit as $k => $v) { ?>
                                                <option value="<?= $v->id ?>" <?php if ($profiles->unit_id === $v->id)  echo "selected"; ?>>
                                                    <?= $v->nama ?>
                                                </option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                            <?php
                            } ?>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="text-decoration-none mx-3">
                                <button type="button" class="btn btn-secondary d-flex align-items-center">
                                    Kembali
                                </button>
                            </a>
                            <button type="submit" class="btn btn-warning d-flex align-items-center">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>