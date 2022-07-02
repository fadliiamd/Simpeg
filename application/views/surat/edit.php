<!-- partial -->
<div class="main-panel">        
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Edit Surat: {{No. Surat}}</h4>
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
              <div class="form-group">
                <label>Unggah Surat</label>
                <input type="file" name="img[]" class="file-upload-default">
                <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                  </span>
                </div>
                <a href="#">Download Surat: {{nama_file}}</a>
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
  