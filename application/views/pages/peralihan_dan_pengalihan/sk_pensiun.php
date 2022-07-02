<div class="row">
	<div class="col-lg-12">
        <h4>Surat Keputusan Pensiun</h4>

        <?php if($this->session->userdata("role") == "admin"){ ?>  
            <!-- Large modal -->
            <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Surat Keputusan Pensiun</button>

                <!-- Modal -->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Surat Keputusan Pensiun</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="forms-sample">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="tgl_pensiun">Tanggal Pensiun</label>
                                        <input type="date" class="form-control" id="tgl_pensiun" name="tgl_pensiun">
                                    </div>
                                    <div class="form-group">
                                        <label for="file_pensiun">File Pensiun</label>
                                        <input type="file" class="form-control-file" id="file_pensiun" name="file_pensiun">
                                    </div>
                                    <div class="form-group">
                                        <label for="usulan_pensiun">Usulan Pensiun</label>
                                        <select class="form-control" id="usulan_pensiun" name="usulan_pensiun">
                                            <option>A</option>
                                            <option>B</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                    <button type="submit" class="btn btn-primary">Tambah Surat Keputusan Pensiun</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
        <?php } ?>

        <div class="table-responsive">
            <table id="tbl-pengajuan-mutasi" class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Mutasi</th>
                        <th>File Mutasi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>2011-06-27</td>
                        <td>
                            <button type="button" class="btn btn-info">Lihat</button> 
                        </td>
                        <td>
                            <?php if($this->session->userdata("role") == "admin"){ ?>  
                                <!-- Large modal -->
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target=".edittable">Edit</button>

                                <!-- Modal -->
                                <div class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Surat Keputusan Pensiun Id : <b>2<b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="jenis_mutasi">Jenis Mutasi</label>
                                                        <select class="form-control" id="jenis_mutasi" name="jenis_mutasi">
                                                            <option>Mutasi Masuk</option>
                                                            <option>Mutasi Keluar</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tgl_mutasi">Tanggal Mutasi</label>
                                                        <input type="date" class="form-control" id="tgl_mutasi" name="tgl_mutasi">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="file_mutasi">File Mutasi</label>
                                                        <input type="file" class="form-control-file" id="file_mutasi" name="file_mutasi">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="usulan_mutasi">Usulan Mutasi</label>
                                                        <select class="form-control" id="usulan_mutasi" name="usulan_mutasi">
                                                            <option>A</option>
                                                            <option>B</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-primary">Edit Surat Keputusan Pensiun</button>
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Surat Keputusan Pensiun Id : <b>2</b> </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-danger">Hapus Surat Keputusan Pensiun</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php } ?>

                        </td>
                    </tr>
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Mutasi</th>
                        <th>File Mutasi</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>