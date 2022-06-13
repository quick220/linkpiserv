// JavaScript Document
$.fn.myAlert=function(type,title,text){
		$(".alert-dismissible").remove();
		var str='<div class="alert alert-'+type+' alert-dismissible" role="alert">'+
 				'<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>'+
				'<span class="fa fa-exclamation-triangle"></span> ';
 		str+='<strong> '+title+' </strong> ';
		str+=text;
		str+='</div>';
		$(this).prepend(str);
		setTimeout(function(){$(".alert-dismissible").fadeOut();},3000);
	};

function htmlAlert(obj,type,title,text,duration)
{
	
	$(obj).hide();
	$(obj).html('<div class="alert alert-'+type+'"><strong>'+title+'</strong> '+text+' <button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button></div>');
	$(obj).fadeIn();
	  if(duration) 
	  {
		  function fout()
		  {
			  $(obj).fadeOut();
			}
	setTimeout(fout,duration);
		
	  }
}
function rpcc(func, params, callbak, usrdata, jsonrpc) {
	if(params==undefined || params==null)
		params=[];	

	if(callbak!=undefined)
		jsonrpc.call(func, params, function(data){callbak(data,usrdata);}, function(res){console.log(res)});
	else
		jsonrpc.call(func, params, function(data){}, function(res){console.log(res)});
}

function rpc(func, params, callbak, usrdata) {
	var jsonrpc = new $.JsonRpcClient({ ajaxUrl: 'RPC' });
	rpcc(func, params, callbak, usrdata, jsonrpc);
}


function func(func, data, callbak)
{
	$.post("func.php?func="+func,data,callbak,"json");
}

function changeLang(lang){
	$("#langcss").attr("href","css/"+lang+".css");
	$("option["+lang+"]").each(function(){
		$(this).text($(this).attr(lang));
	});
	func("saveConfigFile",{path: "config/lang.json",data:JSON.stringify({"lang":lang},null,2)});
}


function getUsedLang() {
	$.ajaxSettings.async = false;
	$.getJSON("config/lang.json",function (data) {
		var lang = data["lang"];
		$("#langcss").attr("href","css/"+lang+".css");
		$("option["+lang+"]").each(function(){
			$(this).text($(this).attr(lang));
		});
	})
	$.ajaxSettings.async = true;
}

function　linkHref(path) {
	var link = document.createElement('link');
	link.href = path;
	link.rel = 'stylesheet';
	link.type = 'text/css';
	$('head')[0].appendChild(link);
}

$(function(){
	$.ajaxSetup({
	  cache: false
	});

	getUsedLang();
});
