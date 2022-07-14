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
    <h4>Daftar Hasil Perangkingan</h4>    
    <form action="<?= base_url("hasil/pengajuan") ?>" method="POST" enctype="multipart/form-data">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-datatable">
          <thead class="thead-dark">
            <tr>
              <th>No. Surat</th>
              <th>Diajukan oleh</th>
              <th>Tanggal Perangkingan</th>
              <th>Pegawai</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            foreach ($list_perangkingan as $key => $value) {
            ?>
              <tr>
                <td><?= $list_surat[$value->id]->no ?></td>
                <td><?= $value->created_by ?></td>
                <td><?= date_indo($value->created_at) ?></td>
                <td>
                  <!-- Large modal -->
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#read-act-<?= $value->id ?>">Lihat</button>

                <!-- Modal -->
                <div id="read-act-<?= $value->id ?>" class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Daftar Pegawai Hasil Perangkingan berdasarkan No. Surat <b><?= $value->surat_id ?><b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="<?= base_url(); ?>surat/update" method="post" class="forms-sample" enctype="multipart/form-data">
                        <div class="modal-body">
                          <div class="table-responsive">
                            <table id="list_surat" class="table table-striped table-bordered">
                              <thead class="thead-dark">
                                <tr>
                                  <th>No</th>
                                  <th>NIP</th>
                                  <th>Nama Pegawai</th>
                                  <th>Jenis Pegawai</th>
                                  <th>Nilai Rank</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $no2 = 1;
                                foreach($list_hasilperangkingan[$value->id] as $key2 => $value2) { ?>
                                  <tr>
                                    <td><?=$no2 ?></td>
                                    <td><?=$value2->account_nip ?></td>
                                    <td><?=$value2->nama ?></td>
                                    <td>
                                      <?php if(!is_null($value2->jabatan_id)){ ?>
                                        <?= $list_jabatan[$value2->jabatan_id]->nama_jabatan ?>
                                      <?php
                                      }?>                                      
                                    </td>
                                    <td><?=$value2->nilai_rank ?></td>
                                  </tr>
                                <?php $no2++;
                                } ?>
                              </tbody>      
                            </table>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->
                </td>
                <td>
                  <?php if($value->status_persetujuan == 2) { ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approve-act-<?=$value->id ?>">
                      Setujui
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="approve-act-<?=$value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Setujui Perangkingan pada Nomor Surat <b><?=$value->surat_id ?></b> </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Apakah anda yakin untuk menyetujui hasil perangkingan ini?
                          </div>
                          <div class="modal-footer">
                            <form action="<?= base_url(); ?>hasil/persetujuan" method="post" class="forms-sample" enctype="multipart/form-data">
                              <input type="hidden" name="perangkingan_id" value="<?=$value->id; ?>">
                              <input type="hidden" name="aksi" value="setujui">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                              <button type="submit" class="btn btn-success">Ya</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reject-act-<?=$value->id ?>">
                      Tolak
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="reject-act-<?=$value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tolak Perangkingan pada Nomor Surat <b><?=$value->surat_id ?></b> </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Apakah anda yakin untuk menolak hasil perangkingan ini?
                          </div>
                          <div class="modal-footer">
                            <form action="<?= base_url(); ?>hasil/persetujuan" method="post" class="forms-sample" enctype="multipart/form-data">
                              <input type="hidden" name="perangkingan_id" value="<?=$value->id; ?>">
                              <input type="hidden" name="aksi" value="tolak">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                              <button type="submit" class="btn btn-danger">Ya</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } else if($value->status_persetujuan == 1) { ?>
                    <button type="button" class="btn btn-success" disabled>Disetujui</button>
                  <?php } else { ?>
                    <button type="button" class="btn btn-danger" disabled>Ditolak</button>
                  <?php } ?>
                </td>
              </tr>
            <?php
            $no++;
            }
            ?>
          </tbody>        
        </table>
      </div>
    </form>
  </div>
</div>