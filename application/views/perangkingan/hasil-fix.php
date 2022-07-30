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
      <div class="d-flex">
        <div class="my-3 mr-3">
          <a href="<?= base_url("hasil/perhitungan") ?>">
            <button type="button" class="btn btn-primary">Hitung Hasil</button>
          </a>
        </div>
        <div class="my-3">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filter">Filter</button>
        </div>
      </div>
      <div id="filter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><b>Filter Berdasarkan :</b></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
            function checked($param, $value)
            {
              if (isset($_GET[$param])) {
                if (is_array($_GET[$param])) {
                  return in_array($value, $_GET[$param]) ? "checked" : "";
                } else {
                  return $_GET[$param] == $value ? "checked" : "";
                }
              } else {
                return "";
              }
            }
            ?>
            <form method="GET" action="<?= base_url('hasil') ?>" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-4">
                    <b>Mulai Masuk</b>
                    <input type="date" id="tgl_masuk@>=" class="form-control" value="<?= isset($_GET['tgl_masuk@>=']) ? $_GET['tgl_masuk@>='] : "" ?>" style="margin:10px 0px">
                    <input class="form-check-input ml-0" name="tgl_masuk@>=" type="checkbox" value="" hidden>
                  </div>
                  <div class="col-md-4">
                    <b>Pendidikan</b><br>
                    <?php
                    $label_pendidikan = [
                      "SMA", "D3", "S1", "S2", "S3"
                    ];
                    foreach ($label_pendidikan as $key => $value) { ?>
                      <div class="form-check form-check-inline" style="display:inline-flex">
                        <input class="form-check-input ml-0" name="pendidikan[]" type="checkbox" id="lp<?= $key ?>" value="<?= $value ?>" <?= checked("pendidikan", $value) ?>>
                        <label class="form-check-label ml-0" for="lp<?= $key ?>"><?= $value ?></label>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                  <div class="col-md-4">
                    <b>Jenis Pegawai</b><br>
                    <?php
                    $label_jp = [
                      "fungsional", "struktural"
                    ];
                    foreach ($label_jp as $key => $value) { ?>
                      <div class="form-check form-check-inline" style="display:inline-flex">
                        <input class="form-check-input ml-0" type="checkbox" name="jenis_jabatan[]" id="jp<?= $key ?>" value="<?= $value ?>" <?= checked("jenis_jabatan", $value) ?>>
                        <label class="form-check-label ml-0 text-capitalize" for="jp<?= $key ?>"><?= $value ?></label>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">
                    <b>Jurusan</b>
                    <?php
                    foreach ($jurusan as $key => $value) { ?>
                      <div class="form-check">
                        <input class="form-check-input ml-0" type="checkbox" name="jurusan_id[]" value="<?= $value->id ?>" id="jurusan<?= $key ?>" <?= checked("jurusan_id", $value->id) ?>>
                        <label class="form-check-label" for="jurusan<?= $key ?>">
                          <?= $value->nama ?>
                        </label>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                  <div class="col-md-4">
                    <b>Bagian</b>
                    <?php
                    foreach ($bagian as $key => $value) { ?>
                      <div class="form-check">
                        <input class="form-check-input ml-0" type="checkbox" name="bagian_id[]" value="<?= $value->id ?>" id="bagian<?= $key ?>" <?= checked("bagian_id",  $value->id) ?>>
                        <label class="form-check-label" for="bagian<?= $key ?>">
                          <?= $value->nama ?>
                        </label>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                  <div class="col-md-4">
                    <b>Unit</b>
                    <?php
                    foreach ($unit as $key => $value) { ?>
                      <div class="form-check">
                        <input class="form-check-input ml-0" type="checkbox" name="unit_id[]" value="<?= $value->id ?>" id="unit<?= $key ?>" <?= checked("unit_id",  $value->id) ?>>
                        <label class="form-check-label" for="unit<?= $key ?>">
                          <?= $value->nama ?>
                        </label>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">
                    <b>Jabatan</b>
                    <?php
                    foreach ($jabatan as $key => $value) { ?>
                      <div class="form-check">
                        <input class="form-check-input ml-0" type="checkbox" name="jabatan_id[]" value="<?= $value->id ?>" id="jabatan<?= $key ?>" <?= checked("jabatan_id",  $value->id) ?>>
                        <label class="form-check-label" for="jabatan<?= $key ?>">
                          <?= $value->nama_jabatan ?>
                        </label>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                  <div class="col-md-4">
                    <b>Bidang Keahlian</b>
                    <?php
                    foreach ($bidang_keahlian as $key => $value) { ?>
                      <div class="form-check">
                        <input class="form-check-input ml-0" type="checkbox" name="bidang_keahlian_id[]" value="<?= $value->id_keahlian ?>" id="keahlian<?= $key ?>" <?= checked("bidang_keahlian_id",  $value->id_keahlian) ?>>
                        <label class="form-check-label" for="keahlian<?= $key ?>">
                          <?= $value->nama_keahlian ?>
                        </label>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                  <div class="col-md-4">
                    <b>Sertifikat Kegiatan</b>
                    <?php
                    $curr_tema = [];
                    foreach ($sertifikat as $key => $value) {                      
                      $tema = str_replace('_', ' ', explode("-", $value->nama_serti)[1]);
                      if (!in_array($tema, $curr_tema)) { ?>
                        <div class="form-check">
                          <input class="form-check-input ml-0" type="checkbox" name="nama_serti[]" value="<?= explode("-", $value->nama_serti)[1] ?>" id="serti<?= $key ?>" <?= checked("nama_serti",  explode("-", $value->nama_serti)[1]) ?>>
                          <label class="form-check-label" for="serti<?= $key ?>">
                            <?php
                            echo $tema;
                            array_push($curr_tema, $tema);
                            ?>
                          </label>
                        </div>
                      <?php
                      }
                      ?>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Filter</button>
              </div>
            </form>
          </div>
        </div>
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
                  <td><?= $value->nilai_rank ?></td>
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
                    foreach ($list_surat as $el) {
                      echo '<option value="' . $el["id"] . '">' . $el["no"] . ' - "' . $el["tema"] . '"</option>';
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

<script>
  $('input[type="date"]').on('change', function() {
    var id = $(this).attr("id");
    var value = $(this).val();

    $('input[name="' + id + '"').val(value);
    $('input[name="' + id + '"').attr("checked", true);
  });
</script>