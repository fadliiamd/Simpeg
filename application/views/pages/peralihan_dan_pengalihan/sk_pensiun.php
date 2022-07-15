<div class="row">
	<div class="col-lg-12">
        <h4>Surat Keputusan Pensiun</h4>

        <!-- <a href="<?= base_url().'assets/pdf/template-surat-pengunduran-diri.pdf'?>" download class="my-3 btn btn-secondary">Surat Keputusan Pensiun</a>     -->

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
            <table class="table table-striped table-bordered table-datatable">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Pegawai</th>
                        <th>Tanggal Pensiun</th>
                        <th>No Surat</th>
                        <th>File Pensiun</th>
                        <?php if($this->session->userdata("role") == "admin"){ ?>  
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        foreach ($sk_pemberhentian as $key => $value) { 
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $value->pegawai_nip ?> - <?= $value->pegawai_nama ?></td>
                        <td><?= $value->tgl_pensiun ?></td>
                        <td><?= $value->nomor_surat ?></td>
                        <td>
                            <?php if($value->file_pensiun != null){ ?>  
                                <a href="<?= base_url().'uploads/'.$value->file_pensiun ?>" download class="btn btn-secondary">Unduh</a>    
                            <?php } ?>
                            <?php if($this->session->userdata("role") == "admin"){ ?>  
                                <!-- Large modal -->
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadtable<?=$i?>">Upload</button>

                                <!-- Modal -->
                                <div class="modal fade" id="uploadtable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Upload File Pensiun No : <b><?= $i; ?><b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("pemberhentian/upload_data_sk"); ?>" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?= $value->id ?>">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="nip">NIP</label>
                                                        <input type="text" class="form-control" id="nip" value="<?= $value->pegawai_nip ?> - <?= $value->alasan ?>" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nomor_surat">Nomor Surat</label>
                                                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="file_pensiun">File Pensiun</label>
                                                        <input type="file" class="form-control-file" id="file_pensiun" name="file_pensiun">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-primary">Upload File Keputusan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            <?php } ?>
                        </td>
                        <?php if($this->session->userdata("role") == "admin"){ ?>  
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable<?=$i?>">
                                Hapus
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="deletetable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form class="forms-sample" action="<?= base_url("pemberhentian/delete_data_sk_pemberhentian"); ?>" method="POST">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Surat Keputusan pemberhentian No : <b><?= $i ?>b></h5>
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
                    <?php $i++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>