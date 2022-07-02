<div class="row">
	<div class="col-lg-12">
        <h4>Penerimaan Mutasi</h4>

        
        <?php if($this->session->userdata("role") == "admin"){ ?>   
            <!-- Large modal -->
            <button type="button" class="my-3 btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Penerimaan Mutasi</button>

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
                                    <label for="daerah_asal">Daerah Asal</label>
                                    <input type="text" class="form-control" id="daerah_asal" name="daerah_asal" placeholder="daerah_asal">
                                </div>
                                <div class="form-group">
                                    <label for="instantsi_asal">Instansi Asal</label>
                                    <input type="text" class="form-control" id="instantsi_asal" name="instantsi_asal" placeholder="instantsi_asal">
                                </div>
                                <div class="form-group">
                                    <label for="alasan">Alasan</label>
                                    <textarea class="form-control" id="alasan" rows="4" name="alasan"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="bagian">Bagian</label>
                                    <select class="form-control" id="bagian" name="bagian">
                                        <option>90 - IT</option>
                                        <option>67 - Dosen</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status_persetujuan">Status</label>
                                    <select class="form-control" id="status_persetujuan" name="status_persetujuan">
                                        <option>Diterima</option>
                                        <option>Ditolak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="direktur_nip">Direktur</label>
                                    <select class="form-control" id="direktur_nip" name="direktur_nip">
                                        <option>Fulan</option>
                                        <option>Fulanah</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Tambah Penerimaan Mutasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal -->
        <?php } ?>

        <div class="table-responsive">
            <table id="tbl-pengajuan-mutasi" class="table table-striped table-bordered table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Instantsi Asal</th>
                        <th>Daerah Asal</th>
                        <th>Alasan</th>
                        <th>Bagian</th>
                        <th>Status</th>
                        <th>Nama Direktur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Politeknik Negeri Subang</td>
                        <td>Subang</td>
                        <td>Karena Gabut</td>
                        <td>Dosen</td>
                        <td>
                            <span class="badge badge-warning">Pending</span>
                            
                            <?php if($this->session->userdata("role") == "direktur"){ ?>   
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
                            <?php } ?>
                        </td>
                        <td>Fulan</td>
                        
                        <?php if($this->session->userdata("role") == "admin"){ ?>   
                            <td>
                                <!-- Large modal -->
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target=".edittable">Edit</button>

                                <!-- Modal -->
                                <div class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Penerimaan Mutasi Id : <b>2<b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="forms-sample">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="daerah_asal">Daerah Asal</label>
                                                        <input type="text" class="form-control" id="daerah_asal" name="daerah_asal" placeholder="daerah_asal">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="instantsi_asal">Instansi Asal</label>
                                                        <input type="text" class="form-control" id="instantsi_asal" name="instantsi_asal" placeholder="instantsi_asal">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alasan">Alasan</label>
                                                        <textarea class="form-control" id="alasan" rows="4" name="alasan"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bagian">Bagian</label>
                                                        <select class="form-control" id="bagian" name="bagian">
                                                            <option>IT</option>
                                                            <option>Dosen</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status_persetujuan">Status</label>
                                                        <select class="form-control" id="status_persetujuan" name="status_persetujuan">
                                                            <option>Diterima</option>
                                                            <option>Ditolak</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="direktur_nip">Direktur</label>
                                                        <select class="form-control" id="direktur_nip" name="direktur_nip">
                                                            <option>Fulan</option>
                                                            <option>Fulanah</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-primary">Tambah Penerimaan Mutasi</button>
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
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Penerimaan Mutasi Id : <b>2</b> </h5>
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

                            </td>
                        <?php } ?>

                    </tr>
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Instantsi Asal</th>
                        <th>Daerah Asal</th>
                        <th>Alasan</th>
                        <th>Bagian</th>
                        <th>Status</th>
                        <th>Nama Direktur</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>