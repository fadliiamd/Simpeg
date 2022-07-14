<div class="row">
  <div class="col-lg-12">
    <h4>Surat</h4>
    
    <!-- Large modal -->
    <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Surat</button>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="modal_Tambah_surat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Surat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url(); ?>surat/create" method="post" class="forms-sample" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label for="file_surat">File Surat (*)</label>
                <input type="file" class="form-control-file" id="file_surat" name="file_surat" required>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="no_surat">Nomor Surat (*)</label>
                  <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Nomor Surat" required>
                </div>
                <div class="col-md-6">
                  <label for="jenis_surat">Jenis Surat (*)</label>
                  <select class="form-control" id="jenis_surat" name="jenis" required>
                    <option value="" selected hidden>--- Jenis Surat ---</option>
                    <option value="tugas">Surat Tugas</option>
                    <option value="undangan">Surat Undangan</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="jenis_kegiatan">Jenis Kegiatan (*)</label>
                  <select class="form-control" id="jenis_kegiatan" name="jenis_kegiatan" required>
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
                <label for="tema">Tema/Judul Kegiatan (*)</label>
                <input type="text" class="form-control" id="tema" name="tema" placeholder="Tema/Judul Kegiatan" required>
              </div>
              <div class="form-group">
                <label for="jenis_tujuan">Jenis Pegawai Tujuan Surat (*)</label>
                <select class="form-control" id="jenis_tujuan" name="jenis_tujuan" required>
                  <option value="" selected hidden>--- Jenis Pegawai Tujuan Surat ---</option>
                  <option value="semua">Semua</option>
                  <option value="divisi">Divisi</option>
                  <option value="perorangan">Perorangan</option>
                </select>
              </div>
              <div id="detail_tujuan">
                
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-primary">Tambah Surat</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End Modal -->

    <div class="table-responsive">
      <table id="list-surat" class="table table-striped table-bordered">
        <thead class="thead-dark">
          <tr>
            <!-- <th>Diupload Oleh</th> -->
            <th>File</th>
            <th>No. Surat</th>
            <th style="max-width:10px;">Tujuan</th>
            <th>Tanggal Upload</th>
            <th>Jenis</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($surat as $key => $value) { ?>
            <tr>
              <!-- <td>2000201</td>             -->
              <td><a href="<?= base_url() ?>uploads/<?= $value->file_name ?>" target="_blank">Lihat</a></td>
              <td><?= $value->no ?></td>
              <td>
                <?= ucwords($value->jenis_tujuan) ?>
              </td>
              <td><?= date_indo($value->tgl_upload) ?></td>
              <td><label class="badge badge-light">Surat <?= ucwords($value->jenis) ?></label></td>
              <td>
                <!-- Large modal -->
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewsurat-<?= $value->id ?>">Lihat</button>

                <!-- Modal -->
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
                          <div class="form-group">
                            <label for="file_surat">File Surat</label>
                            <div class="mt-1">
                              <a href="<?= base_url() . 'uploads/' . $value->file_name ?>" target="_blank">                              
                                  Lihat Surat                              
                              </a>
                            </div>                            
                          </div>
                          <div class="form-group row">
                            <div class="col-md-6">
                              <label for="no_surat">Nomor Surat</label>
                              <input type="text" class="form-control" id="no_surat" value=<?=$value->no ?> disabled>
                            </div>
                            <div class="col-md-6">
                              <label for="jenis_surat">Jenis Surat</label>
                              <input type="text" class="form-control" id="jenis_surat" value=<?=ucwords($value->jenis) ?> disabled>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-6">
                              <label for="jenis_kegiatan">Jenis Kegiatan</label>
                              <input type="text" class="form-control" id="jenis_kegiatan" value=<?=ucwords($value->jenis_kegiatan) ?> disabled>
                            </div> 
                            <div class="col-md-6">
                              <label for="jenis_tujuan">Jenis Pegawai Tujuan Surat</label>
                              <input type="text" class="form-control" id="jenis_tujuan" value=<?=ucwords($value->jenis_tujuan) ?> disabled>
                            </div>
                          </div>
                          <div id="detail_tujuan">
                            <?php if($value->jenis_tujuan === 'divisi') { ?>
                              <div class="form-group">
                                <label for="divisi">Divisi Tujuan</label>
                                <input type="text" class="form-control" id="divisi" value=<?=ucwords($value->tujuan) ?> disabled>
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
                                    if ($value->detail_tujuan != NULL) {
                                      $detail_tujuan = explode(',', $value->detail_tujuan);
                                      $no = 1;
                                      foreach($detail_tujuan as $el) { ?>
                                        <tr>
                                          <td><?= $no ?></td>
                                          <td><?= $el ?></td>
                                          <td><?= $list_detail_tujuan[$key][$no-1]->nama ?></td>
                                        </tr>
                                    <?php $no++; }
                                    } ?>
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
                                    if ($value->detail_tujuan != NULL) {
                                      $detail_tujuan = explode(',', $value->detail_tujuan);
                                      $no = 1;
                                      foreach($detail_tujuan as $el) { ?>
                                        <tr>
                                          <td><?= $no ?></td>
                                          <td><?= $el ?></td>
                                          <td><?= $list_detail_tujuan[$key][$no-1]->nama ?></td>
                                          <td><?= $list_detail_tujuan[$key][$no-1]->jabatan ?></td>
                                        </tr>
                                    <?php $no++;   }
                                    } ?>
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

                <!-- Large modal -->
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edittable-<?= $value->id ?>">Edit</button>

                <!-- Modal -->
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
                          <div class="form-group">
                            <label for="file_surat">File Surat (*)</label>
                            <input type="file" class="form-control-file" id="file_surat" name="file_surat">
                            <div class="mt-1">
                            <a href="<?= base_url() . 'uploads/' . $value->file_name ?>" target="_blank">                              
                                Lihat Surat                              
                            </a>
                            </div>                            
                          </div>
                          <div class="form-group row">
                            <div class="col-md-6">
                              <label for="no_surat">Nomor Surat (*)</label>
                              <input type="text" class="form-control" id="no_surat" name="no_surat" value=<?=$value->no; ?> required>
                            </div>
                            <div class="col-md-6">
                              <label for="jenis_surat">Jenis Surat (*)</label>
                              <select class="form-control" id="jenis_surat" name="jenis" required>
                                <option value="tugas" <?php if($value->jenis === 'tugas') echo "selected"; ?>>Surat Tugas</option>
                                <option value="undangan" <?php if($value->jenis === 'undangan') echo "selected"; ?>>Surat Undangan</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-6">
                              <label for="jenis_kegiatan">Jenis Kegiatan (*)</label>
                              <select class="form-control" id="jenis_kegiatan" name="jenis_kegiatan" required>
                                <option value="diklat" <?php if($value->jenis_kegiatan === 'diklat') echo "selected"; ?>>Diklat</option>
                                <option value="bimtek" <?php if($value->jenis_kegiatan === 'bimtek') echo "selected"; ?>>Bimbingan Teknis (Bimtek)</option>
                                <option value="prajabatan" <?php if($value->jenis_kegiatan === 'prajabatan') echo "selected"; ?>>Prajabatan</option>
                              </select>
                            </div> 
                            <div class="col-md-6">
                              <label for="jenis_tujuan">Jenis Pegawai Tujuan Surat (*)</label>
                              <select class="form-control" id="jenis_tujuan" name="jenis_tujuan" required>
                                <option value="semua" <?php if($value->jenis_tujuan === 'semua') echo "selected"; ?>>Semua</option>
                                <option value="divisi" <?php if($value->jenis_tujuan === 'divisi') echo "selected"; ?>>Divisi</option>
                                <option value="perorangan" <?php if($value->jenis_tujuan === 'perorangan') echo "selected"; ?>>Perorangan</option>
                              </select>
                            </div>
                          </div>
                          <div id="detail_tujuan">
                            <?php if($value->jenis_tujuan === 'divisi') { ?>
                              <div class="form-group row">
                                <div class="col-md-6">
                                  <label for="divisi">Divisi Tujuan (*)</label>
                                  <select class="form-control" id="divisi" name="divisi" required>
                                    <option value="jurusan" <?php if($value->tujuan === 'jurusan') echo "selected"; ?>>Jurusan</option>
                                    <option value="bagian" <?php if($value->tujuan === 'bagian') echo "selected"; ?>>Bagian</option>
                                    <option value="unit" <?php if($value->tujuan === 'unit') echo "selected"; ?>>Unit</option>
                                  </select>
                                </div>
                                <div class="col-md-6">
                                  <label for="tujuan">Tujuan (*)</label>
                                  <select class="form-control" id="tujuan" name="tujuan[]" multiple="multiple" required>
                                    <option value="" selected hidden>--- Tujuan ---</option>
                                    <?php
                                    if($value->detail_tujuan != NULL) {
                                      if($value->tujuan == 'jurusan') {
                                        $list_divisi = $jurusan;
                                      } else if($value->tujuan == 'bagian') {
                                        $list_divisi = $bagian;
                                      } else if($value->tujuan == 'unit') {
                                        $list_divisi = $unit;
                                      }
                                      $detail_tujuan = explode(',', $value->detail_tujuan);
                                      $no = 1;
                                      foreach($list_divisi as $item) {
                                        $found = 0;
                                        foreach($detail_tujuan as $el) {
                                          if($item->id == $el) {
                                            $found = 1;
                                            break;
                                          }
                                        }
                                    ?>
                                        <option value="<?= $item->id ?>" <?php if($found == 1) echo "selected"; ?>><?= $item->nama ?></option>
                                    <?php
                                    $no++; }
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>
                            <?php } else if($value->jenis_tujuan === 'perorangan') { ?>
                              <div class="form-group row">
                                <div class="col-md-6">
                                  <label for="jenis_pegawai">Jenis Tujuan Pegawai (*)</label>
                                  <select class="form-control" id="jenis_pegawai" name="jenis_pegawai" required>
                                    <option value="struktural" <?php if($value->tujuan === 'struktural') echo "selected"; ?>>Struktural</option>
                                    <option value="fungsional" <?php if($value->tujuan === 'fungsional') echo "selected"; ?>>Fungsional</option>
                                  </select>
                                </div>
                                <div class="col-md-6">
                                  <label for="tujuan">Pegawai Tujuan (*)</label>
                                  <select class="form-control" id="tujuan" name="tujuan[]" multiple="multiple" required>
                                    <option selected hidden>--- Tujuan ---</option>
                                    <?php
                                    if($value->detail_tujuan != NULL) {
                                      $detail_tujuan = explode(',', $value->detail_tujuan);
                                      $no = 1;
                                      foreach($pegawai as $item) {
                                        $found = 0;
                                        foreach($detail_tujuan as $el) {
                                          if($item->account_nip == $el) {
                                            $found = 1;
                                            break;
                                          }
                                        } ?>
                                        <option value="<?= $item->account_nip ?>" <?php if($found == 1) echo "selected"; ?>><?= $item->nama ?></option>
                                    <?php $no++; }
                                    } ?>
                                  </select>
                                </div>
                              </div>
                            <?php } ?>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                          <button type="submit" class="btn btn-primary">Edit Surat</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->

                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable-<?= $value->id ?>">
                  Hapus
                </button>

                <!-- Modal -->
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
              </td>
            </tr>
          <?php
          } ?>

        </tbody>
      </table>
    </div>
  </div>
</div>