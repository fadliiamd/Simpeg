<div class="row">
  <div class="col-lg-12">
    <h4>Perangkingan</h4>

    <div class="table-responsive pt-3 text-dark">
      <form class="forms-sample" action="<?= base_url('kriteria/simpan_mpb') ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <table class="table table-bordered">
            <thead>
              <tr style="text-align: center;">
                <th colspan="5">
                  Matriks Perbandingan Berpasangan
                </th>
              </tr>
              <tr style="text-align: center;">
                <th>
                  Kriteria
                </th>
                <?php foreach ($kriteria as $key => $value) {
                  echo "<th>" . $value->nama . "</th>";
                } ?>
              </tr>
            </thead>
            <tbody>
              <?php
              $baris = 1;
              foreach ($kriteria as $key => $b) {
                $kolom = 1;
              ?>
                <tr>
                  <th style="text-align: center;">
                    <?= $b->nama ?>
                  </th>
                  <?php foreach ($kriteria as $key => $k) { ?>
                    <td>
                      <div class="form-group" style="margin-bottom: 0;">
                        <?php
                        if ($kolom > $baris) {
                          $option_format = '';
                          for ($val = 1; $val <= 9; $val++) {
                            $option_format .= '<option value="' . $val . '">' . $val . '</option>';
                          }
                          $format = '<select 
                        id="' . $baris . '-' . $kolom . '" 
                        name="' . $b->id . '-' . $k->id . '" class="form-control form-control-sm text-dark">
                          ' . $option_format . '
                        </select>';
                        } else {
                          $option_format = '';
                          for ($val = 1; $val <= 9; $val++) {
                            $option_format .= '<option value="' . $val . '">' . $val . '</option>';
                          }
                          $format = '<select 
                        id="' . $baris . '-' . $kolom . '" 
                        name="' . $b->id . '-' . $k->id . '" class="form-control form-control-sm text-dark" disabled>
                          ' . $option_format . '
                        </select>';
                        }
                        echo $format;
                        ?>
                      </div>
                    </td>
                  <?php
                    $kolom++;
                  } ?>
                  </th>
                </tr>
              <?php
                $baris++;
              } ?>
            </tbody>
            <thead>
              <tr style="text-align: center;">
                <th style="vertical-align: middle;">
                  Jumlah
                </th>
                <?php foreach (range(1, count($kriteria)) as $i) { ?>
                  <th id="jmlh-<?= $i ?>">
                    1
                  </th>
                <?php } ?>
              </tr>
            </thead>
          </table>
        </div>
        <div class="form-group">
          <button id="load" type="button" class="btn btn-primary">Load Matriks</button>
          <button type="submit" class="btn btn-primary">Simpan Matriks</button>
        </div>
      </form>

      <hr />
      <!-- <form class="forms-sample">
        <div class="form-group">
          <table class="table table-bordered">
            <thead>
              <tr style="text-align: center;">
                <th colspan="7">
                  Matriks Nilai Kriteria
                </th>
              </tr>
              <tr style="text-align: center;">
                <th>
                  Kriteria
                </th>
                <th>
                  A
                </th>
                <th>
                  B
                </th>
                <th>
                  C
                </th>
                <th>
                  D
                </th>
                <th>
                  Jumlah
                </th>
                <th>
                  Prioritas
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th style="text-align: center;">
                  A
                </th>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
              <tr>
                <th style="text-align: center;">
                  B
                </th>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
              <tr>
                <th style="text-align: center;">
                  C
                </th>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
              <tr>
                <th style="text-align: center;">
                  D
                </th>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </form> -->

      <hr />
      <!-- <form class="forms-sample">
        <div class="form-group">
          <table class="table table-bordered">
            <thead>
              <tr style="text-align: center;">
                <th colspan="7">
                  Matriks Penjumlahan Tiap Baris
                </th>
              </tr>
              <tr style="text-align: center;">
                <th>
                  Kriteria
                </th>
                <th>
                  A
                </th>
                <th>
                  B
                </th>
                <th>
                  C
                </th>
                <th>
                  D
                </th>
                <th>
                  Jumlah
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th style="text-align: center;">
                  A
                </th>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
              <tr>
                <th style="text-align: center;">
                  B
                </th>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
              <tr>
                <th style="text-align: center;">
                  C
                </th>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
              <tr>
                <th style="text-align: center;">
                  D
                </th>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </form> -->

      <hr />
      <!-- <form class="forms-sample">
        <div class="form-group">
          <table class="table table-bordered">
            <thead>
              <tr style="text-align: center;">
                <th colspan="7">
                  Rasio Konsistensi
                </th>
              </tr>
              <tr style="text-align: center;">
                <th>
                  Kriteria
                </th>
                <th>
                  Jumlah Per Baris
                </th>
                <th>
                  Prioritas
                </th>
                <th>
                  Hasil
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th style="text-align: center;">
                  A
                </th>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
              <tr>
                <th style="text-align: center;">
                  B
                </th>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
              <tr>
                <th style="text-align: center;">
                  C
                </th>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
              <tr>
                <th style="text-align: center;">
                  D
                </th>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
            </tbody>
            <thead>
              <tr style="text-align: center;">
                <th style="vertical-align: middle;" colspan="3">
                  Total
                </th>
                <th>
                  6
                </th>
              </tr>
            </thead>
          </table>
        </div>
      </form> -->

      <hr />
      <!-- <form class="forms-sample">
        <div class="form-group">
          <table class="table table-bordered">
            <thead>
              <tr style="text-align: center;">
                <th colspan="7">
                  Hasil Perhitungan
                </th>
              </tr>
              <tr style="text-align: center;">
                <th>
                  Keterangan
                </th>
                <th>
                  Nilai
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="text-align: center;">
                  Jumlah
                  </th>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="text-align: center;">
                  n (Jumlah Kriteria)
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="text-align: center;">
                  Maks (Jumlah/n)
                  </th>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="text-align: center;">
                  CI (Maks-n/n)
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="text-align: center;">
                  CR (CI/IR)
                </td>
                <td>
                  <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control" value="1" disabled>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </form> -->
    </div>
  </div>
