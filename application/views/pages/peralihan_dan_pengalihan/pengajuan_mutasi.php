<div class="row">
    <div class="col-lg-12">
        <h4>Berkas Persyaratan</h4>

        <!-- Large modal -->
        <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Mutasi</button>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengajuan Mutasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP">
                            </div>
                            <div class="form-group">
                                <label for="alasan">Alasan</label>
                                <textarea class="form-control" id="alasan" rows="4" name="alasan"></textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                                    <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan">
                                </div>
                                <div class="col-md-6">
                                    <label for="tgl_persetujuan">Tanggal Persetujuan</label>
                                    <input type="date" class="form-control" id="tgl_persetujuan" name="tgl_persetujuan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status_pengajuan">Status</label>
                                <select class="form-control" id="status_pengajuan" name="status_pengajuan">
                                    <option>Diterima</option>
                                    <option>Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="button" class="btn btn-primary">Tambah Mutasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <div class="table-responsive">
            <table id="tabel-pengajuan-mutasi" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Alasan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status Pengajuan</th>
                        <th>Tanggal Persetujuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>200124111</td>
                        <td>Lorem ipsum color sti amet parabellum dos ente</td>
                        <td>2011-07-25</td>
                        <td>
                            Pending
                            <div class="mt-3">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetable">
                                    Setujui
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="approvetable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Setujui Pengajuan Mutasi NIP : <b>2</b> </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-success">Setujui Mutasi</button>
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
                                                <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan Mutasi NIP : <b>2</b> </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-danger">Tolak Mutasi</button>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Pengajuan Mutasi Id : <b>2<b></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="forms-sample">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nip">NIP</label>
                                                    <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP">
                                                </div>
                                                <div class="form-group">
                                                    <label for="alasan">Alasan</label>
                                                    <textarea class="form-control" id="alasan" rows="4" name="alasan"></textarea>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                                                        <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="tgl_persetujuan">Tanggal Persetujuan</label>
                                                        <input type="date" class="form-control" id="tgl_persetujuan" name="tgl_persetujuan">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status_pengajuan">Status</label>
                                                    <select class="form-control" id="status_pengajuan" name="status_pengajuan">
                                                        <option>Diterima</option>
                                                        <option>Ditolak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                <button type="button" class="btn btn-primary">Edit Mutasi</button>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Mutasi Id : <b>2</b> </h5>
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

                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#uploadtable">
                                Unggah
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="uploadtable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Unggah Surat pengajuan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="forms-sample">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="surat_pengajuan">Surat Pengajuan</label>
                                                    <input type="file" class="form-control-file" id="surat_pengajuan" name="surat_pengajuan" placeholder="surat_pengajuan">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-warning">Unggah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-secondary" data-toggle="modal">
                                Unduh
                            </button>
                        </td>
                    </tr>
                </tbody>            
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tabel-pengajuan-mutasi').DataTable();
    });
</script>