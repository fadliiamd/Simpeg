<div class="row">
    <div class="col-lg-12">
        <h4>Pengajuan Pemberhentian</h4>

        <!-- Large modal -->
        <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Pemberhentian</button>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengajuan Pemberhentian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="jenis_berhenti">Jenis Berhenti</label>
                                <select class="form-control" id="jenis_berhenti" name="jenis_berhenti">
                                    <option>Diterima</option>
                                    <option>Ditolak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alasan">Alasan</label>
                                <textarea class="form-control" id="alasan" rows="4" name="alasan"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status_pengajuan">Status</label>
                                <select class="form-control" id="status_pengajuan" name="status_pengajuan">
                                    <option>Diterima</option>
                                    <option>Ditolak</option>
                                </select>
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
                                <label for="mpp">MPP</label>
                                <input type="text" class="form-control" id="mpp" name="mpp" placeholder="MPP">
                            </div>
                            <div class="form-group">
                                <div class="mb-3 input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="tunjangan" placeholder="Tunjangan">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pegawai_nip">Pegawai</label>
                                <select class="form-control" id="pegawai_nip" name="pegawai_nip">
                                    <option>Fulan</option>
                                    <option>Fulanah</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="button" class="btn btn-primary">Tambah Pengajuan Pemberhentian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <div class="table-responsive">
            <table id="tbl-pengajuan-mutasi" class="table table-striped table-bordered">
                <thead>
                    <tr class="thead-dark">
                        <th>No</th>
                        <th>Jenis Berhenti</th>
                        <th>Alasan</th>
                        <th>Status Pengajuan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Tanggal Persetujuan</th>
                        <th>MPP</th>
                        <th>Tunjangan</th>
                        <?php if($this->session->userdata("role") == "pegawai"){ ?>   
                            <th>Surat Pengunduran Diri</th>
                        <?php } ?>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>200124111</td>
                        <td>Lorem ipsum color sti amet parabellum dos ente</td>
                        <td>
                            <span class="badge badge-warning">Pending</span>
                            <?php if($this->session->userdata("role") == "admin"){ ?>   
                                <div class="mt-3">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvetable">
                                        Setujui
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="approvetable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Setujui Pengajuan Pemberhentian NIP : <b>2</b> </h5>
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan Pemberhentian NIP : <b>2</b> </h5>
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
                            <?php } ?>
                        </td>
                        <td>2011-04-27</td>
                        <td>2011-07-25</td>
                        <td>MPP</td>
                        <td>RP.10.000,00</td>
                        <td>
                            <!-- Large modal -->
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target=".edittable">Edit</button>
                            <!-- Modal -->
                            <div class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Pengajuan Pemberhentian Id : <b>2<b></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="forms-sample">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="jenis_berhenti">Jenis Berhenti</label>
                                                    <select class="form-control" id="jenis_berhenti" name="jenis_berhenti">
                                                        <option>Diterima</option>
                                                        <option>Ditolak</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alasan">Alasan</label>
                                                    <textarea class="form-control" id="alasan" rows="4" name="alasan"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status_pengajuan">Status</label>
                                                    <select class="form-control" id="status_pengajuan" name="status_pengajuan">
                                                        <option>Diterima</option>
                                                        <option>Ditolak</option>
                                                    </select>
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
                                                    <label for="mpp">MPP</label>
                                                    <input type="text" class="form-control" id="mpp" name="mpp" placeholder="MPP">
                                                </div>
                                                <div class="form-group">
                                                    <div class="mb-3 input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">$</span>
                                                        </div>
                                                        <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="tunjangan" placeholder="Tunjangan">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pegawai_nip">Pegawai</label>
                                                    <select class="form-control" id="pegawai_nip" name="pegawai_nip">
                                                        <option>Fulan</option>
                                                        <option>Fulanah</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                <button type="submit" class="btn btn-primary">Edit Pengajuan Pemberhentian</button>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Pengajuan Pemberhentian Id : <b>2</b> </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-danger">Hapus Pengajuan Pemberhentian</button>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Unggah Bukti Pendukung</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="forms-sample">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="surat_pengajuan">Bukti Pendukung</label>
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

                        <?php if($this->session->userdata("role") == "pegawai"){ ?>   
                            <button type="button" class="btn btn-secondary" data-toggle="modal">
                                Unduh
                            </button>
                        <?php } ?>
                        </td>
                    </tr>
                </tbody>           
                <tfoot>
                    <tr class="thead-dark">
                        <th>No</th>
                        <th>Jenis Berhenti</th>
                        <th>Alasan</th>
                        <th>Status Pengajuan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Tanggal Persetujuan</th>
                        <th>MPP</th>
                        <th>Tunjangan</th>
                        <?php if($this->session->userdata("role") == "pegawai"){ ?>   
                            <th>Surat Pengunduran Diri</th>
                        <?php } ?>
                        <th>Action</th>
                    </tr>
                </tfoot> 
            </table>
        </div>
    </div>
</div>