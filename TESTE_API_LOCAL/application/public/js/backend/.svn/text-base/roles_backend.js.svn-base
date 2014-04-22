$(".floppy_save").click( function () {
	var idClik 		= this.id.split("-");
	var aba			= $("#"+idClik[1]+"-aba").val();
	var modulo		= $("#"+idClik[1]+"-modulo").val();
	var desc		= $("#"+idClik[1]+"-desc").val();
	var menu		= $("#"+idClik[1]+"-menu").val();
	jsonObject={"id":idClik[1],"aba":aba,"modulo":modulo,"desc":desc,"menu":menu};
	$.ajax({
		type		: "POST",
		url			: HTTP_BASEPATH+"/backend/roles_mig_json/edit",
		data		: jsonObject,
		dataType	: "json",	
		async 		: false,
		complete 	: function(jqXHR, textStatus) {
			if (textStatus == "error") {
				alert(JSON.stringify(jqXHR));
			}
		},
		success : function(data) {
			if (data.errorCode == 0) {				
				openErrorModal("Sucesso",'<span class="glyphicons circle_ok">Método alterado com sucesso</span>',true);
			} else {
				openErrorModal("Erro",data.errorDesc,true)
			}
		}
	});

});
$(".remove").click( function () {
	var idClik 		= this.id.split("-");
	var aba			= $("#"+idClik[1]+"-aba").val();
	jsonObject={"id":idClik[1]};
	$.ajax({
		type		: "POST",
		url			: HTTP_BASEPATH+"/backend/roles_mig_json/remove",
		data		: jsonObject,
		dataType	: "json",	
		async 		: false,
		complete 	: function(jqXHR, textStatus) {
			if (textStatus == "error") {
				alert(JSON.stringify(jqXHR));
			}
		},
		success : function(data) {
			if (data.errorCode == 0) {
				$("#remove-"+idClik[1]).remove();
				openErrorModal("Sucesso",'<span class="glyphicons circle_ok">Método removido com sucesso</span>',true);
			} else {
				openErrorModal("Erro",data.errorDesc,true)
			}
		}
	});

});


var openTr = "";
$(".toogleTable").click(function(){
	openTr = this.id;
	if($(this).next().hasClass('openTr')){
		$("#"+this.id).next().toggle("slow").removeClass("openTr");
		return;
	}
	$(".openTr").toggle("slow").removeClass("openTr");
	$("#"+this.id).next().toggle("slow").addClass("openTr");
});