<div class="row">
  <div class="col-lg-12">
    <h4>Penugasan Undangan Diklat</h4>

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
          <?php
          $no = 0;
          foreach ($list_diklat as $key => $value) { ?>
            <tr>
              <!-- <td>2000201</td> -->
              <td><a href="<?= base_url() ?>uploads/<?= $value->file_name ?>" target="_blank">Lihat</a></td>
              <td><?= $value->no ?></td>
              <td><?= ucwords($value->jenis_tujuan) ?></td>
              <td><?= date_indo($value->tgl_upload) ?></td>
              <td><label class="badge badge-light">Surat <?= ucwords($value->jenis) ?></label></td>
              <td>
                <?php if(!$check_diklat[$no]) { ?>
                <!-- Large modal -->
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#register-<?= $value->id ?>">Daftar</button>

                <!-- Modal -->
                <div id="register-<?= $value->id ?>" class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pemberkasan Diklat dengan No. Surat <b><?= $value->no ?><b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="<?= base_url() ?>diklat/create" method="post" class="forms-sample" enctype="multipart/form-data">
                        <div class="modal-body">
                          <input type="hidden" id="surat_id" name="surat_id" value=<?= $value->id ?>>
                          <div class="form-group row">
                            <div class="col-md-6">
                              <label for="file_foto">Pas Foto (*)</label>
                              <input type="file" class="form-control-file" id="file_foto" name="file_foto">  
                            </div>
                            <div class="col-md-6">
                              <label for="file_ktp">KTP (*)</label>
                              <input type="file" class="form-control-file" id="file_ktp" name="file_ktp">  
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-6">
                              <label for="file_kk">KK (*)</label>
                              <input type="file" class="form-control-file" id="file_kk" name="file_kk">  
                            </div>
                            <div class="col-md-6">
                              <label for="file_ijazah">Ijazah (*)</label>
                              <input type="file" class="form-control-file" id="file_ijazah" name="file_ijazah">  
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-6">
                              <label for="file_surat_sehat">Surat Sehat (opsional)</label>
                              <input type="file" class="form-control-file" id="file_surat_sehat" name="file_surat_sehat">  
                            </div>
                            <div class="col-md-6">
                              <label for="file_tambahan">Dokumen Lainnya (opsional)</label>
                              <input type="file" class="form-control-file" id="file_tambahan" name="file_tambahan">  
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                          <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->
                <?php } else { ?>
                  <button type="button" class="btn btn-warning" disabled>Terdaftar</button>

                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable-<?= $value->id ?>">
                    Batalkan
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="deletetable-<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Batalkan Diklat dengan No. Surat : <b><?= $value->no ?></b> </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Apakah anda yakin untuk membatalkan pemberkasan ini?
                        </div>
                        <div class="modal-footer">
                          <form action="<?= base_url(); ?>diklat/delete" method="post" class="forms-sample" enctype="multipart/form-data">
                            <input type="hidden" name="diklat_id" value="<?= $list_diklat_id[$no] ?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger">Ya</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </td>
            </tr>
          <?php $no++;
          } ?>

        </tbody>
      </table>
    </div>
  </div>
</div>