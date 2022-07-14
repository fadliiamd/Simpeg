<div class="row">
    <div class="col-lg-12">
        <h3>Data Unsur Kegiatan</h3>

        <!-- Large modal -->
        <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Tambah Data Unsur Kegiatan</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Data Unsur Kegiatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="<?= base_url("pak/unsur_kegiatan/create"); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Unsur</label>
                                <select class="form-control" name="unsur_id" required>
                                    <option value="" selected hidden>--- Pilih Unsur ---</option>
                                    <?php
                                    $option = '';
                                    foreach ($unsur as $key => $value) {
                                        $option .= '<option value="' . $value->id . '">' . $value->unsur . ' ' . $value->sub_unsur . '</option>';
                                    }
                                    echo $option;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="kode">Kode Kegiatan</label>
                                    <input class="form-control" id="kode" name="kode" required>
                                </div>
                                <div class="col-md-9">
                                    <label for="kegiatan">Kegiatan</label>
                                    <input class="form-control" id="kegiatan" name="kegiatan" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="angka_kredit">Angka Kredit</label>
                                    <input type="number" class="form-control" id="angka_kredit" name="angka_kredit" step="any">
                                </div>
                                <div class="col-md-6">
                                    <label for="satuan">Satuan</label>
                                    <input class="form-control" id="satuan" name="satuan" required>
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
            <table id="tbl-data-Unsur" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Unsur ID</th>
                        <th>Kode</th>
                        <th>Kegiatan</th>
                        <th>Angka Kredit</th>
                        <th>Satuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php
                    foreach ($unsur_kegiatan as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value->id ?></td>
                            <td><?php echo $value->unsur_id; ?></td>
                            <td><?php echo $value->kode ?></td>
                            <td><?php echo $value->kegiatan; ?></td>
                            <td><?php echo $value->angka_kredit; ?></td>
                            <td><?php echo $value->satuan; ?></td>
                            <td>
                                <!-- Large modal -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".edittable-<?= $value->id ?>">Edit</button>

                                <!-- Modal -->
                                <div class="modal fade edittable-<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Unsur Kegiatan ID : <b><?php echo "" . $value->id ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("pak/unsur_kegiatan/update/" . $value->id); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="nama">Unsur</label>
                                                        <select class="form-control" name="unsur_id" required>                                                            
                                                            <?php
                                                            $option = '';
                                                            $selected = 'selected';
                                                            foreach ($unsur as $k => $v) {    
                                                                if($value->unsur_id == $v->id){
                                                                    $selected = 'selected';
                                                                }else{
                                                                    $selected = '';
                                                                }
                                                                $option .= '<option value="' . $v->id . '" '.$selected.'>' . $v->unsur . ' ' . $v->sub_unsur . '</option>';
                                                            }
                                                            echo $option;
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <label for="kode">Kode Kegiatan</label>
                                                            <input class="form-control" id="kode" name="kode" value="<?= $value->kode ?>" required>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <label for="kegiatan">Kegiatan</label>
                                                            <input class="form-control" id="kegiatan" name="kegiatan" value="<?= $value->kegiatan ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="angka_kredit">Angka Kredit</label>
                                                            <input type="number" class="form-control" id="angka_kredit" name="angka_kredit" value="<?= $value->angka_kredit ?>" step="any">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="satuan">Satuan</label>
                                                            <input class="form-control" id="satuan" name="satuan" value="<?= $value->satuan ?>" required>
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

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable-<?= $value->id ?>">Hapus</button>

                                <!-- Modal -->
                                <div class="modal fade" id="deletetable-<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Unsur Kegiatan ID : <b><?php echo "" . $value->id ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("pak/unsur_kegiatan/delete/" . $value->id); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus Unsur ini?</p>
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
        $('#tbl-data-Unsur').DataTable();
    });
</script>