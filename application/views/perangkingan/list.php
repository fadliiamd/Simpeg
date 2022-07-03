<div class="row">
  <div class="col-lg-12">
    <h4>Perangkingan</h4>

    <div class="table-responsive">
      <table id="tbl-pengajuan-mutasi" class="table table-striped table-bordered">
        <thead class="thead-dark">
          <tr>
            <th>No. Surat</th>
            <th>Tujuan Surat</th>
            <th>Kriteria</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>01.003/SMA-SM/V/2022</td>
            <td>Perorangan</td>
            <td>
              <ol>
                <li>Jenis Sertifikat</li>
                <li>Usia</li>
              </ol>
            </td>
            <td>
              <a href="<?=base_url(); ?>perangkingan/perhitungan">
                <button type="button" class="btn btn-info">Perhitungan</button>
              </a>
              <a href="<?=base_url(); ?>perangkingan/hasil">
                <button type="button" class="btn btn-success">Hasil Perangkingan</button>
              </a>
              <a href="<?=base_url(); ?>perangkingan/hasil_fix">
                <button type="button" class="btn btn-success">Hasil Perangkingan (FIX)</button>
              </a>
            </td>
          </tr>
          <tr>
            <td>02.010/SMA-SM/V/2022</td>
            <td>Unit</td>
            <td>
              <ol>
                <li>Jenis Sertifikat</li>
                <li>Usia</li>
              </ol>
            </td>
            <td>
              <a href="<?=base_url(); ?>perangkingan/perhitungan">
                <button type="button" class="btn btn-info">Perhitungan</button>
              </a>
              <a href="<?=base_url(); ?>perangkingan/hasil">
                <button type="button" class="btn btn-success">Hasil Perangkingan</button>
              </a>
              <a href="<?=base_url(); ?>perangkingan/hasil_fix">
                <button type="button" class="btn btn-success">Hasil Perangkingan (FIX)</button>
              </a>
            </td>
          </tr>
        </tbody>
        <tfoot class="thead-dark">
          <tr>
            <th>No. Surat</th>
            <th>Tujuan Surat</th>
            <th>Kriteria</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>