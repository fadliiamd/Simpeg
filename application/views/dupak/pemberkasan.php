<div class="row">
    <div class="col-lg-12">
        <h3>Daftar Usulan PAK</h3>

        <!-- Large modal -->
        <a href="<?= base_url('dupak/pemberkasan/create')?>" class="">
            <button type="button" class="my-3 btn btn-primary">Tambah Daftar Usulan PAK</button>
        </a>
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
        <!-- Modal -->
        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Daftar Usulan PAK</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="<?= base_url("kenaikan_jabatan/create_pengajuan"); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="nama">Pengajuan</label>
                                    <select name="jabatan" class="form-control text-dark" required>
                                        <option value="" selected hidden>---Pilih Daftar Pengajuan---</option>
                                        <?php
                                        $option = '';
                                        foreach ($pengajuan as $p) {
                                            $option .= '<option value="' . $p->id . '">'. '#'. $p->id . ' : '. $p->account_nip . ' Mengajukan Menjadi ' . $p->jabatan_tujuan . '</option>';
                                        }
                                        echo $option;
                                        ?>
                                    </select>
                                </div>
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

        <div class="table-responsive">
            <table id="tbl-data-pegawai" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Usulan</th>
                        <th>NIP Pengusul</th>
                        <th>Tanggal Usulan</th>
                        <th>Hasil Angka Kredit</th>
                        <th>Status</th>
                        <th>Tanggal Validasi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php
                    foreach ($nilai_rekap as $key => $value) { ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $value->id; ?></td>
                            <td><?php echo $value->account_nip; ?></td>
                            <td><?php echo $value->tgl_usulan; ?></td>
                            <td><?= $value->hasil_akk ?></td>
                            <td><?= $value->status ?></td>
                            <td><?= $value->tgl_validasi ?></td>
                            <td>
                                <a target="_blank" href="<?= base_url('uploads/' . $value->bukti_1) ?>">
                                    Lihat <?= $label_bukti_1[$value->jabatan_tujuan] ?>
                                </a>
                            </td>
                            <td>
                                <a target="_blank" href="<?= base_url('uploads/' . $value->bukti_2) ?>">
                                    Lihat <?= $label_bukti_2[$value->jabatan_tujuan] ?>
                                </a>
                            </td>
                            <td>
                                <a target="_blank" href="<?= base_url('uploads/' . $value->bukti_jurnal) ?>">
                                    Lihat Jurnal
                                </a>
                            </td>
                            <td><?= $value->status ?></td>
                            <td>
                                <!-- Large modal -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".edittable-<?= $value->id ?>">Edit</button>

                                <!-- Modal -->
                                <div class="modal fade edittable-<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Daftar Usulan PAK ID : <b><?php echo "J-" . $value->id ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("pengajuan/update"); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="hidden" id="id_pengajuan" name="id_pengajuan" value="<?= $value->id ?>">

                                                        <label for="nama">Nama</label>
                                                        <input class="form-control" id="nama" name="nama" value="<?php echo $value->account_nip ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="submit" class="btn btn-primary">Edit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable-<?= $value->id ?>">Hapus</button>

                                <!-- Modal -->
                                <div class="modal fade" id="deletetable-<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Daftar Usulan PAK ID : <b><?php echo "J-" . $value->id ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("pengajuan/delete"); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus pengajuan ini?</p>
                                                    <input type="hidden" id="id_pengajuan" name="id_pengajuan" value="<?= $value->id ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="submit" class="btn btn-danger">Ya, hapus aja</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                        <input type="file" name="bukti_1" class="form-control" required>
                        </div>
                    <div class="form-group col-md-6">
                        <label for="nama">Bukti SKP/Nilai Prestasi Kerja Selama 1 Tahun</label>
                        <input type="file" name="bukti_2" class="form-control" required>
                    </div>     
                `);
            } else {
                $("#container-file-upload").html(`
                    <div class="form-group col-md-6">
                        <label for="nama">Bukti Pengabdian Kepada Masyarakat</label>
                        <input type="file" name="bukti_1" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama">Bukti Menjabat Asisten Ahli (2 Tahun)</label>
                        <input type="file" name="bukti_2" class="form-control" required>
                    </div>      
                `);
            }
        });
    });
</script>