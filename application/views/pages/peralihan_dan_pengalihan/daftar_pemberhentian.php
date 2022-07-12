<div class="row">
    <div class="col-lg-12">
        <h4>Pengajuan Pemberhentian</h4>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-datatable">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Alasan</th>
                        <th>Status Pengajuan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Tanggal Persetujuan</th>
                        <th>MPP</th>
                        <th>Tunjangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        foreach ($pemberhentian as $key => $value) { 
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value->alasan ?></td>
                            <td>
                                <?php if($value->status_pengajuan == "setuju") {?>
                                    <span class="badge badge-success"><?= $value->status_pengajuan; ?></span>
                                <?php }; ?>
                                <?php if($value->status_pengajuan == "ditolak") {?>
                                    <span class="badge badge-danger"><?= $value->status_pengajuan; ?></span>
                                <?php }; ?>
                            </td>
                            <td><?= $value->tgl_pengajuan ?></td>
                            <td><?= $value->tgl_persetujuan ?></td>
                            <td><?= $value->mpp ?></td>
                            <td><?= $value->tunjangan ?></td>
                        </tr>
                    <?php $i++; } ?>
                </tbody>           
            </table>
        </div>
    </div>
</div>