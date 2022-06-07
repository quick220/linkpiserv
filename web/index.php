<?php
include( "session.php" );
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title>LinkPi</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="vendor/switch/bootstrap-switch.css" rel="stylesheet">
    <link href="js/confirm/jquery-confirm.min.css" rel="stylesheet" />

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="js/global.js"></script>
    <script src="js/zcfg.js"></script>
    <script src="js/jquery.jsonrpcclient.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="vendor/switch/bootstrap-switch.min.js"></script>
    <style>
        html,
        body {
            background-color: #333;
            color: #fff;
        }

        .mytab .col {
            color: #999;
            margin-top: 15px;
            box-sizing: border-box;
            padding-top: 10px;
            padding-bottom: 10px;
            box-shadow: 0px -10px 10px -10px #111 inset;
            cursor: pointer;
        }

        .mytab .col.active {
            color: #fff;
            border-radius: 10px 10px 0 0;
            background-color: #202020;
            box-shadow: 0px 0px 10px #111;
        }

        .myimg {
            margin: 5px 0px;
            position: relative;
        }

        .myimg .progress {
            position: absolute;
            left: 5px;
            right: 5px;
            bottom: 5px;
            height: 12px;
        }


        .mytitle {
            border-left: 8px solid #999;
            padding-left: 8px;
        }

        .mytitle.online {
            border-left-color: #00B22D;
        }

        .mytitle h5 {
            font-size: 1rem;
            display: inline;
        }

        .mytitle span {
            float: right;
            color: #999;
        }

        .mytitle i{
            display: none;
            padding: 0 5px;
            color:#999;
        }

        .mytab .col.active .mytitle i{
            display: inline;
        }

        .mytitle i:hover{
            font-weight: bold;
            color:#fb0;
        }


        .card.dark {
            background-color: #000;
            border: 0px;
            border-radius: 10px;
            
            box-shadow: 0px 0px 6px #0a0a0a;
        }

        .card.dark .card-header {
            background-color: #181818;
            border-bottom: 0;
        }

        .card.dark .card-header:first-child {
            border-radius: 10px 10px 0 0;
        }

        .card hr {
            border-top-color: #222;
        }

        .btn-warning {
            background-color: #fb0;
            border-color: #ea0;
        }

        .btn-warning:hover {
            background-color: #ea0;
            border-color: #d90;
        }

        .bootstrap-switch .bootstrap-switch-handle-on.bootstrap-switch-warning,
        .bootstrap-switch .bootstrap-switch-handle-off.bootstrap-switch-warning {
            background-color: #fb0;
            color: #000;
        }

        .bootstrap-switch .bootstrap-switch-handle-on.bootstrap-switch-default,
        .bootstrap-switch .bootstrap-switch-handle-off.bootstrap-switch-default {
            background-color: rgb(52, 58, 64);
            color: #888;
        }

        .myicon {
            opacity: 0.3;
        }

        .myicon.active {
            opacity: 1;
        }

        .myicon .t {
            overflow: hidden;
        }

        ;

        .myicon .b {
            overflow: hidden;
        }

        #wifi {
            display: block;
            margin: 0 auto;
            width: 50px;
            height: 40px;
            ;
            background-image: url("img/wifi.png");
            background-position-x: 0;
            background-position-y: -55px;
        }

        #lte {
            display: block;
            text-align: left;
            margin: 0 auto;
            width: 50px;
            height: 40px;
            ;
            background-image: url("img/lte.png");
            background-position-x: 0;
            background-position-y: -55px;
        }

        #lte .svr {
            font-weight: bolder;

        }

        .nav-tabs {
            border-bottom: none;
        }
        .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
            color: #fff;
            background-color: #000;
            border-color: #000;
            border-radius: 10px 10px 0 0;
        }

        .nav-tabs .nav-link{
            color: #666;
        }

        .btn.disabled, .btn:disabled {
            opacity: 1;
        }

        .jconfirm .jconfirm-box {
            background: #222;
            border: 1px solid #666;
            box-shadow: 0px 0px 10px #000;
        }
        #minqp,#maxqp{
            display: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row" style="background-color: #444; ">
            <div class="col-lg-10 offset-lg-1 col-md-12">
                <div class="row mytab">
                    <div class="col active">
                        <div class="mytitle">
                            <h5>聚合通道1</h5><i class="fa fa-edit"></i><span>0kb/s</span>
                        </div>
                        <div class="myimg">
                            <img src="/img/nosignal.jpg" class="img-fluid">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mytitle">
                            <h5>聚合通道2</h5><i class="fa fa-edit"></i><span>0kb/s</span>
                        </div>
                        <div class="myimg">
                            <img src="/img/nosignal.jpg" class="img-fluid">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar"  aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mytitle">
                            <h5>聚合通道3</h5><i class="fa fa-edit"></i><span>0kb/s</span>
                        </div>
                        <div class="myimg">
                            <img src="/img/nosignal.jpg" class="img-fluid">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar"  aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mytitle">
                            <h5>聚合通道4</h5><i class="fa fa-edit"></i><span>0kb/s</span>
                        </div>
                        <div class="myimg">
                            <img src="/img/nosignal.jpg" class="img-fluid">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar"  aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mytitle">
                            <h5>聚合通道5</h5><i class="fa fa-edit"></i><span>0kb/s</span>
                        </div>
                        <div class="myimg">
                            <img src="/img/nosignal.jpg" class="img-fluid">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar"  aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mytitle">
                            <h5>聚合通道6</h5><i class="fa fa-edit"></i><span>0kb/s</span>
                        </div>
                        <div class="myimg">
                            <img src="/img/nosignal.jpg" class="img-fluid">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar"  aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12"
                style="background-color: #202020; border-radius: 0 0 10px 10px; margin-bottom: 15px; padding-top: 15px; padding-bottom: 15px;">
                <div class="row">
                    <div class="col">
                        <div style="width: 100%;padding-bottom: 56.25%; position: relative; margin-bottom: 15px;">
                            <div style="position: absolute;width: 100%;height: 100%;">
                                <video id="player" controls style="width:100%;height: 100%; background: #000;"
                                    muted></video>
                            </div>
                        </div>

                        <div class="card dark">
                            <div class="card-header">推流参数</div>
                            <div class="card-body" style="padding-top: 10px;">
                                <div id="templetURL">
                                    <div class="row">
                                        <div class="col-2">
                                            <input zcfg="[#].des" type="text" class="form-control bg-dark text-white">
                                        </div>
                                        <div class="col-6">
                                            <input zcfg="[#].path" type="text" class="form-control bg-dark text-white">
                                        </div>
                                        <div class="col-2 text-center">
                                            <input type="checkbox" zcfg="[#].enable"
                                                class="switch form-control bg-dark text-white">
                                        </div>
                                        <div class="col-2 text-center">
                                            <p class="form-control-static speed"></p>
                                        </div>
                                    </div>
                                    <hr style="margin-top:10px; margin-bottom: 10px;" />
                                </div>
                                <div class="form-group">
                                    <div class="text-center">
                                        <button type="button" id="save" class="btn btn-warning col-4">
                                            保存
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card dark mb-3 text-center" style="padding: 20px 0;">
                            <div class="row mx-0 text-center">
                                <div class="col px-0 myicon active">
                                    <div class="t">SDI</div>
                                    <div class="m">
                                        <img src="img/sdi.png" alt="">
                                    </div>
                                    <div class="b">
                                        1080P60
                                    </div>
                                </div>
                                <div class="col px-0 myicon">
                                    <div class="t">HDMI</div>
                                    <div class="m">
                                        <img src="img/hdmi.png" alt="">
                                    </div>
                                    <div class="b">
                                        - - -
                                    </div>
                                </div>
                                <div class="col px-0 myicon">
                                    <div class="t">LAN</div>
                                    <div class="m">
                                        <img src="img/lan.png" alt="">
                                    </div>
                                    <div class="b">
                                        0kb
                                    </div>
                                </div>
                                <div class="col px-0 myicon">
                                    <div class="t">WiFi</div>
                                    <div class="m">
                                        <span id="wifi"></span>
                                    </div>
                                    <div class="b">
                                        0kb
                                    </div>
                                </div>
                                <div class="col px-0 myicon active">
                                    <div class="t">中国移动</div>
                                    <div class="m">
                                        <span id="lte"><span class="svr">4G</span></span>
                                    </div>
                                    <div class="b">
                                        0kb
                                    </div>
                                </div>
                                <div class="col px-0 myicon">
                                    <div class="t">中国移动</div>
                                    <div class="m">
                                        <span id="lte"><span class="svr">4G</span></span>
                                    </div>
                                    <div class="b">
                                        0kb
                                    </div>
                                </div>
                                <div class="col px-0 myicon">
                                    <div class="t">中国移动</div>
                                    <div class="m">
                                        <span id="lte"><span class="svr">4G</span></span>
                                    </div>
                                    <div class="b">
                                        0kb
                                    </div>
                                </div>
                                <div class="col px-0 myicon">
                                    <div class="t">中国移动</div>
                                    <div class="m">
                                        <span id="lte"><span class="svr">4G</span></span>
                                    </div>
                                    <div class="b">
                                        0kb
                                    </div>
                                </div>
                                <div class="col px-0 myicon">
                                    <div class="t">中国移动</div>
                                    <div class="m">
                                        <span id="lte"><span class="svr">4G</span></span>
                                    </div>
                                    <div class="b">
                                        0kb
                                    </div>
                                </div>
                                <div class="col px-0 myicon">
                                    <div class="t">中国移动</div>
                                    <div class="m">
                                        <span id="lte"><span class="svr">4G</span></span>
                                    </div>
                                    <div class="b">
                                        0kb
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card dark mb-3 text-center">
                            <div id="time" style="font-size: 4rem; ">[00:00:00.0]</div>
                            <div class=" text-center" style="padding-bottom: 15px;">
                                <button type="button" id="startPush" class="btn btn-warning col-3">
                                    <i class="fa fa-video-camera"></i>
                                    推流
                                </button>
                                <button type="button" id="stopPush" disabled="disabled" class="btn btn-default col-3">
                                    <i class="fa fa-stop"></i>
                                    停止
                                </button>
                            </div>
                        </div>
                        <div class="card dark mb-3">
                            <div class="card-header" style="padding: 0;">
                            <ul class="nav nav-tabs md-tabs" id="myTab" role="tablist" style="padding: 10px 15px 0 15px;">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-toggle="tab" href="#cfg_video" role="tab">视频编码</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#cfg_audio" role="tab">音频编码</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#cfg_push" role="tab">推流参数</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#cfg_intercom" role="tab">集成通信</a>
                                </li>
                            </ul>
                            </div>
                            <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="cfg_video" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row mx-0" >
                                    <div class="col px-0">
                                        <form>
                                            <div class="form-group row">
                                                <label class="col-4 text-right col-form-label">码率</label>
                                                <div class="col-8">
                                                    <input type="text" zcfg="encode.encV_cfg[0].bitrate" class="form-control bg-dark text-white">
                                                </div>
                                            </div>
                                            <hr style="margin-top:10px; margin-bottom: 10px;" />
                                            <div class="form-group row">
                                                <label class="col-4 text-right col-form-label">分辨率</label>
                                                <div class="col-8">
                                                    <select zcfg="encode.encV.width*x*encode.encV.height" class="form-control bg-dark text-white">
                                                        <option value="1920x1080">1080p</option>
                                                        <option value="1280x720">720p</option>
                                                        <option value="640x360">360p</option>
                                                        <option value="1080x1920">1080x1920</option>
                                                        <option value="720x1280">720x1280</option>
                                                        <option value="360x640">360x640</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr style="margin-top:10px; margin-bottom: 10px;" />
                                            <div class="form-group row">
                                                <label class="col-4 text-right col-form-label">旋转</label>
                                                <div class="col-8">
                                                    <select zcfg="encode.encV.rotate" class="form-control bg-dark text-white">
                                                        <option value="0">0</option>
                                                        <option value="90">90</option>
                                                        <option value="180">180</option>
                                                        <option value="270">270</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr style="margin-top:10px; margin-bottom: 10px;" />
                                            <div id="minqp">
                                                <div class="form-group row">
                                                    <label class="col-4 text-right col-form-label">minQP</label>
                                                    <div class="col-8">
                                                        <input type="text" zcfg="encode.encV_cfg[0].minqp" class="form-control bg-dark text-white">
                                                    </div>
                                                </div>
                                                <hr style="margin-top:10px; margin-bottom: 10px;" />
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-4 text-right col-form-label">GOP(秒)</label>
                                                <div class="col-8">
                                                    <input type="text" zcfg="encode.encV_cfg[0].gop" class="form-control bg-dark text-white">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col px-0">
                                        <form>
                                            
                                            <div class="form-group row">
                                                <label class="col-4 text-right col-form-label">帧率</label>
                                                <div class="col-8">
                                                    <input type="text" zcfg="encode.encV_cfg[0].framerate" class="form-control bg-dark text-white">
                                                </div>
                                            </div>
                                            <hr style="margin-top:10px; margin-bottom: 10px;" />
                                            <div class="form-group row">
                                                <label class="col-4 text-right col-form-label">编码</label>
                                                <div class="col-8">
                                                    <select zcfg="encode.encV.codec*,*encode.encV.profile" class="form-control bg-dark text-white">
                                                        <option value="h264,base">H.264 Baseline Profile</option>
                                                        <option value="h264,main">H.264 Main Profile</option>
                                                        <option value="h264,high">H.264 High Profile</option>
                                                        <option value="h265,main">H.265 Main Profile</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr style="margin-top:10px; margin-bottom: 10px;" />
                                            <div class="form-group row">
                                                <label class="col-4 text-right col-form-label">码率控制</label>
                                                <div class="col-8">
                                                    <select zcfg="encode.encV_cfg[0].rcmode" class="form-control bg-dark text-white">
                                                        <option value="avbr">AVBR</option>
                                                        <option value="vbr">VBR</option>
                                                        <option value="cbr">CBR</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr style="margin-top:10px; margin-bottom: 10px;" />
                                            <div id="maxqp">
                                                <div class="form-group row">
                                                    <label class="col-4 text-right col-form-label">maxQP</label>
                                                    <div class="col-8">
                                                        <input type="text" zcfg="encode.encV_cfg[0].maxqp" class="form-control bg-dark text-white">
                                                    </div>
                                                </div>
                                                <hr style="margin-top:10px; margin-bottom: 10px;" />
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                                </div>
                                <div class="tab-pane fade" id="cfg_audio" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row mx-0" id="config">
                                        <div class="col px-0">
                                            <form>
                                                <div class="form-group row">
                                                    <label class="col-4 text-right col-form-label">音源</label>
                                                    <div class="col-8">
                                                        <select zcfg="encode.encA.source" class="form-control bg-dark text-white">
                                                            <option value="line">Line-In</option>
                                                            <option value="video">视频输入</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr style="margin-top:10px; margin-bottom: 10px;" />
                                                <div class="form-group row">
                                                    <label class="col-4 text-right col-form-label">采样率</label>
                                                    <div class="col-8">
                                                        <select zcfg="encode.encA.samplerate" class="form-control bg-dark text-white">
                                                            <option value="16000">16K</option>
                                                            <option value="32000">32K</option>
                                                            <option value="44100">44.1K</option>
                                                            <option value="48000">48K</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr style="margin-top:10px; margin-bottom: 10px;" />
                                                <div class="form-group row">
                                                    <label class="col-4 text-right col-form-label">码率</label>
                                                    <div class="col-8">
                                                        <input type="text" zcfg="encode.encA_cfg[0].bitrate" class="form-control bg-dark text-white">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col px-0">
                                            <form>
                                                <div class="form-group row">
                                                    <label class="col-4 text-right col-form-label">声道</label>
                                                    <div class="col-8">
                                                        <select zcfg="encode.encA.channels" class="form-control bg-dark text-white">
                                                            <option value="1">单声道</option>
                                                            <option value="2">立体声</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr style="margin-top:10px; margin-bottom: 10px;" />
                                                <div class="form-group row">
                                                    <label class="col-4 text-right col-form-label">编码格式</label>
                                                    <div class="col-8">
                                                        <select zcfg="encode.encA.codec" class="form-control bg-dark text-white">
                                                            <option value="aac">AAC</option>
                                                            <option value="pcma">PCMA</option>
                                                            <option value="mp2">MPEG2</option>
                                                            <option value="mp3">MP3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr style="margin-top:10px; margin-bottom: 10px;" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="cfg_push" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row mx-0" id="config">
                                        <div class="col px-0">
                                            <form>
                                                <div class="form-group row">
                                                    <label class="col-4 text-right col-form-label">算法策略</label>
                                                    <div class="col-8">
                                                    <select zcfg="buffer.mode" class="form-control bg-dark text-white">
                                                            <option value="0">画质优先</option>
                                                            <option value="1">均衡</option>
                                                            <option value="2">流畅优先</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col px-0">
                                            <form>
                                                <div class="form-group row">
                                                    <label class="col-4 text-right col-form-label">延迟</label>
                                                    <div class="col-8">
                                                        <input type="text" zcfg="buffer.latency" class="form-control bg-dark text-white">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="cfg_intercom" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row mx-0" id="config">
                                        <div class="col px-0">
                                            <form>
                                                <div class="form-group row">
                                                    <label class="col-4 text-right col-form-label">本机ID</label>
                                                    <div class="col-8">
                                                        <select zcfg="intercom.did" class="form-control bg-dark text-white">
                                                            <option value="0">0</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr style="margin-top:10px; margin-bottom: 10px;" />
                                                <div class="form-group row">
                                                    <label class="col-4 text-right col-form-label">延迟</label>
                                                    <div class="col-8">
                                                        <select zcfg="intercom.buf" class="form-control bg-dark text-white">
                                                            <option value="8">200ms</option>
                                                            <option value="16">400ms</option>
                                                            <option value="24">600ms</option>
                                                            <option value="32">800ms</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col px-0">
                                            <form>
                                            <div class="form-group row">
                                                    <label class="col-4 text-right col-form-label">目标ID</label>
                                                    <div class="col-8">
                                                        <select zcfg="intercom.tid" class="form-control bg-dark text-white">
                                                            <option value="-1">ALL</option>
                                                            <option value="0">0</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr style="margin-top:10px; margin-bottom: 10px;" />
                                                <div class="form-group row">
                                                    <label class="col-4 text-right col-form-label">自动静音</label>
                                                    <div class="col-8">
                                                        <select zcfg="intercom.vad" class="form-control bg-dark text-white">
                                                            <option value="0">关闭</option>
                                                            <option value="40">低</option>
                                                            <option value="50">中</option>
                                                            <option value="65">高</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class=" text-center">
                                    <hr style="margin-top:10px; margin-bottom: 10px;" />
                                    <button type="button" id="setConfig" class="btn btn-warning col-4">
                                        保存
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content  bg-dark">
        <div class="modal-body pt-4">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    
            <input type="text" zcfg="name" class="form-control bg-dark text-white">
                </div>
            </div>
            <div class="row m-3">
                <div class="text-center" style="display: block; width:100%;">
                    <button type="button" id="saveName" class="btn btn-warning col-4">保存</button>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <script language="javascript" src="js/flv.js" ></script>
    <script type="text/javascript" language="javascript" src="js/confirm/jquery-confirm.min.js"></script>
    <script>
        $.fn.bootstrapSwitch.defaults.size = 'middle';
        $.fn.bootstrapSwitch.defaults.onColor = 'warning';
        var config = {};
        var clientConfig={};
        var state = [];
        var index = 0;
        $.getJSON("config/MPConfig.json", function (result) {
            config = result;
            for (var i = 0; i < config.length; i++) {
                $(".mytitle h5").eq(i).text(config[i].name);
            }

            $(".mytitle i").each(function(i,obj){
                $(obj).click(function(e){
                    $('#exampleModal').modal('show');
                });
            });

            selectChn(0);
            
            getState();
            setInterval(getSpeed,2000);
            setInterval(getState,1000);
        });

        function getConfig()
        {
            rpc( "getConfig", [index], function ( data ) {
                console.log(data);
                if(data.encode==undefined)
                {
                    setTimeout(getConfig,300);
                }
                else
                {
                    clientConfig=data;
                    zcfg("#myTabContent",clientConfig);
                }
            } );
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

            for(var i=0;i<10;i++)
            {
                $(".myicon").eq(i).removeClass("active");
                $(".myicon .b").eq(i).text("- - -");
                if(i>2)
                    $(".myicon .t").eq(i).text("- - -");
                $(".myicon .svr").each(function(ii,obj){
                    $(obj).text("X");
                });
            }
            getConfig();
            startPreview();
        }

        var player=null;


    if (flvjs.isSupported()) {
        player = flvjs.createPlayer({
            type: 'flv',
            hasAudio: true,
            url: 'http://'+window.location.host+'/flv?app=live&stream=preview0'
        });
        player.attachMediaElement(document.getElementById("player"));
    }


        function stopPreview()
        {
            if(player==null)
                return;
            player.unload();
            player.detachMediaElement();
            player.destroy();
            player=null;
        }

        function startPreview()
        {
            stopPreview();

            player = flvjs.createPlayer({
                type: 'flv',
                hasAudio: true,
                url: 'http://'+window.location.host+'/flv?app=live&stream=preview'+index
            });
            player.attachMediaElement(document.getElementById("player"));
            player.load();
            player.play();
        }

        function checkDelay() {
            if (player != null && player.buffered.length > 0) {
                //console.log(player.currentTime,player.buffered.end(0));
                if (player.buffered.end(0) - player.currentTime > 0.6) {
                    player.currentTime = player.buffered.end(0) - 0.2;
                }
            }

            if (player != null && player.buffered.length<=0){
                startPreview();
            }
        }

        setInterval(checkDelay, 1000);

        $(".mytab .col").each(function (index, obj) {
            $(obj).click(function () {
                selectChn(index);
            });

        });

        $( "#setConfig" ).click( function ( e ) {
            rpc( "setConfig", [index,clientConfig], function ( data ) {
            } );
        } );

        function save()
        {
            $('#exampleModal').modal('hide');
            rpc( "updateChn", [index,config[index] ], function ( data ) {
                $(".mytitle h5").eq(index).text(config[index].name);
            } );
        }

        $( "#save" ).click(save);
        $( "#saveName" ).click(save);

        $( "#startPush" ).click( function ( e ) {
            rpc( "startPush",[index]);
            startPreview();
        } );

        $( "#stopPush").click( function ( e ) {
            $.confirm( {
                    title: '停止推流',
                    content: '是否立即停止推流？',
                    buttons: {
                        ok: {
                            text: "确认停止",
                            btnClass: 'btn-warning',
                            type: 'dark',
                            keys: [ 'enter' ],
                            action: function () {
                                rpc( "stopPush",[index]);
                                stopPreview();
                                setTimeout(getState,300);
                            }
                        },
                        cancel: {
                            text: "取消",
                            action: function () {
                                console.log( 'the user clicked cancel' );
                            }
                        }

                    }
                } );
                return false;
            
        } );

        function getSpeed(){
            rpc( "getSpeed", [index], function ( data ) {

                for(var i=0;i<data.length;i++)
                {
                    $("#templetURL .speed").eq(i).text(data[i]+"kb/s");
                }
            } );
        }

        function getState() {
            rpc("getState", null, function (data) {
                state = data;
                //console.log(data);
                for (var i = 0; i < state.length; i++) {
                    if (state[i].alive) {
                        $(".mytab .mytitle").eq(i).addClass("online");
                    }
                    else{
                        $(".mytab .mytitle").eq(i).removeClass("online");
                    }

                    if(state[i].alive && state[i].startTime>0)
                    {
                        $(".mytab img").eq(i).attr( "src", "snap/snap" + i + ".jpg?rnd=" + Math.random() );
                        $(".mytab .mytitle span").eq(i).text(Math.floor(state[i].speed*8/1024)+"kb/s");
                        $(".mytab .progress-bar").eq(i).css("width",state[i].buffer+"%");
                    }
                    else
                    {
                        $(".mytab img").eq(i).attr( "src", "/img/nosignal.jpg" );
                        $(".mytab .mytitle span").eq(i).text("- - -");
                        $(".mytab .progress-bar").eq(i).css("width",0);
                    }

                }

                var sta=state[index];
                if(sta.alive)
                {
                    for(var i=0;i<2;i++)
                    {
                        var iface={};
                        if(i==0)
                            iface=sta.iface.sdi;
                        else if(i==1)
                            iface=sta.iface.hdmi;
                        
                        if(iface.s){
                            $(".myicon").eq(i).addClass("active");
                            $(".myicon .b").eq(i).text(iface.h+(iface.i?"I":"P")+iface.f);
                        }
                        else {
                            $(".myicon").eq(i).removeClass("active");
                            $(".myicon .b").eq(i).text("- - -");
                        }
                    }

                    var net=sta.net;
                    for (var i = 0; i < net.length; i++) {
                        var k = i + 2;
                        if (net[i].a) {
                            $(".myicon").eq(k).addClass("active");
                            if(net[i].t!=undefined)
                                $(".myicon .t").eq(k).text(net[i].t);
                            if(net[i].o!=undefined)
                                $(".myicon").eq(k).find(".svr").text(net[i].o);
                            
                                $(".myicon .b").eq(k).text(net[i].tx+"kb");
                        }
                        else{
                            $(".myicon").eq(k).removeClass("active");
                            if(i>0)
                                $(".myicon .t").eq(k).text("- - -");
                            if(i>1)
                                $(".myicon").eq(k).find(".svr").text("X");
                            
                            $(".myicon .b").eq(k).text("- - -");

                        }

                        if(i==1)
                        {
                            if(net[i].a)
                                $(".myicon").eq(k).find("#wifi").css("background-position-y",(-5-(4-net[i].s)*50)+"px");
                            else
                                $(".myicon").eq(k).find("#wifi").css("background-position-y","-5px");
                        }
                        else if(i>1)
                        {
                            if(net[i].a)
                                $(".myicon").eq(k).find("#lte").css("background-position-y",(-5-(5-net[i].s)*50)+"px");
                            else
                                $(".myicon").eq(k).find("#lte").css("background-position-y","-5px");
                        }
                        
                    }
                }
                
                


               

                
            });
        }

        function updateTime(){
            if(state.length==0)
                return;
            if(state[index].alive && state[index].startTime>0)
            {
                var cur=(new Date()).getTime();
                var diff=cur-state[index].startTime;
                if(diff<0)
                    diff=0;
                var h=Math.floor(diff/3600000);
                diff-=h*3600000;
                var m=Math.floor(diff/60000);
                diff-=m*60000;
                var s=Math.floor(diff/1000);
                diff-=s*1000;
                var ms=Math.floor(diff/100);

                $("#time").text((h>9?"[":"[0")+h+(m>9?":":":0")+m+(s>9?":":":0")+s+"."+ms+"]");

                $("#startPush").addClass("btn-default");
                $("#startPush").removeClass("btn-warning");
                $("#startPush").attr("disabled","disabled");
                
                $("#stopPush").addClass("btn-warning");
                $("#stopPush").removeClass("btn-default");
                $("#stopPush").removeAttr("disabled");
                $("#setConfig").attr("disabled","disabled");
                $("#setConfig").addClass("btn-default");
                $("#setConfig").removeClass("btn-warning");
            }
            else{
                $("#time").text("[00:00:00.0]");

                $("#stopPush").addClass("btn-default");
                $("#stopPush").removeClass("btn-warning");
                $("#stopPush").attr("disabled","disabled");
                
                $("#startPush").addClass("btn-warning");
                $("#startPush").removeClass("btn-default");
                $("#startPush").removeAttr("disabled");
                $("#setConfig").removeAttr("disabled");
                $("#setConfig").addClass("btn-warning");
                $("#setConfig").removeClass("btn-default");
            }
        }
        
        setInterval(updateTime, 100);
    </script>
</body>

</html>