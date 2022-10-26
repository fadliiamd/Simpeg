<div class="row">
    <div class="col-lg-12">
        <h3>Daftar Dosen Pemeriksa PAK</h3>

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
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Akses</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($pegawai as $key => $value) { ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $value->account_nip; ?></td>
                            <td><?php echo $value->nama; ?></td>
                            <td><?php echo $value->nama_jabatan; ?></td>
                            <td>
                                <div class="form-check pl-3">
                                    <input class="form-check-input" type="checkbox" value="<?= $value->account_nip ?>" id="access_pak_<?= $no ?>" <?= $value->access_pak ? "checked" : "" ?>>
                                    <label class="form-check-label ml-1" for="access_pak_<?= $no ?>">
                                        Aktif
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tbl-data-dupak').DataTable();

        // on check access_pak
        $('.form-check-input').on('change', function() {
            let err = false;
            if (this.checked) {                
                // ajax update pegawai status access_pak
                if (confirm('Yakin pegawai '+this.value+' akan dijadikan pemeriksa PAK?')) {
                    $.ajax({
                        type: 'POST',                                                
                        data: {
                            'account_nip': this.value,
                            'access_pak': 1
                        },
                        url: "<?= base_url()?>" + "account/update_pemeriksa_pak/" + this.value,
                        success: function(data) {
                            let pegawai = JSON.parse(data);
                            alert('Pegawai '+pegawai.id+' telah jadi pemeriksa PAK');                            
                        },
                        error: function(data) {
                            let pegawai = JSON.parse(data);                            
                            alert('Pegawai '+pegawai.id+' gagal jadi pemeriksa PAK');                                                 
                            err = true;
                        }                                                                        
                    });

                    if(err)
                        this.checked = false;                    
                } else {
                    this.checked = false;
                }
            } else {
                // ajax update pegawai status access_pak
                if (confirm('Yakin pegawai '+this.value+' akan dijadikan bukan pemeriksa PAK?')) {
                    $.ajax({
                        type: 'POST',                                                
                        data: {
                            'account_nip': this.value,
                            'access_pak': 0
                        },
                        url: "<?= base_url()?>" + "account/update_pemeriksa_pak/" + this.value,
                        success: function(data) {
                            let pegawai = JSON.parse(data);
                            alert('Pegawai '+pegawai.id+' bukan pemeriksa PAK lagi!');                            
                        },
                        error: function(data) {
                            let pegawai = JSON.parse(data);                            
                            alert('Pegawai '+pegawai.id+' gagal jadi bukan pemeriksa PAK');                                                 
                            err = true;
                        }                                                                        
                    });

                    if(err)
                        this.checked = true;
                } else {
                    this.checked = true;
                }
            }
        });
    });
</script>