<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold text-capitalize">Selamat Datang <?= $_SESSION['role'] . ' #' . $_SESSION['nip'] ?></h3>
                <h6 class="font-weight-normal">Bekerjalah sepenuh hati agar tidak merasa tersakiti!</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                    <div class="card-people mt-auto">
                        <img src="<?= base_url() ?>assets/images/dashboard/people.png" alt="people">
                        <div class="weather-info">
                            <div class="d-flex">
                                <div>
                                    <h2 class="mb-0 font-weight-normal"><span id="wheater-temparature">?</span><sup>C</sup></h2>
                                </div>
                                <div class="ml-2">
                                    <h4 class="location font-weight-normal">Subang</h4>
                                    <h6 class="font-weight-normal">Jawa Barat</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Total Bimtek</p>
                                <p class="fs-30 mb-2"><?= $total_bimtek ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Diklat</p>
                                <p class="fs-30 mb-2"><?= $total_diklat ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Prajabatan</p>
                                <p class="fs-30 mb-2"><?= $total_prajabatan ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Hasil AKK (terakhir)</p>
                                <p class="fs-30 mb-2"><?php if (!is_null($akk_terakhir)) {
                                                            echo $akk_terakhir;
                                                        } else {
                                                            echo "Belum Punya";
                                                        } ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Notifikasi</h4>
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
                <td><label class="badge <?= $el->status=="Unseen" ? "badge-secondary" : "badge-primary" ?>"><?= $el->status ?></label></td>
                <td>
                  <form method="POST" action="<?= base_url() ?>notifikasi/change_status">
                    <input type="hidden" name="account_nip" value="<?= $el->account_nip ?>">
                    <input type="hidden" name="notifikasi_id" value="<?= $el->notifikasi_id ?>">
                    <?php if($el->status == 'Unseen') { ?>
                      <button type="submit" class="btn btn-success">Baca</button>
                    <?php } else { ?>
                      <button type="submit" class="btn btn-success" disabled>Baca</button>
                    <?php } ?>
                    <!-- <button type="button" class="btn btn-danger">Hapus</button> -->
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
<script>
  $(document).ready(function() {       
    $.getJSON('https://cuaca.umkt.ac.id/api/cuaca/DigitalForecast-JawaBarat.xml', function(jsonData) {
      const findClosest = (data, accessor, target = Date.now()) => data.reduce((prev, curr) => {
        const a = Math.abs(accessor(curr).getTime() - target);
        const b = Math.abs(accessor(prev).getTime() - target);
        return a - b < 0 ? curr : prev;
      });
      var sampleData = jsonData.row.data.forecast.area[25].parameter[5].timerange;
      var output = sampleData.map(s => {
        if (s.hasOwnProperty("@datetime")) {
          s.datetime = s['@datetime'];
          delete s['@datetime'];
        }
        return s;
      })
      const processDateString = (dateString) => {
        const year = dateString.substring(0, 4);
        const month = dateString.substring(4, 6);
        const date = dateString.substring(6, 8);
        const hour = dateString.substring(8, 10);
        const minute = dateString.substring(10, 12);
        return new Date(year, month - 1, date, hour, minute);
      };

      const closest = findClosest(sampleData, ({
        datetime
      }) => processDateString(datetime));

      console.log(closest.value[0]);
      $('#wheater-temparature').html(closest.value[0]['#text']);
    });
  });
</script>