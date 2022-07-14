<div class="row">
    <div class="col-lg-12">
        <h3>Data Sertifikat</h3>

        <div class="table-responsive">
            <table id="tbl-data-Sertifikat" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Sertifikat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php
                    foreach ($sertifikat as $key => $value) { ?>
                        <tr>

                            <td><?php echo $no ?></td>
                            <td><?php echo $value->account_nip; ?></td>
                            <td>
                                <a href="<?= base_url() . 'uploads/' . $value->nama_serti ?>" target="_blank">                              
                                    Lihat <?php echo $value->nama_serti; ?>                             
                                </a>
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
        $('#tbl-data-Sertifikat').DataTable();
    });
</script>