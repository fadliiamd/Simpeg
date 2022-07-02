<div class="row">
	<div class="col-lg-12">
        <h4>Usulan Pensiun</h4>

        <div class="table-responsive">
            <table id="tbl-pengajuan-mutasi" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pensiun</th>
                        <th>Tanggal Usulan</th>
                        <th>Status Persetujuan</th>
                        <th>Tanggal Persetujuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>2011-07-25</td>
                        <td>2011-07-25</td> 
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
                <h5 class="modal-title" id="exampleModalLabel">Setujui Pengajuan pensiun NIP : <b>2</b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Setujui pensiun</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan pensiun NIP : <b>2</b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Tolak pensiun</button>
            </div>
        </div>
    </div>
</div>
                            </div>
                        </td>
                        <td>2011-04-27</td>
                        <td>
                        <!-- Large modal -->
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target=".edittable">Edit</button>

<!-- Modal -->
<div class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pengajuan pensiun Id : <b>2<b></h5>
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
                        <label for="tgl_usulan">Usulan</label>
                        <select class="form-control" id="tgl_usulan" name="tgl_usulan">
                            <option>A</option>
                            <option>B</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Edit Usulan Pensiun</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Hapus pensiun Id : <b>2</b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Hapus pensiun</button>
            </div>
        </div>
    </div>
</div>

                        <button type="button" class="btn btn-secondary" data-toggle="modal">
                        Unduh
                        </button>

                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pensiun</th>
                        <th>Tanggal Usulan</th>
                        <th>Status Persetujuan</th>
                        <th>Tanggal Persetujuan</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>