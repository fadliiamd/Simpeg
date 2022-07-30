<div class="row">
    <div class="col-lg-12">
        <h3>Data Sertifikat</h3>

        <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Tambah Data Sertifikat</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Data Sertifikat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="<?= base_url("Sertifikat/create"); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="account_nip">Pegawai (*)</label>
                                        <select class="form-control" name="account_nip" required>
                                            <option value="" selected hidden>--- Pilih Pegawai ---</option>
                                            <?php
                                            $format = '';
                                            foreach ($pegawai as $key => $value) {
                                                $format .= '<option value="' . $value->account_nip . '">' . $value->account_nip . ' - ' . $value->nama . '</option>';
                                            }
                                            echo $format;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="nama_serti">Nama Sertifikat (*)</label>
                                        <input type="text" class="form-control" id="nama_serti" name="nama_serti" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="file_sertifikat">File Sertifikat (*)</label>
                                        <input type="file" class="form-control" id="file_sertifikat" name="file_sertifikat" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="id_jenis_sertifikat">Jenis Sertifikat</label>
                                        <select class="form-control" name="id_jenis_sertifikat">
                                            <option value="" selected hidden>--- Pilih Jenis Sertifikat ---</option>
                                            <?php
                                            $format = '';
                                            foreach ($jenis_sertifikat as $key => $value) {
                                                $format .= '<option value="' . $value->id_jenis_sertifikat . '">' . $value->nama_jenis_sertifikat . '</option>';
                                            }
                                            echo $format;
                                            ?>
                                        </select>
                                    </div>
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
            <table id="tbl-data-Sertifikat" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Sertifikat</th>
                        <th>Jenis</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php
                    foreach ($sertifikat as $key => $value) { ?>
                        <tr>

                            <td><?php echo $no ?></td>
                            <td><?php echo $value->account_nip; ?></td>
                            <td>
                                <a href="<?= base_url() . 'uploads/' . $value->nama_serti ?>" target="_blank">
                                    <?php echo $value->nama_serti; ?>
                                </a>
                            </td>
                            <td class="text-capitalize">
                                <?= $value->nama_jenis_sertifikat ?>
                            </td>
                            <td>
                                <!-- Large modal -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".edittable-<?= $key ?>">Edit</button>

                                <!-- Modal -->
                                <div class="modal fade edittable-<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Sertifikat NIP : <b><?php echo $value->account_nip ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("Sertifikat/update"); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <input type="hidden" class="form-control" name="serti_id" value="<?= $value->id ?>">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="account_nip">Pegawai</label>
                                                                <select class="form-control" name="account_nip">
                                                                    <option value="<?= $value->account_nip ?>" selected hidden><?= $value->account_nip ?></option>
                                                                    <?php
                                                                    $format = '';
                                                                    foreach ($pegawai as $k => $v) {
                                                                        $format .= '<option value="' . $v->account_nip . '">' . $v->account_nip . ' - ' . $v->nama . '</option>';
                                                                    }
                                                                    echo $format;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="nama_serti">Nama Sertifikat (*)</label>
                                                                <input type="text" class="form-control" id="nama_serti" name="nama_serti" value="<?= explode("-", $value->nama_serti)[1] ?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="nama">File Sertifikat</label>
                                                                <input type="file" class="form-control" id="nama" name="file_sertifikat" value="">
                                                                <?php if (!is_null($value->nama_serti)) { ?>
                                                                    <a href="<?= base_url() . 'uploads/' . $value->nama_serti ?>" target="_blank">Lihat Sertifikat</a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="id_jenis_sertifikat">Jenis Sertifikat</label>
                                                                <select class="form-control" name="id_jenis_sertifikat">
                                                                    <?php
                                                                    if (!(is_null($value->id_jenis_sertifikat))) { ?>
                                                                        <option value="<?= $value->id_jenis_sertifikat ?>" selected hidden><?= $value->nama_jenis_sertifikat ?></option>
                                                                    <?php
                                                                    } else { ?>
                                                                        <option value="" selected hidden>--- Pilih Jenis Sertifikat ---</option>
                                                                    <?php
                                                                    }
                                                                    $format = '';
                                                                    foreach ($jenis_sertifikat as $k => $v) {
                                                                        $format .= '<option value="' . $v->id_jenis_sertifikat . '">' . $v->nama_jenis_sertifikat . '</option>';
                                                                    }
                                                                    echo $format;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
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

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable-<?= $key ?>">Hapus</button>

                                <!-- Modal -->
                                <div class="modal fade" id="deletetable-<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Sertifikat ID : <b><?php echo "B-" . $value->account_nip ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("Sertifikat/delete"); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus Sertifikat ini?</p>
                                                    <input type="hidden" id="id_Sertifikat" name="serti_id" value="<?= $value->id ?>">
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
        $('#tbl-data-Sertifikat').DataTable();
    });
</script>