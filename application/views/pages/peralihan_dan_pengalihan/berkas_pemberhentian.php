<div class="row">
	<div class="col-lg-12">
        <h3>Berkas Persyaratan</h3>

        <!-- Large modal -->
        <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Berkas Persyaratan</button>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Berkas Persyaratan</h5>
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

        <div class="table-responsive">
            <table id="tbl-pengajuan-mutasi" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>SK CPNS</th>
                        <th>SK PNS</th>
                        <th>Pangkat Akhir</th>
                        <th>Karpeg</th>
                        <th>DP3 Akhir</th>
                        <th>Ijazah</th>
                        <th>Riwayat Hidup</th>
                        <th>Status Pertujuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>Caritana Photo</td>
                        <td>Caritana Photo</td>
                        <td>Caritana Photo</td>
                        <td>Caritana Photo</td>
                        <td>Caritana Photo</td>
                        <td>Caritana Photo</td>
                        <td>Caritana Photo</td>
                        <td>
                            <span class="badge badge-warning">Pending</span>
                            <div class="mt-3">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetable">
                                    Setujui
                                </button>

<!-- Modal -->
<div class="modal fade" id="approvetable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Setujui Berkas Persyaratan NIP : <b>2</b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Setujui Berkas</button>
            </div>
        </div>
    </div>
</div>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noapprovetable">
                                    Tolak
                                </button>

<!-- Modal -->
<div class="modal fade" id="noapprovetable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tolak Berkas Persyaratan NIP : <b>2</b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Tolak Berkas</button>
            </div>
        </div>
    </div>
</div>
                            </div>
                        </td>
                        <td>
                        <!-- Large modal -->
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target=".edittable">Edit</button>

<!-- Modal -->
<div class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Berkas Persyaratan NIP : <b>2<b></h5>
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

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable">
                        Hapus
                        </button>

<!-- Modal -->
<div class="modal fade" id="deletetable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Berkas Persyaratan NIP : <b>2</b> </h5>
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

                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#deletetable">
                        Unduh
                        </button>

                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>SK CPNS</th>
                        <th>SK PNS</th>
                        <th>Pangkat Akhir</th>
                        <th>Karpeg</th>
                        <th>DP3 Akhir</th>
                        <th>Ijazah</th>
                        <th>Riwayat Hidup</th>
                        <th>Status Pertujuan</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>