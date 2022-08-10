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
    <h4>Pilih Pegawai Untuk Mengikuti Kegiatan</h4>

    <form action="<?= base_url(); ?>hasil" method="get" class="forms-sample">
      <div class="row d-flex align-items-center my-4">
        <div class="col-md-7">
          <select class="form-control" id="surat_id" name="surat_id" required>
            <option value="">--- Pilih Surat ---</option>
            <?php
            foreach ($list_all_surat as $item) {
              if(isset($_GET))
                $selected = $item->id === $_GET["surat_id"] ? "selected" : "";
            ?>
              <option value="<?= $item->id ?>" <?= $selected ?>><?= $item->no ?> - "<?= ucwords($item->tema) ?>"</option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-primary">Filter</button>
        </div>
      </div>
    </form>

    <!-- Aksi: Filter -->
    <!-- <div class="d-flex">
      <div class="my-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewdiklat">Filter</button>
      </div>
    </div> -->
    <!-- Modal -->
    <div id="viewdiklat" class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Filter Berdasarkan Surat<b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url(); ?>hasil" method="post" class="forms-sample">
            <div class="modal-body">
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="surat_id">Surat</label>
                  <select class="form-control" id="surat_id" name="surat_id" required>
                    <option>--- Pilih Surat ---</option>
                    <?php
                    foreach ($list_all_surat as $item) {
                    ?>
                      <option value="<?= $item->id ?>"><?= $item->no ?> - "<?= ucwords($item->tema) ?>"</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
              <button type="submit" name="delete_filter" class="btn btn-danger">Hapus Filter</button>
              <button type="submit" name="filter" class="btn btn-primary">Filter</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End Modal -->

    <form action="<?= base_url("hasil/pengajuan") ?>" method="POST" enctype="multipart/form-data">
      <div class="table-responsive">
        <table id="list_hasil_perangkingan" class="table table-striped table-bordered">
          <thead class="thead-dark">
            <tr class="text-center">
              <th rowspan="2">Pilih</th>
              <th rowspan="2">No</th>
              <th rowspan="2">NIP</th>
              <th rowspan="2">Nama Pegawai</th>
              <th rowspan="2">Jabatan</th>
              <th rowspan="2">Mulai Masuk</th>
              <th rowspan="2">Masa Kerja</th>
              <th rowspan="2">Pendidikan</th>
              <th rowspan="2">Jurusan</th>
              <th rowspan="2">Bagian</th>
              <th rowspan="2">Unit</th>
              <th rowspan="2">Bidang Keahlian</th>
              <th colspan="4">Sertifikat
                <!-- <th>Nilai Rank</th> -->
            </tr>
            <tr class="teext-center">
              <th>Diklat</th>
              <th>Bimtek</th>
              <th>Prajabatan</th>
              <th>Lainnya</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $CI = &get_instance();
            $CI->load->model(["diklat_model", "bimtek_model", "prajabatan_model", "sertifikat_model"]);
            $no = 1;
            if (!is_null($pegawai)) {
              foreach ($pegawai as $key => $value) { ?>
                <tr>
                  <td><input type="checkbox" name="checklist_id[]" value="<?= $value->account_nip ?>"></td>
                  <td><?= $no ?></td>
                  <td><?= $value->account_nip ?></td>
                  <td><?= $value->nama ?></td>
                  <td>
                    <?php if ($value->jabatan_id != NULL) { ?>
                      <?= $list_jabatan[$value->jabatan_id]->nama_jabatan ?>
                    <?php  } ?>
                  </td>
                  <td>
                    <?= $value->tgl_masuk ?>
                  </td>
                  <td>
                    <?= date_create($value->tgl_masuk)->diff(date_create('now'))->y ?> Tahun
                  </td>
                  <td>
                    <?= $value->pendidikan ?>
                  </td>
                  <td><?= $value->nama_jurusan ?></td>
                  <td><?= $value->nama_bagian ?></td>
                  <td><?= $value->nama_unit ?></td>
                  <td><?= $value->nama_keahlian ?></td>
                  <td style="max-width:200px;word-wrap:break-word;white-space:normal;">
                    <ul class="m-0">
                      <?php
                      $diklat = $CI->diklat_model->get_all_where(["diklat.pegawai_nip" => $value->account_nip]);
                      foreach ($diklat as $k => $v) { ?>
                        <li><a href="<?= base_url("uploads/" . $v->nama_serti) ?>" target="_blank"><?= $v->nama_serti ?></li>
                      <?php
                      }
                      ?>
                    </ul>
                  </td>
                  <td style="max-width:200px;word-wrap:break-word;white-space:normal;">
                    <ul class="m-0">
                      <?php
                      $bimtek = $CI->bimtek_model->get_all_where(["bimtek.pegawai_nip" => $value->account_nip]);
                      foreach ($bimtek as $k => $v) { ?>
                        <li><a href="<?= base_url("uploads/" . $v->nama_serti) ?>" target="_blank"><?= $v->nama_serti ?></li>
                      <?php
                      }
                      ?>
                    </ul>
                  </td>
                  <td style="max-width:200px;word-wrap:break-word;white-space:normal;">
                    <ul class="m-0">
                      <?php
                      $prajabatan = $CI->prajabatan_model->get_all_where(["prajabatan.pegawai_nip" => $value->account_nip]);
                      foreach ($prajabatan as $k => $v) { ?>
                        <li><a href="<?= base_url("uploads/" . $v->nama_serti) ?>" target="_blank"><?= $v->nama_serti ?></li>
                      <?php
                      }
                      ?>
                    </ul>
                  </td>
                  <td style="max-width:200px;word-wrap:break-word;white-space:normal;">
                    <ul class="m-0">
                      <?php
                      $sertifikat = $CI->sertifikat_model->get_all_where(["sertifikat.account_nip" => $value->account_nip, "sertifikat.tipe" => 'lainnya']);
                      foreach ($sertifikat as $k => $v) { ?>
                        <li><a href="<?= base_url("uploads/" . $v->nama_serti) ?>" target="_blank"><?= $v->nama_serti ?></li>
                      <?php
                      }
                      ?>
                    </ul>
                  </td>

                  <!-- <td><?= $value->nilai_rank ?></td> -->
                </tr>
              <?php
                $no++;
              }
            } else { ?>
              <tr>
                tidak ada
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="my-3">
        <input type="hidden" class="form-control" id="surat_id" name="surat_id" value="<?= isset($_GET["surat_id"]) ? $_GET["surat_id"] : "" ?>" required>
        
        <!-- Large modal -->
        <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#choose_surat" <?= isset($_GET["surat_id"]) ? "" : "disabled" ?>>Ajukan Pegawai</button>

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
                    foreach ($list_surat as $el) {
                      echo '<option value="' . $el["id"] . '">' . $el["no"] . ' - "' . $el["tema"] . '"</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Ajukan!</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal -->
      </div>
    </form>
  </div>
</div>

<script>
  function getYearDiff(count_year) {
    var curr_year = new Date().getFullYear();
    return curr_year - count_year;
  }

  $('#tgl_masuk').on('input', function() {
    var id = $(this).attr("id");
    var value = $(this).val();
    value = getYearDiff(value);
    console.log(value);
    $('#tgl_masuk_on').val(value);
  });
</script>