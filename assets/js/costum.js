$(document).ready(function () {
	$("#tbl-pengajuan-mutasi").DataTable({});

	$("#tbl-sk-mutasi").DataTable({});

	$('#list_table').DataTable({
		'columnDefs': [{
		 'targets': 0,
		 'searchable': false,
		 'orderable': false,
		 'className': 'dt-body-center'
		}],
		'order': [[1, 'asc']]
	});

	$('#list_hasil_perangkingan').DataTable({
		'columnDefs': [{
		 'targets': 0,
		 'searchable': false,
		 'orderable': false,
		 'className': 'dt-body-center',
		}],
		'order': [[1, 'asc']]
	});

	var title = `<h4 class="card-title">Kriteria Undangan</h4>`;
	var kriteria = `<div class="form-group row">
			<div class="col-10">
				<label>Kriteria</label>
				<input type="text" class="form-control" name="kriteria[]" placeholder="Nama Kriteria">
			</div>
			<div class="col-2">
				<label>Aksi</label>
				<button type="button" class="btn btn-success" id="tambah_kriteria">Tambah Kriteria</button>
			</div>
		</div>`;
	var tambah_kriteria = `<div class="form-group row">
			<div class="col-10">
				<label>Kriteria</label>
				<input type="text" class="form-control" name="kriteria[]" placeholder="Nama Kriteria">
			</div>
		</div>`;

	$("#jenis_surat").change(function () {
		if ($("#jenis_surat").val() == "undangan") {
			$("#kriteria_section").append(title);
			$("#kriteria_section").append(kriteria);
		} else {
			$("#kriteria_section").empty();
		}
	});

	$("#kriteria_section").on("click", "#tambah_kriteria", function () {
		$("#kriteria_section").append(tambah_kriteria);
	});

	$('#jenis_kegiatan').change(function() {
		if($(this).val() == 'diklat') {
			$("#detail_jenis_kegiatan").empty();
			$("#detail_jenis_kegiatan").append(`
				<label for="jenis_diklat">Jenis Diklat (*)</label>
				<select class="form-control" id="jenis_diklat" name="jenis_diklat" required>
					<option value="" selected hidden>--- Jenis Diklat ---</option>
					<option value="teknis">Teknis</option>
					<option value="fungsional">Fungsional</option>
					<option value="unit">Unit</option>
				</select>
			`);
		} else {
			$("#detail_jenis_kegiatan").empty();
		}
	});
	
	$('#jenis_tujuan').change(function() {
		switch ($(this).val()) {
			case "semua":
				$("#detail_tujuan").empty();
				break;
			case "perorangan":
				$("#detail_tujuan").empty();
				$("#detail_tujuan").append(`
					<div class="form-group row">
						<div class="col-md-6">
							<label for="jenis_pegawai">Jenis Tujuan Pegawai (*)</label>
							<select class="form-control" id="jenis_pegawai" name="jenis_pegawai" required>
								<option value="">--- Pilih Jenis Tujuan Pegawai ---</option>
								<option value="struktural">Struktural</option>
								<option value="non struktural">Non Struktural</option>
							</select>
						</div>
						<div class="col-md-6">
							<label for="pegawai">Pegawai Tujuan (*)</label>
							<select class="form-control" id="pegawai" name="pegawai[]" multiple="multiple" required>
								<option value="" selected hidden>--- Pegawai ---</option>
							</select>
						</div>
					</div>
				`);
				break;
			case "divisi":
				$("#detail_tujuan").empty();
				$("#detail_tujuan").append(`
					<div class="form-group row">
						<div class="col-md-6">
							<label for="divisi">Divisi Tujuan (*)</label>
							<select class="form-control" id="divisi" name="divisi" required>
								<option value="">--- Pilih Divisi Tujuan ---</option>
								<option value="jurusan">Jurusan</option>
								<option value="bagian">Bagian</option>
								<option value="unit">Unit</option>
							</select>
						</div>
						<div class="col-md-6">
							<label for="tujuan">Tujuan (*)</label>
							<select class="form-control" id="tujuan" name="tujuan[]" multiple="multiple" required>
								<option value="" selected hidden>--- Tujuan ---</option>
							</select>
						</div>
					</div>
				`);
				break;
		}
	});

	// AJAX Get Data Divisi dari Database
	$("#detail_tujuan").on("change", "#divisi", function () {
		$.ajax({
			type: "GET",
			url: "surat/get_divisi/" + $(this).val(),
			success: function (data) {
				data = JSON.parse(data);
				$("#tujuan").empty();
				for (let i = 0; i < data.length; i++) {
					var id = data[i].id;
					var nama = data[i].nama;
					$("#tujuan").append("<option value=" + id + ">" + nama + "</option>");
				}
			},
		});
	});

	// AJAX Get Data Pegawai dari Database
	$("#detail_tujuan").on("change", "#jenis_pegawai", function () {
		if ($(this).val !== "semua") {
			$.ajax({
				type: "GET",
				url: "surat/get_pegawai/" + $(this).val(),
				success: function (data) {
					data = JSON.parse(data);
					$("#pegawai").empty();
					for (let i = 0; i < data.length; i++) {
						var nip = data[i].account_nip;
						var nama = data[i].nama;
						$("#pegawai").append(
							"<option value=" + nip + ">" + nama + "</option>"
						);
					}
				},
			});
		}
	});
});
