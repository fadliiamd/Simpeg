<div class="row">
  <div class="col-lg-12">
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
    <h4>Surat</h4>
    
    <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target="#unggah_surat">
      Unggah Surat
    </button>
    <!-- Modal: Unggah Surat -->
    <div class="modal fade" id="unggah_surat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Unggah Surat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url(); ?>surat/upload" method="post" class="forms-sample" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label for="no_surat">Nomor Surat (*)</label>
                <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Nomor Surat" required>
              </div>
              <div class="form-group">
                <label for="file_surat">File Surat (*)</label>
                <input type="file" class="form-control-file" id="file_surat" name="file_surat" required>
                <p class="card-description mt-1">
                  Format file: .pdf&emsp;Maksimal ukuran file: 2MB
                </p>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-primary">Unggah Surat</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Unggah Surat Lengkap</button>

    <div class="modal fade bd-example-modal-lg" id="modal_Tambah_surat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Unggah Surat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="surat/create" method="post" class="forms-sample" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group row">
                <div class="col-md-8">
                  <label for="no_surat">Nomor Surat (*)</label>
                  <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Nomor Surat" required>
                </div>
                <div class="col-md-4">
                  <label for="file_surat">File Surat (*)</label>
                  <input type="file" class="form-control-file" id="file_surat" name="file_surat" required>
                  <p class="card-description mt-1">
                    Format file: .pdf&emsp;Maksimal ukuran file: 2MB
                  </p>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="jenis_kegiatan">Jenis Kegiatan (*)</label>
                  <select class="form-control" id="jenis_kegiatan" name="jenis_kegiatan">
                    <option value="" selected hidden>--- Jenis Kegiatan ---</option>
                    <option value="diklat">Diklat</option>
                    <option value="bimtek">Bimbingan Teknis (Bimtek)</option>
                    <option value="prajabatan">Prajabatan</option>
                  </select>
                </div> 
                <div class="col-md-6" id="detail_jenis_kegiatan">

                </div>
              </div>
              <div class="form-group">
                <label for="tema">Tema/Judul Kegiatan</label>
                <input type="text" class="form-control" id="tema" name="tema" placeholder="Tema/Judul Kegiatan">
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="subjek">Subjek Surat (*)</label>
                  <select class="form-control" id="subjek" name="subjek">
                    <option value="" selected hidden>--- Subjek Surat ---</option>
                    <option value="semua">Semua</option>
                    <option value="spesifik">Spesifik</option>
                    <option value="tidak ada">Belum Jelas (Butuh Perangkingan)</option>
                  </select>
                </div>
                <div class="col-md-6" id="detail_subjek">
                  
                </div>
              </div>
              <div id="detail_tujuan">
                
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-primary">Unggah Surat</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table id="list-surat" class="table table-striped table-bordered">
        <thead class="thead-dark">
          <tr>
            <th>File</th>
            <th>No. Surat</th>
            <th>Jenis Kegiatan</th>
            <th>Tujuan</th>
            <th>Tanggal Upload</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($surat as $key => $value) { ?>
            <tr>
              <td><a href="<?= base_url() ?>uploads/<?= $value->file_name ?>" target="_blank">Lihat</a></td>
              <td><?= $value->no ?></td>
              <td>Surat <?= ucwords($value->jenis_kegiatan) ?></td>
              <td>
                <?= ucwords($value->jenis_tujuan) ?>
              </td>
              <td><?= date_indo($value->tgl_upload) ?></td>
              <td>
                <label class="badge badge-<?php if($value->status == 'ready to send') echo 'info'; else if($value->status == 'sent') echo 'success'; else if($value->status == 'need ranking') echo 'warning'; else echo 'danger'; ?>">
                  <?php
                  if($value->status == 'need to fill') {
                    echo 'Isian Perlu Dilengkapi';
                  } else if($value->status == 'need ranking') {
                    echo 'Perlu Perangkingan';
                  } else if($value->status == 'ready to send') {
                    echo 'Siap Dikirim';
                  } else if($value->status == 'sent') {
                    echo 'Terkirim';
                  } ?>
                </label>
              </td>
              <td>
                <!-- Modal: Add Filter -->
                <?php if($value->jenis_tujuan == 'tidak ada') { ?>
                <?php if($value->kriteria_id == NULL) { ?>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#filtersurat-<?= $value->id ?>">Tambah Kriteria</button>
                <div id="filtersurat-<?= $value->id ?>" class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Filter Berdasarkan :</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="POST" action="<?= base_url('surat/filter') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="surat_id" value="<?= $value->id ?>" />
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-4">
                              <b>Masa Kerja Minimal</b>
                              <div class="d-flex align-items-center">
                                <input type="number" name="masa_kerja" class="form-control" min="0" style="max-width:100px;">
                                <span class="pl-2">Tahun</span>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <b>Pendidikan</b><br>
                              <div class="d-flex align-items-center">
                                <select class="form-control js-example-basic-multiple" name="pendidikan[]" multiple="multiple" style="width:100%">
                                <?php
                                $label_pendidikan = [
                                  "SMA", "D3", "S1", "S2", "S3"
                                ];
                                foreach ($label_pendidikan as $key => $el) { ?>
                                  <option value="<?= $el ?>"><?= $el ?></option>
                                <?php
                                }
                                ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <b>Jenis Pegawai</b><br>
                              <div class="d-flex align-items-center">
                                <select class="form-control js-example-basic-multiple" name="jenis_pegawai[]" multiple="multiple" style="width:100%">
                                <?php
                                $label_pendidikan = [
                                  "fungsional", "struktural"
                                ];
                                foreach ($label_pendidikan as $key => $el) { ?>
                                  <option value="<?= $el ?>"><?= ucwords($el) ?></option>
                                <?php
                                }
                                ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <hr />
                          <div class="row">
                            <div class="col-md-4">
                              <b>Jurusan</b><br>
                              <select class="form-control js-example-basic-multiple" name="jurusan[]" multiple="multiple" style="width:100%">
                              <?php
                              foreach ($jurusan as $key => $el) { ?>
                                <option value="<?= $el->id ?>"><?= ucwords($el->nama) ?></option>
                              <?php
                              }
                              ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <b>Bagian</b><br>
                              <select class="form-control js-example-basic-multiple" name="bagian[]" multiple="multiple" style="width:100%">
                              <?php
                              foreach ($bagian as $key => $el) { ?>
                                <option value="<?= $el->id ?>"><?= ucwords($el->nama) ?></option>
                              <?php
                              }
                              ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <b>Unit</b><br>
                              <select class="form-control js-example-basic-multiple" name="unit[]" multiple="multiple" style="width:100%">
                              <?php
                              foreach ($unit as $key => $el) { ?>
                                <option value="<?= $el->id ?>"><?= ucwords($el->nama) ?></option>
                              <?php
                              }
                              ?>
                              </select>
                            </div>
                          </div>
                          <hr />
                          <div class="row">
                            <div class="col-md-4">
                              <b>Jabatan</b><br>
                              <select class="form-control js-example-basic-multiple" name="jabatan[]" multiple="multiple" style="width:100%">
                              <?php
                              foreach ($jabatan as $key => $el) { ?>
                                <option value="<?= $el->id ?>"><?= ucwords($el->nama_jabatan) ?></option>
                              <?php
                              }
                              ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <b>Bidang Keahlian</b><br>
                              <select class="form-control js-example-basic-multiple" name="bidang_keahlian[]" multiple="multiple" style="width:100%">
                              <?php
                              foreach ($bidang_keahlian as $key => $el) { ?>
                                <option value="<?= $el->id_keahlian ?>"><?= ucwords($el->nama_keahlian) ?></option>
                              <?php
                              }
                              ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <b>Sertifikat Kegiatan</b><br>
                              <select class="form-control js-example-basic-multiple" name="sertifikat_kegiatan[]" multiple="multiple" style="width:100%">
                              <?php
                              $curr_tema = [];
                              foreach ($sertifikat as $key => $el) {
                                $tema = str_replace('_', ' ', explode("-", $el->nama_serti)[1]);
                                if (!in_array($tema, $curr_tema)) {
                                ?>
                                <option value="<?= $el->id ?>"><?php echo $tema; array_push($curr_tema, $tema); ?></option>
                              <?php
                              } }
                              ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                          <button type="submit" name="filter" class="btn btn-primary">Ubah Filter Surat</button>
                        </div>
                    </div>
                  </div>
                </div>
                <?php } else { ?>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editfiltersurat-<?= $value->id ?>">Edit Kriteria</button>
                <div id="editfiltersurat-<?= $value->id ?>" class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Filter Berdasarkan :</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="POST" action="<?= base_url('surat/filter') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="surat_id" value="<?= $value->id ?>" />
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-4">
                              <b>Masa Kerja Minimal</b>
                              <div class="d-flex align-items-center">
                                <input type="number" name="masa_kerja" class="form-control" min="0" style="max-width:100px;" value="<?= $list_kriteria[$value->kriteria_id]->masa_kerja ?>">
                                <span class="pl-2">Tahun</span>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <b>Pendidikan</b><br>
                              <div class="d-flex align-items-center">
                                <select class="form-control js-example-basic-multiple" name="pendidikan[]" multiple="multiple" style="width:100%">
                                <?php
                                $label_pendidikan = [
                                  "SMA", "D3", "S1", "S2", "S3"
                                ];
                                foreach ($label_pendidikan as $key => $el) {
                                  $arr = explode(",", $list_kriteria[$value->kriteria_id]->pendidikan);
                                  $selected = "";
                                  foreach($arr as $item) {
                                    if($item == $el) {
                                      $selected = "selected";
                                      break;
                                    }
                                  }
                                  ?>
                                  <option value="<?= $el ?>" <?= $selected ?>>><?= $el ?></option>
                                <?php
                                }
                                ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <b>Jenis Pegawai</b><br>
                              <div class="d-flex align-items-center">
                                <select class="form-control js-example-basic-multiple" name="jenis_pegawai[]" multiple="multiple" style="width:100%">
                                <?php
                                $label_pendidikan = [
                                  "fungsional", "struktural"
                                ];
                                foreach ($label_pendidikan as $key => $el) {
                                  $arr = explode(",", $list_kriteria[$value->kriteria_id]->jenis_pegawai);
                                  $selected = "";
                                  foreach($arr as $item) {
                                    if($item == $el) {
                                      $selected = "selected";
                                      break;
                                    }
                                  }
                                  ?>
                                  <option value="<?= $el ?>" <?= $selected ?>><?= ucwords($el) ?></option>
                                <?php
                                }
                                ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <hr />
                          <div class="row">
                            <div class="col-md-4">
                              <b>Jurusan</b><br>
                              <select class="form-control js-example-basic-multiple" name="jurusan[]" multiple="multiple" style="width:100%">
                              <?php
                              foreach ($jurusan as $key => $el) {
                                $arr = explode(",", $list_kriteria[$value->kriteria_id]->jurusan_id);
                                $selected = "";
                                foreach($arr as $item) {
                                  if($item == $el->id) {
                                    $selected = "selected";
                                    break;
                                  }
                                }
                                ?>
                                <option value="<?= $el->id ?>" <?= $selected ?>><?= ucwords($el->nama) ?></option>
                              <?php
                              }
                              ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <b>Bagian</b><br>
                              <select class="form-control js-example-basic-multiple" name="bagian[]" multiple="multiple" style="width:100%">
                              <?php
                              foreach ($bagian as $key => $el) {
                                $arr = explode(",", $list_kriteria[$value->kriteria_id]->bagian_id);
                                $selected = "";
                                foreach($arr as $item) {
                                  if($item == $el->id) {
                                    $selected = "selected";
                                    break;
                                  }
                                }
                                ?>
                                <option value="<?= $el->id ?>" <?= $selected ?>><?= ucwords($el->nama) ?></option>
                              <?php
                              }
                              ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <b>Unit</b><br>
                              <select class="form-control js-example-basic-multiple" name="unit[]" multiple="multiple" style="width:100%">
                              <?php
                              foreach ($unit as $key => $el) {
                                $arr = explode(",", $list_kriteria[$value->kriteria_id]->unit_id);
                                $selected = "";
                                foreach($arr as $item) {
                                  if($item == $el->id) {
                                    $selected = "selected";
                                    break;
                                  }
                                }
                                ?>
                                <option value="<?= $el->id ?>" <?= $selected ?>><?= ucwords($el->nama) ?></option>
                              <?php
                              }
                              ?>
                              </select>
                            </div>
                          </div>
                          <hr />
                          <div class="row">
                            <div class="col-md-4">
                              <b>Jabatan</b><br>
                              <select class="form-control js-example-basic-multiple" name="jabatan[]" multiple="multiple" style="width:100%">
                              <?php
                              foreach ($jabatan as $key => $el) {
                                $arr = explode(",", $list_kriteria[$value->kriteria_id]->jabatan_id);
                                $selected = "";
                                foreach($arr as $item) {
                                  if($item == $el->id) {
                                    $selected = "selected";
                                    break;
                                  }
                                }
                                ?>
                                <option value="<?= $el->id ?>"><?= ucwords($el->nama_jabatan) ?></option>
                              <?php
                              }
                              ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <b>Bidang Keahlian</b><br>
                              <select class="form-control js-example-basic-multiple" name="bidang_keahlian[]" multiple="multiple" style="width:100%">
                              <?php
                              foreach ($bidang_keahlian as $key => $el) {
                                $arr = explode(",", $list_kriteria[$value->kriteria_id]->bidang_keahlian_id);
                                $selected = "";
                                foreach($arr as $item) {
                                  if($item == $el->id_keahlian) {
                                    $selected = "selected";
                                    break;
                                  }
                                }
                                ?>
                                <option value="<?= $el->id_keahlian ?>"><?= ucwords($el->nama_keahlian) ?></option>
                              <?php
                              }
                              ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <b>Sertifikat Kegiatan</b><br>
                              <select class="form-control js-example-basic-multiple" name="sertifikat_kegiatan[]" multiple="multiple" style="width:100%">
                              <?php
                              $curr_tema = [];
                              foreach ($sertifikat as $key => $el) {
                                $tema = str_replace('_', ' ', explode("-", $el->nama_serti)[1]);
                                if (!in_array($tema, $curr_tema)) {
                                  $arr = explode(",", $list_kriteria[$value->kriteria_id]->sertifikat_id);
                                  $selected = "";
                                  foreach($arr as $item) {
                                    if($item == $el->id) {
                                      $selected = "selected";
                                      break;
                                    }
                                  }
                                ?>
                                <option value="<?= $el->id ?>"><?php echo $tema; array_push($curr_tema, $tema); ?></option>
                              <?php
                              } }
                              ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                          <button type="submit" name="filter" class="btn btn-primary">Ubah Filter Surat</button>
                        </div>
                    </div>
                  </div>
                </div>
                <?php } } ?>

                <!-- Modal: Detail -->
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewsurat-<?= $value->id ?>">Detail</button>
                <div id="viewsurat-<?= $value->id ?>" class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">No. Surat : <b><?= $value->no ?><b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="<?= base_url(); ?>surat/update" method="post" class="forms-sample" enctype="multipart/form-data">
                        <div class="modal-body">
                          <div class="form-group row">
                            <div class="col-md-8">
                              <label for="no_surat">Nomor Surat</label>
                              <input type="text" class="form-control" id="no_surat" value=<?=$value->no ?> disabled>
                            </div>
                            <div class="col-md-4">
                              <label for="file_surat">File Surat</label>
                              <div class="mt-1">
                                <a href="<?= base_url() . 'uploads/' . $value->file_name ?>" target="_blank">                              
                                    Lihat Surat                              
                                </a>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-6">
                              <label for="jenis_kegiatan">Jenis Kegiatan</label>
                              <input type="text" class="form-control" id="jenis_kegiatan" value="<?=ucwords($value->jenis_kegiatan) ?>" disabled>
                            </div> 
                            <?php if($value->jenis_kegiatan == 'diklat') { ?>
                            <div class="col-md-6">
                              <label for="jenis_diklat">Jenis Diklat</label>
                              <input type="text" class="form-control" id="jenis_kegiatan" value="<?=ucwords($value->jenis_diklat) ?>" disabled>
                            </div>
                            <?php } ?>
                          </div>
                          <div class="form-group">
                              <label for="jenis_tujuan">Jenis Pegawai Tujuan Surat</label>
                              <input type="text" class="form-control" id="jenis_tujuan" value="<?=ucwords($value->jenis_tujuan) ?>" disabled>
                            </div>
                          <div class="form-group">
                            <label for="tema">Tema/Judul Kegiatan</label>
                            <input type="text" class="form-control" id="tema" value="<?=$value->tema ?>" disabled>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-6">
                              <label for="subjek">Subjek Surat (*)</label>
                              <input type="text" class="form-control" id="subjek" value="<?php if($value->jenis_tujuan == 'semua') { echo 'Semua'; } else if($value->jenis_tujuan == 'tidak ada') { echo 'Belum Jelas (Butuh Perangkingan)'; } else if($value->jenis_tujuan == 'divisi') { echo 'Spesifik'; } else if($value->jenis_tujuan == 'perorangan') { echo ucwords('Spesifik'); } ?>" disabled>
                            </div>
                            <div class="col-md-6" id="detail_subjek">
                              <?php if($value->jenis_tujuan == 'divisi' || $value->jenis_tujuan == 'perorangan') { ?>
                              <label for="jenis_tujuan">Jenis Pegawai Tujuan Surat</label>
                              <input type="text" class="form-control" id="jenis_tujuan" value="<?=ucwords($value->jenis_tujuan) ?>" disabled>
                              <?php } ?>
                            </div>
                          </div>
                          <div id="detail_tujuan">
                            <?php if($value->jenis_tujuan === 'divisi') { ?>
                              <div class="form-group">
                                <label for="divisi">Divisi Tujuan</label>
                                <input type="text" class="form-control" id="divisi" value="<?=ucwords($value->tujuan) ?>" disabled>
                              </div>
                              <div class="form-group">
                                <label for="tujuan">Tujuan</label>
                                <div class="table-responsive">
                                  <table class="table table-striped table-bordered table-datatable">
                                    <thead class="thead-dark">
                                      <tr>
                                        <th>No</th>
                                        <th>ID <?=ucwords($value->tujuan) ?></th>
                                        <th>Nama <?=ucwords($value->tujuan) ?></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                      $no = 1;
                                      foreach($list_detail_tujuan[$value->id] as $el) { ?>
                                        <tr>
                                          <td><?= $no ?></td>
                                          <td><?= $el->id ?></td>
                                          <td><?= $el->nama ?></td>
                                        </tr>
                                    <?php $no++; } ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            <?php } else if($value->jenis_tujuan === 'perorangan') { ?>
                              <div class="form-group">
                                <label for="tujuan">Jenis Pegawai Tujuan</label>
                                <input type="text" class="form-control" id="tujuan" value="<?=ucwords($value->tujuan) ?>" disabled>
                              </div>
                              <div class="form-group">
                                <label for="tujuan">Tujuan</label>
                                <div class="table-responsive">
                                  <table id="list_surat" class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                      <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama Pegawai</th>
                                        <th>Jabatan</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                      $no = 1;
                                      foreach($list_detail_tujuan[$value->id] as $el) { ?>
                                        <tr>
                                          <td><?= $no ?></td>
                                          <td><?= $el->account_nip ?></td>
                                          <td><?= $el->nama ?></td>
                                          <td>
                                            <?php if($el->jabatan_id != NULL) { ?>
                                            <?= $list_jabatan[$el->jabatan_id]->nama_jabatan ?>
                                            <?php } ?>
                                          </td>
                                        </tr>
                                    <?php $no++; } ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            <?php } ?>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->

                <!-- Modal: Edit -->
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edittable-<?= $value->id ?>">
                  <?= ($value->status == 'need to fill') ? 'Lengkapi' : 'Edit' ?>
                </button>
                <div id="edittable-<?= $value->id ?>" class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit No. Surat : <b><?= $value->no ?><b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="<?= base_url(); ?>surat/update" method="post" class="forms-sample" enctype="multipart/form-data">
                        <div class="modal-body">
                          <input type="hidden" class="form-control-file" id="id_surat" name="id_surat" value="<?= $value->id ?>">
                          <div class="form-group row">
                            <input type="hidden" name="no_surat_old" value=<?=$value->no; ?> required>
                            <div class="col-md-6">
                              <label for="no_surat_edit">Nomor Surat (*)</label>
                              <input type="text" class="form-control" id="no_surat_edit" name="no_surat" value=<?=$value->no; ?> required>
                            </div>
                            <div class="col-md-6">
                              <label for="file_surat_edit">File Surat (*)</label>
                              <input type="file" class="form-control-file" id="file_surat_edit" name="file_surat">
                              <p class="card-description mt-1">
                                Format file: .pdf&emsp;Maksimal ukuran file: 2MB
                              </p>
                              <div class="mt-1">
                                <a href="<?= base_url() . 'uploads/' . $value->file_name ?>" target="_blank">                              
                                    Lihat Surat                              
                                </a>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-6">
                              <label for="jenis_kegiatan_edit_<?= $value->id ?>">Jenis Kegiatan (*)</label>
                              <select class="form-control" id="jenis_kegiatan_edit_<?= $value->id ?>" name="jenis_kegiatan" onchange="change_jenis_kegiatan(this, <?= $value->id ?>)" required>
                                <option hidden <?= ($value->jenis_kegiatan == NULL) ? "selected" : "" ?>>--- Pilih Jenis Kegiatan ---</option>
                                <option value="diklat" <?php if($value->jenis_kegiatan === 'diklat') echo "selected"; ?>>Diklat</option>
                                <option value="bimtek" <?php if($value->jenis_kegiatan === 'bimtek') echo "selected"; ?>>Bimbingan Teknis (Bimtek)</option>
                                <option value="prajabatan" <?php if($value->jenis_kegiatan === 'prajabatan') echo "selected"; ?>>Prajabatan</option>
                              </select>
                            </div>
                            <div class="col-md-6" id="detail_jenis_kegiatan_edit_<?= $value->id ?>">
                            <?php if($value->jenis_kegiatan == 'diklat') { ?>                          
                              <label for="jenis_diklat_edit_<?= $value->id ?>">Jenis Diklat</label>
                              <select class="form-control" id="jenis_diklat_edit_<?= $value->id ?>" name="jenis_diklat">
                                <option hidden <?= ($value->jenis_diklat == NULL) ? "selected" : "" ?>>--- Pilih Jenis Diklat ---</option>
                                <option value="teknis" <?php if($value->jenis_diklat === 'teknis') echo "selected"; ?>>Teknis</option>
                                <option value="fungsional" <?php if($value->jenis_diklat === 'fungsional') echo "selected"; ?>>Fungsional</option>
                                <option value="unit" <?php if($value->jenis_diklat === 'unit') echo "selected"; ?>>Unit</option>
                              </select>
                            <?php } ?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="tema_edit_<?= $value->id ?>">Tema/Judul Kegiatan</label>
                            <input type="text" class="form-control" id="tema_edit_<?= $value->id ?>" name="tema" placeholder="Masukkan Tema/Judul Kegiatan" value="<?=$value->tema?>">
                          </div>
                          <div class="form-group row">
                            <div class="col-md-6">
                              <label for="subjek_edit_<?= $value->id ?>">Subjek Surat (*)</label>
                              <select class="form-control" id="subjek_edit_<?= $value->id ?>" name="subjek" onchange="change_subjek(this, <?= $value->id ?>)" required>
                                <option hidden <?= ($value->jenis_tujuan == NULL) ? "selected" : "" ?>>--- Subjek Surat ---</option>
                                <option value="semua" <?= ($value->jenis_tujuan == 'semua') ? "selected" : "" ?>>Semua</option>
                                <option value="spesifik" <?= ($value->jenis_tujuan == 'divisi' || $value->jenis_tujuan == 'perorangan') ? "selected" : "" ?>>Spesifik</option>
                                <option value="tidak ada" <?= ($value->jenis_tujuan == 'tidak ada') ? "selected" : "" ?>>Belum Jelas (Butuh Perangkingan)</option>
                              </select>
                            </div>
                            <div class="col-md-6" id="detail_subjek_edit_<?= $value->id ?>">
                              <?php if($value->jenis_tujuan != NULL && ($value->jenis_tujuan == 'divisi' || $value->jenis_tujuan == 'perorangan')) { ?>
                                <label for="jenis_tujuan_edit_<?= $value->id ?>">Jenis Pegawai Tujuan Surat</label>
                                <select class="form-control" id="jenis_tujuan_edit_<?= $value->id ?>" name="jenis_tujuan" onchange="change_jenis_tujuan(this, <?= $value->id ?>)">
                                  <option hidden <?= ($value->jenis_tujuan == NULL) ? "selected" : "" ?>>--- Pilih Jenis Pegawai Tujuan ---</option>
                                  <option value="divisi" <?php if($value->jenis_tujuan === 'divisi') echo "selected"; ?>>Divisi</option>
                                  <option value="perorangan" <?php if($value->jenis_tujuan === 'perorangan') echo "selected"; ?>>Perorangan</option>
                                </select>
                              <?php } ?>
                            </div>
                          </div>
                          <div id="detail_tujuan_edit_<?= $value->id ?>" class="row">
                            <?php if($value->jenis_tujuan === 'divisi') { ?>
                              <div class="form-group">
                                <label for="divisi_edit_<?= $value->id ?>">Divisi Tujuan</label>
                                <select class="form-control" id="divisi_edit_<?= $value->id ?>" name="divisi" onchange="change_divisi(this, <?= $value->id ?>)">
                                  <option hidden <?= ($value->tujuan == NULL) ? "selected" : "" ?>>--- Pilih Divisi Tujuan ---</option>
                                  <option value="jurusan" <?php if($value->tujuan === 'jurusan') echo "selected"; ?>>Jurusan</option>
                                  <option value="bagian" <?php if($value->tujuan === 'bagian') echo "selected"; ?>>Bagian</option>
                                  <option value="unit" <?php if($value->tujuan === 'unit') echo "selected"; ?>>Unit</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="tujuan"><?= ucwords($value->tujuan) ?> Tujuan</label>
                                <div class="table-responsive">
                                  <table class="table table-striped table-bordered table-datatable">
                                    <thead class="thead-dark">
                                      <tr>
                                        <th>No</th>
                                        <th>ID <?=ucwords($value->tujuan) ?></th>
                                        <th>Nama <?=ucwords($value->tujuan) ?></th>
                                        <th>Pilih</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                      $no = 1;
                                      foreach($list_detail_tujuan[$value->id] as $el) { ?>
                                        <tr>
                                          <td><?= $no ?></td>
                                          <td><?= $el->id ?></td>
                                          <td><?= $el->nama ?></td>
                                          <td><input type="checkbox" name="checked_subjek_id[]" value="<?= $el->id ?>"></td>
                                        </tr>
                                    <?php $no++; } ?>
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <td colspan="2" style="text-align: center; vertical-align: middle;">Aksi</td>
                                        <td colspan="2" style="text-align: center; vertical-align: middle;">
                                          <button type="submit" name="delete_tujuan" class="btn btn-danger">Hapus Tujuan Terpilih</button>
                                        </td>
                                      </tr>
                                    </tfoot>
                                  </table>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="tujuan_edit_<?= $value->id ?>">Tambah <?= ucwords($value->tujuan) ?> Tujuan</label>
                                <select class="form-control" size="10" id="tujuan_edit_<?= $value->id ?>" name="tujuan[]" multiple="multiple">
                                  <option value="" hidden>--- Tujuan ---</option>
                                  <?php
                                  if(isset($list_detail_tujuan[$value->id])) {
                                    if($value->tujuan == 'jurusan') {
                                      $list_divisi = $jurusan;
                                    } else if($value->tujuan == 'bagian') {
                                      $list_divisi = $bagian;
                                    } else if($value->tujuan == 'unit') {
                                      $list_divisi = $unit;
                                    }
                                    foreach($list_divisi as $item) {
                                      $found = 0;
                                      foreach($list_detail_tujuan[$value->id] as $el) {
                                        if($item->id == $el->id) {
                                          $found = 1;
                                          break;
                                        }
                                      }
                                  
                                  if($found != 1) { ?>
                                      <option value="<?= $item->id ?>"><?= $item->nama ?></option>
                                  <?php
                                  } } }
                                  ?>
                                </select>
                              </div>
                            <?php } else if($value->jenis_tujuan === 'perorangan') { ?>
                              <!-- <div class="form-group">
                                <label for="jenis_pegawai_edit_<?= $value->id ?>">Jenis Tujuan Pegawai</label>
                                <select class="form-control" id="jenis_pegawai_edit_<?= $value->id ?>" name="jenis_pegawai" onchange="change_jenis_pegawai(this, <?= $value->id ?>)">
                                  <option value="struktural" <?php if($value->tujuan === 'struktural') echo "selected"; ?>>Struktural</option>
                                  <option value="fungsional" <?php if($value->tujuan === 'fungsional') echo "selected"; ?>>Fungsional</option>
                                </select>
                              </div> -->
                              <div class="form-group">
                                <label for="tujuan">Pegawai Tujuan</label>
                                <div class="table-responsive">
                                  <table id="list_surat" class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                      <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Pilih</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                      $no = 1;
                                      foreach($list_detail_tujuan[$value->id] as $el) { ?>
                                        <tr>
                                          <td><?= $no ?></td>
                                          <td><?= $el->account_nip ?></td>
                                          <td><?= $el->nama ?></td>
                                          <td>
                                            <?php if($el->jabatan_id != NULL) { ?>
                                            <?= $list_jabatan[$el->jabatan_id]->nama_jabatan ?>
                                            <?php } ?>
                                          </td>
                                          <td>
                                            <input type="checkbox" name="checked_subjek_id[]" value="<?= $el->account_nip ?>">
                                          </td>
                                        </tr>
                                    <?php $no++; } ?>
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <td colspan="2" style="text-align: center; vertical-align: middle;">Aksi</td>
                                        <td colspan="3" style="text-align: center; vertical-align: middle;">
                                          <button type="submit" name="delete_tujuan" class="btn btn-danger">Hapus Tujuan Terpilih</button>
                                        </td>
                                      </tr>
                                    </tfoot>
                                  </table>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="tujuan_edit_<?= $value->id ?>">Tambah Pegawai Tujuan</label>
                                <select class="form-control js-example-basic-multiple" size="10" id="tujuan_edit_<?= $value->id ?>" name="tujuan[]" multiple="multiple">
                                  <?php
                                  if(isset($list_detail_tujuan[$value->id])) {
                                    foreach($pegawai as $item) {
                                      $found = 0;
                                      foreach($list_detail_tujuan[$value->id] as $el) {
                                        if($item->account_nip == $el->account_nip) {
                                          $found = 1;
                                          break;
                                        }
                                      }
                                      if($found != 1) { ?>
                                      <option value="<?= $item->account_nip ?>">(<?= $item->account_nip ?>) <?= $item->nama ?></option>
                                  <?php } } } ?>
                                </select>
                              </div>
                            <?php } ?>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                          <button type="submit" name="edit" class="btn btn-primary">Edit Surat</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->

                <!-- Modal: Hapus -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable-<?= $value->id ?>">
                  Hapus
                </button>
                <div class="modal fade" id="deletetable-<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Nomor Surat : <b><?= $value->no ?></b> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Apakah anda yakin untuk menghapus surat ini?
                      </div>
                      <div class="modal-footer">
                        <form action="<?= base_url(); ?>surat/delete" method="post" class="forms-sample" enctype="multipart/form-data">
                          <input type="hidden" name="id_surat" value="<?= $value->id; ?>">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                          <button type="submit" class="btn btn-danger">Ya</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <?php if($value->status == 'ready to send') { ?>
                <form action="<?= base_url() ?>surat/send_to_subjek" method="POST">
                  <input type="hidden" name="surat_id" value="<?= $value->id ?>">
                  <button type="submit" class="btn btn-success my-2">
                    Kirim Surat
                  </button>
                </form>
                <?php } ?>
              </td>
            </tr>
          <?php
          } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>