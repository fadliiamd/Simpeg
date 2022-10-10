<div class="row">
    <div class="col-lg-12">
        <h4>Pengajuan Pemberhentian</h4>                

        <!-- Large modal -->
        <?php 
        date_default_timezone_set('Asia/Jakarta');
        $time = new DateTime('now');
        $newtime = $time->modify('-20 year')->format('Y-m-d H:i:s');        
        foreach ($users as $key => $value) { ?>
            <?php if (
            (($this->session->userdata("role") == "pegawai" && !$pemberhentian)
            && 
            ($value->status != "PNS") )|| ($value->status == "PNS" && $value->tgl_menjabat <= $newtime)){ ?>
                <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Pemberhentian</button>
            <?php }?>            
        <?php } ?>
                
        <?php if  ($this->session->userdata("role") == "admin"){ ?>
            <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Pemberhentian</button>
        <?php } ?>

        <a href="<?= base_url().'assets/pdf/pengunduran_diri.docx'?>" download class="my-3 btn btn-secondary">Surat Pengunduran Diri</a>    

        <a href="<?= base_url().'assets/pdf/pensiun_dini.docx'?>" download class="my-3 btn btn-secondary">Surat Pensiun Dini</a>    

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengajuan Pemberhentian NIP : <b><?= $this->session->userdata("nip") ?></b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>                    
                    <form class="forms-sample" action="<?= base_url("pemberhentian/create_data_pemberhentian"); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <?php if  ($this->session->userdata("role") == "admin"){ ?>
                                <div class="form-group">
                                    <label for="jenis_berhenti">Jenis Berhenti</label>
                                    <select class="form-control" id="jenis_berhenti" name="jenis_berhenti">
                                        <option value="Pengunduran diri">Pengunduran diri</option>
                                        <option value="Pensiun dini">Pensiun dini</option>
                                        <option value="Pensiun batas usia">Pensiun batas usia</option>
                                    </select>
                                </div>
                            <?php } else { ?>
                                <?php if($value->status == "PNS" && $value->tgl_menjabat <= $newtime) { ?>
                                        <input type="hidden" name="jenis_berhenti" value="Pensiun dini">
                                    <?php } else { ?>
                                        <input type="hidden" name="jenis_berhenti" value="Pengunduran diri">
                                <?php } ?>
                            <?php } ?>
                            <div class="form-group">
                                <?php if ($this->session->userdata("role") == "pegawai") { ?>
                                    <input type="hidden" name="pegawai_nip" value="<?= $this->session->userdata("nip") ?>">
                                <?php } else { ?>
                                    <div id="pegawaiPNSNonDini">
                                        <label for="pegawai_nip_pns_non_dini">Pegawai</label>
                                        <select class="form-control" id="pegawai_nip_pns_non_dini" name="pegawai_nip">
                                            <?php foreach ($pegawaiPNSNonDini as $key => $value) { ?>
                                                <option value="<?= $value->account_nip ?> - <?= $value->email ?>"><?= $value->account_nip ?> - <?= $value->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div id="pegawaiPNSDini">
                                        <label for="pegawai_nip_pns_dini">Pegawai</label>
                                        <select class="form-control" id="pegawai_nip_pns_dini" name="pegawai_nip">
                                            <?php foreach ($pegawaiPNSDini as $key => $value) { ?>
                                                <option value="<?= $value->account_nip ?> - <?= $value->email ?>"><?= $value->account_nip ?> - <?= $value->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div id="pegawaiNonPNS">
                                        <label for="pegawai_nip_non_pns">Pegawai</label>
                                        <select class="form-control" id="pegawai_nip_non_pns" name="pegawai_nip">
                                            <?php foreach ($pegawaiNonPNS as $key => $value) { ?>
                                                <option value="<?= $value->account_nip ?> - <?= $value->email ?>"><?= $value->account_nip ?> - <?= $value->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="alasan">Alasan</label>
                                <textarea class="form-control" id="alasan" rows="4" name="alasan"></textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-1">
                                    <label for="mpp">MPP</label>
                                </div>
                                <div class="col-lg-11">
                                    <div class="mx-3">
                                        <input class="form-check-input" type="radio" name="mpp" id="exampleRadios1" value="Ya" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="mx-3">
                                        <input class="form-check-input" type="radio" name="mpp" id="exampleRadios2" value="Tidak">
                                        <label class="form-check-label" for="exampleRadios2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="surat_pengunduran_diri">Surat Pengajuan</label>
                                <input type="file" class="form-control" id="surat_pengunduran_diri" name="surat_pengunduran_diri">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Tambah Pengajuan Pemberhentian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal -->

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
                <thead>
                    <tr class="thead-dark">
                        <th>No</th>
                        <th>Pegawai</th>
                        <th>Jenis Berhenti</th>
                        <th>Alasan</th>
                        <th>Persetujuan 1</th>
                        <th>Persetujuan 2</th>
                        <th>Persetujuan 3</th>
                        <th>Status Pengajuan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Tanggal Persetujuan</th>
                        <th>MPP</th>
                        <th>Tunjangan</th>
                        <th>Surat Pengajuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    foreach ($pemberhentian as $key => $value) {  ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value->pegawai_nip ?> - <?= $value->nama ?></td>  
                            <td><?= $value->jenis_berhenti ?></td>
                            <td><?= $value->alasan ?></td>
                            <td>
                                <?php if ($value->jenis_berhenti != "Pensiun batas usia") { ?>
                                        <?php if($value->persetujuan_1 == "pending") {?>
                                            <span class="badge badge-warning"><?= $value->persetujuan_1; ?></span>
                                                <?php if (isset($this->session->userdata("user")->jabatan_id)){
                                                    if(
                                                    ($this->session->userdata("user")->jabatan_id == 12 
                                                    && $value->jenis_jabatan == "fungsional" 
                                                    && $this->session->userdata("user")->jurusan_id == $value->jurusan_id) 
                                                    || 
                                                    ($this->session->userdata("nama_jabatan") == "Kepala Bagian Umum" 
                                                    && $value->jenis_jabatan == "struktural")){ ?>
                                                    <div class="mt-3">
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetablepersetujuan1_<?=$i?>">
                                                            Setujui
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="approvetablepersetujuan1_<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <form class="forms-sample" action="<?= base_url("pemberhentian/status_pemberhentian_1"); ?>" method="POST">
                                                                        <div class="modal-header">
                                                                            <input type="hidden" name="id" value="<?= $value->id_pemberhentian ?>">
                                                                            <input type="hidden" name="pegawai_nip" value="<?= $value->pegawai_nip ?>">
                                                                            <input type="hidden" name="status" value="setujui">
                                                                            <input type="hidden" name="email" value="<?= $value->email ?>">
                                                                            <input type="hidden" name="jenis_berhenti" value="<?= $value->jenis_berhenti ?>">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Setujui Pengajuan Pemberhentian NIP : <b><?= $value->pegawai_nip ?></b> </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-success">Setujui Pemberhentian</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noapprovetablepersetujuan1_<?=$i?>">
                                                            Tolak
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="noapprovetablepersetujuan1_<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <form class="forms-sample" action="<?= base_url("pemberhentian/status_pemberhentian_1"); ?>" method="POST">
                                                                        <div class="modal-header">
                                                                        <input type="hidden" name="id" value="<?= $value->id_pemberhentian ?>">
                                                                        <input type="hidden" name="status" value="tolak">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan Pemberhentian NIP : <b><?= $value->pegawai_nip ?></b> </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="alasan">Alasan</label>
                                                                            <textarea class="form-control" id="alasan" rows="4" name="alasan_tolak" required></textarea>
                                                                        </div>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-danger">Tolak Pemberhentian</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                <?php }}; 
                                        } else { ?>
                                        <?php if($value->persetujuan_1 == "setujui") {?>
                                            <span class="badge badge-success"><?= $value->persetujuan_1; ?></span>
                                        <?php }; ?>
                                        <?php if($value->persetujuan_1 == "tolak") {?>
                                            <span class="badge badge-danger"><?= $value->persetujuan_1; ?></span>
                                        <?php }; ?>
                                    <?php }; ?>
                                <?php }else{ ?>
                                    -
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($value->jenis_berhenti != "Pensiun batas usia") { ?>
                                    <?php if($value->persetujuan_2 == "pending") {?>
                                        <span class="badge badge-warning"><?= $value->persetujuan_2; ?></span>
                                        <?php if(($this->session->userdata("nama_jabatan") == "Wakil Direktur I" && $value->jenis_jabatan == "fungsional") || ($this->session->userdata("nama_jabatan") == "Wakil Direktur II" && $value->jenis_jabatan == "struktural") && $value->persetujuan_1 == "setujui"){ ?>
                                            <div class="mt-3">
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetablepersetujuan2_<?=$i?>">
                                                    Setujui
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="approvetablepersetujuan2_<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form class="forms-sample" action="<?= base_url("pemberhentian/status_pemberhentian_2"); ?>" method="POST">
                                                                <div class="modal-header">
                                                                    <input type="hidden" name="id" value="<?= $value->id_pemberhentian ?>">
                                                                    <input type="hidden" name="pegawai_nip" value="<?= $value->pegawai_nip ?>">
                                                                    <input type="hidden" name="status" value="setujui">
                                                                    <input type="hidden" name="email" value="<?= $value->email ?>">
                                                                    <input type="hidden" name="jenis_berhenti" value="<?= $value->jenis_berhenti ?>">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Setujui Pengajuan Pemberhentian NIP : <b><?= $value->pegawai_nip ?></b> </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-success">Setujui Pemberhentian</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noapprovetablepersetujuan2_<?=$i?>">
                                                    Tolak
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="noapprovetablepersetujuan2_<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form class="forms-sample" action="<?= base_url("pemberhentian/status_pemberhentian_2"); ?>" method="POST">
                                                                <div class="modal-header">
                                                                <input type="hidden" name="id" value="<?= $value->id_pemberhentian ?>">
                                                                <input type="hidden" name="status" value="tolak">
                                                                <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan Pemberhentian NIP : <b><?= $value->pegawai_nip ?></b> </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="alasan">Alasan</label>
                                                                    <textarea class="form-control" id="alasan" rows="4" name="alasan_tolak" required></textarea>
                                                                </div>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Tolak Pemberhentian</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <?php }; ?>
                                    <?php } else { ?>
                                        <?php if($value->persetujuan_2 == "setujui") {?>
                                            <span class="badge badge-success"><?= $value->persetujuan_2; ?></span>
                                        <?php }; ?>
                                        <?php if($value->persetujuan_2 == "tolak") {?>
                                            <span class="badge badge-danger"><?= $value->persetujuan_2; ?></span>
                                        <?php }; ?>
                                    <?php }; ?>
                                <?php }else{ ?>
                                    -
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($value->jenis_berhenti != "Pensiun batas usia") { ?>
                                    <?php if($value->persetujuan_3 == "pending") {?>
                                        <span class="badge badge-warning"><?= $value->persetujuan_3; ?></span>
                                        <?php if($this->session->userdata("role") == "admin" && $value->persetujuan_1 == "setujui" && $value->persetujuan_2 == "setujui"){ ?>
                                            <div class="mt-3">
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetablepersetujuan3_<?=$i?>">
                                                    Setujui
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="approvetablepersetujuan3_<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form class="forms-sample" action="<?= base_url("pemberhentian/status_pemberhentian_3"); ?>" method="POST">
                                                                <div class="modal-header">
                                                                    <input type="hidden" name="id" value="<?= $value->id_pemberhentian ?>">
                                                                    <input type="hidden" name="pegawai_nip" value="<?= $value->pegawai_nip ?>">
                                                                    <input type="hidden" name="status" value="setujui">
                                                                    <input type="hidden" name="email" value="<?= $value->email ?>">
                                                                    <input type="hidden" name="jenis_berhenti" value="<?= $value->jenis_berhenti ?>">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Setujui Pengajuan Pemberhentian NIP : <b><?= $value->pegawai_nip ?></b> </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-success">Setujui Pemberhentian</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noapprovetablepersetujuan3_<?=$i?>">
                                                    Tolak
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="noapprovetablepersetujuan3_<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form class="forms-sample" action="<?= base_url("pemberhentian/status_pemberhentian_3"); ?>" method="POST">
                                                                <div class="modal-header">
                                                                <input type="hidden" name="id" value="<?= $value->id_pemberhentian ?>">
                                                                <input type="hidden" name="status" value="tolak">
                                                                <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan Pemberhentian NIP : <b><?= $value->pegawai_nip ?></b> </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="alasan">Alasan</label>
                                                                    <textarea class="form-control" id="alasan" rows="4" name="alasan_tolak" required></textarea>
                                                                </div>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Tolak Pemberhentian</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <?php }; ?>
                                    <?php } else { ?>
                                        <?php if($value->persetujuan_3 == "setujui") {?>
                                            <span class="badge badge-success"><?= $value->persetujuan_3; ?></span>
                                        <?php }; ?>
                                        <?php if($value->persetujuan_3 == "tolak") {?>
                                            <span class="badge badge-danger"><?= $value->persetujuan_3; ?></span>
                                        <?php }; ?>
                                    <?php }; ?>
                                <?php }else{ ?>
                                -
                                <?php } ?>
                            </td>
                            <td>
                                <?php if($value->status_pengajuan == "pending") {?>
                                    <span class="badge badge-warning"><?= $value->status_pengajuan; ?></span>
                                    <?php if(($value->jenis_berhenti == "Pensiun batas usia" && $this->session->userdata("nama_jabatan") == "Direktur Utama")||($this->session->userdata("nama_jabatan") == "Direktur Utama" && $value->persetujuan_1 == "setujui" && $value->persetujuan_2 == "setujui" && $value->persetujuan_3 == "setujui")){ ?>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetable<?=$i?>">
                                                Setujui
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="approvetable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="forms-sample" action="<?= base_url("pemberhentian/status_pemberhentian"); ?>" method="POST">
                                                            <div class="modal-header">
                                                                <input type="hidden" name="id" value="<?= $value->id_pemberhentian ?>">
                                                                <input type="hidden" name="pegawai_nip" value="<?= $value->pegawai_nip ?>">
                                                                <input type="hidden" name="status" value="setujui">
                                                                <input type="hidden" name="email" value="<?= $value->email ?>">
                                                                <input type="hidden" name="jenis_berhenti" value="<?= $value->jenis_berhenti ?>">
                                                                <h5 class="modal-title" id="exampleModalLabel">Setujui Pengajuan Pemberhentian NIP : <b><?= $value->pegawai_nip ?></b> </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Setujui Pemberhentian</button>
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
                                                        <form class="forms-sample" action="<?= base_url("pemberhentian/status_pemberhentian"); ?>" method="POST">
                                                            <div class="modal-header">
                                                            <input type="hidden" name="id" value="<?= $value->id_pemberhentian ?>">
                                                            <input type="hidden" name="status" value="tolak">
                                                            <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan Pemberhentian NIP : <b><?= $value->pegawai_nip ?></b> </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="alasan">Alasan</label>
                                                                <textarea class="form-control" id="alasan" rows="4" name="alasan_tolak" required></textarea>
                                                            </div>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Tolak Pemberhentian</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <?php }; ?>
                                <?php } else { ?>
                                    <?php if($value->status_pengajuan == "setujui") {?>
                                        <span class="badge badge-success"><?= $value->status_pengajuan; ?></span>
                                    <?php }; ?>
                                    <?php if($value->status_pengajuan == "tolak") {?>
                                        <span class="badge badge-danger"><?= $value->status_pengajuan; ?></span>
                                        <p class="mt-3"><?= $value->alasan_tolak ?></p>
                                    <?php }; ?>
                                <?php }; ?>
                            </td>
                            <td><?= $value->tgl_pengajuan ?></td>
                            <td><?= ($value->tgl_persetujuan == null) ? "-" : $value->tgl_persetujuan ; ?></td>
                            <td><?= $value->mpp ?></td>
                            <td><?= $value->tunjangan ?></td>
                            <td>
                                <?php if ($value->jenis_berhenti == "Pengunduran diri") {?>
                                    <form action="<?= base_url("pemberhentian/surat_pengajuan_pemberhentian"); ?>" method="POST">                            
                                        <input type="hidden" name="nip" value="<?= $value->pegawai_nip ?>">
                                        <input type="hidden" name="nama" value="<?= $value->nama ?>">
                                        <input type="hidden" name="ttl" value="<?= $value->tempat_lahir ?>, <?= $value->tgl_lahir ?>">
                                        <input type="hidden" name="jabatan" value="<?= $value->nama_jabatan ?>">
                                        <input type="hidden" name="alamat" value="<?= $value->alamat ?>">
                                        <input type="hidden" name="alasan" value="<?= $value->alasan ?>">
                                        <button type="submit" class="btn btn-secondary">Unduh</button>
                                    </form>
                                <?php } elseif ($value->jenis_berhenti == "Pensiun dini") { ?>
                                    <form action="<?= base_url("pemberhentian/surat_pengajuan_pensiun_dini"); ?>" method="POST">                            
                                        <input type="hidden" name="nip" value="<?= $value->pegawai_nip ?>">
                                        <input type="hidden" name="nama" value="<?= $value->nama ?>">
                                        <input type="hidden" name="ttl" value="<?= $value->tempat_lahir ?>, <?= $value->tgl_lahir ?>">
                                        <input type="hidden" name="pangkat" value="<?= $value->pangkat ?>">
                                        <input type="hidden" name="masa" value="<?= $value->tgl_menjabat ?>">
                                        <input type="hidden" name="jabatan" value="<?= $value->nama_jabatan ?>">
                                        <input type="hidden" name="alamat" value="<?= $value->alamat ?>">
                                        <button type="submit" class="btn btn-secondary">Unduh</button>
                                    </form>
                                <?php } else { ?>
                                    <form action="<?= base_url("pemberhentian/surat_pengajuan_pensiun_batas_usia"); ?>" method="POST">                            
                                        <input type="hidden" name="nip" value="<?= $value->pegawai_nip ?>">
                                        <input type="hidden" name="nama" value="<?= $value->nama ?>">
                                        <input type="hidden" name="pangkat" value="<?= $value->pangkat ?>">
                                        <input type="hidden" name="jabatan" value="<?= $value->nama_jabatan ?>">
                                        <button type="submit" class="btn btn-secondary">Unduh</button>
                                    </form>
                                <?php } ?>
                            </td>
                            <td>
                                <!-- Large modal -->
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edittable<?=$i?>">Edit</button>
                                <!-- Modal -->
                                <div class="modal fade" id="edittable<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Pengajuan Pemberhentian No : <b><?= $i ?><b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample" action="<?= base_url("pemberhentian/update_data_pemberhentian"); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" value="<?= $value->id ?>">
                                                        <label for="jenis_berhenti">Jenis Berhenti</label>
                                                        <select class="form-control" id="jenis_berhenti" name="jenis_berhenti">
                                                            <option <?= ($value->jenis_berhenti == "Pengunduran diri ") ? "selected" : "" ?> value="Pengunduran diri">Pengunduran diri</option>
                                                            <option <?= ($value->jenis_berhenti == "Pensiun") ? "selected" : "" ?> value="Pensiun">Pensiun</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alasan">Alasan</label>
                                                        <textarea class="form-control" id="alasan" rows="4" name="alasan"><?= $value->alasan ?></textarea>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-1">
                                                            <label for="mpp">MPP</label>
                                                        </div>
                                                        <div class="col-lg-11">
                                                            <div class="mx-3">
                                                                <input class="form-check-input" type="radio" name="mpp" id="exampleRadios1" value="Ya" <?= ($value->mpp == "Ya") ? "selected" : "" ?>>
                                                                <label class="form-check-label" for="exampleRadios1">
                                                                    Ya
                                                                </label>
                                                            </div>
                                                            <div class="mx-3">
                                                                <input class="form-check-input" type="radio" name="mpp" id="exampleRadios2" value="Tidak" <?= ($value->mpp == "Tidak") ? "selected" : "" ?>>
                                                                <label class="form-check-label" for="exampleRadios2">
                                                                    Tidak
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-primary">Edit Pengajuan Pemberhentian</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable<?= $value->id ?>">
                                    Hapus
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="deletetable<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form class="forms-sample" action="<?= base_url("pemberhentian/delete_data_pemberhentian"); ?>" method="POST">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus pemberhentian No : <b><?= $i ?></b> </h5>
                                                    <input type="hidden" name="id" value="<?= $value->id ?>">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Hapus Pemberhentian</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php $i++; } ?>
                </tbody>           
            </table>
        </div>
    </div>
</div>

<script>
    $( '#pegawaiPNSDini').hide();
    $( '#pegawaiPNSNonDini').hide();
    $( "#jenis_berhenti" ).change(function(){
        if ($( "#jenis_berhenti" ).val() == "Pengunduran diri") {
            $( '#pegawaiNonPNS').show();
            $( "#pegawai_nip_non_pns").prop('disabled', false);
            $( '#pegawaiPNSDini').hide();
            $( "#pegawai_nip_pns_dini").prop('disabled', true);
            $( '#pegawaiPNSNonDini').hide();
            $( "#pegawai_nip_pns_non_dini").prop('disabled', true);
        }else if($( "#jenis_berhenti" ).val() == "Pensiun dini"){
            $( '#pegawaiNonPNS').hide();
            $( "#pegawai_nip_non_pns").prop('disabled', true);
            $( '#pegawaiPNSDini').show();
            $( "#pegawai_nip_pns_dini").prop('disabled', false);
            $( '#pegawaiPNSNonDini').hide();
            $( "#pegawai_nip_pns_non_dini").prop('disabled', true);
        }else{
            $( '#pegawaiNonPNS').hide();
            $( "#pegawai_nip_non_pns").prop('disabled', true);
            $( '#pegawaiPNSDini').hide();
            $( "#pegawai_nip_pns_dini").prop('disabled', true);
            $( '#pegawaiPNSNonDini').show();
            $( "#pegawai_nip_pns_non_dini").prop('disabled', false);
        }
    });

</script>