$.fn.bootstrapSwitch.defaults.size = 'middle';
$.fn.bootstrapSwitch.defaults.onColor = 'warning';
var config = {};
var clientConfig = {};
var state = [];
var index = 0;
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
	rpc("getConfig", [index], function (data) {
		if (data.encode == undefined) {
			setTimeout(getConfig, 300);
		}
		else {
			clientConfig = data;
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


if (flvjs.isSupported()) {
	player = flvjs.createPlayer({
		type: 'flv',
		hasAudio: true,
		url: 'http://' + window.location.host + '/flv?app=live&stream=preview0'
	});
	player.attachMediaElement(document.getElementById("player"));
}


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

function stopPreview() {
	if (player == null)
		return;
	player.unload();
	player.detachMediaElement();
	player.destroy();
	player = null;
}

function startPreview() {
	stopPreview();

	if(state.length==0 || !state[index].alive || state[index].startTime <= 0)
		return;

	player = flvjs.createPlayer({
		type: 'flv',
		hasAudio: true,
		url: 'http://' + window.location.host + '/flv?app=live&stream=preview' + index
	});
	player.attachMediaElement(document.getElementById("player"));
	player.load();
	player.play();
}

function checkDelay() {
	if (player != null && player.buffered.length > 0) {
		console.log(player.buffered.length);
		console.log(player.buffered.end(0) - player.currentTime);
		if (player.buffered.end(0) - player.currentTime > 1) {
			player.currentTime = player.buffered.end(0) - 0.2;
		}
	}

	if (player == null || player.buffered.length <= 0) {
		startPreview();
	}
}

setInterval(checkDelay, 2000);

$(".mytab .col").each(function (index, obj) {
	$(obj).click(function () {
		selectChn(index);
	});

});

$("#setConfig").click(function (e) {
	rpc("setConfig", [index, clientConfig], function (data) {
	});
});

function save() {
	$('#exampleModal').modal('hide');
	rpc("updateChn", [index, config[index]], function (data) {
		$(".mytitle h5").eq(index).text(config[index].name);
	});
}

$("#save").click(save);
$("#saveName").click(save);

$("#startPush").click(function (e) {
	rpc("startPush", [index]);
	startPreview();
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
				$(".mytab img").eq(i).attr("src", "snap/snap" + i + ".jpg?rnd=" + Math.random());
				$(".mytab .mytitle span").eq(i).text(Math.floor(state[i].speed * 8 / 1024) + "kb/s");
				$(".mytab .progress-bar").eq(i).css("width", state[i].buffer + "%");
			}
			else {
				$(".mytab img").eq(i).attr("src", "/img/nosignal.jpg");
				$(".mytab .mytitle span").eq(i).text("- - -");
				$(".mytab .progress-bar").eq(i).css("width", 0);
			}

		}

		var sta = state[index];
		if (sta.alive) {
			for (var i = 0; i < 2; i++) {
				var iface = {};
				if (i == 0)
					iface = sta.iface.sdi;
				else if (i == 1)
					iface = sta.iface.hdmi;

				if (iface.s) {
					$(".myicon").eq(i).addClass("active");
					$(".myicon .b").eq(i).text(iface.h + (iface.i ? "I" : "P") + iface.f);
				}
				else {
					$(".myicon").eq(i).removeClass("active");
					$(".myicon .b").eq(i).text("- - -");
				}
			}

			var net = sta.net;
			for (var i = 0; i < net.length; i++) {
				var k = i + 2;
				if (net[i].a) {
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

				if (i == 1) {
					if (net[i].a)
						$(".myicon").eq(k).find("#wifi").css("background-position-y", (-5 - (4 - net[i].s) * 50) + "px");
					else
						$(".myicon").eq(k).find("#wifi").css("background-position-y", "-5px");
				}
				else if (i > 1) {
					if (net[i].a)
						$(".myicon").eq(k).find("#lte").css("background-position-y", (-5 - (5 - net[i].s) * 50) + "px");
					else
						$(".myicon").eq(k).find("#lte").css("background-position-y", "-5px");
				}

			}
		}


		if(!sta.alive || sta.startTime<=0)
			stopPreview();

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
		$("#setConfig").attr("disabled", "disabled");
		$("#setConfig").addClass("btn-default");
		$("#setConfig").removeClass("btn-warning");
	}
	else {
		$("#time").text("[00:00:00.0]");

		$("#stopPush").addClass("btn-default");
		$("#stopPush").removeClass("btn-warning");
		$("#stopPush").attr("disabled", "disabled");

		$("#startPush").addClass("btn-warning");
		$("#startPush").removeClass("btn-default");
		$("#startPush").removeAttr("disabled");
		$("#setConfig").removeAttr("disabled");
		$("#setConfig").addClass("btn-warning");
		$("#setConfig").removeClass("btn-default");
	}
}

setInterval(updateTime, 100);
function hideSvrConfig()
{
	$('#configModal').modal('hide');
}
$("#setServer").click(function (e) {
	if($("#svr_sls").hasClass("active"))
	{
		func("saveConfigFile", {path: "config/sls.conf",data:$("#sls_config").val()},function( res ) {
			if ( res.error != "" )
				htmlAlert( "#alertSvr", "danger", res.error, "", 2000 );
			else
				htmlAlert( "#alertSvr", "success", "设置成功！", "", 2000 );
		});	
	}
	else if($("#svr_pwd").hasClass("active"))
	{
		func( "setPasswd", $( "#passwd" ).serialize(), function ( res ) {
			if ( res.error != "" )
				htmlAlert( "#alertSvr", "danger", res.error, "", 2000 );
			else
				htmlAlert( "#alertSvr", "success", "修改密码成功！", "", 2000 );
		} );
	}

	setTimeout(hideSvrConfig,2000);
	
	
});

$.ajax( {
	url: "config/sls.conf",
	success: function ( data ) {
		$("#sls_config").val(data);
	}
} ).responseText;