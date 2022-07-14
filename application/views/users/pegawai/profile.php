<div class="container">
    <div class="main-body">
        <h1><?php echo ($id === $_SESSION['nip'] ?'My' : '');?> Profile</h1>
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?= base_url('uploads/' . $profiles->foto) ?>" alt="FOTO PROFILE" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4><?= explode(' ', $profiles->nama)[0] ?></h4>
                                <p class="text-secondary mb-1 text-capitalize"><?= $profiles->role ?> SPK POLSUB</p>
                                <!-- <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p> -->
                                <!-- <button class="btn btn-primary">Follow</button>
                                <button class="btn btn-outline-primary">Message</button> -->
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">NIP</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $profiles->account_nip ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nama Lengkap</h6>
                            </div>
                            <div class="col-sm-9 text-secondary text-capitalize">
                                <?= $profiles->nama ?>
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
                                <?= $label_kelamin[$profiles->jenis_kelamin] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $profiles->email ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Tempat, Tanggal Lahir</h6>
                            </div>
                            <div class="col-sm-9 text-secondary text-capitalize">
                                <?= $profiles->tempat_lahir . ', ' . $profiles->tgl_lahir ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Agama</h6>
                            </div>
                            <div class="col-sm-9 text-secondary text-capitalize">
                                <?= $profiles->agama ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Alamat</h6>
                            </div>
                            <div class="col-sm-9 text-secondary text-capitalize">
                                <?= $profiles->alamat ?>
                            </div>
                        </div>
                        <hr>
                        <?php if (!is_null($profiles->jabatan_id)) {
                            echo '<div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Jabatan</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                ' . $profiles->nama_jabatan . '
                            </div>
                        </div>
                        <hr>';
                        } ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Gaji</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $profiles->gaji ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Status Kepegawaian</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $profiles->status ?>
                            </div>
                        </div>
                        <hr>
                        <?php if (!is_null($profiles->jurusan_id)) {
                            echo '<div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Jurusan</h6>
                            </div>
                            <div class="col-sm-9 text-secondary text-capitalize">
                                ' . $profiles->nama_jurusan . '
                            </div>
                        </div>
                        <hr>';
                        } ?>
                        <?php if (!is_null($profiles->bagian_id)) {
                            echo '<div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Bagian</h6>
                            </div>
                            <div class="col-sm-9 text-secondary text-capitalize">
                                ' . $profiles->nama_bagian . '
                            </div>
                        </div>
                        <hr>';
                        } ?>
                        <?php if (!is_null($profiles->unit_id)) {
                            echo '<div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Unit</h6>
                            </div>
                            <div class="col-sm-9 text-secondary text-capitalize">
                                ' . $profiles->nama_unit . '
                            </div>
                        </div>
                        <hr>';
                        } ?>
                        <!-- <div class="row">
                            <div class="col-sm-12">
                                <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>
                            </div>
                        </div> -->
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>