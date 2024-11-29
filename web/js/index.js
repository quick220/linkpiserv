$.fn.bootstrapSwitch.defaults.size = 'middle';
$.fn.bootstrapSwitch.defaults.onColor = 'warning';
var config = {};
var clientConfig = {};
var state = [];
var index = 0;
var stopPrev = false;
$.getJSON("config/MPConfig.json", function (result) {
	config = result;
	for (var i = 0; i < config.length; i++) {
		$(".mytitle h5").eq(i).text(config[i].name);
	}

	$(".mytitle i").each(function (i, obj) {
		$(obj).click(function (e) {
			$('#exampleModal').modal('show');
		});
	});

	selectChn(0);
	getState();
	setInterval(getSpeed, 2000);
	setInterval(getState, 1000);
});

function getConfig() {
	clientConfig={};
	rpc("getConfig", [index], function (data) {
		if (data.encode == undefined) {
			setTimeout(getConfig, 300);
		}
		else {
			clientConfig = data;
			if(clientConfig.version==undefined)
			{
				clientConfig.encode.encV=Object.assign(clientConfig.encode.encV, clientConfig.encode.encV_cfg[0]);
				clientConfig.encode.encA=Object.assign(clientConfig.encode.encA, clientConfig.encode.encA_cfg[0]);
				clientConfig.buffer.channel=clientConfig.buffer.svrPort-6000+1;
			}
			zcfg("#myTabContent", clientConfig);
			showQP();
		}
	});
}

function selectChn(i) {
	index = i;
	zctemplet("#templetURL", config[i].url);
	zcfg("#exampleModal", config[i]);

	for (var i = 0; i < config.length; i++) {
		if (i == index)
			$(".mytab .col").eq(i).addClass("active");
		else
			$(".mytab .col").eq(i).removeClass("active");
	}

	for (var i = 0; i < 10; i++) {
		$(".myicon").eq(i).removeClass("active");
		$(".myicon .b").eq(i).text("- - -");
		if (i > 2)
			$(".myicon .t").eq(i).text("- - -");
		$(".myicon .svr").each(function (ii, obj) {
			$(obj).text("X");
		});
	}
	getConfig();
	startPreview();
}

var player = null;
var playTime = 0;

function stopPreview() {
	if (player == null)
		return;
	if (player.detachMediaElement == undefined) {

		player.destroy();
	}
	else {
		player.unload();
		player.detachMediaElement();
		player.destroy();
	}
	player = null;
	playTime = 0;
}

function startPreview() {

	stopPreview();

	if (stopPrev || state.length == 0 || !state[index].alive || state[index].startTime <= 0)
		return;

	if (state[index].codec == "h265") {
		player = new Jessibuca({
			container: $("#player")[0],
			videoBuffer: 0.5, // 缓存时长
			isResize: false,
			text: "",
			loadingText: "加载中",
			debug: true,
			showBandwidth: true, // 显示网速
			operateBtns: {
				fullscreen: true,
				screenshot: false,
				play: true,
				audio: true,
				record: false
			},
			forceNoOffscreen: true,
			isNotMute: false,
			//useMSE: (state[index].codec!="h265"),
		});
		$("#player_264").hide();
		$("#player").show();
		player.play('http://' + window.location.host + '/flv?app=live&stream=preview' + index);
	}
	else {
		player = flvjs.createPlayer({
            type: 'flv',
            hasAudio: true,
            url: 'http://'+window.location.host+'/flv?app=live&stream=preview'+index
        });
		$("#player_264").show();
		$("#player").hide();

        player.attachMediaElement(document.getElementById("player_264"));
        player.load();
        player.play();
	}

	playTime = (new Date()).getTime();
}

function checkDelay() {
	if(player == null || player.detachMediaElement == undefined)
		return;
	if (player.buffered.length > 0) {
		if (player.buffered.end(0) - player.currentTime > 1) {
			player.currentTime = player.buffered.end(0) - 0.2;
		}
	}
}
setInterval(checkDelay, 2000);

