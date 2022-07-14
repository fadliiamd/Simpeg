<div class="container">
    <div class="main-body">
        <h1> My Profile</h1>
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="FOTO PROFILE" class="rounded-circle" width="150">
                            <div class="mt-3">                                
                                <h4><?= explode(' ', $profiles->nama)[0] ?></h4>
                                <p class="text-secondary mb-1 text-capitalize"><?= $_SESSION['role'] ?> SPK POLSUB</p>
                                <!-- <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p> -->
                                <!-- <button class="btn btn-primary">Follow</button>
                                <button class="btn btn-outline-primary">Message</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">NIP</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $profiles->account_nip ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nama Lengkap</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $profiles->nama ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $profiles->email ?>
                            </div>
                        </div>
                        <hr>                        
                        <!-- <div class="row">
                            <div class="col-sm-12">
                                <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>
                            </div>
                        </div> -->
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