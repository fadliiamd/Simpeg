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
    <h4>Penugasan Undangan Prajabatan</h4>
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-datatable">
        <thead class="thead-dark">
          <tr>
            <th>File</th>
            <th>No. Surat</th>
            <th style="max-width:10px;">Tujuan</th>
            <th>Tanggal Upload</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 0;
          foreach ($list_prajabatan as $key => $value) { ?>
            <tr>
              <td><a href="<?= base_url() ?>uploads/<?= $value->file_name ?>" target="_blank">Lihat</a></td>
              <td><?= $value->no ?></td>
              <td><?= ucwords($value->jenis_tujuan) ?></td>
              <td><?= date_indo($value->tgl_upload) ?></td>
              <td>
                <?php if($this->session->userdata('role') == 'admin') { ?>
                  <!-- Aksi: Lihat -->
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewprajabatan-<?= $value->id ?>">Lihat</button>
                  <!-- Modal -->
                  <div id="viewprajabatan-<?= $value->id ?>" class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            </div>
                            <div class="form-group">
                              <label for="jenis_tujuan">Jenis Pegawai Tujuan Surat</label>
                              <input type="text" class="form-control" id="jenis_tujuan" value="<?=ucwords($value->jenis_tujuan) ?>" disabled>
                            </div>
                            <div class="form-group">
                              <label for="tema">Tema/Judul Kegiatan (*)</label>
                              <input type="text" class="form-control" id="tema" value="<?=$value->tema ?>" disabled>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label for="subjek">Subjek Surat (*)</label>
                                <input type="text" class="form-control" id="subjek" value="<?php if($value->jenis_tujuan == 'semua') { echo 'Semua'; } else if($value->jenis_tujuan == 'divisi') { echo 'Spesifik'; } else if($value->jenis_tujuan == 'perorangan') { echo ucwords('Spesifik'); } ?>" disabled>
                              </div>
                              <div class="col-md-6" id="detail_subjek">
                                <?php if($value->jenis_tujuan != 'semua') { ?>
                                <label for="jenis_tujuan">Jenis Pegawai Tujuan Surat (*)</label>
                                <input type="text" class="form-control" id="jenis_tujuan" value="<?=ucwords($value->jenis_tujuan) ?>" disabled>
                                <?php } ?>
                              </div>
                            </div>
                            <div id="detail_tujuan">
                              <?php if($value->jenis_tujuan == 'divisi') { ?>
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
                              <?php } else if($value->jenis_tujuan == 'perorangan') { ?>
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
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label for="file_surat">File Materi</label>
                                <div class="mt-1">
                                  <?php
                                  if(isset($list_prajabatan_hasil[$value->id])) { ?>
                                  <a href="<?= base_url().'uploads/'.$list_prajabatan_berkas[$value->id]->file_materi ?>" target="_blank">                              
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
                                  if(isset($list_prajabatan_hasil[$value->id])) {
                                  ?>
                                  <a href="<?= base_url().'uploads/'.$list_prajabatan_hasil[$value->id]->nama_serti ?>" target="_blank">                              
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
                            <div class="form-group">
                              <label for="angka_kredit">Angka Kredit</label>
                              <?php
                              if(isset($list_diklat_hasil[$value->id])) {
                              ?>
                              <input type="text" class="form-control" id="angka_kredit" value="<?= $list_diklat_hasil[$value->id]->angka_kredit ?>" disabled>
                              <?php } else { ?>
                              <input type="text" class="form-control" id="angka_kredit" value="" disabled>
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

                <?php } else { ?>
                  <?php if($check_prajabatan[$value->id] == NULL) { ?>
                    <!-- Aksi: Daftar -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#register-<?= $value->id ?>">Daftar</button>
                    <!-- Modal -->
                    <div id="register-<?= $value->id ?>" class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pemberkasan Prajabatan dengan No. Surat <b><?= $value->no ?><b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="<?= base_url() ?>prajabatan/create" method="post" class="forms-sample" enctype="multipart/form-data">
                            <div class="modal-body">
                              <input type="hidden" id="surat_id" name="surat_id" value=<?= $value->id ?>>
                              <div class="form-group">
                                <?php if($uploaded_berkas->foto != NULL && $uploaded_berkas->ktp != NULL && $uploaded_berkas->kk != NULL && $uploaded_berkas->ijazah != NULL) { ?>
                                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Berkas utama telah lengkap. Jika anda ingin mengubahnya silahkan menuju halaman profil
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                <?php } else { ?>
                                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    Silahkan untuk melengkapi berkas utama yang diperlukan.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                <?php } ?>
                              </div>
                              <h4>
                                Utama
                              </h4>
                              <hr />
                              <div class="form-group row">
                                <div class="col-md-6">
                                  <label for="file_foto">Pas Foto (*)</label>
                                  <?php if($uploaded_berkas->foto == NULL) { ?>
                                    <input type="file" class="form-control-file" id="file_foto" name="file_foto" required>  
                                    <p class="card-description mt-1">
                                      Format file: jpg, png&emsp;Maksimal ukuran file: 2MB
                                    </p>
                                  <?php } else { ?>
                                    <div class="mt-1">
                                      <a href="<?= base_url() . 'uploads/' . $uploaded_berkas->foto ?>" target="_blank">                              
                                        Lihat Pas Foto
                                      </a>
                                    </div>
                                  <?php } ?>
                                </div>
                                <div class="col-md-6">
                                  <label for="file_ktp">KTP (*)</label>
                                  <?php if($uploaded_berkas->ktp == NULL) { ?>
                                    <input type="file" class="form-control-file" id="file_ktp" name="file_ktp" required>  
                                    <p class="card-description mt-1">
                                      Format file: pdf, jpg, png&emsp;Maksimal ukuran file: 2MB
                                    </p>
                                  <?php } else { ?>
                                    <div class="mt-1">
                                      <a href="<?= base_url() . 'uploads/' . $uploaded_berkas->ktp ?>" target="_blank">                              
                                        Lihat KTP
                                      </a>
                                    </div>
                                  <?php } ?>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-md-6">
                                  <label for="file_kk">KK (*)</label>
                                  <?php if($uploaded_berkas->kk == NULL) { ?>
                                    <input type="file" class="form-control-file" id="file_kk" name="file_kk" required>  
                                    <p class="card-description mt-1">
                                      Format file: pdf, jpg, png&emsp;Maksimal ukuran file: 2MB
                                    </p>
                                  <?php } else { ?>
                                    <div class="mt-1">
                                      <a href="<?= base_url() . 'uploads/' . $uploaded_berkas->kk ?>" target="_blank">                              
                                        Lihat KK
                                      </a>
                                    </div> 
                                  <?php } ?>
                                </div>
                                <div class="col-md-6">
                                  <label for="file_ijazah">Ijazah (*)</label>
                                  <?php if($uploaded_berkas->ijazah == NULL) { ?>
                                    <input type="file" class="form-control-file" id="file_ijazah" name="file_ijazah" required>  
                                    <p class="card-description mt-1">
                                      Format file: pdf&emsp;Maksimal ukuran file: 2MB
                                    </p>
                                    <?php } else { ?>
                                    <div class="mt-1">
                                      <a href="<?= base_url() . 'uploads/' . $uploaded_berkas->ijazah ?>" target="_blank">                              
                                        Lihat Ijazah
                                      </a>
                                    </div>
                                  <?php } ?>
                                </div>
                              </div>
                              <br />
                              <h4>
                                Tambahan
                              </h4>
                              <hr />
                              <div class="form-group row">
                                <div class="col-md-6">
                                  <label for="file_surat_sehat">Surat Sehat (opsional)</label>
                                  <input type="file" class="form-control-file" id="file_surat_sehat" name="file_surat_sehat">  
                                  <p class="card-description mt-1">
                                    Format file: pdf&emsp;Maksimal ukuran file: 2MB
                                  </p>
                                </div>
                                <div class="col-md-6">
                                  <label for="file_tambahan">Dokumen Lainnya (opsional)</label>
                                  <input type="file" class="form-control-file" id="file_tambahan" name="file_tambahan">  
                                  <p class="card-description mt-1">
                                    Format file: pdf&emsp;Maksimal ukuran file: 2MB
                                  </p>
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

                    <!-- Aksi: Lihat -->
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewprajabatan-<?= $value->id ?>">Lihat</button>
                    <!-- Modal -->
                    <div id="viewprajabatan-<?= $value->id ?>" class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                              </div>
                              <div class="form-group">
                                <label for="jenis_tujuan">Jenis Pegawai Tujuan Surat</label>
                                <input type="text" class="form-control" id="jenis_tujuan" value="<?=ucwords($value->jenis_tujuan) ?>" disabled>
                              </div>
                              <div class="form-group">
                                <label for="tema">Tema/Judul Kegiatan (*)</label>
                                <input type="text" class="form-control" id="tema" value="<?=$value->tema ?>" disabled>
                              </div>
                              <div class="form-group row">
                                <div class="col-md-6">
                                  <label for="subjek">Subjek Surat (*)</label>
                                  <input type="text" class="form-control" id="subjek" value="<?php if($value->jenis_tujuan == 'semua') { echo 'Semua'; } else if($value->jenis_tujuan == 'divisi') { echo 'Spesifik'; } else if($value->jenis_tujuan == 'perorangan') { echo ucwords('Spesifik'); } ?>" disabled>
                                </div>
                                <div class="col-md-6" id="detail_subjek">
                                  <?php if($value->jenis_tujuan != 'semua') { ?>
                                  <label for="jenis_tujuan">Jenis Pegawai Tujuan Surat (*)</label>
                                  <input type="text" class="form-control" id="jenis_tujuan" value="<?=ucwords($value->jenis_tujuan) ?>" disabled>
                                  <?php } ?>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-md-6">
                                  <label for="file_surat">File Materi</label>
                                  <div class="mt-1">
                                    <?php
                                    if(isset($list_prajabatan_hasil[$value->id])) { ?>
                                    <a href="<?= base_url().'uploads/'.$list_prajabatan_berkas[$value->id]->file_materi ?>" target="_blank">                              
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
                                    if(isset($list_prajabatan_hasil[$value->id])) {
                                    ?>
                                    <a href="<?= base_url().'uploads/'.$list_prajabatan_hasil[$value->id]->nama_serti ?>" target="_blank">                              
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
                              <div class="form-group">
                                <label for="angka_kredit">Angka Kredit</label>
                                <?php
                                if(isset($list_diklat_hasil[$value->id])) {
                                ?>
                                <input type="text" class="form-control" id="angka_kredit" value="<?= $list_diklat_hasil[$value->id]->angka_kredit ?>" disabled>
                                <?php } else { ?>
                                <input type="text" class="form-control" id="angka_kredit" value="" disabled>
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

                    <!-- Aksi: Batalkan -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable-<?= $value->id ?>">
                      Batalkan
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="deletetable-<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Batalkan Prajabatan dengan No. Surat : <b><?= $value->no ?></b> </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Apakah anda yakin untuk membatalkan pemberkasan ini?
                          </div>
                          <div class="modal-footer">
                            <form action="<?= base_url(); ?>prajabatan/delete" method="post" class="forms-sample" enctype="multipart/form-data">
                              <input type="hidden" name="prajabatan_id" value="<?= $list_prajabatan_berkas[$value->id]->id ?>">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                              <button type="submit" class="btn btn-danger">Ya</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal -->

                    <?php
                    if($has_upload_hasil[$value->id] == 0) {
                    ?>
                    <!-- Aksi: Unggah Hasil -->
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#hasil-<?= $value->id ?>">
                      Unggah Hasil
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="hasil-<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Unggah Hasil Prajabatan dengan No. Surat : <b><?= $value->no ?></b> </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="<?= base_url() ?>prajabatan/hasil" method="post" class="forms-sample" enctype="multipart/form-data">
                            <div class="modal-body">
                              <input type="hidden" id="prajabatan_id" name="prajabatan_id" value=<?= $check_prajabatan[$value->id] ?>>
                              <div class="form-group">
                                <label for="file_materi">Materi Hasil Prajabatan (*)</label>
                                <input type="file" class="form-control-file" id="file_materi" name="file_materi">  
                              </div>
                              <div class="form-group">
                                <label for="file_sertifikat">Sertifikat Prajabatan (*)</label>
                                <input type="file" class="form-control-file" id="file_sertifikat" name="file_sertifikat">  
                              </div>
                              <div class="form-group">
                                <label for="angka_kredit">Angka Kredit (*)</label>
                                <input type="text" class="form-control" id="angka_kredit" name="angka_kredit" placeholder="Angka Kredit" required> 
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
                      <button type="button" class="btn btn-warning" disabled>Hasil Terunggah</button>
                    <?php } ?>
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