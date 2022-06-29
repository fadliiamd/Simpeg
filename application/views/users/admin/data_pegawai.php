<div class="row">
    <div class="col-lg-12">
        <h3>Data Pegawai</h3>

        <!-- Large modal -->
        <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Data Pegawai</button>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id_aju_mutasi">NIP</label>
                                <input class="form-control" id="nama" name="nip">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="id_aju_mutasi">Jurusan</label>
                                    <select class="form-control" id="id_aju_mutasi" name="id_jurusan">
                                        <option>1</option>
                                        <option>2</option>
                                    </select>
                                </div>
                                <div class="col-md-4">

                                    <label for="id_aju_mutasi">Bagian</label>
                                    <select class="form-control" id="id_aju_mutasi" name="id_bagian">
                                        <option>1</option>
                                        <option>2</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="id_aju_mutasi">Unit</label>
                                    <select class="form-control" id="id_aju_mutasi" name="id_unit">
                                        <option>1</option>
                                        <option>2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="SK_CPNS">SK CPNS</label>
                                    <input type="file" class="form-control-file" id="SK_CPNS" name="SK_CPNS">
                                </div>
                                <div class="col-md-3">
                                    <label for="SK_PNS">SK PNS</label>
                                    <input type="file" class="form-control-file" id="SK_PNS" name="SK_PNS">
                                </div>
                                <div class="col-md-3">
                                    <label for="Pangkat_akhir">Pangkat Akhir</label>
                                    <input type="file" class="form-control-file" id="Pangkat_akhir" name="Pangkat_akhir">
                                </div>
                                <div class="col-md-3">
                                    <label for="karpeg">Karpeg</label>
                                    <input type="file" class="form-control-file" id="karpeg" name="karpeg">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="DP3_akhir">DP3 Akhir</label>
                                    <input type="file" class="form-control-file" id="DP3_akhir" name="DP3_akhir">
                                </div>
                                <div class="col-md-3">
                                    <label for="ijazah">Ijazah</label>
                                    <input type="file" class="form-control-file" id="ijazah" name="ijazah">
                                </div>
                                <div class="col-md-3">
                                    <label for="riwayat_hidup">Riwayat Hidup</label>
                                    <input type="file" class="form-control-file" id="riwayat_hidup" name="riwayat_hidup">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Tambah Pegawai</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <div class="table-responsive">
            <table id="tbl-data-pegawai" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Pangkat Golongan</th>
                        <th>Jurusan</th>
                        <th>Unit</th>
                        <th>Bagian</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>20001240011</td>
                        <td>Roles Gonxales</td>
                        <td>RolesGonxales@gmail.com</td>
                        <td>PNS/Honores</td>
                        <td>III-A</td>
                        <td>Teknik Komputer dan Informatika</td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                            <!-- Large modal -->
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target=".edittable">Edit</button>

                            <!-- Modal -->
                            <div class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Pegawai NIP : <b>2<b></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="forms-sample">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="id_aju_mutasi">NIP</label>
                                                    <select class="form-control" id="id_aju_mutasi" name="id_aju_mutasi">
                                                        <option>1</option>
                                                        <option>2</option>
                                                    </select>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label for="SK_CPNS">SK CPNS</label>
                                                        <input type="file" class="form-control-file" id="SK_CPNS" name="SK_CPNS">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="SK_PNS">SK PNS</label>
                                                        <input type="file" class="form-control-file" id="SK_PNS" name="SK_PNS">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="Pangkat_akhir">Pangkat Akhir</label>
                                                        <input type="file" class="form-control-file" id="Pangkat_akhir" name="Pangkat_akhir">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="karpeg">Karpeg</label>
                                                        <input type="file" class="form-control-file" id="karpeg" name="karpeg">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label for="DP3_akhir">DP3 Akhir</label>
                                                        <input type="file" class="form-control-file" id="DP3_akhir" name="DP3_akhir">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="ijazah">Ijazah</label>
                                                        <input type="file" class="form-control-file" id="ijazah" name="ijazah">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="riwayat_hidup">Riwayat Hidup</label>
                                                        <input type="file" class="form-control-file" id="riwayat_hidup" name="riwayat_hidup">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                <button type="submit" class="btn btn-primary">Tambah Berkas Pesyaratan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->

                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable">Hapus</button>

                            <!-- Modal -->
                            <div class="modal fade" id="deletetable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pegawai NIP : <b>2</b> </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-danger">Hapus Mutasi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#deletetable">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tbl-data-pegawai').DataTable();
    });
</script>