var snapIndex = 0;
var snapPlayer = null;
var snapPlayTime = 0;
function snap() {
	if (state.length == 0)
		return;

	if (state[snapIndex].alive && state[snapIndex].startTime > 0) {
		if (snapPlayer == null) {
			snapPlayer = new Jessibuca({
				container: $("#snap")[0],
				videoBuffer: 0.2, // 缓存时长
				isResize: false,
				showBandwidth: false, // 显示网速
				operateBtns: {
					fullscreen: false,
					screenshot: false,
					play: false,
					audio: false,
					record: false
				},
				forceNoOffscreen: true,
				isNotMute: false
			});
			snapPlayer.play('http://' + window.location.host + '/flv?app=live&stream=preview' + snapIndex);
			snapPlayTime = (new Date()).getTime();
		}
		else {
			if (snapPlayer.isPlaying()) {
				// const fileBlob = snapPlayer.screenshot("test", 'blob');
				// snapPlayer.pause();
				var ii = snapIndex;
				$("#snap canvas")[0].toBlob(function (blob) {
					$(".mytab img").eq(ii).attr("src", URL.createObjectURL(blob));
				});

				snapPlayer.destroy();
				snapPlayer = null;
				snapPlayTime = 0;
				snapIndex = (snapIndex + 1) % state.length;
			}
			else if ((new Date()).getTime() - snapPlayTime > 5000) {
				snapPlayer.destroy();
				snapPlayer = null;
				snapPlayTime = 0;
				snapIndex = (snapIndex + 1) % state.length;
			}
		}
	}
	else {
		snapIndex = (snapIndex + 1) % state.length;
	}
}
setInterval(snap, 1000);

$("#rcmode").change(showQP);

function showQP() {
	if ($("#rcmode").val() == "vbr") {
		$("#minqp").show();
		$("#maxqp").show();
	}
	else {
		$("#minqp").hide();
		$("#maxqp").hide();
	}
}


$(".mytab .col").each(function (index, obj) {
	$(obj).click(function () {
		selectChn(index);
	});

});

$("#setConfig").click(function (e) {
	if(clientConfig.version==undefined)
	{
		clientConfig.encode.encV_cfg[0].bitrate=clientConfig.encode.encV.bitrate;
		clientConfig.encode.encV_cfg[0].minqp=clientConfig.encode.encV.minqp;
		clientConfig.encode.encV_cfg[0].gop=clientConfig.encode.encV.gop;
		clientConfig.encode.encV_cfg[0].framerate=clientConfig.encode.encV.framerate;
		clientConfig.encode.encV_cfg[0].rcmode=clientConfig.encode.encV.rcmode;
		clientConfig.encode.encV_cfg[0].maxqp=clientConfig.encode.encV.maxqp;
		clientConfig.encode.encA_cfg[0].bitrate=clientConfig.encode.encA.bitrate;
		clientConfig.buffer.svrPort=clientConfig.buffer.channel+6000-1;
	}
	rpc("setConfig", [index, clientConfig], function (data) {
	});
});

$("#reboot").click(function (e) {
	var cmd={};
	cmd.func="reboot";
	cmd.args="";
	$.confirm({
		title: '重启设备',
		content: '是否立即重启设备？',
		buttons: {
			ok: {
				text: "确认重启",
				btnClass: 'btn-warning',
				type: 'dark',
				keys: ['enter'],
				action: function () {
					rpc("stopPush", [index]);
					stopPreview();
					rpc("sendCmd", [index, cmd], function (data) {
					});
				}
			},
			cancel: {
				text: "取消",
				action: function () {
					console.log('the user clicked cancel');
				}
			}

		}
	});
	return false;
	
});

function save() {
	$('#exampleModal').modal('hide');
	rpc("updateChn", [index, config[index]], function (data) {
		$(".mytitle h5").eq(index).text(config[index].name);
	});
}

$("#save").click(save);
$("#saveName").click(save);

var ptzInterval=0;
var ptzCurP=0;
var ptzCurT=0;
var ptzCurZ=0;
var ptzSpeed=1;
var ptzDelay=200;
function ptzCtrl(func,val){
	var cmd={};
	cmd.func="ptzCtrl";
	var args={};
	args.func=func;
	args.val=val;
	cmd.args=args;
	rpc("sendCmd", [index, cmd]);
}
function ptzStop(){
	clearInterval(ptzInterval);
	ptzInterval=0;
}

$("#ptz_up").mousedown(function (e) {
	ptzInterval=setInterval('ptzCtrl("ptz_rlt_t",ptzSpeed*3600);', ptzDelay);
});
$("#ptz_down").mousedown(function (e) {
	ptzInterval=setInterval('ptzCtrl("ptz_rlt_t",-ptzSpeed*3600);', ptzDelay);
});
$("#ptz_left").mousedown(function (e) {
	ptzInterval=setInterval('ptzCtrl("ptz_rlt_p",-ptzSpeed*3600);', ptzDelay);
});
$("#ptz_right").mousedown(function (e) {
	ptzInterval=setInterval('ptzCtrl("ptz_rlt_p",ptzSpeed*3600);', ptzDelay);
});
$("#ptz_zoom_in").mousedown(function (e) {
	ptzInterval=setInterval('ptzCtrl("ptz_rlt_z",ptzSpeed*2);', ptzDelay);
});
$("#ptz_zoom_out").mousedown(function (e) {
	ptzInterval=setInterval('ptzCtrl("ptz_rlt_z",-ptzSpeed*2);', ptzDelay);
});


