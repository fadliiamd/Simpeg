<div class="container">
    <div class="main-body">
        <h1> My Profile</h1>
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="FOTO PROFILE" class="rounded-circle" width="150">
                            <div class="mt-3">                                
                                <h4><?= explode(' ', $profiles->nama)[0] ?></h4>
                                <p class="text-secondary mb-1 text-capitalize"><?= $_SESSION['role'] ?> SPK POLSUB</p>
                                <!-- <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p> -->
                                <!-- <button class="btn btn-primary">Follow</button>
                                <button class="btn btn-outline-primary">Message</button> -->
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
                            <div class="col-sm-9 text-secondary">
                                <?= $profiles->nama ?>
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