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
              <div class="form-group">
                <label for="jenis_tujuan">Jenis Pegawai Tujuan Surat (*)</label>
                <select class="form-control" id="jenis_tujuan" name="jenis_tujuan" required>
                  <option value="">--- Jenis Pegawai Tujuan Surat ---</option>
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
      <table class="table table-striped table-bordered table-datatable">
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
              <td><?= $value->tujuan ?></td>
              <td><?= $value->tgl_upload ?></td>
              <td><label class="badge badge-light">Surat <?= $value->jenis ?></label></td>
              <td>
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
                              <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Nomor Surat" value="<?= $value->no ?>" required>
                              <input type="hidden" name="id_surat" value="<?= $value->id ?>">
                              <input type="hidden" name="tgl_upload_old" value="<?= $value->tgl_upload ?>">
                              <input type="hidden"  name="file_surat_old" value="<?= $value->file_name ?>">
                            </div>
                            <div class="col-md-6">
                              <label for="jenis_surat">Jenis Surat (*)</label>
                              <select class="form-control" id="jenis_surat" name="jenis" required>
                                <option value="" selected hidden>--- Jenis Surat ---</option>
                                <option value="tugas" <?php if ($value->jenis === 'tugas')  echo "selected"; ?>>Surat Tugas</option>
                                <option value="undangan" <?php if ($value->jenis === 'undangan')  echo "selected"; ?>>Surat Undangan</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="tujuan">Tujuan Surat (*)</label>
                            <input class="form-control" id="tujuan" name="tujuan" placeholder="Masukan tujuan surat secara singkat" value="<?= $value->tujuan ?>" required>
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