</div>

<script>
  $('select').on('change', function() {
    var idx_mtx = this.id;
    var idx_mtx_bar = this.id.split('-')[0];
    var idx_mtx_col = this.id.split('-')[1];
    var max_mtx = <?= count($kriteria) ?>;

    var nilai_invers = 1 / parseInt(this.value);
    var jmlh = 0;

    $('#' + idx_mtx_col + '-' + idx_mtx_bar).append('<option value="' + nilai_invers + '" selected>' + nilai_invers + '</option>');
    $('#' + idx_mtx_col + '-' + idx_mtx_bar).val(nilai_invers);

    for (j = 1; j <= max_mtx; j++) {
      jmlh = 0;
      for (i = 1; i <= max_mtx; i++) {
        jmlh += parseFloat($('#' + i + '-' + j).val());
      }
      $('#jmlh-' + j).html(jmlh);
    }
  });

  $("#load").click(function(e) {
    e.preventDefault();
    $.ajax({
      type: 'get',
      dataType: 'json',
      url: "<?= base_url('kriteria/get_nilai_mbp'); ?>",
      data: $(this).serialize(),
      error: function() {
        console.log("error");
      },
      beforeSend: function() {
        console.log("bentar lagi before send");
      },
      success: function(x) {
        if (x.status == "ok") {
          $.each(x.data, function(key, d) {
            // $('select[name="' + d.dari_kriteria + '-' + d.ke_kriteria + '"] option[value="' + d.nilai + '"]').attr('selected', true);
            $('select[name="' + d.dari_kriteria + '-' + d.ke_kriteria + '"]').val(d.nilai);
            $('select[name="' + d.dari_kriteria + '-' + d.ke_kriteria + '"]').trigger("change")
          });
        } else {
          console.log("error tapi ya gitu lah success");
        }
      },
    });
  });
</script>