<div class="row">
    <div class="col-lg-12">
        <h3>Data Sub Kriteria</h3>

        <!-- Large modal -->
        <div class="d-flex">
            <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Tambah Data Sub Kriteria</button>
            <form class="forms-sample mx-3" action="<?= base_url('perhitungan') ?>" method="GET">
                <button name="jenis_hitung" value="subkriteria" type="submit" class="my-3 btn btn-info">
                    Hitung Prioritas Subkriteria
                </button>
            </form>
        </div>        
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
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Sub Kriteria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="<?= base_url("subkriteria/create"); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama (*)</label>
                                <input class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="kriteria_id">Kriteria (*)</label>
                                <select class="form-control" id="kriteria_id" name="kriteria_id" required>
                                    <option value="" hidden selected>-- Pilih Kriteria --</option>
                                    <?php foreach ($kriteria as $key => $value) { ?>
                                        <option value="<?= $value->id ?>"> <?= $value->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nilai">Nilai (*)</label>
                                <select class="form-control" id="nilai" name="nilai" required>
                                    <option value="" hidden selected>-- Pilih Nilai --</option>
                                    <option value="1">Kurang (1)</option>
                                    <option value="3">Cukup (3)</option>
                                    <option value="5">Baik (5)</option>
                                </select>
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
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Kriteria</th>
                        <th>Nilai</th>
                        <th>Prioritas</th>  
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php
                    foreach ($subkriteria as $key => $value) { ?>
                        <tr>

                            <td><?php echo $no ?></td>
                            <td><?php echo "SC-" . $value->sub_id; ?></td>
                            <td><?php echo $value->sub_nama; ?></td>
                            <td>
                                <?php echo $value->nama_kriteria; ?>
                            </td>                            
                            <td>
                                <?php 
                                switch ($value->nilai) {
                                    case '1':
                                        echo "Kurang";
                                        break;
                                    case '3':
                                        echo "Cukup";
                                        break;
                                    case '5':
                                        echo "Baik";
                                        break;
                                    default:
                                        echo "WAHHH ERROR GUYS";
                                        break;
                                }                               
                                ?>
                            </td>
                            <td>
                                <?php echo $value->nilai_prioritas; ?>
                            </td>
                            <td>
                                <!-- Large modal -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".edittable-<?= $value->sub_id ?>">Edit</button>

                                <!-- Modal -->
                                <div class="modal fade edittable-<?= $value->sub_id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Sub Kriteria ID : <b><?php echo "SC-" . $value->id ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("subkriteria/update"); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="nama">Nama (*)</label>
                                                        <input class="form-control" id="nama" name="nama" value="<?= $value->sub_nama ?>" required>
                                                        <input type="hidden" class="form-control" id="nama" name="id_subkriteria" value="<?= $value->sub_id ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="kriteria_id">Kriteria (*)</label>
                                                        <select class="form-control" id="kriteria_id" name="kriteria_id" required>
                                                            <option value="" hidden selected>-- Pilih Kriteria --</option>
                                                            <?php foreach ($kriteria as $k => $v) { ?>
                                                                <option value="<?= $value->id ?>" <?php if ($value->nama_kriteria === $v->nama)  echo "selected"; ?>> <?= $value->nama ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nilai">Nilai (*)</label>
                                                        <select class="form-control" id="nilai" name="nilai" required>
                                                            <option value="" hidden selected>-- Pilih Nilai --</option>
                                                            <option value="1" <?php if ($value->nilai === "1")  echo "selected"; ?>>Kurang (1)</option>
                                                            <option value="3" <?php if ($value->nilai === "3")  echo "selected"; ?>>Cukup (3)</option>
                                                            <option value="5" <?php if ($value->nilai === "5")  echo "selected"; ?>>Baik (5)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable-<?= $value->sub_id ?>">Hapus</button>

                                <!-- Modal -->
                                <div class="modal fade" id="deletetable-<?= $value->sub_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Sub Kriteria ID : <b><?php echo "SC-" . $value->sub_id ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("subkriteria/delete"); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus subkriteria ini?</p>
                                                    <input type="hidden" id="id_subkriteria" name="sub_id" value="<?= $value->sub_id ?>">
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
    });
</script>