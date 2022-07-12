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
    $('#list_surat').DataTable({});
    $(".table-datatable").DataTable({});
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
</body>

</html>