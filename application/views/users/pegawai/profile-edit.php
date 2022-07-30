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
        <form id="form-profile" class="forms-sample" action="<?= base_url('account/update_profile_pegawai') ?>" enctype="multipart/form-data" method="post">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <div class="container-image">
                                    <img id="output" src="<?= !is_null($profiles->foto) ? base_url('uploads/' . $profiles->foto) :  base_url('assets/images/default-user.png') ?>" alt="FOTO PROFILE" class="rounded-circle" width="150">
                                    <div class="image-upload top-right">
                                        <label for="foto">
                                            <i class="mdi mdi-lead-pencil text-primary"></i>
                                        </label>
                                        <input id="foto" name="foto" class="d-none" type="file" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" />
                                    </div>
                                </div>
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
                            <li class="list-group-item d-flex align-items-center flex-wrap">
                                <i class="mdi mdi-file mr-3"></i>
                                <h6 class="mb-0">
                                    <a id="name-ijazah" href="<?= !is_null($profiles->ijazah) ? base_url('uploads/' . $profiles->ijazah) . '" target="_blank' : "#" ?>"><?= !is_null($profiles->ijazah) ? "Lihat Ijazah" : "Belum Ada Ijazah" ?></a>
                                </h6>
                                <div class="emp">
                                    <label for="ijazah">
                                        <i class="btn p-0 px-2 mdi mdi-lead-pencil text-primary"></i>
                                    </label>
                                    <input type="file" class="form-control-file d-none" id="ijazah" name="ijazah" onchange="document.getElementById('name-ijazah').innerHTML = this.value.replace(/C:\\fakepath\\/i, '');">
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center flex-wrap">
                                <i class="mdi mdi-file mr-3"></i>
                                <h6 class="mb-0">
                                    <a id="name-karpeg" href="<?= !is_null($profiles->karpeg) ? base_url('uploads/' . $profiles->karpeg) . '" target="_blank' : "#" ?>"><?= !is_null($profiles->karpeg) ? "Lihat Kartu Pegawai" : "Belum Ada karpeg" ?></a>
                                </h6>
                                <div class="emp">
                                    <label for="karpeg">
                                        <i class="btn p-0 px-2 mdi mdi-lead-pencil text-primary"></i>
                                    </label>
                                    <input type="file" class="form-control-file d-none" id="karpeg" name="karpeg" onchange="document.getElementById('name-karpeg').innerHTML = this.value.replace(/C:\\fakepath\\/i, '');">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
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
                                    <select class="form-control" id="jabatan" name="jabatan" disabled>
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
                                    <input type="number" class="form-control" id="gaji" name="gaji" value="<?= $profiles->gaji ?>" placeholder="Rp." disabled>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Status Kepegawaian</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select class="form-control" id="status_pegawai" name="status_pegawai" disabled>
                                        <option value="PNS" <?php if ($profiles->status === 'PNS')  echo "selected"; ?>>PNS</option>
                                        <option value="Honorer" <?php if ($profiles->status === 'Honorer')  echo "selected"; ?>>Honorer</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Bidang Keahlian</h6>
                                </div>
                                <div class="col-sm-9 text-secondary text-capitalize">
                                    <select class="form-control" id="jurusan_id" name="keahlian_id">
                                        <option value="">-- Pilih Bidang Keahlian --</option>
                                        <?php foreach ($bidang_keahlian as $k => $v) { ?>
                                            <option value="<?= $v->id_keahlian ?>" <?php if ($profiles->bidang_keahlian_id === $v->id_keahlian)  echo "selected"; ?>>
                                                <?= $v->nama_keahlian ?>
                                            </option>
                                        <?php
                                        } ?>
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
                                        <select class="form-control" id="jurusan_id" name="jurusan_id" disabled>
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
                                        <select class="form-control" id="bagian_id" name="bagian_id" disabled>
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
                                        <select class="form-control" id="unit_id" name="unit_id" disabled>
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
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="<?= base_url("account/profile_pegawai/" . $id) ?>" class="text-decoration-none mx-3">
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

<script>
    $(document).ready(function() {
        var nip_default = $('#nip').val();
        $("#nip").on('change', function() {
            if (nip_default !== $(this).val()) {
                alert("Kamu mengubah NIP. Setelah klik tombol simpan anda diharuskan login kembali!");
            }
        })
    });
</script>