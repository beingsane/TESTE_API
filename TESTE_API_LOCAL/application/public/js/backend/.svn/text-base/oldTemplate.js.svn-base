/////Resaize da páginavar resizeSite = function(){	var HEIGHT	= $(window).height()-50;	var WIDTH	= $(window).width();	$("#content").css("height",HEIGHT+"px");	$("#contentForm").css("height",HEIGHT-60+"px");	if($("#contentMesError").css("width")){		$("#contentMesError").css("margin-left",(WIDTH/2)- ($("#contentMesError").css("width").split("px")[0]/2))	}}
resizeSite();
$(window).resize(resizeSite);
////Sube menu

$(".linkMenu").click( // When a top menu item is clicked...
	function () {
		$(this).next().slideToggle("normal")
	}
);


$("#maskError,#closeError").click(
	function () {
		$("#maskError").css("display","none");
		$("#contentMesError").css("display","none");
	}
);
var thisId = "";
var mostraErro=function(id,error,mens){
	if(error==true){
		$("#"+id).next().html(mens);
	  	$("#"+id).next().removeClass("sucessField");
	  	$("#"+id).next().addClass("errorField");
	}else{
	   $("#"+id).next().html("");
	   $("#"+id).next().removeClass("errorField");
	   $("#"+id).next().addClass("sucessField");
	}
}

function mascaraData(campoData){
    var data = $(campoData).val();
    if (data.length == 2){
        data = data + '/';
        $(campoData).val(data);
return true;              
    }
    if (data.length == 5){
        data = data + '/';
        $(campoData).val(data);
        return true;
    }
}

var functionValidate=[];
/////valida preenchimento de no minimo 4 caracteres
functionValidate["validateName"] = function(id,value,compar){
	if(value.length<3){
		mostraErro(id,true,"Preencha com no mínimo tres caracteres!");
		return true;
	}else{
		mostraErro(id,false,"");
		return false;
	}
};
/////valida preenchimento de no minimo 4 caracteres
functionValidate["validateEmail"] = function(id,value,compar){
		var email 	= value;
		var exclude	= /[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
	    var check	= /@[\w\-]+\./;
	    var checkend= /\.[a-zA-Z]{2,3}$/;
		thisId		= this;
	    if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){
			 mostraErro(id,true,"Preencha um e-mail válido!") 
			 return true;
		} else {
			mostraErro(id,false,"");
			return false;
		}
		
}
functionValidate["validateData"] = function(id,value,compar){
	if(value.length<10){
		mostraErro(id,true,"Preencha com uma data valida! ex(10/10/2000)");
		return true;
	}else{
		mostraErro(id,false,"");
		return false;
	}
}
functionValidate["validateImage"] = function(id,value,compar){
	
}
functionValidate["validateText"] = function(id,value,compar){
	if(value.length<10){
		mostraErro(id,true,"Preencha com no mínimo dez caracteres!");
		return true;
	}else{
		mostraErro(id,false,"");
		return false;
	}
}

functionValidate["validateSenha"] = function(id,value,compar){
	if(value.length<5){
		mostraErro(id,true,"Preencha com no mínimo cinco caracteres!");
		return true;
	}else{
		mostraErro(id,false,"");
		return false;
	}
}

functionValidate["validateSenhaConf"] = function(id,value,idComparacao){
	if(value!=$("#"+idComparacao).val()){
		mostraErro(id,true,"As senhas são diferentes verifique!");
		return true;
	}else{
		mostraErro(id,false,"");
		return false;
	}
}

$(".submitFormEdit").click(
	function(){
		var id 		= this.id;
		var idCheck	= id.split("-")[0];
		$(":checkbox[id*="+idCheck+"]").removeAttr("checked")
		$("#"+idCheck+"-"+id.split("-")[1]).attr("checked",true);
		$("#formAdmin").attr("action",$(this).attr("alt"));	
		document.adminForm.submit();
	}
);


$(".iconTollbar").click( 
		function () {
			var classConfirm 	= $(this).hasClass('iconTollbarConfirm');
			var validate 		= false;
			if(classConfirm){
			/////Verifica se existe algum campo para validar
				$('.validate').each(function(){
					id 		=  this.id;
					funcao	= id.split("-")[0];
					compar	= id.split("-");
					value   = $("#"+id).val();
					if(functionValidate[funcao](id,value,compar[1]+"-"+compar[2])){
						validate = true;
					}
				});
				if(validate){
					return false;
				}
				if(!confirm("Confirma as informações"))
				return false;
			}
			
			if(validate){
				return false;
			}
			$("#formAdmin").attr("action",$(this).attr("alt"));
			document.adminForm.submit();
		}
	);