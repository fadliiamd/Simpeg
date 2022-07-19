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
    <h4>Hasil Perangkingan</h4>
    
    <?php if ($this->session->userdata('jabatan') != 'Kepala Bagian Umum') { ?>
    <div class="my-3">
      <a href="<?= base_url("hasil/perhitungan") ?>">
        <button type="button" class="btn btn-primary">Hitung Hasil</button>
      </a>
    </div>
    <?php } ?>
        
    <form action="<?= base_url("hasil/pengajuan") ?>" method="POST" enctype="multipart/form-data">
      <div class="table-responsive">
        <table id="list_hasil_perangkingan" class="table table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>Pilih</th>
              <th>No</th>
              <th>NIP</th>
              <th>Nama Pegawai</th>
              <th>Jenis Pegawai</th>
              <th>Nilai Rank</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $no = 1;
              foreach ($pegawai as $key => $value){ ?>
                <tr>
                  <td><input type="checkbox" name="checklist_id[]" value="<?= $value->account_nip ?>"></td>
                  <td><?= $no ?></td>
                  <td><?= $value->account_nip ?></td>
                  <td><?= $value->nama ?></td>
                  <td>
                    <?php if($value->jabatan_id != NULL) { ?>
                    <?= $list_jabatan[$value->jabatan_id]->nama_jabatan ?>
                    <?php  }?>
                  </td>
                  <td><?= $value->nilai_rank ?></td>
                </tr>
              <?php
              $no++;
              }
            ?>
          </tbody>        
        </table>
      </div>
      <div class="my-3">
        <!-- Large modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#choose_surat">Ajukan Perangkingan</button>

        <!-- Modal -->
        <div id="choose_surat" class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Surat Undangan<b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="surat_id">Pilih Surat/No. Surat Undangan (*)</label>
                  <select class="form-control" id="surat_id" name="surat_id" required>
                    <option value="" selected>--- Pilih Surat ---</option>
                    <?php
                    $list_surat = json_decode(json_encode($list_surat), true);
                    foreach($list_surat as $el) {
                      echo '<option value="'.$el["id"].'">'.$el["no"].' - "'.$el["tema"].'"</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Ajukan Perangkingan</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal -->
      </div>
    </form>
  </div>
</div>