$("#ptzFrame button").each(function(index,obj){
	$(obj).mouseup(ptzStop);
	$(obj).mouseout(ptzStop);
});

$("#ptz_home").mousedown(function (e) {
	ptzCtrl("ptz_abs_p",0);
	setTimeout('ptzCtrl("ptz_abs_t",0);', 200);
	setTimeout('ptzCtrl("ptz_abs_z",100);', 400);
});

$("#startPush").click(function (e) {
	rpc("startPush", [index]);
	startPreview();
});

$("#stopPlay").click(function (e) {
	stopPrev=!stopPrev;
	if(stopPrev)
	{
		$("#stopPlay").text("PLAY");
		stopPreview();
	}		
	else
	{
		$("#stopPlay").text("STOP");
		startPreview();
	}
		
});

$("#stopPush").click(function (e) {
	$.confirm({
		title: '停止推流',
		content: '是否立即停止推流？',
		buttons: {
			ok: {
				text: "确认停止",
				btnClass: 'btn-warning',
				type: 'dark',
				keys: ['enter'],
				action: function () {
					rpc("stopPush", [index]);
					stopPreview();
					setTimeout(getState, 300);
				}
			},
			cancel: {
				text: "取消",
				action: function () {
					console.log('the user clicked cancel');
				}
			}

		}
	});
	return false;

});

function getSpeed() {
	rpc("getSpeed", [index], function (data) {

		for (var i = 0; i < data.length; i++) {
			$("#templetURL .speed").eq(i).text(data[i] + "kb/s");
		}
	});
}

function getState() {
	
	rpc("getState", null, function (data) {
		state = data;
		//console.log(data);
		for (var i = 0; i < state.length; i++) {
			if (state[i].alive) {
				$(".mytab .mytitle").eq(i).addClass("online");
			}
			else {
				$(".mytab .mytitle").eq(i).removeClass("online");
			}

			if (state[i].alive && state[i].startTime > 0) {
				// $(".mytab img").eq(i).attr("src", "snap/snap" + i + ".jpg?rnd=" + Math.random());
				$(".mytab .mytitle span").eq(i).text(Math.floor(state[i].speed * 8 / 1024) + "kb/s");
				$(".mytab .progress-bar").eq(i).css("width", state[i].buffer + "%");
			}
			else {
				$(".mytab img").eq(i).attr("src", "/img/nosignal.jpg");
				$(".mytab .mytitle span").eq(i).text("- - -");
				$(".mytab .progress-bar").eq(i).css("width", 0);
			}

			if (state[i].alive && state[i].bat != undefined) {
				$(".mytab .battery .bat_bar").eq(i).css("width", (state[i].bat.val * 40 / 100) + "px");
				$(".mytab .battery .bat_txt").eq(i).text((state[i].bat.crg ? "~" : "") + Math.round(state[i].bat.val));
				$(".mytab .battery").eq(i).show();
			}
			else {
				$(".mytab .battery").eq(i).hide();
			}

		}

		if(Object.keys(clientConfig).length==0)
			return;
		
		var sta = state[index];
		if (sta.alive) {
			if(clientConfig.version==undefined)
			{
				var iface={};
				sta.input={};
				if(sta.iface.sdi.s)
				{
					iface=sta.iface.sdi;
					sta.input.type="sdi";
					sta.input.avalible=true;
				}
				else if(sta.iface.hdmi.s)
				{
					iface=sta.iface.hdmi;
					sta.input.type="hdmi";
					sta.input.avalible=true;
				}
				else{
					sta.input.type="hdmi";
					sta.input.avalible=false;
				}

				if(sta.input.avalible)
				{
					sta.input.width=iface.w;
					sta.input.height=iface.h;
					sta.input.framerate=iface.f;
					sta.input.interlace=iface.i;
				}				
			}

			if(sta.input.avalible)
			{
				$("#input").addClass("active");
				$("#input .b").text(sta.input.height + (sta.input.interlace ? "I" : "P") + sta.input.framerate);
			}				
			else
			{
				$("#input").removeClass("active");
				$("#input .b").text("- - -");
			}
			$("#input .t").text(sta.input.type.toUpperCase());
			$("#input img").attr("src","img/"+sta.input.type+".png");

			if(sta.net!=undefined)
			{
				var net = sta.net;
				if(clientConfig.version==undefined)
				{
					for (var i = 0; i < net.length; i++) {
						if(i==0)
							net[i].type="lan"
						else if(i==1)
							net[i].type="wifi"
						else
							net[i].type="dongle"
					}
				}

				
				while($("#stateBar").children().length-3<net.length-2)
				{
					$("#stateBar").append($("#stateBar").children().last().prop("outerHTML"));
				}

				while($("#stateBar").children().length-3>net.length-2)
				{
					$("#stateBar").children().last().remove();
				}

				var lteCnt=0;
				for (var i = 0; i < net.length; i++) {
					var k;
					if(net[i].type=="lan")
						k = 1;
					else if(net[i].type=="wifi")
						k = 2;
					else{
						lteCnt++;
						k=2+lteCnt;
					}

					if (net[i].a>0) {
						$(".myicon").eq(k).addClass("active");
						if (net[i].t != undefined)
							$(".myicon .t").eq(k).text(net[i].t);
						if (net[i].o != undefined)
							$(".myicon").eq(k).find(".svr").text(net[i].o);

						$(".myicon .b").eq(k).text(net[i].tx + "kb");
					}
					else {
						$(".myicon").eq(k).removeClass("active");
						if (i > 0)
							$(".myicon .t").eq(k).text("- - -");
						if (i > 1)
							$(".myicon").eq(k).find(".svr").text("X");

						$(".myicon .b").eq(k).text("- - -");

					}

					if (net[i].type=="wifi") {
						if (net[i].a>0)
							$(".myicon").eq(k).find("#wifi").css("background-position-y", (-5 - (4 - net[i].s) * 50) + "px");
						else
							$(".myicon").eq(k).find("#wifi").css("background-position-y", "-5px");
					}
					else if (net[i].type=="dongle") {
						if (net[i].a>0)
							$(".myicon").eq(k).find("#lte").css("background-position-y", (-5 - (5 - net[i].s) * 50) + "px");
						else
							$(".myicon").eq(k).find("#lte").css("background-position-y", "-5px");
					}

				}
			}
			
		}


		if (!sta.alive || sta.startTime <= 0)
			stopPreview();

		if (sta.alive && sta.startTime > 0 && (new Date()).getTime() - playTime > 5000)
		{
			if( player == null || (player.isPlaying!=undefined && !player.isPlaying()) || (player.isPlaying==undefined && player.buffered.length<=0) ){
					startPreview();
			}
				
		}
			

	});
}


