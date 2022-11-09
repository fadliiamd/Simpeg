<div class="row">
    <div class="col-lg-12">
        <h3>Daftar Tim Penilai PAK</h3>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#exampleModal">
            Tambah Tim Penilai
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Tim Penilai PAK</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="create" action="<?= base_url('account/create_tim_penilai_pak') ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ketua">Ketua</label>
                                <select class="form-control" id="ketua" name="ketua">
                                    <option value="" selected hidden>Pilih Ketua</option>
                                    <?php foreach ($penilai as $key => $value) { ?>
                                        <option value="<?= $value->account_nip ?>"><?= $value->nama . ' - ' . get_jabatan($value->jabatan_id) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="anggota1">Anggota 1</label>
                                <select class="form-control" id="anggota1" name="anggota1">
                                    <option value="" selected hidden>Pilih Anggota 1</option>
                                    <?php foreach ($penilai as $key => $value) { ?>
                                        <option value="<?= $value->account_nip ?>"><?= $value->nama . ' - ' . get_jabatan($value->jabatan_id) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="anggota2">Anggota 2</label>
                                <select class="form-control" id="anggota2" name="anggota2">
                                    <option value="" selected hidden>Pilih Anggota 2</option>
                                    <?php foreach ($penilai as $key => $value) { ?>
                                        <option value="<?= $value->account_nip ?>"><?= $value->nama . ' - ' . get_jabatan($value->jabatan_id) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
                        <th>Ketua</th>
                        <th>Anggota 1</th>
                        <th>Anggota 2</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($tim as $key => $value) { ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td>
                                <?php
                                $ketua = get_pegawai($value->ketua);
                                echo $ketua->nama . ' (' . get_jabatan($ketua->jabatan_id) . ')';
                                ?>
                            </td>
                            <td>
                                <?php
                                $anggota1 = get_pegawai($value->anggota1);
                                echo $anggota1->nama . ' - ' . get_jabatan($anggota1->jabatan_id);
                                ?>
                            </td>
                            <td>
                                <?php
                                $anggota2 = get_pegawai($value->anggota2);
                                echo $anggota2->nama . ' - ' . get_jabatan($anggota2->jabatan_id);
                                ?>
                            </td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#setting<?= $no ?>">
                                    <i class="mdi mdi-settings"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="setting<?= $no ?>" tabindex="-1" aria-labelledby="settingLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pilih Reviewer PAK</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="create" action="<?= base_url('account/penilai_pak') ?>" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="anggota1">Anggota 1</label>
                                                                <input type="hidden" class="form-control" id="anggota1" name="anggota1" value="<?= $value->anggota1 ?>" readonly>
                                                                <p class=""><?= $anggota1->nama . '(' . get_jabatan($anggota1->jabatan_id) . ')' ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="anggota1_pegawai1">Me-Review</label>                                                                
                                                                <select class="form-control" id="anggota1_pegawai1" name="anggota1_pegawai1">
                                                                    <option value="" selected hidden>Pilih Pegawai</option>
                                                                    <?php foreach ($pegawai as $k => $p) {                        
                                                                        if ($anggota1->jabatan_id > $p->jabatan_id) { ?>
                                                                            <option value="<?= $p->account_nip ?>"><?= $p->nama . ' - ' . get_jabatan($p->jabatan_id) ?></option>
                                                                    <?php
                                                                        }else{
                                                                            echo 'tidak ada';
                                                                        }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="anggota2">Anggota 2</label>
                                                                <input type="hidden" class="form-control" id="anggota2" name="anggota2" value="<?= $value->anggota2 ?>" readonly>
                                                                <p class=""><?= $anggota2->nama . '(' . get_jabatan($anggota2->jabatan_id) . ')' ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="anggota2_pegawai1">Me-Review</label>                                                                
                                                                <select class="form-control" id="anggota2_pegawai1" name="anggota2_pegawai1">
                                                                    <option value="" selected hidden>Pilih Pegawai</option>
                                                                    <?php foreach ($pegawai as $k => $p) {                        
                                                                        if ($anggota2->jabatan_id > $p->jabatan_id) { ?>
                                                                            <option value="<?= $p->account_nip ?>"><?= $p->nama . ' - ' . get_jabatan($p->jabatan_id) ?></option>
                                                                    <?php
                                                                        }else{
                                                                            echo 'tidak ada';
                                                                        }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
                if (confirm('Yakin pegawai ' + this.value + ' akan dijadikan pemeriksa PAK?')) {
                    $.ajax({
                        type: 'POST',
                        data: {
                            'account_nip': this.value,
                            'access_pak': 1
                        },
                        url: "<?= base_url() ?>" + "account/update_pemeriksa_pak/" + this.value,
                        success: function(data) {
                            let pegawai = JSON.parse(data);
                            alert('Pegawai ' + pegawai.id + ' telah jadi pemeriksa PAK');
                        },
                        error: function(data) {
                            let pegawai = JSON.parse(data);
                            alert('Pegawai ' + pegawai.id + ' gagal jadi pemeriksa PAK');
                            err = true;
                        }
                    });

                    if (err)
                        this.checked = false;
                } else {
                    this.checked = false;
                }
            } else {
                // ajax update pegawai status access_pak
                if (confirm('Yakin pegawai ' + this.value + ' akan dijadikan bukan pemeriksa PAK?')) {
                    $.ajax({
                        type: 'POST',
                        data: {
                            'account_nip': this.value,
                            'access_pak': 0
                        },
                        url: "<?= base_url() ?>" + "account/update_pemeriksa_pak/" + this.value,
                        success: function(data) {
                            let pegawai = JSON.parse(data);
                            alert('Pegawai ' + pegawai.id + ' bukan pemeriksa PAK lagi!');
                        },
                        error: function(data) {
                            let pegawai = JSON.parse(data);
                            alert('Pegawai ' + pegawai.id + ' gagal jadi bukan pemeriksa PAK');
                            err = true;
                        }
                    });

                    if (err)
                        this.checked = true;
                } else {
                    this.checked = true;
                }
            }
        });

        // on change select ketua
        $('#ketua').on('change', function() {
            let ketua = this.value;
            let anggota1 = $('#anggota1').val();
            let anggota2 = $('#anggota2').val();

            if (ketua == anggota1 || ketua == anggota2) {
                alert('Ketua tidak boleh sama dengan anggota');
                this.value = '';
            }
        });

        // on change select anggota1
        $('#anggota1').on('change', function() {
            let ketua = $('#ketua').val();
            let anggota1 = this.value;
            let anggota2 = $('#anggota2').val();

            if (ketua == anggota1 || anggota1 == anggota2) {
                alert('Anggota 1 tidak boleh sama dengan anggota 2');
                this.value = '';
            }
        });

        // on change select anggota2
        $('#anggota2').on('change', function() {
            let ketua = $('#ketua').val();
            let anggota1 = $('#anggota1').val();
            let anggota2 = this.value;

            if (ketua == anggota2 || anggota1 == anggota2) {
                alert('Anggota 2 tidak boleh sama dengan anggota 1');
                this.value = '';
            }
        });

    });
</script>