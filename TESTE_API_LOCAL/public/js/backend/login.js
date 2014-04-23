var validateEmail =  function(value){
	var email 	= value;
	var exclude	= /[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
    var check	= /@[\w\-]+\./;
    var checkend= /\.[a-zA-Z]{2,3}$/;
    if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){
		return false;
	} 
    return true;
};

$("#lost_pass").click(function(){
	$("#mask,#lost_pass_content").show();
});

$("#mask").click(function(){
	$("#mask,#lost_pass_content").hide();
});

$("#send_email").click(function(){
	var email 	= $("#lost_pass_email").val();
	
	if(validateEmail(email)==false){
		$("#lost_pass_email").focus();
		$("#error_lost_pass").html("Preencha o endereço de email válido!")
		return false
	}
	jsonObject={"email":email};
	$.ajax({
		type		: "POST",
		url			: "/backend/lost_pass",
		data		: jsonObject,
		dataType	: "json",	
		async 		: false,
		complete 	: function(jqXHR, textStatus) {
			if (textStatus == "error") {
				alert(JSON.stringify(jqXHR));
			}
		},
		success : function(data) {
			$("#error_lost_pass").html(data.errorDesc ? data.errorDesc : data.message)
		}
	});
	return false;
})