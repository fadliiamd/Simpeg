<div class="row">
  <div class="col-lg-12">
    <h4>Surat</h4>

    <!-- Large modal -->
    <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Unggah Surat</button>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="modal_unggah_surat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Unggah Surat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="forms-sample">
            <div class="modal-body">
              <div class="form-group">
                <label for="no_surat">Nomor Surat</label>
                <input type="text" class="form-control" id="no_surat" placeholder="Nomor Surat">
              </div>
              <div class="form-group">
                <label for="tujuan">Tujuan Surat</label>
                <div class="col-sm-5">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="tujuan" id="tujuan3" value="semua">
                      Semua
                    </label>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="tujuan" id="tujuan1" value="perorangan">
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
              <div id="tujuan_section"></div>
              <div class="form-group">
                <label for="jenis_surat">Jenis Kegiatan</label>
                <select class="form-control" id="jenis_ke">
                  <option>--- Jenis Kegiatan ---</option>
                  <option value="tugas">Diklat</option>
                  <option value="undangan">Bimtek</option>
                  <option value="prajabatan">Prajabatan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="jenis_surat">Jenis Surat</label>
                <select class="form-control" id="jenis_surat">
                  <option>--- Jenis Surat ---</option>
                  <option value="tugas">Surat Tugas</option>
                  <option value="undangan">Surat Undangan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="file_surat">File Surat</label>
                <input type="file" class="form-control-file" id="file_surat" name="file_surat">
              </div>
              <hr />
              <div id="kriteria_section"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-primary">Tambah Surat</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End Modal -->

    <div class="table-responsive">
      <table id="tbl-pengajuan-mutasi" class="table table-striped table-bordered">
        <thead class="thead-dark">
          <tr>
            <th>No. Surat</th>
            <th>Tujuan</th>
            <th>Detail Tujuan</th>
            <th>Tanggal</th>
            <th>Jenis</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>01.003/SMA-SM/V/2022</td>
            <td>Perorangan</td>
            <td>
              <ol>
                <li>Arsal</li>
                <li>Nuno</li>
                <li>Sobri</li>
              </ol>
            </td>
            <td>24 Juni 2022</i></td>
            <td><label class="badge badge-warning">Surat Tugas</label></td>
            <td>
              <button type="button" class="btn btn-success">Lihat</button>

              <!-- Large modal -->
              <button type="button" class="btn btn-info" data-toggle="modal" data-target=".edittable">Edit</button>

              <!-- Modal -->
              <div class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Surat dengan No Surat : <b>01.003/SMA-SM/V/2022<b></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form class="forms-sample">
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="no_surat">Nomor Surat</label>
                          <input type="text" class="form-control" id="no_surat" placeholder="Nomor Surat">
                        </div>
                        <div class="form-group">
                          <label for="tujuan">Tujuan Surat</label>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="tujuan" id="tujuan3" value="semua">
                                Semua
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="tujuan" id="tujuan1" value="perorangan">
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
                        <div id="tujuan_section"></div>
                        <div class="form-group">
                          <label for="jenis_surat">Jenis Kegiatan</label>
                          <select class="form-control" id="jenis_ke">
                            <option>--- Jenis Kegiatan ---</option>
                            <option value="tugas">Diklat</option>
                            <option value="undangan">Bimtek</option>
                            <option value="prajabatan">Prajabatan</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="jenis_surat">Jenis Surat</label>
                          <select class="form-control" id="jenis_surat">
                            <option>--- Jenis Surat ---</option>
                            <option value="tugas">Surat Tugas</option>
                            <option value="undangan">Surat Undangan</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="file_surat">File Surat</label>
                          <input type="file" class="form-control-file" id="file_surat" name="file_surat">
                        </div>
                        <hr />
                        <div id="kriteria_section"></div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Tambah Surat</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- End Modal -->

              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable">
                Hapus
              </button>

              <!-- Modal -->
              <div class="modal fade" id="deletetable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Hapus Surat Keputusan Mutasi Id : <b>2</b> </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-danger">Hapus Surat Keputusan Mutasi</button>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>02.010/SMA-SM/V/2022</td>
            <td>Unit</td>
            <td>
              Perpustakaan
            </td>
            <td>30 Juni 2022</i></td>
            <td><label class="badge badge-warning">Surat Undangan</label></td>
            <td>
              <button type="button" class="btn btn-success">Lihat</button>

              <!-- Large modal -->
              <button type="button" class="btn btn-info" data-toggle="modal" data-target=".edittable">Edit</button>

              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable">
                Hapus
              </button>

              <!-- Modal -->
              <div class="modal fade" id="deletetable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Hapus Surat Keputusan Mutasi Id : <b>2</b> </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-danger">Hapus Surat Keputusan Mutasi</button>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
        <tfoot class="thead-dark">
          <tr>
            <th>No. Surat</th>
            <th>Tujuan</th>
            <th>Detail Tujuan</th>
            <th>Tanggal</th>
            <th>Jenis</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>