</div>
</div>
</div>
<!-- partial:partials/_footer.html -->
<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-center text-muted text-sm-left d-block d-sm-inline-block">Copyright © 2021. All rights reserved.</span>
    <span class="float-none mt-1 text-center float-sm-right d-block mt-sm-0">Hand-crafted & made with <i class="ml-1 ti-heart text-danger"></i></span>
  </div>
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-center text-muted text-sm-left d-block d-sm-inline-block">TIM TA SPK POLITEKNIK NEGERI SUBANG</span>
  </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->


<!-- inject:js -->
<script src="<?= base_url(); ?>assets/js/off-canvas.js"></script>
<script src="<?= base_url(); ?>assets/js/hoverable-collapse.js"></script>
<script src="<?= base_url(); ?>assets/js/template.js"></script>
<script src="<?= base_url(); ?>assets/js/settings.js"></script>
<script src="<?= base_url(); ?>assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?= base_url(); ?>assets/js/dashboard.js"></script>
<script src="<?= base_url(); ?>assets/js/Chart.roundedBarCharts.js"></script>
<!-- End custom js for this page-->

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
<!-- Costum js progantara -->
<script src="<?= base_url(); ?>assets/js/costum.js"></script>
<!-- End Costum js progantara -->
  <script>
    const MONTH_NAMES = [
      'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
      'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    function getFormattedDate(date, prefomattedDate = false, hideYear = false) {
      const day = date.getDate();
      const month = MONTH_NAMES[date.getMonth()];
      const year = date.getFullYear();
      const hours = date.getHours();
      let minutes = date.getMinutes();

      if (minutes < 10) {
        minutes = `0${ minutes }`;
      }

      if (prefomattedDate) {
        // Hari ini pada 10:20
        // Kemarin pada 10:20
        return `${ prefomattedDate } pada ${ hours }:${ minutes }`;
      }

      if (hideYear) {
        // 10 January pada 10:20
        return `${ day } ${ month } pada ${ hours }:${ minutes }`;
      }

      // 10 January 2017 pada 10:20
      return `${ day } ${ month } ${ year } pada ${ hours }:${ minutes }`;
    }

    function timeAgo(dateParam) {
      if (!dateParam) {
        return null;
      }

      const date = typeof dateParam === 'object' ? dateParam : new Date(dateParam);
      const DAY_IN_MS = 86400000; // 24 * 60 * 60 * 1000
      const today = new Date();
      const yesterday = new Date(today - DAY_IN_MS);
      const seconds = Math.round((today - date) / 1000);
      const minutes = Math.round(seconds / 60);
      const isToday = today.toDateString() === date.toDateString();
      const isYesterday = yesterday.toDateString() === date.toDateString();
      const isThisYear = today.getFullYear() === date.getFullYear();


      if (seconds < 5) {
        return 'baru saja';
      } else if (seconds < 60) {
        return `${ seconds } detik yang lalu`;
      } else if (seconds < 90) {
        return 'sekitar semenit yang lalu';
      } else if (minutes < 60) {
        return `${ minutes } menit yang lalu`;
      } else if (isToday) {
        return getFormattedDate(date, 'Hari ini'); // Hari ini pada 10:20
      } else if (isYesterday) {
        return getFormattedDate(date, 'Kemarin'); // Kemarin pada 10:20
      } else if (isThisYear) {
        return getFormattedDate(date, false, true); // 10 January pada 10:20
      }

      return getFormattedDate(date); // 10 January 2017 pada 10:20
    }

    function load_unseen_notification() {
      $.ajax({
        url: "<?=base_url() ?>notifikasi/hook",
        dataType: "json",
        success: function(data) {
          console.log('Refreshing');
          $("#notification_list").empty();
          $("#notification_list").append(`
            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
          `);
          for(let i=0; i<data.length; i++) {
            var display_date = data[i].created_at.replace(' ', 'T');
            var element = `
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">${data[i].judul}</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    ${timeAgo(new Date(display_date))}
                  </p>
                </div>
              </a>
            `;
            $("#notification_list").append(element);
          }
        }
      });
    }

    function reload_notification() {
      load_unseen_notification();
      setTimeout(function() {
        load_unseen_notification();
      }, 30000);
    }

    $(document).ready( function () {
      reload_notification();
      $('#list_surat').DataTable({});
      $(".table-datatable").DataTable({});
    } );    
  </script>
  <!-- Costum js progantara -->
  <script src="<?= base_url();?>assets/js/costum.js"></script>
  <!-- End Costum js progantara -->
</body>

</html>