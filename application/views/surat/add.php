<!-- partial -->
<div class="main-panel">        
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Tambah/Unggah Surat</h4>
            <p class="card-description">
              Harap unggah surat dalam format pdf
            </p>
            <form class="forms-sample">
              <div class="form-group">
                <label for="no_surat">No Surat</label>
                <input type="text" class="form-control" id="no_surat" placeholder="Name">
              </div>
              <div class="form-group">
                <label for="tujuan">Tujuan Surat</label>
                <div class="col-sm-4">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="tujuan" id="tujuan1" value="perorangan" checked>
                      Perorangan
                    </label>
                  </div>
                </div>
                <div class="col-sm-5">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="tujuan" id="tujuan2" value="unit">
                      Unit
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="jenis_pegawai">Jenis Tujuan Pegawai</label>
                <select class="form-control" id="jenis_pegawai">
                  <option value="struktural">Struktural</option>
                  <option value="fungsional">Fungsional</option>
                </select>
              </div>
              <div class="form-group">
                <label for="pegawai">Pegawai</label>
                <select class="form-control" id="pegawai">
                  <option>Pilih Pegawai</option>
                  <option value="pegawai1">Pegawai 1</option>
                  <option value="pegawai2">Pegawai 2</option>
                </select>
              </div>
              <div class="form-group">
                <label for="jenis_surat">Jenis Surat</label>
                <select class="form-control" id="jenis_surat">
                  <option value="tugas">Surat Tugas</option>
                  <option value="undangan">Surat Undangan</option>
                </select>
              </div>
              <div class="form-group row">
                <div class="col-5">
                  <label>Kriteria</label>
                  <select class="form-control" id="kriteria_1">
                    <option>--- Pilih Kriteria ---</option>
                    <option value="kriteria_a">Kriteria 1</option>
                    <option value="kriteria_b">Kriteria 2</option>
                  </select>
                </div>
                <div class="col-5">
                  <label>Nilai</label>
                  <input type="text" class="form-control" name="nilai_1" placeholder="Nilai (1 s.d 5)">
                </div>
                <div class="col-2">
                  <label>More</label>
                  <button class="btn btn-success">Tambah Kriteria</button>
                </div>
              </div>
              <div class="form-group">
                <label>Unggah Surat</label>
                <input type="file" name="img[]" class="file-upload-default">
                <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                  </span>
                </div>
              </div>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  