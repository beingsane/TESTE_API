var HTTP_BASEPATH = $("#HTTP_BASEPATH").val();
///////Funções para COOKIES
var GerarCookie = function (strCookie, strValor, lngDias){
    var dtmData = new Date();
    if(lngDias){
        dtmData.setTime(dtmData.getTime() + (lngDias * 24 * 60 * 60 * 1000));
        var strExpires = "; expires=" + dtmData.toGMTString();
    } else {
        var strExpires = "";
    }
    document.cookie = strCookie + "=" + strValor + strExpires + "; path=/";
};
//Função para ler o cookie.
var LerCookie= function (strCookie){
    var strNomeIgual = strCookie + "=";
    var arrCookies = document.cookie.split(';');
    for(var i = 0; i < arrCookies.length; i++){
        var strValorCookie = arrCookies[i];
        while(strValorCookie.charAt(0) == ' '){
            strValorCookie = strValorCookie.substring(1, strValorCookie.length);
        }
        if(strValorCookie.indexOf(strNomeIgual) == 0){
            return strValorCookie.substring(strNomeIgual.length, strValorCookie.length);
        }
    }
    return null;
};



var openMenuAction	= false;
$("#actionUser").click(function(){
	window.location = HTTP_BASEPATH+"/backend/deslog_mig";
});
$("#actionMenu span").click(function(){
	if(openMenuAction){
		return false;
	}
	openMenuAction = true;
	if(LerCookie("openMenuAdmin")=="close"){
		GerarCookie("openMenuAdmin","open",30);
		$( "#menuLeft" ).animate({
			 marginLeft: "-226px",
		}, 200, "linear", function() {
			$( "#contentRight" ).animate({
				marginLeft: "0px",
			}, 200, "linear",function(){
				openMenuAction = false;
			});
		});
	}else{
		GerarCookie("openMenuAdmin","close",30);
		$( "#contentRight" ).animate({
			 marginLeft: "226px",
		}, 200, "linear", function() {
			$( "#menuLeft" ).animate({
				marginLeft: "0px",
			}, 200, "linear",function(){
				openMenuAction = false;
			});
		});
	}
	alert(openMenu);
});

if(LerCookie("openMenuAdmin")=="open"){
	$("#contentRight").css("margin-left",0);
	$("#menuLeft").css("margin-left",-226);
}



var resizeSite = function(){
	var HEIGHT	= $(window).height()-42;
	var WIDTH	= $(window).width();
	$("#content").css("height",(HEIGHT-68)+"px");
	$("#menuLat").css("height",HEIGHT+"px");
	$("#contentForm").css("height",HEIGHT-60+"px");
	if($("#errorContent").css("width")){
		$("#errorContent").css("margin-left",(WIDTH/2)- ($("#errorContent").css("width").split("px")[0]/2))
	}
}
resizeSite();
$(window).resize(resizeSite);

/////Função para esconder o menu lateral
$(".showMenu").change(function(){
	var idClick = this.name.split("-");
	$( "#div-"+idClick[1] ).toggle( "slow");
});
/////Função para abrir a modal de erros
var openErrorModal = function(title,text,set_html){
	var heightModal = $("#errorContent").height();
	var WIDTH		= $(window).width();
	$("#errorContent").css({"top":-heightModal,"display":"block"});
	
	if(set_html){
		$("#topErrorContent h4").html(title);
		$("#centerErrorContent").html(text);
	}
	
	$("#maskError").fadeIn("fast",function(){
		$( "#errorContent" ).animate({
			 top: "100px",
		}, 500, "linear", function() {
			
		});
	});
}
/////Função para fechar a modal de erros
$("#btnCloseError,#closeError,#maskError").click(function(){
	var heightModal = $("#errorContent").height()+50;
	$( "#errorContent" ).animate({
		 top: -heightModal,
	}, 500, "linear", function() {
		$("#maskError").fadeOut("fast");
	});
});
/////Verifica se deve mostrar as informações de erro
if($("#topErrorContent h4").html()){
	openErrorModal("",'',false);
}
/////Função abri e fechar as abas
var abaAtual = "";
$(".aba_sys").click(function(){
	abaAtual= this;
	$(this).next().slideToggle("fast",function(){
		if($(abaAtual).hasClass( "circle_minus" )){
			$(abaAtual).removeClass("circle_minus").addClass("circle_plus");
		}else{
			$(abaAtual).removeClass("circle_plus").addClass("circle_minus");
		}
	})
});

$(".submitFormEdit").click(function(){
	var id 		= this.id;
	var idCheck	= id.split("-")[0];
	$(":checkbox[id*="+idCheck+"]").removeAttr("checked")
	$("#"+idCheck+"-"+id.split("-")[1]).attr("checked",true);
	$("#formAdmin").attr("action",HTTP_BASEPATH+$(this).attr("href"));	
	document.adminForm.submit();
});


$(".btnTollbar").click(function(){
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
	$("#formAdmin").attr("action",$(this).attr("href"));
	document.adminForm.submit();
});

function mark_all_checkbox(ele,name_check){
	   if ($(ele).attr("checked")){
	      $('.'+name_check).each(
	         function(){
	            $(this).attr("checked", true);
	         }
	      );
	   }else{
	      $('.'+name_check).each(
	         function(){
	            $(this).attr("checked", false);
	         }
	      );
	   }
	}
$(".mark_all_checkbox").change(function(){
	mark_all_checkbox(this,this.id);
})

 $( document ).tooltip();

function formatNumber(number){
    number = number.toFixed(2) + '';
    x = number.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}