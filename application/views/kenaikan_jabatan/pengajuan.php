<div class="row">
    <div class="col-lg-12">
        <h3>Data Pengajuan Kenaikan Jabatan</h3>

        <!-- Large modal -->
        <?php if ($_SESSION['role'] !== 'direktur') { ?>
            <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Tambah Data Pengajuan Kenaikan Jabatan</button>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Data Pengajuan Kenaikan Jabatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="forms-sample" action="<?= base_url("kenaikan_jabatan/create_pengajuan"); ?>" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="accpunt_nip">Pegawai</label>
                                        <select name="account_nip" class="form-control text-dark" <?php echo $_SESSION['role'] === 'pegawai' ? "disabled" : ""; ?>>
                                            <option value="" selected hidden>---Pilih Pegawai---</option>
                                            <?php
                                            $option = '';
                                            foreach ($pegawai as $p) {
                                                if ($_SESSION["nip"] === $p->account_nip) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                                $option .= '<option value="' . $p->account_nip . '" ' . $selected . '>' . $p->account_nip . ' - ' . $p->nama . '</option>';
                                            }
                                            echo $option;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama">Jabatan</label>
                                        <select name="jabatan" class="form-control text-dark">
                                            <option value="" selected hidden>---Pilih Jabatan Yang Dituju---</option>
                                            <option value="asisten ahli">Asisten Ahli</option>
                                            <option value="lektor">Lektor</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="container-file-upload" class="row">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal -->
        <?php
        } ?>
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

        <div class="table-responsive">
            <table id="tbl-data-pegawai" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Tanggal Pengajuan</th>
                        <th>NIP</th>
                        <th>Jabatan Tujuan</th>
                        <th>Bukti 1</th>
                        <th>Bukti 2</th>                        
                        <th>AK Tujuan</th>
                        <th>AK</th>
                        <th>Sisa AK</th>
                        <th>Status</th>
                        <?php
                        $bagian = $this->pegawai_model->get_one_with_join(array(
                            'account_nip' => $this->session->userdata('nip')
                        ));
                        if (!is_null($bagian)) {
                            $bagian = $bagian->nama_bagian;
                        }
                        ?>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php
                    $label_bukti_1 = [
                        'asisten ahli' => 'Ijazah Magister',
                        'lektor' => 'Bukti PKM'
                    ];
                    $label_bukti_2 = [
                        'asisten ahli' => 'Bukti SKP',
                        'lektor' => 'Bukti Asisten Ahli'
                    ];
                    $label_badge = [
                        "pending" => "badge-secondary",
                        "ditolak" => "badge-danger",
                        "disetujui berkas" => "badge-success",
                        "disetujui" => "badge-success"
                    ];
                    $angka_kredit_tujuan = [
                        "asisten ahli" => 150,
                        "lektor" => 200
                    ];
                    foreach ($pengajuan as $key => $value) { ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $value->id; ?></td>
                            <td><?php echo $value->created_at; ?></td>
                            <td><?php echo $value->account_nip; ?></td>
                            <td>
                                <?= $value->jabatan_tujuan ?>
                            </td>
                            <td>
                                <a target="_blank" href="<?= !is_null($value->bukti_1) ? base_url('uploads/' . $value->bukti_1) : '#' ?>">
                                    <?= !is_null($value->bukti_1) ? "Lihat " . $label_bukti_1[$value->jabatan_tujuan] : "-" ?>
                                </a>
                            </td>
                            <td>
                                <a target="_blank" href="<?= !is_null($value->bukti_2) ? base_url('uploads/' . $value->bukti_2) : '#' ?>">
                                    <?= !is_null($value->bukti_2) ? "Lihat " . $label_bukti_2[$value->jabatan_tujuan] : "-" ?>
                                </a>
                            </td>
                            <td><?= $angka_kredit_tujuan[$value->jabatan_tujuan] ?></td>
                            <td>
                                <?php
                                $this->load->model("rekap_nilai_model");
                                $last_akk = $this->rekap_nilai_model->get_akk_terakhir([
                                    "account_nip"=> $value->account_nip,
                                    "tgl_usulan <=" => $value->created_at,
                                    "status" => 'disetujui'
                                ]);
                                if(is_null($last_akk)){
                                    $last_akk = 0;                                    
                                }
                                echo $last_akk;
                                ?>
                            </td>
                            <td>
                            <?php 
                                $sisa = $angka_kredit_tujuan[$value->jabatan_tujuan] - $last_akk;
                                if($sisa<=0){
                                    echo 0;
                                }else{
                                    echo $sisa;
                                }
                            ?>
                             </td>
                            <td>
                                <span class="badge <?= $label_badge[$value->status] ?>">
                                    <?= $value->status ?>
                                </span>
                                <?php
                                if (($value->status === 'pending') and !is_null($bagian)) {
                                    if ((strtolower($bagian) === 'kepegawaian') and ($value->account_nip !== $this->session->userdata('nip'))) { ?>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetable<?= $value->account_nip ?>">
                                                Setujui Berkas
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="approvetable<?= $value->account_nip ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="forms-sample" action="<?= base_url("kenaikan_jabatan/status_aju/" . $value->id); ?>" method="POST">
                                                            <div class="modal-header">
                                                                <input type="hidden" name="status" value="disetujui berkas">
                                                                <h5 class="modal-title" id="exampleModalLabel">Setujui Berkas NIP : <b><?= $value->account_nip ?></b> </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Setujui Berkas</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noapprovetable<?= $value->account_nip ?>">
                                                Tolak
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="noapprovetable<?= $value->account_nip ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="forms-sample" action="<?= base_url("kenaikan_jabatan/status_aju/" . $value->id); ?>" method="POST">
                                                            <div class="modal-header">
                                                                <input type="hidden" name="status" value="ditolak">
                                                                <h5 class="modal-title" id="exampleModalLabel">Tolak Berkas NIP : <b><?= $value->account_nip ?></b> </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Tolak Mutasi</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                } else if ($value->status === 'disetujui berkas' and $this->session->userdata('role') === 'direktur') { ?>
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetable<?= $value->account_nip ?>">
                                            Setujui
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="approvetable<?= $value->account_nip ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" action="<?= base_url("kenaikan_jabatan/status_aju/" . $value->id); ?>" method="POST">
                                                        <div class="modal-header">
                                                            <input type="hidden" name="status" value="disetujui">
                                                            <h5 class="modal-title" id="exampleModalLabel">Setujui Pengajuan NIP : <b><?= $value->account_nip ?></b> </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Setujui Kenaikan Jabatan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noapprovetable<?= $value->account_nip ?>">
                                            Tolak
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="noapprovetable<?= $value->account_nip ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" action="<?= base_url("kenaikan_jabatan/status_aju/" . $value->id); ?>" method="POST">
                                                        <div class="modal-header">
                                                            <input type="hidden" name="status" value="ditolak">
                                                            <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan NIP : <b><?= $value->account_nip ?></b> </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Tolak Mutasi</button>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php } ?>
                            </td>                            
                            <td>
                                <!-- Large modal -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edittable<?= $value->id ?>">Edit</button>

                                <!-- Modal -->
                                <div class="modal fade" id="edittable<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Berkas Pengajuan NIP : <b><?= $value->account_nip ?><b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("kenaikan_jabatan/update_berkas/" . $value->id); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <label for="bukti_1">Bukti <?= $label_bukti_1[$value->jabatan_tujuan] ?></label>
                                                            <input type="file" class="form-control-file" id="bukti_1" name="bukti_1">
                                                            <?= !is_null($value->bukti_1) ? '<a target="_blank" href="' . base_url('uploads/' . $value->bukti_1) . '">Lihat ' . $label_bukti_1[$value->jabatan_tujuan] . '</a>' : "" ?>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="bukti_2">Bukti <?= !is_null($value->bukti_2) ? "Lihat " . $label_bukti_2[$value->jabatan_tujuan] : "-" ?></label>
                                                            <input type="file" class="form-control-file" id="bukti_2" name="bukti_2">
                                                            <?= !is_null($value->bukti_2) ? '<a target="_blank" href="' . base_url('uploads/' . $value->bukti_2) . '">Lihat ' . $label_bukti_2[$value->jabatan_tujuan] . '</a>' : "-" ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-primary">Edit Berkas Pengajuan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </td>
                        </tr>
                    <?php $no++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tbl-data-pegawai').DataTable();
        $('select[name="jabatan"]').on('change', function() {
            if (this.value == 'asisten ahli') {
                $("#container-file-upload").html(`
                    <div class="form-group col-md-6">
                        <label for="nama">Ijazah Magister</label>
                        <input type="file" name="bukti_1" class="form-control">
                        </div>
                    <div class="form-group col-md-6">
                        <label for="nama">Bukti SKP/Nilai Prestasi Kerja Selama 1 Tahun</label>
                        <input type="file" name="bukti_2" class="form-control">
                    </div>     
                `);
            } else {
                $("#container-file-upload").html(`
                    <div class="form-group col-md-6">
                        <label for="nama">Bukti Pengabdian Kepada Masyarakat</label>
                        <input type="file" name="bukti_1" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama">Bukti Menjabat Asisten Ahli (2 Tahun)</label>
                        <input type="file" name="bukti_2" class="form-control">
                    </div>      
                `);
            }
        });
    });
</script>