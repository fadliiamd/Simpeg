<div class="row">
  <div class="col-lg-12">
    <h4>Hasil Perangkingan</h4>
    
    <div class="my-3">
      <a href="<?= base_url("hasil/perhitungan") ?>">
        <button type="button" class="btn btn-primary">Hitung Hasil</button>
      </a>
    </div>
        
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
            $format = '';
            $no = 1;
            foreach ($pegawai as $key => $value){
              $format .= '
              <tr>
                <td></td>
                <td>'.$no.'</td>
                <td>'.$value->account_nip.'</td>
                <td>'.$value->nama.'</td>
                <td>'.$value->jenis_pegawai.'</td>
                <td>'.$value->nilai_rank.'</td>
              </tr>';
              $no++;
            }
            echo $format;
          ?>
        </tbody>        
      </table>
    </div>
  </div>
</div>