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
                <!-- Large modal -->
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewdiklat-<?= $value->id ?>">Lihat</button>

                <!-- Modal -->
                <div id="viewdiklat-<?= $value->id ?>" class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                <input type="text" class="form-control" id="divisi" value="<?=ucwords($value->tujuan) ?>" disabled>
                              </div>
                            <?php } else if($value->jenis_tujuan === 'perorangan') { ?>
                              <div class="form-group">
                                <label for="tujuan">Jenis Pegawai Tujuan</label>
                                <input type="text" class="form-control" id="tujuan" value="<?=ucwords($value->tujuan) ?>" disabled>
                              </div>
                            <?php } ?>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-6">
                              <label for="file_surat">File Materi</label>
                              <div class="mt-1">
                                <?php
                                $file_materi = $list_diklat_berkas[$value->id]->file_materi;
                                if($file_materi != NULL) { ?>
                                <a href="<?= base_url().'uploads/diklat/'.$file_materi ?>" target="_blank">                              
                                    Lihat File Materi                         
                                </a>
                                <?php } else { ?>
                                <a>                              
                                    Tidak Ada                         
                                </a>
                                <?php } ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label for="file_surat">Sertifikat</label>
                              <div class="mt-1">
                                <?php
                                $sertifikat = $list_diklat_hasil[$value->id]->nama_serti;
                                if($sertifikat != NULL) {
                                ?>
                                <a href="<?= base_url().'uploads/diklat/'.$sertifikat ?>" target="_blank">                              
                                    Lihat Sertifikat                         
                                </a>
                                <?php } else { ?>
                                <a>                              
                                    Tidak Ada                         
                                </a>
                                <?php } ?>
                              </div>
                            </div>                
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
                <?php if($check_diklat[$value->id] == NULL) { ?>
                  <!-- Large modal -->
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#register-<?= $value->id ?>">Daftar</button>

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
                  <button type="button" class="btn btn-success" disabled>Terdaftar</button>

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
                            <input type="hidden" name="diklat_id" value="<?= $list_diklat_berkas[$value->id]->id ?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger">Ya</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php
                  if($has_upload_hasil[$value->id] == 0) {
                  ?>
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#hasil-<?= $value->id ?>">
                    Unggah Hasil
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="hasil-<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Unggah Hasil Diklat dengan No. Surat : <b><?= $value->no ?></b> </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="<?= base_url() ?>diklat/hasil" method="post" class="forms-sample" enctype="multipart/form-data">
                          <div class="modal-body">
                            <input type="hidden" id="diklat_id" name="diklat_id" value=<?= $check_diklat[$value->id] ?>>
                            <div class="form-group">
                              <label for="file_materi">Materi Hasil Diklat (*)</label>
                              <input type="file" class="form-control-file" id="file_materi" name="file_materi">  
                            </div>
                            <div class="form-group">
                              <label for="file_sertifikat">Sertifikat Diklat (*)</label>
                              <input type="file" class="form-control-file" id="file_sertifikat" name="file_sertifikat">  
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
                  <?php } else { ?>
                    <button type="button" class="btn btn-warning" disabled>Unggah Hasil</button>
                  <?php } ?>
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