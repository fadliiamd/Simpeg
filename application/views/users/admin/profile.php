<div class="container">
    <div class="main-body">
        <div class="profile d-flex justify-content-between align-items-center">
            <h1> My Profile</h1>
            <div class="box">
                <a href="<?= base_url('account/edit_profile_admin/' . $profiles->account_nip) ?>">
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">NIP</h6>
                            </div>
                            <div class="col-sm-9 text-secondary val">
                                <?= $profiles->account_nip ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nama Lengkap</h6>
                            </div>
                            <div class="col-sm-9 text-secondary val">
                                <?= $profiles->nama ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary val">
                                <?= $profiles->email ?>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>