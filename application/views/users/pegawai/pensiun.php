<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SPK POLSUB <?= $title ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= site_url() ?>assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <script src="https://kit.fontawesome.com/48c190b106.js" crossorigin="anonymous"></script>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= site_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?= site_url(); ?>assets/js/select.dataTables.min.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/vendors/select2/select2.min.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= site_url() ?>assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= site_url(); ?>assets/images/favicon.png" />

    <!-- plugins:js -->
    <script src="<?= site_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="<?= site_url() ?>assets/vendors/chart.js/Chart.min.js"></script>
    <script src="<?= site_url() ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= site_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= site_url() ?>assets/js/dataTables.select.min.js"></script>
    <script src="<?= site_url() ?>assets/js/dataTables.buttons.min.js"></script>
    <script src="<?= site_url() ?>assets/vendors/select2/select2.min.js"></script>

    <style>
        .btn-pink {
            background-color: #fc47c0;
            color: #fff;
        }

        .btn-pink:hover {
            background-color: #ff00a9;
            color: #fff;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none !important;
            margin: 0;
        }

        /* Firefox */
        input[type=number].hide-arrows {
            -moz-appearance: textfield !important;
        }

        .container-image {
            position: relative;
            text-align: center;
            color: white;
        }

        .top-right {
            position: absolute;
            top: 8px;
            right: 16px;
        }

        .padding-log {
            padding: 3rem !important
        }

        .card-log {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            border: none;
            margin-bottom: 30px
        }

        .card-log .card-log-header {
            background-color: transparent;
            border-bottom: none;
            padding: 25px 20px
        }

        .card-log-block {
            padding: 1.25rem;
            margin-top: -40px
        }

        .card-log .card-log-header h5 {
            margin-bottom: 0;
            color: #505458;
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
            margin-right: 10px;
            line-height: 1.4
        }

        .text-muted {
            margin-bottom: 0px
        }

        .user-activity-card .u-img .cover-img {
            width: 60px;
            height: 60px
        }

        .m-b-25 {
            margin-top: 20px
        }

        .user-activity-card .u-img .profile-img {
            width: 20px;
            height: 20px;
            position: absolute;
            bottom: -5px;
            right: -5px
        }

        .img-radius {
            border-radius: 5px
        }

        .user-activity-card .u-img {
            position: relative
        }

        .m-b-5 {
            margin-bottom: 5px
        }

        h6 {
            font-size: 14px
        }

        .card-log .card-log-block p {
            line-height: 25px
        }

        .text-muted {
            color: #919aa3 !important
        }

        .card-log .card-log-block p {
            line-height: 25px
        }

        .text-muted {
            color: #919aa3 !important
        }

        .m-r-10 {
            margin-right: 4px
        }

        .feather {
            font-family: 'feather' !important;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .text-center {
            margin-top: 15px
        }
    </style>
    <!-- End plugin js for this page -->
    <?PHP
    header('Access-Control-Allow-Origin: *');
    ?>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="flex-row p-0 navbar col-lg-12 col-12 fixed-top d-flex">
            <div class="mt-0 text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="mr-5 navbar-brand brand-logo" href="<?= site_url(); ?>"><img src="<?= site_url(); ?>assets/images/simpeg2.png" class="mr-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="<?= site_url(); ?>"><img src="<?= site_url(); ?>assets/images/favpolsub60.png" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="<?= site_url(); ?>#" data-toggle="dropdown">
                            <i class="mx-0 icon-bell"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" id="notification_list" aria-labelledby="notificationDropdown">
                            <!-- Notification List -->
                        </div>
                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= site_url(); ?>#" data-toggle="dropdown" id="profileDropdown">
                            <img src="<?= site_url(); ?>assets/images/faces/face28.jpg" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a href="<?= site_url('auth/logout') ?>" class="dropdown-item">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        </div>
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
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="mr-3 border img-ss rounded-circle bg-light"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="mr-3 border img-ss rounded-circle bg-dark"></div>Dark
                    </div>
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
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li id="base-url" class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- partial -->
            <div class="main-panel">

                <div class="content-wrapper">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="<?= base_url('assets/images/default-user.png') ?>" alt="FOTO PROFILE" class="rounded-circle" width="150">
                                        <div class="mt-3">
                                            <h4><?= $pensiun->pegawai_nip .' - '. $pensiun->pegawai_nama ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <h4 class="card-title">File Surat Keputusan <?= $pensiun->jenis_berhenti ?></h4>
                                    <a class="w-100" href="<?= base_url() . 'uploads/' . $pensiun->file_pensiun ?>" target="_blank">
                                        <i class="mdi mdi-file-pdf"></i> 
                                        Lihat file
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-center text-muted text-sm-left d-block d-sm-inline-block">Copyright © 2021. All rights reserved.</span>
                        <span class="float-none mt-1 text-center float-sm-right d-block mt-sm-0">Hand-crafted & made with <i class="ml-1 ti-heart text-danger"></i></span>
                    </div>
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-center text-muted text-sm-left d-block d-sm-inline-block">TIM TA SPK POLITEKNIK NEGERI SUBANG</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->


    <!-- inject:js -->
    <script src="<?= base_url(); ?>assets/js/off-canvas.js"></script>
    <script src="<?= base_url(); ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url(); ?>assets/js/template.js"></script>
    <script src="<?= base_url(); ?>assets/js/settings.js"></script>
    <script src="<?= base_url(); ?>assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= base_url(); ?>assets/js/dashboard.js"></script>
    <script src="<?= base_url(); ?>assets/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->

    <!-- Costum js progantara -->
    <script src="<?= base_url(); ?>assets/js/costum.js"></script>
    <!-- End Costum js progantara -->
    <script>
        $(document).ready(function() {
            $("body").tooltip({
                selector: '[data-toggle=tooltip]'
            });
        });

        const MONTH_NAMES = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        function getFormattedDate(date, prefomattedDate = false, hideYear = false) {
            const day = date.getDate();
            const month = MONTH_NAMES[date.getMonth()];
            const year = date.getFullYear();
            const hours = date.getHours();
            let minutes = date.getMinutes();

            if (minutes < 10) {
                minutes = `0${ minutes }`;
            }

            if (prefomattedDate) {
                // Hari ini pada 10:20
                // Kemarin pada 10:20
                return `${ prefomattedDate } pada ${ hours }:${ minutes }`;
            }

            if (hideYear) {
                // 10 January pada 10:20
                return `${ day } ${ month } pada ${ hours }:${ minutes }`;
            }

            // 10 January 2017 pada 10:20
            return `${ day } ${ month } ${ year } pada ${ hours }:${ minutes }`;
        }

        function timeAgo(dateParam) {
            if (!dateParam) {
                return null;
            }

            const date = typeof dateParam === 'object' ? dateParam : new Date(dateParam);
            const DAY_IN_MS = 86400000; // 24 * 60 * 60 * 1000
            const today = new Date();
            const yesterday = new Date(today - DAY_IN_MS);
            const seconds = Math.round((today - date) / 1000);
            const minutes = Math.round(seconds / 60);
            const isToday = today.toDateString() === date.toDateString();
            const isYesterday = yesterday.toDateString() === date.toDateString();
            const isThisYear = today.getFullYear() === date.getFullYear();

            if (seconds < 5) {
                return 'baru saja';
            } else if (seconds < 60) {
                return `${ seconds } detik yang lalu`;
            } else if (seconds < 90) {
                return 'sekitar semenit yang lalu';
            } else if (minutes < 60) {
                return `${ minutes } menit yang lalu`;
            } else if (isToday) {
                return getFormattedDate(date, 'Hari ini'); // Hari ini pada 10:20
            } else if (isYesterday) {
                return getFormattedDate(date, 'Kemarin'); // Kemarin pada 10:20
            } else if (isThisYear) {
                return getFormattedDate(date, false, true); // 10 January pada 10:20
            }

            return getFormattedDate(date); // 10 January 2017 pada 10:20
        }

        function load_unseen_notification() {
            $.ajax({
                url: "<?= base_url() ?>notifikasi/hook",
                dataType: "json",
                success: function(data) {
                    console.log('Refreshing');
                    $("#notification_list").empty();
                    $("#notification_list").append(`
            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
          `);
                    for (let i = 0; i < data.length; i++) {
                        var display_date = data[i].created_at.replace(' ', 'T');
                        var element = `
              <a class="dropdown-item preview-item" href="<?= base_url() ?>${data[i].redirect_to}">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">${data[i].judul}</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    ${timeAgo(new Date(display_date))}
                  </p>
                </div>
              </a>
            `;
                        $("#notification_list").append(element);
                    }
                }
            });
        }

        function reload_notification() {
            load_unseen_notification();
            setInterval(function() {
                load_unseen_notification();
            }, 30000);
        }

        $(document).ready(function() {
            reload_notification();
            $('#list_surat').DataTable({});
            $(".table-datatable").DataTable({});
        });
    </script>
</body>

</html>