<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">List Notifikasi</h4>
        <div class="table-responsive">
          <table class="table table-datatable">
            <thead>
              <tr>
                <th>Judul</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($list_notifikasi as $el) { ?>
              <tr>
                <td><?= $el->judul ?></td>
                <td><?= timeAgo($el->created_at) ?></td>
                <td><label class="badge badge-primary"><?= $el->status ?></label></td>
                <td>
                  <form method="POST" action="<?= base_url() ?>notifikasi/change_status">
                    <input type="hidden" name="account_nip" value="<?= $el->account_nip ?>">
                    <input type="hidden" name="notifikasi_id" value="<?= $el->notifikasi_id ?>">
                    <?php if($el->status == 'Unseen') { ?>
                      <button type="submit" class="btn btn-success">Baca</button>
                    <?php } else { ?>
                      <button type="submit" class="btn btn-success" disabled>Baca</button>
                    <?php } ?>
                    <button type="button" class="btn btn-danger">Hapus</button>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#detail-<?= $el->account_nip ?>-<?= $el->notifikasi_id ?>">Lihat</button>

                    <!-- Modal -->
                    <div id="detail-<?= $el->account_nip ?>-<?= $el->notifikasi_id ?>" class="modal fade edittable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Notifikasi: <b><?= $el->judul ?><b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <?= $el->pesan ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal -->
                  </form>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>