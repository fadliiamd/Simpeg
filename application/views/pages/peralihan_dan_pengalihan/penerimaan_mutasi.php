<div class="row">
	<div class="col-lg-12">
        <h4>Penerimaan Mutasi</h4>

        
        <?php if($this->session->userdata("role") == "admin"){ ?>   
            <!-- Large modal -->
            <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Penerimaan Mutasi</button>

            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pengajuan Mutasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="forms-sample" action="<?= base_url("mutasi/create_data_penerimaan"); ?>" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="pegawai_nip">NIP</label>
                                    <select class="custom-select" id="pegawai_nip" name="pegawai_nip">
                                        <?php foreach ($pegawai as $key => $value) { ?>
                                            <option value="<?= $value->account_nip ?>"><?= $value->account_nip ?> - <?= $value->nama ?></option>
                                        <?php } ?>
                                    </select>
                                    <span>Tidak ada pegawai? <a href="<?= base_url("account/data_pegawai"); ?>">Daftarkan pegawai</a> </span> 
                                </div>
                                <div class="form-group">
                                    <label for="daerah_asal">Daerah Asal</label>
                                    <input type="text" class="form-control" id="daerah_asal" name="daerah_asal" placeholder="Daerah Asal">
                                </div>
                                <div class="form-group">
                                    <label for="instansi_asal">Instansi Asal</label>
                                    <input type="text" class="form-control" id="instansi_asal" name="instansi_asal" placeholder="Instansi Asal">
                                </div>
                                <div class="form-group">
                                    <label for="alasan">Alasan</label>
                                    <textarea class="form-control" id="alasan" rows="4" name="alasan"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="bagian_id">Bagian</label>
                                    <select class="form-control" id="bagian_id" name="bagian_id">
                                        <?php foreach ($bagian as $key => $value) {
                                            $banyak = 0;
                                            if ($value->id == 1) $banyak = $b_akademik;
                                            if ($value->id == 2) $banyak = $b_umum;
                                            if ($value->id == 3) $banyak = $b_keuangan;
                                            if ($value->id == 4) $banyak = $b_kepegawaian; ?>
                                            <option value="<?= $value->id ?>"><?=$banyak?>/<?= $value->jmlh_maksimal ?> - <?= $value->nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Tambah Penerimaan Mutasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal -->
        <?php } ?>

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
            <table class="table text-center table-striped table-bordered table-datatable">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Pegawai</th>
                        <th>Instantsi Asal</th>
                        <th>Daerah Asal</th>
                        <th>Alasan</th>
                        <th>Bagian</th>
                        <th>Status</th>
                        <th>Nama Direktur</th>
                        <?php if($this->session->userdata("role") == "admin"){ ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        foreach ($penerimaan_mutasi as $key => $value) { 
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value->pegawai_nip ?> - <?= $value->pegawai_nama ?></td>
                            <td><?= $value->instansi_asal ?></td>
                            <td><?= $value->daerah_asal ?></td>
                            <td><?= $value->alasan ?></td>
                            <td><?= $value->bagian_id ?> - <?= $value->bagian_nama ?></td>
                            <td>
                                <?php if($value->status_persetujuan == "pending") {?>
                                    <span class="badge badge-warning"><?= $value->status_persetujuan; ?></span>
                                    <?php if($this->session->userdata("role") == "direktur"){ ?>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetable<?=$i?>">
                                                Setujui
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="approvetable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="forms-sample" action="<?= base_url("mutasi/status_penerimaan"); ?>" method="POST">
                                                            <div class="modal-header">
                                                                <input type="hidden" name="id" value="<?= $value->id ?>">
                                                                <input type="hidden" name="penerimaan_id" value="<?= $value->id ?>">
                                                                <input type="hidden" name="direktur_nip" value="<?= $value->direktur_nip ?>">
                                                                <input type="hidden" name="jenis_mutasi" value="Mutasi Masuk">
                                                                <input type="hidden" name="status" value="setujui">
                                                                <input type="hidden" name="pegawai_nip" value="<?= $value->pegawai_nip ?>">
                                                                <h5 class="modal-title" id="exampleModalLabel">Setujui Pengajuan Mutasi Id : <b><?= $value->id ?></b> </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Setujui Mutasi</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noapprovetable<?=$i?>">
                                                Tolak
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="noapprovetable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="forms-sample" action="<?= base_url("pemberhentian/status_berkas"); ?>" method="POST">
                                                            <div class="modal-header">
                                                            <input type="hidden" name="id" value="<?= $value->id ?>">
                                                            <input type="hidden" name="status" value="tolak">
                                                            <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan Mutasi Id : <b><?= $value->id ?></b> </h5>
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
                                        <?php }; ?>
                                <?php } else { ?>
                                    <?php if($value->status_persetujuan == "setujui") {?>
                                        <span class="badge badge-success"><?= $value->status_persetujuan; ?></span>
                                    <?php }; ?>
                                    <?php if($value->status_persetujuan == "tolak") {?>
                                        <span class="badge badge-danger"><?= $value->status_persetujuan; ?></span>
                                    <?php }; ?>
                                <?php }; ?>
                            </td>
                            <td><?= $value->direktur_nip ?> - <?= $value->direktur_nama ?></td>
                            <?php if($this->session->userdata("role") == "admin"){ ?>   
                                <td>
                                    <!-- Large modal -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="edittable<?=$i?>">Edit</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="edittable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Penerimaan Mutasi No : <b><?= $i ?><b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="forms-sample" action="<?= base_url("mutasi/update_data_penerimaan"); ?>" method="POST">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="<?= $value->id ?>">
                                                        <div class="form-group">
                                                            <label for="daerah_asal">Daerah Asal</label>
                                                            <input type="text" class="form-control" id="daerah_asal" name="daerah_asal" value="<?= $value->daerah_asal ?>"  required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="instansi_asal">Instansi Asal</label>
                                                            <input type="text" class="form-control" id="instansi_asal" name="instansi_asal" value="<?= $value->instansi_asal ?>"  required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="alasan">Alasan</label>
                                                            <textarea class="form-control" id="alasan" rows="4" name="alasan" required><?= $value->alasan ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-primary">Edit Penerimaan Mutasi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable<?=$i?>">
                                    Hapus
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deletetable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form class="forms-sample" action="<?= base_url("mutasi/delete_data_penerimaan"); ?>" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Penerimaan Mutasi No : <b><?= $i ?></b> </h5>
                                                        <input type="hidden" name="id" value="<?= $value->id ?>">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Hapus Berkas</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            <?php } ?>

                        </tr>

                    <?php } ?>
                </tbody>                
            </table>
        </div>
    </div>
</div>