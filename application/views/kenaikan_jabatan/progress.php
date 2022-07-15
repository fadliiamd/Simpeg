<div class="row">
    <div class="col-lg-12">
        <h3>Progress Pengajuan Berkas</h3>

        <!-- Large modal -->
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

        <div class="table-responsive">
            <table id="tbl-data-bagian" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Progress</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php           
                    $bagian = $this->pegawai_model->get_one_with_join(array(
                        'account_nip' => $this->session->userdata('nip')
                    ));
                    if (!is_null($bagian)) {
                        $bagian = $bagian->nama_jabatan;
                        if(strtolower($bagian) !== 'kepegawaian'){
                            $bagian = null;                            
                        }
                    }                         
                    foreach ($pengajuan as $key => $value) { ?>
                        <tr>

                            <td><?php echo $no ?></td>
                            <td><?php echo $value->account_nip; ?></td>
                            <td>
                                <?php                                
                                $jumlah = 0;
                                if(!is_null($value->bukti_1)){
                                    $jumlah++;
                                }
                                if(!is_null($value->bukti_2)){
                                    $jumlah++;
                                }
                                if(!is_null($value->bukti_jurnal)){
                                    $jumlah++;
                                }                                
                                 ?>                                
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width:<?= ($jumlah/3)*100 ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td>   
                                <form action="<?= base_url('kenaikan_jabatan/send_notification') ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="sisa" value="<?= 3-$jumlah ?>">
                                <input type="hidden" name="account_nip" value="<?= $value->account_nip ?>">
                                <button type="submit" class="btn btn-warning" <?= ($jumlah === 3) || (is_null($bagian)) ? 'disabled' : '' ?>>Kirim Notifikasi</button>
                                </form>
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
        $('#tbl-data-bagian').DataTable();
    });
</script>