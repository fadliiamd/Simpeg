<div class="row">
    <div class="col-lg-12">
        <h3>Daftar Usulan PAK</h3>

        <!-- Large modal -->
        <?php
        if ($_SESSION['role'] === 'pegawai') { ?>
            <a href="<?= base_url('dupak/pemberkasan/create') ?>" class="">
                <button type="button" class="my-3 btn btn-primary">Tambah Daftar Usulan PAK</button>
            </a>
        <?php
        }
        ?>
        <?php if ($this->session->flashdata('message_success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('message_success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>
        <?php if ($this->session->flashdata('message_error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('message_error') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>
        <!-- Modal -->
        <!-- End Modal -->

        <div class="table-responsive">
            <table id="tbl-data-dupak" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Usulan</th>
                        <th>NIP Pengusul</th>
                        <th>Tanggal Usulan</th>
                        <th>Hasil Angka Kredit</th>
                        <th>Status</th>
                        <th>Tanggal Validasi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php
                    foreach ($nilai_rekap as $key => $value) { ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $value->id; ?></td>
                            <td><?php echo $value->account_nip; ?></td>
                            <td><?php echo $value->tgl_usulan; ?></td>
                            <td><?= $value->hasil_akk ?></td>
                            <td><?= $value->status ?></td>
                            <td>
                                <?php
                                if(is_null($value->tgl_validasi)){
                                    $kepegawaian = $this->pegawai_model->get_one_with_join(array(
                                        'account_nip' => $this->session->userdata('nip')
                                    ));
                                    if (!is_null($kepegawaian)) {
                                        $kepegawaian = $kepegawaian->nama_bagian;
                                        if(strtolower($kepegawaian) == 'kepegawaian'){ ?>
                                        <a href="<?= base_url('dupak/pemberkasan/validasi_pak/'.$value->id) ?>">
                                            <button type="button" class="btn btn-warning">Validasi</button>
                                        </a>
                                    <?php
                                        }
                                    }
                                }else{
                                    echo $value->tgl_validasi;
                                }
                                ?>
                            </td>
                            <td>
                                <!-- Large modal -->
                                <a href="<?= base_url('dupak/pemberkasan/usulan_pak/'.$value->id) ?>">
                                    <button type="button" class="btn btn-info">Lihat</button>
                                </a>
                            
                                <?php if ($_SESSION['role'] !== 'pegawai') { ?>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetable-<?= $value->id ?>">Hapus</button>

                                    <div class="modal fade" id="deletetable-<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Daftar Usulan PAK ID : <b><?php echo $value->id ?></b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="forms-sample" action="<?= base_url("dupak/pemberkasan/delete/" . $value->id); ?>" method="POST" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin menghapus daftar usulan ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button type="submit" class="btn btn-danger">Ya, hapus aja</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } ?>
                            </td>
                        </tr>
                    <?php $no++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tbl-data-dupak').DataTable();
        $('select[name="jabatan"]').on('change', function() {
            if (this.value == 'asisten ahli') {
                $("#container-file-upload").html(`
                    <div class="form-group col-md-6">
                        <label for="nama">Ijazah Magister</label>
                        <input type="file" name="bukti_1" class="form-control" required>
                        </div>
                    <div class="form-group col-md-6">
                        <label for="nama">Bukti SKP/Nilai Prestasi Kerja Selama 1 Tahun</label>
                        <input type="file" name="bukti_2" class="form-control" required>
                    </div>     
                `);
            } else {
                $("#container-file-upload").html(`
                    <div class="form-group col-md-6">
                        <label for="nama">Bukti Pengabdian Kepada Masyarakat</label>
                        <input type="file" name="bukti_1" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama">Bukti Menjabat Asisten Ahli (2 Tahun)</label>
                        <input type="file" name="bukti_2" class="form-control" required>
                    </div>      
                `);
            }
        });
    });
</script>