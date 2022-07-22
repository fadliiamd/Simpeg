<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SPK POLSUB <?php echo $title ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <script src="https://kit.fontawesome.com/48c190b106.js" crossorigin="anonymous"></script>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/js/select.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/select2/select2.min.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.png" />

    <!-- plugins:js -->
    <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="<?= base_url() ?>assets/vendors/chart.js/Chart.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url() ?>assets/js/dataTables.select.min.js"></script>
    <script src="<?= base_url() ?>assets/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/select2/select2.min.js"></script>
    <style>
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
            speak: none;
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

        table,
        th,
        td {
            border: 1px solid;
        }
    </style>
    <!-- End plugin js for this page -->
    <?PHP
    header('Access-Control-Allow-Origin: *');
    ?>
</head>

<body>
    <h3 class="text-center">Formulir Usulan Penilaian Angka Kredit Ke-<?php echo $id ?></h3>
    <form>
        <table>
            <thead>
                <tr class="text-center">
                    <th style="text-align:center">No</th>
                    <th colspan="2">Komponen Kegiatan</th>
                    <th>Batas Maksimal Diakui</th>
                    <th>Bukti Kegiatan</th>
                    <th style="word-wrap: break-word;min-width: 120px;max-width: 120px;white-space:normal;">Angka Kredit Tertinggi</th>
                    <th> Angka Kredit </th>
                </tr>
            </thead>
            <tbody>
                <?php
                function findObjectByUkId($id, $arr)
                {
                    if (!(empty($arr))) {
                        foreach ($arr as $element) {
                            if ($id == $element->unsur_kegiatan_id) {
                                return $element;
                            }
                        }
                    }

                    return false;
                }
                $current_u = '';
                $inc_char = 65;
                foreach ($unsur as $k => $u) {
                    if ($u->unsur != $current_u) { ?>
                        <tr>
                            <td><?php echo chr($k + $inc_char) ?></td>
                            <td colspan="6"><?php echo $u->unsur ?></td>
                        </tr>
                    <?php
                        $current_u = $u->unsur;
                    } else {
                        $inc_char--;
                    }

                    $jmlh_sub_kegiatan = 1;
                    $format_unsur_kegiatan = '';
                    foreach ($unsur_kegiatan as $key => $uk) {
                        $val = findObjectByUkId($uk->id, $nilai);
                        $file = '';
                        $nilai_akk = 0;
                        if ($val !== FALSE) {
                            $file = '<a href="' . base_url('uploads/' . $val->file) . '" target="_blank">Lihat File Bukti</a>';
                            $nilai_akk = $val->nilai;
                        } else {
                            $file = 'Tidak ada';
                            $nilai_akk = 0;
                        }
                        if ($u->id == $uk->unsur_id) {
                            $format_unsur_kegiatan .= '
                                <tr>
                                    <td>' . $uk->kode . '. ' . $uk->kegiatan . '</td>
                                    <td>' . $uk->satuan . '</td>
                                    <td>
                                        ' . $file . '
                                    </td>
                                    <td>' . $uk->angka_kredit . '</td>
                                    <td>' . $nilai_akk . '</td>
                                </tr>';
                            $jmlh_sub_kegiatan++;
                        }
                    }
                    $format_sub_unsur = '
                        <tr>
                            <td rowspan="' . $jmlh_sub_kegiatan . '"></td>
                            <td rowspan="' . $jmlh_sub_kegiatan . '">' . ($k + 1) . '</td>
                            <td  style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;">' . $u->sub_unsur . ':</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>                            
                        </tr>';
                    echo $format_sub_unsur;
                    echo $format_unsur_kegiatan;
                    ?>
                <?php } ?>
            </tbody>
        </table>
    </form>
</body>

</html>