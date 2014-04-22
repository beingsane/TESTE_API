var detailState = 0;
function pagination_changePage(offset) {
	$("#pagination_offset").val(offset);
	$("#formAdmin").attr("action",$("#submitPagination").val());
	document.adminForm.submit();
}
