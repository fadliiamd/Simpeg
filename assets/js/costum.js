function change_jenis_kegiatan(element, id) {
	if(element.value == 'diklat') {
		$("#detail_jenis_kegiatan_edit_" + id).empty();
		$("#detail_jenis_kegiatan_edit_" + id).append(`
			<label for="jenis_diklat_edit_${id}">Jenis Diklat (*)</label>
			<select class="form-control" id="jenis_diklat_edit_${id}" name="jenis_diklat">
				<option value="" selected hidden>--- Jenis Diklat ---</option>
				<option value="teknis">Teknis</option>
				<option value="fungsional">Fungsional</option>
				<option value="unit">Unit</option>
			</select>
		`);
	} else {
		$("#detail_jenis_kegiatan_edit_" + id).empty();
	}
}

function change_subjek(element, id) {
		if(element.value == 'spesifik') {
			$("#detail_subjek_edit_" + id).empty();
			$("#detail_subjek_edit_" + id).append(`
				<label for="jenis_tujuan_edit_${id}">Jenis Pegawai Tujuan Surat (*)</label>
				<select class="form-control" id="jenis_tujuan_edit_${id}" name="jenis_tujuan" onchange="change_jenis_tujuan(this, ${id})">
					<option value="" selected hidden>--- Jenis Pegawai Tujuan Surat ---</option>
					<option value="divisi">Divisi</option>
					<option value="perorangan">Perorangan</option>
				</select>
			`);
		} else {
			$("#detail_subjek_edit_" + id).empty();
			$("#detail_tujuan_edit_" + id).empty();
		}
}

function change_jenis_tujuan(element, id) {
	switch (element.value) {
		case "perorangan":
			$("#detail_tujuan_edit_" + id).empty();
			$("#detail_tujuan_edit_" + id).append(`
				<div class="form-group">
					<label for="jenis_pegawai_edit_${id}">Jenis Tujuan Pegawai (*)</label>
					<select class="form-control" id="jenis_pegawai_edit_${id}" name="jenis_pegawai" onchange="change_jenis_pegawai(this, ${id})">
						<option value="" selected hidden>--- Pilih Jenis Tujuan Pegawai ---</option>
						<option value="struktural">Struktural</option>
						<option value="fungsional">Fungsional</option>
					</select>
				</div>
				<div class="form-group">
					<label for="tujuan_edit_${id}">Pegawai Tujuan (*)</label>
					<select class="form-control search-select" id="tujuan_edit_${id}" name="tujuan[]" multiple="multiple" required>
						<option value="" hidden>--- Pegawai ---</option>
					</select>
				</div>
			`);
			break;
		case "divisi":
			$("#detail_tujuan_edit_" + id).empty();
			$("#detail_tujuan_edit_" + id).append(`
				<div class="form-group">
					<label for="divisi_edit_${id}">Divisi Tujuan (*)</label>
					<select class="form-control" id="divisi_edit_${id}" name="divisi" onchange="change_divisi(this, ${id})">
						<option value="">--- Pilih Divisi Tujuan ---</option>
						<option value="jurusan">Jurusan</option>
						<option value="bagian">Bagian</option>
						<option value="unit">Unit</option>
					</select>
				</div>
				<div class="form-group">
					<label for="tujuan_edit_${id}">Tujuan (*)</label>
					<select class="form-control search-select" id="tujuan_edit_${id}" name="tujuan[]" multiple="multiple" required>
						<option value="" hidden>--- Tujuan ---</option>
					</select>
				</div>
			`);
			break;
	}
}

function change_divisi(element, id) {
	$.ajax({
		type: "GET",
		url: "surat/get_divisi/" + element.value,
		success: function (data) {
			data = JSON.parse(data);
			$("#tujuan_edit_" + id).empty();
			for (let i = 0; i < data.length; i++) {
				var id2 = data[i].id;
				var nama = data[i].nama;
				$("#tujuan_edit_" + id).append("<option value=" + id2 + ">" + nama + "</option>");
			}
		},
	});
}

function change_jenis_pegawai(element, id) {
	if (element.value !== "semua") {
		$.ajax({
			type: "GET",
			url: "surat/get_pegawai/" + element.value,
			success: function (data) {
				data = JSON.parse(data);
				$("#tujuan_edit_" + id).empty();
				for (let i = 0; i < data.length; i++) {
					var nip = data[i].account_nip;
					var nama = data[i].nama;
					$("#tujuan_edit_" + id).append(
						"<option value=" + nip + ">" + nama + "</option>"
					);
				}
			},
		});
	}
}

$(document).ready(function () {
	$("#tbl-pengajuan-mutasi").DataTable({});

	$("#tbl-sk-mutasi").DataTable({});
	
	$('#list-surat').DataTable({
		"bDestroy": true
	}); 

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
		 'className': 'dt-body-center'		 
		}],
		'order': [[1, 'asc']],
		"bDestroy": true
	});

	// -------------
	// Form Unggah
	// -------------
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

	$('#subjek').change(function() {
		if($(this).val() == 'spesifik') {
			$("#detail_subjek").empty();
			$("#detail_subjek").append(`
				<label for="jenis_tujuan">Jenis Pegawai Tujuan Surat (*)</label>
				<select class="form-control" id="jenis_tujuan" name="jenis_tujuan" required>
					<option value="" selected hidden>--- Jenis Pegawai Tujuan Surat ---</option>
					<option value="divisi">Divisi</option>
					<option value="perorangan">Perorangan</option>
				</select>
			`);
		} else {
			$("#detail_subjek").empty();
			$("#detail_tujuan").empty();
		}
	});
	
	$("#detail_subjek").on("change", "#jenis_tujuan", function () {
		switch ($(this).val()) {
			case "perorangan":
				$("#detail_tujuan").empty();
				$("#detail_tujuan").append(`
					<div class="form-group">
						<label for="jenis_pegawai">Jenis Tujuan Pegawai (*)</label>
						<select class="form-control" id="jenis_pegawai" name="jenis_pegawai" required>
							<option value="" selected hidden>--- Pilih Jenis Tujuan Pegawai ---</option>
							<option value="struktural">Struktural</option>
							<option value="fungsional">Fungsional</option>
						</select>
					</div>
					<div class="form-group">
						<label for="tujuan">Pegawai Tujuan (*)</label>
						<select class="form-control search-select" id="tujuan" name="tujuan[]" multiple="multiple" required>
							<option value="" hidden>--- Pegawai ---</option>
						</select>
					</div>
				`);
				break;
			case "divisi":
				$("#detail_tujuan").empty();
				$("#detail_tujuan").append(`
					<div class="form-group">
						<label for="divisi">Divisi Tujuan (*)</label>
						<select class="form-control" id="divisi" name="divisi" required>
							<option value="">--- Pilih Divisi Tujuan ---</option>
							<option value="jurusan">Jurusan</option>
							<option value="bagian">Bagian</option>
							<option value="unit">Unit</option>
						</select>
					</div>
					<div class="form-group">
						<label for="tujuan">Tujuan (*)</label>
						<select class="form-control search-select" id="tujuan" name="tujuan[]" multiple="multiple" required>
							<option value="" hidden>--- Tujuan ---</option>
						</select>
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
					$("#tujuan").empty();
					for (let i = 0; i < data.length; i++) {
						var nip = data[i].account_nip;
						var nama = data[i].nama;
						$("#tujuan").append(
							"<option value=" + nip + ">" + nama + "</option>"
						);
					}
				},
			});
		}
	});

	// -------------
	// Form Edit
	// -------------
});
