<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/mdi/css/materialdesignicons.min.css">
  <script src="https://kit.fontawesome.com/48c190b106.js" crossorigin="anonymous"></script>
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.png" />  

  <!-- plugins:js -->
  <script src="<?= base_url(); ?>assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->

  <!-- Plugin js for this page -->
  <script src="<?= base_url(); ?>assets/vendors/chart.js/Chart.min.js"></script>
  <script src="<?= base_url(); ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="<?= base_url(); ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="<?= base_url(); ?>assets/js/dataTables.select.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/dataTables.buttons.min.js"></script>
  <!-- End plugin js for this page -->

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="flex-row p-0 navbar col-lg-12 col-12 fixed-top d-flex">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="mr-5 navbar-brand brand-logo" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/images/logo.svg" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <!-- <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul> -->
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="<?= base_url(); ?>#" data-toggle="dropdown">
              <i class="mx-0 icon-bell"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="float-left mb-0 font-weight-normal dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mx-0 ti-info-alt"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Application Error</h6>
                  <p class="mb-0 font-weight-light small-text text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mx-0 ti-settings"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="mb-0 font-weight-light small-text text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mx-0 ti-user"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                  <p class="mb-0 font-weight-light small-text text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="<?= base_url(); ?>#" data-toggle="dropdown" id="profileDropdown">
              <img src="<?= base_url(); ?>assets/images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a href="<?= site_url('auth/logout') ?>" class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="<?= base_url(); ?>#">
              <i class="icon-ellipsis"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="mr-3 border img-ss rounded-circle bg-light"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="mr-3 border img-ss rounded-circle bg-dark"></div>Dark</div>
          <p class="mt-2 settings-heading">HEADER SKINS</p>
          <div class="px-4 mx-0 color-tiles">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="<?= base_url(); ?>#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="<?= base_url(); ?>#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="px-3 mb-0 add-items d-flex">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="px-3 list-wrapper">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 mt-5 mb-0 text-muted font-weight-light">Events</h4>
            <div class="px-3 pt-4 events">
              <div class="mb-2 wrapper d-flex">
                <i class="mr-2 ti-control-record text-primary"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="mb-0 text-gray">The total number of sessions</p>
            </div>
            <div class="px-3 pt-4 events">
              <div class="mb-2 wrapper d-flex">
                <i class="mr-2 ti-control-record text-primary"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="mb-0 text-gray ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="pt-0 pb-0 pl-3 mb-3 settings-heading border-top-0 border-bottom-0">Friends</p>
              <small class="pt-0 pb-0 pr-3 mb-3 settings-heading border-top-0 border-bottom-0 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="<?= base_url(); ?>assets/images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="my-auto text-muted">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="<?= base_url(); ?>assets/images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="mx-2 my-auto badge badge-success badge-pill">4</div>
                <small class="my-auto text-muted">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="<?= base_url(); ?>assets/images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="my-auto text-muted">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="<?= base_url(); ?>assets/images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="my-auto text-muted">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="<?= base_url(); ?>assets/images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="my-auto text-muted">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="<?= base_url(); ?>assets/images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="my-auto text-muted">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url(); ?>">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <hr>
          <li class="nav-item">
            <span class="font-weight-bold menu-title">Peralihan dan Pengalihan</span>
            <hr>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#peralihan" aria-expanded="false" aria-controls="peralihan">
              <i class="mdi mdi-account-convert menu-icon"></i>
              <span class="menu-title">Mutasi</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="peralihan">
              <ul class="nav flex-column sub-menu">
                <?php if($this->session->userdata("role") == "admin" || $this->session->userdata("role") == "pegawai"){ ?>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url("Mutasi/pengajuan_mutasi"); ?>">Pengajuan</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url("Mutasi/berkas_mutasi"); ?>">Berkas Persyaratan</a></li>
                <?php } ?>
                <?php if($this->session->userdata("role") == "admin" || $this->session->userdata("role") == "direktur"){ ?>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url("Mutasi/usulan_mutasi"); ?>">Usulan</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url("Mutasi/penerimaan_mutasi"); ?>">Penerimaan</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url("Mutasi/sk_mutasi"); ?>">Surat Keputusan</a></li>
                <?php } ?>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#pemberhentian" aria-expanded="false" aria-controls="pemberhentian">
              <i class="mdi mdi-account-off menu-icon"></i>
              <span class="menu-title">Pemberhentian</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="pemberhentian">
              <ul class="nav flex-column sub-menu">
                <?php if($this->session->userdata("role") == "admin" || $this->session->userdata("role") == "pegawai"){ ?>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url("Pemberhentian/pengajuan_pemberhentian"); ?>">Pengajuan</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url("Pemberhentian/berkas_pemberhentian"); ?>">Berkas Persyaratan</a></li>
                <?php } ?>
                <?php if($this->session->userdata("role") == "admin" || $this->session->userdata("role") == "direktur"){ ?>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url("Pemberhentian/usulan_pensiun"); ?>">Usulan Pensiun</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url("Pemberhentian/sk_pensiun"); ?>">SK Pensiun</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url("Pemberhentian/riwayat_pemberhentian"); ?>">Riwayat</a></li>
                <?php } ?>
              </ul>
            </div>
          </li>
          <hr>
          <li class="nav-item">
            <span class="font-weight-bold menu-title">Kepegawaian</span>
            <hr>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="<?= base_url().'surat' ?>">
              <i class="mdi mdi-email menu-icon"></i>
              <span class="menu-title">Surat</span>              
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="<?= base_url().'sertifikat' ?>">
              <i class="mdi mdi-certificate menu-icon"></i>
              <span class="menu-title">Sertifikat</span>              
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#perangkingan" aria-expanded="false" aria-controls="perangkingan">
              <i class="mdi mdi-trophy-variant menu-icon"></i>
              <span class="menu-title">Perangkingan</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="perangkingan">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url("kriteria"); ?>">Kriteria</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url("subkriteria"); ?>">Sub Kriteria</a></li>                                
                <li class="nav-item"> <a class="nav-link"  href="<?= base_url("hasil"); ?>">Hasil</a></li>                
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#kegiatan" aria-expanded="false" aria-controls="kegiatan">
              <i class="mdi mdi-format-list-bulleted-type menu-icon"></i>
              <span class="menu-title">Kegiatan</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="kegiatan">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="#">Diklat</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Bimtek</a></li>
                <li class="nav-item"> <a class="nav-link"  href="#">Prajabatan</a></li>                
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Divisi" aria-expanded="false" aria-controls="Divisi">
              <i class="fa-solid fa-building-columns menu-icon"></i>
              <span class="menu-title">Divisi</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Divisi">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url("jurusan"); ?>">Jurusan</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url("bagian"); ?>">Bagian</a></li>
                <li class="nav-item"> <a class="nav-link"  href="<?= base_url("unit"); ?>">Unit</a></li>                
              </ul>
            </div>
          </li>
          <hr>
          <li class="nav-item">
            <span class="font-weight-bold menu-title">Peningkatan Karir</span>
            <hr>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#kenaikan_jabatan" aria-expanded="false" aria-controls="kenaikan_jabatan">
              <i class="mdi mdi-chart-line menu-icon"></i>
              <span class="menu-title">Kenaikan Jabatan</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="kenaikan_jabatan">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url("kenaikan_jabatan/pengajuan_kenaikan"); ?>">Pengajuan</a></li>                
                <li class="nav-item"> <a class="nav-link" href="<?= base_url("kenaikan_jabatan/progress"); ?>">Progress</a></li>                             
              </ul>
            </div>
          </li>          
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#DUPAK" aria-expanded="false" aria-controls="DUPAK">
              <i class="mdi mdi-file-document-box menu-icon"></i>
              <span class="menu-title">DUPAK</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="DUPAK">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url("dupak/pemberkasan"); ?>">Pemberkasan</a></li>                
                <li class="nav-item"> <a class="nav-link" href="<?= base_url("dupak/riwayat_kinerja"); ?>">Riwayat Kinerja</a></li>                             
                <li class="nav-item"> <a class="nav-link" href="<?= base_url("dupak/hasil_diklat"); ?>">Hasil Diklat</a></li>                             
              </ul>
            </div>
          </li>
          <hr>
          <li class="nav-item">
            <span class="font-weight-bold menu-title">User dan Aplikasi</span>
            <hr>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Account" aria-expanded="false" aria-controls="Account">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Account</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Account">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url("account/data_pegawai"); ?>">Pegawai</a></li>                
                <li class="nav-item"> <a class="nav-link" href="<?= base_url("account/data_direktur"); ?>">Direktur</a></li>
                <li class="nav-item"> <a class="nav-link"  href="#">Admin</a></li>                
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#kepegawaian" aria-expanded="false" aria-controls="kepegawaian">
              <i class="mdi mdi-account-settings menu-icon"></i>
              <span class="menu-title">Kepegawaian</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="kepegawaian">
              <ul class="nav flex-column sub-menu">                
                <li class="nav-item"> <a class="nav-link" href="<?= base_url("golpang"); ?>">Golongan/Pangkat</a></li>                  
                <li class="nav-item"> <a class="nav-link" href="<?= base_url("jabatan"); ?>">Jabatan</a></li>                  
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#PAK" aria-expanded="false" aria-controls="PAK">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">PAK</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="PAK">
              <ul class="nav flex-column sub-menu">                
                <li class="nav-item"> <a class="nav-link" href="<?= base_url("pak/unsur"); ?>">Unsur</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url("pak/unsur_kegiatan"); ?>">Unsur Kegiatan</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">UI Elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>welcome/uiButton">Buttons</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>welcome/uiDropdown">Dropdowns</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>welcome/uiTypo">Typography</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Form elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>welcome/formBasic">Basic Elements</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Charts</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>welcome/chartsJS">ChartJs</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Tables</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>welcome/tableBasic">Basic table</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
              <i class="icon-contract menu-icon"></i>
              <span class="menu-title">Icons</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>welcome/iconsMdi">Mdi icons</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>welcome/userLogin"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>welcome/userRegister"> Register </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
              <i class="icon-ban menu-icon"></i>
              <span class="menu-title">Error pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>welcome/page404"> 404 </a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>welcome/page500"> 500 </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url(); ?>welcome/documentation">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
        </ul>
      </nav>

      <!-- partial -->
      <div class="main-panel">
          
          <div class="content-wrapper">