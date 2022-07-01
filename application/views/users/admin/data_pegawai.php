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
                    <form action="<?= base_url("account/create_data_pegawai"); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input class="form-control" id="email" name="email">
                                </div>
                                <div class="col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>                                
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="nip">NIP</label>
                                    <input class="form-control" id="nip" name="nip">
                                </div>                        
                                <div class="col-md-3">
                                    <label for="nama">Nama Lengkap</label>
                                    <input class="form-control" id="nama" name="nama">
                                </div>  
                                <div class="col-md-3">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="l">Laki-laki</option>
                                        <option value="p">Perempuan</option>
                                    </select>
                                </div>    
                                <div class="col-md-3">
                                    <label for="agama">Agama</label>
                                    <select class="form-control" id="agama" name="agama">
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="islam">Islam</option>
                                        <option value="protestan">Protestan</option>
                                        <option value="katholik">Katholik</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="budha">Budha</option>
                                        <option value="konghucu">Konghucu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input class="form-control" id="tempat_lahir" name="tempat_lahir">
                                </div>
                                <div class="col-md-4">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                                </div>    
                                <div class="col-md-4">
                                    <label for="alamat">Alamat</label>
                                    <input class="form-control" id="alamat" name="alamat">
                                </div> 
                            </div>   
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan">
                                </div>
                                <div class="col-md-6">
                                    <label for="gaji">Gaji</label>
                                    <input type="number" class="form-control" id="gaji" name="gaji">
                                </div>
                            </div>
                            <div class="form-group row">                         
                                <div class="col-md-4">
                                    <label for="golongan_id">Golongan/Pangkat</label>
                                    <select class="form-control" id="golongan_id" name="golongan_id">
                                        <option value="">-- Pilih Golongan/Pangkat --</option>
                                        <?php foreach ($golpang as $key => $value) 
                                        { ?>
                                            <option value="<?= $value->golongan ?>">
                                                <?= $value->golongan." / ".$value->pangkat ?>
                                            </option>                                            
                                        <?php 
                                        } ?>
                                    </select>
                                </div>                                
                                <div class="col-md-4">
                                    <label for="jenis_pegawai">Jenis Pegawai</label>
                                    <select class="form-control" id="jenis_pegawai" name="jenis_pegawai">
                                        <option value="">-- Pilih Jenis Pegawai --</option>                                        
                                        <option value="1">Struktural</option>
                                        <option value="2">Non-Struktural</option>
                                    </select>
                                </div>                                
                                <div class="col-md-4">
                                    <label for="status_pegawai">Status Pegawai</label>
                                    <select class="form-control" id="status_pegawai" name="status_pegawai">
                                        <option value="">-- Pilih Status Pegawai --</option>                                        
                                        <option value="1">PNS</option>
                                        <option value="2">Honorer</option>                                        
                                    </select>
                                </div>                                
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="jurusan_id">Jurusan</label>
                                    <select class="form-control" id="jurusan_id" name="jurusan_id">
                                        <option value="">-- Pilih Jurusan --</option>
                                    <?php foreach ($jurusan as $key => $value) 
                                        { ?>
                                            <option value="<?= $value->id ?>">
                                                <?= $value->nama ?>
                                            </option>                                            
                                        <?php 
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">

                                    <label for="bagian_id">Bagian</label>
                                    <select class="form-control" id="bagian_id" name="bagian_id">
                                        <option value="">-- Pilih Bagian --</option>
                                    <?php foreach ($bagian as $key => $value) 
                                        { ?>
                                            <option value="<?= $value->id ?>">
                                                <?= $value->nama ?>
                                            </option>                                            
                                        <?php 
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="unit_id">Unit</label>
                                    <select class="form-control" id="unit_id" name="unit_id">
                                        <option value="">-- Pilih Unit --</option>
                                    <?php foreach ($unit as $key => $value) 
                                        { ?>
                                            <option value="<?= $value->id ?>">
                                                <?= $value->nama ?>
                                            </option>                                            
                                        <?php 
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control-file" id="foto" name="foto">                                    
                                </div>
                                <div class="col-md-4">
                                    <label for="ijazah">Ijazah</label>
                                    <input type="file" class="form-control-file" id="ijazah" name="ijazah">
                                </div>
                                <div class="col-md-4">
                                    <label for="karpeg">Karpeg</label>
                                    <input type="file" class="form-control-file" id="karpeg" name="karpeg">
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
                    <?php
                    $no = 1;
                    foreach ($pegawai as $key => $value) { ?>
                        <tr>
                        <td><?= $no ?></td>
                        <td><?= $value->account_nip ?></td>
                        <td><?= $value->nama_pegawai ?></td>
                        <td><?= $value->email ?></td>
                        <td><?= $value->status ?></td>
                        <td><?= $value->golongan_id ?></td>
                        <td><?= $value->nama_jurusan ?></td>
                        <td><?= $value->nama_unit ?></td>
                        <td><?= $value->nama_bagian ?></td>
                        <td>
                            <!-- Large modal -->
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".edittable">Edit</button>

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

                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#deletetable">Detail</button>
                        </td>
                    </tr>
                    <?php 
                        $no++;    
                    } 
                     ?>

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