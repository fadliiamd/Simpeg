<div class="container">
    <div class="main-body">
        <div class="profile d-flex justify-content-between align-items-center">
            <h1><?php echo ($id === $_SESSION['nip'] ? 'My' : 'Detail'); ?> Profile</h1>
            <div class="box">
                <a href="<?= base_url('account/edit_profile_pegawai/' . $profiles->account_nip) ?>">
                    <button id="edit-profile" type="button" class="btn btn-warning btn-sm d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Edit">
                        <i class="mdi mdi-pencil-box-outline"></i>
                    </button>
                </a>
            </div>
        </div>
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?= !is_null($profiles->foto) ? base_url('uploads/' . $profiles->foto) :  base_url('assets/images/default-user.png') ?>" alt="FOTO PROFILE" class="rounded-circle" width="150">
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
                    <hr>
                    <h6 class="mb-3">Log Kegiatan :</h6>
                    <div class="page-content page-container" id="page-content">
                        <div class="">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-12">
                                    <div class="accordion" id="accordionExample">
                                        <div class="card user-activity-card">
                                            <div class="card-header p-2 bg-primary">
                                                <button class="btn btn-sm p-0 m-0 btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <h5 class="m-0 text-white">Diklat</h5>
                                                </button>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-blok">
                                                    <?php
                                                    if (empty($diklat)) {
                                                        echo "<p class='text-center'>Belum ada diklat</p>";
                                                    }
                                                    foreach ($diklat as $key => $val) { ?>
                                                        <div class="row m-b-25">
                                                            <div class="col-auto p-r-0">
                                                                <div class="u-img">
                                                                    <i class="mdi mdi-history"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5"><?= $val->tema ?></h6>
                                                                <p class="text-muted m-b-0"><i class="mdi mdi-timer feather icon-clock m-r-10"></i><?= $val->created_at ?></p>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="text-center"> <a href="<?= base_url('diklat') ?>" class="b-b-primary text-primary" data-abc="true">View all Diklat</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-content page-container" id="page-content">
                        <div class="">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-12">
                                    <div class="accordion" id="accordionExample">
                                        <div class="card user-activity-card">
                                            <div class="card-header p-2 bg-primary">
                                                <button class="btn btn-sm p-0 m-0 btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                    <h5 class="m-0 text-white">Bimtek</h5>
                                                </button>
                                            </div>
                                            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                <div class="card-blok">
                                                    <?php
                                                    if (empty($bimtek)) {
                                                        echo "<p class='text-center'>Belum ada bimtek</p>";
                                                    }
                                                    foreach ($bimtek as $key => $val) { ?>
                                                        <div class="row m-b-25">
                                                            <div class="col-auto p-r-0">
                                                                <div class="u-img">
                                                                    <i class="mdi mdi-history"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5"><?= $val->tema ?></h6>
                                                                <p class="text-muted m-b-0"><i class="mdi mdi-timer feather icon-clock m-r-10"></i><?= $val->created_at ?></p>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="text-center"> <a href="<?= base_url('bimtek') ?>" class="b-b-primary text-primary" data-abc="true">View all Bimtek</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-content page-container" id="page-content">
                        <div class="">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-12">
                                    <div class="accordion" id="accordionExample">
                                        <div class="card user-activity-card">
                                            <div class="card-header p-2 bg-primary">
                                                <button class="btn btn-sm p-0 m-0 btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                    <h5 class="m-0 text-white">Prajabatan</h5>
                                                </button>
                                            </div>
                                            <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                <div class="card-blok">
                                                    <?php
                                                    if (empty($prajabatan)) {
                                                        echo "<p class='text-center'>Belum ada prajabatan</p>";
                                                    }
                                                    foreach ($prajabatan as $key => $val) { ?>
                                                        <div class="row m-b-25">
                                                            <div class="col-auto p-r-0">
                                                                <div class="u-img">
                                                                    <i class="mdi mdi-history"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5"><?= $val->tema ?></h6>
                                                                <p class="text-muted m-b-0"><i class="mdi mdi-timer feather icon-clock m-r-10"></i><?= $val->created_at ?></p>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="text-center"> <a href="<?=base_url('prajabatan')?>" class="b-b-primary text-primary" data-abc="true">View all Prajabatan</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>