function updateTime() {
	if (state.length == 0)
		return;
	if (state[index].alive && state[index].startTime > 0) {
		var cur = (new Date()).getTime();
		var diff = cur - state[index].startTime;
		if (diff < 0)
			diff = 0;
		var h = Math.floor(diff / 3600000);
		diff -= h * 3600000;
		var m = Math.floor(diff / 60000);
		diff -= m * 60000;
		var s = Math.floor(diff / 1000);
		diff -= s * 1000;
		var ms = Math.floor(diff / 100);

		$("#time").text((h > 9 ? "[" : "[0") + h + (m > 9 ? ":" : ":0") + m + (s > 9 ? ":" : ":0") + s + "." + ms + "]");

		$("#startPush").addClass("btn-default");
		$("#startPush").removeClass("btn-warning");
		$("#startPush").attr("disabled", "disabled");

		$("#stopPush").addClass("btn-warning");
		$("#stopPush").removeClass("btn-default");
		$("#stopPush").removeAttr("disabled");
		// $("#setConfig").attr("disabled", "disabled");
		// $("#setConfig").addClass("btn-default");
		// $("#setConfig").removeClass("btn-warning");
	}
	else {
		$("#time").text("[00:00:00.0]");

		$("#stopPush").addClass("btn-default");
		$("#stopPush").removeClass("btn-warning");
		$("#stopPush").attr("disabled", "disabled");

		$("#startPush").addClass("btn-warning");
		$("#startPush").removeClass("btn-default");
		$("#startPush").removeAttr("disabled");
		// $("#setConfig").removeAttr("disabled");
		// $("#setConfig").addClass("btn-warning");
		// $("#setConfig").removeClass("btn-default");
	}
}

setInterval(updateTime, 100);
function hideSvrConfig() {
	$('#configModal').modal('hide');
}
$("#setServer").click(function (e) {
	if ($("#svr_sls").hasClass("active")) {
		func("saveConfigFile", { path: "config/sls.conf", data: $("#sls_config").val() }, function (res) {
			if (res.error != "")
				htmlAlert("#alertSvr", "danger", res.error, "", 2000);
			else
				htmlAlert("#alertSvr", "success", "设置成功！", "", 2000);
		});
	}
	else if ($("#svr_pwd").hasClass("active")) {
		func("setPasswd", $("#passwd").serialize(), function (res) {
			if (res.error != "")
				htmlAlert("#alertSvr", "danger", res.error, "", 2000);
			else
				htmlAlert("#alertSvr", "success", "修改密码成功！", "", 2000);
		});
	}

	setTimeout(hideSvrConfig, 2000);


});

$.ajax({
	url: "config/sls.conf",
	success: function (data) {
		$("#sls_config").val(data);
	}
}).responseText;