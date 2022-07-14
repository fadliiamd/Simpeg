<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold text-capitalize">Selamat Datang <?= $_SESSION['role'].' #'.$_SESSION['nip'] ?></h3>
                <h6 class="font-weight-normal">Bekerjalah sepenuh hati agar tidak merasa tersakiti!</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                    <div class="card-people mt-auto">
                        <img src="<?= base_url()?>assets/images/dashboard/people.png" alt="people">
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
                                <p class="mb-4">Total Pengguna</p>
                                <p class="fs-30 mb-2"><?= $total_pengguna ?></p>                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Kegiatan</p>
                                <p class="fs-30 mb-2"><?= $total_kegiatan ?></p>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Mutasi (masuk dan keluar)</p>
                                <p class="fs-30 mb-2"><?= $total_mutasi ?></p>                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Total Pemberhentian</p>
                                <p class="fs-30 mb-2"><?= $total_pemberhentian ?></p>                                
                            </div>
                        </div>
                    </div>
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