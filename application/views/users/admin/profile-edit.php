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
        <div class="profile d-flex justify-content-between align-items-center">
            <h1> My Profile</h1>
        </div>
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="FOTO PROFILE" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4><?= explode(' ', $profiles->nama)[0] ?></h4>
                                <p class="text-secondary mb-1 text-capitalize"><?= $_SESSION['role'] ?> SPK POLSUB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <form id="form-profile" class="forms-sample" action="<?= base_url('account/update_data_admin')?>" enctype="multipart/form-data" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">NIP</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input class="form-control" id="nip" name="nip" value="<?= $profiles->account_nip ?>" type="number">
                                    <input class="form-control" type="hidden" name="nip_old" value="<?= $profiles->account_nip ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nama Lengkap</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input class="form-control" name="nama" value="<?= $profiles->nama ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input class="form-control" value="<?= $profiles->email ?>" name="email" type="email">
                                    <input class="form-control" value="<?= $profiles->email ?>" name="email_old" type="hidden">
                                </div>
                            </div>
                            <hr>
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
