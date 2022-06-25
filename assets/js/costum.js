$(document).ready(function () {
	$("#tbl-pengajuan-mutasi").DataTable({
		dom: "Bfrtip",
		buttons: ["copy", "csv", "excel", "pdf", "print"],
	});
});
