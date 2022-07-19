<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>LOGIN SPK POLSUB</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="px-0 content-wrapper d-flex align-items-center auth">
        <div class="mx-0 row w-100">
          <div class="mx-auto col-lg-4">

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
          
            <div class="px-4 py-5 text-left auth-form-light px-sm-5">
              <div class="brand-logo d-flex justify-content-center">
                <img src="<?= base_url(); ?>assets/images/polsub2.png" alt="logo">
              </div>
              <h4>Sistem Pendukung Keputusan POLSUB</h4>
              <h6 class="font-weight-light">Silahkan login terlebih dahulu!</h6>
              <form class="pt-3" action="<?= base_url(); ?>auth/do_login" method="post" enctype="multipart/form-data">
                <?php if ($this->session->flashdata('message_login_error')) : ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('message_login_error') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <?php endif ?>
                <div class="form-group">
                  <input type="text" name="nip" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="NIP / NIK">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">LOGIN</button>
                </div>
                <div class="mt-4 text-center font-weight-light">
                  Pegawai baru mutasi masuk? <a href="#" class="text-primary" data-toggle="modal" data-target=".createPending">Buat Akun</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>


  <!-- Modal -->
  <div class="modal fade createPending" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url("auth/create_data_pegawai"); ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="status_kerja" value="pending">
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
                                        <option value="D3">D3</option>
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
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?= base_url(); ?>assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?= base_url(); ?>assets/js/off-canvas.js"></script>
  <script src="<?= base_url(); ?>assets/js/hoverable-collapse.js"></script>
  <script src="<?= base_url(); ?>assets/js/template.js"></script>
  <script src="<?= base_url(); ?>assets/js/settings.js"></script>
  <script src="<?= base_url(); ?>assets/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>