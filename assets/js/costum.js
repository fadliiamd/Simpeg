$(document).ready(function () {
	$("#tbl-pengajuan-mutasi").DataTable({
		dom: "Bfrtip",
		buttons: ["copy", "csv", "excel", "pdf", "print"],
	});

	$("#tbl-sk-mutasi").DataTable({
		dom: "Bfrtip",
		buttons: ["copy", "csv", "excel", "pdf", "print"],
	});
});

$('#list_hasil_perangkingan').DataTable({
	select: true,
	'columnDefs': [{
	 'targets': 0,
	 'searchable': false,
	 'orderable': false,
	 'className': 'dt-body-center',
	 'render': function (data, type, full, meta){
			 return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
		}
	}],
	'order': [[1, 'asc']]
});

var title = `<h4 class="card-title">Kriteria Undangan</h4>`;
var kriteria = 
	`<div class="form-group row">
		<div class="col-10">
			<label>Kriteria</label>
			<input type="text" class="form-control" name="kriteria[]" placeholder="Nama Kriteria">
		</div>
		<div class="col-2">
			<label>Aksi</label>
			<button type="button" class="btn btn-success" id="tambah_kriteria">Tambah Kriteria</button>
		</div>
	</div>`;
var tambah_kriteria = 
	`<div class="form-group row">
		<div class="col-10">
			<label>Kriteria</label>
			<input type="text" class="form-control" name="kriteria[]" placeholder="Nama Kriteria">
		</div>
	</div>`;

$('#jenis_surat').change(function() {
	if($('#jenis_surat').val() == "undangan") {
		$("#kriteria_section").append(title);
		$("#kriteria_section").append(kriteria);
	} else {
		$("#kriteria_section").empty()
	}
});

$('#kriteria_section').on('click', '#tambah_kriteria', function() {
	$("#kriteria_section").append(tambah_kriteria);
});

$('input[type=radio][name=tujuan]').on('change', function() {
	console.log("Change Radio 2");
	switch ($(this).val()) {
		case 'perorangan':
			$("#tujuan_section").empty();
			$("#tujuan_section").append(`
				<div class="form-group">
					<label for="jenis_pegawai">Jenis Tujuan Pegawai</label>
					<select class="form-control" id="jenis_pegawai">
						<option>--- Jenis Pegawai ---</option>
						<option value="struktural">Struktural</option>
						<option value="fungsional">Fungsional</option>
					</select>
				</div>
				<div class="form-group">
					<label for="pegawai">Pegawai Tujuan</label>
					<select class="form-control" id="pegawai">
						<option>--- Pegawai ---</option>
						<option value="pegawai1">Pegawai 1</option>
						<option value="pegawai2">Pegawai 2</option>
					</select>
				</div>
			`);
			break;
		case 'unit':
			$("#tujuan_section").empty();
			$("#tujuan_section").append(`
				<div class="form-group">
					<label for="unit">Unit Tujuan</label>
					<select class="form-control" id="unit">
						<option value="perpustakaan">Perpustakaan</option>
						<option value="akademik">Akademik</option>
					</select>
				</div>
			`);
			break;
	}
});