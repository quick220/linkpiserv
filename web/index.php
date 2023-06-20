<?php
include("session.php");
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
    <link rel="stylesheet" id="langcss" href="css/cn.css">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="js/global.js"></script>
    <script src="js/zcfg.js"></script>
    <script src="js/flv.js"></script>
    <script src="js/jquery.jsonrpcclient.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="vendor/switch/bootstrap-switch.min.js"></script>
    <link href="css/index.css" rel="stylesheet" />
</head>

<body>
    <div id="snap" style="width: 640px; height:360px; display:none;" ></div>
    <div id="toolbar">
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#configModal"><i class="fa fa-cog"></i></button>
        <div class="btn-group">
            <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-globe"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#" onClick="changeLang('en');">English</a>
                <a class="dropdown-item" href="#" onClick="changeLang('cn');">中文</a>
            </div>
        </div>
        <a href="login.php?logout=true" type="button" class="btn btn-dark"><i class="fa fa-sign-out"></i></a>
    </div>
    <div class="container-fluid">
        <div class="row" style="background-color: #444; ">
            <div class="col-lg-10 offset-lg-1 col-md-12">
                <div class="row mytab">
                    <div class="col active">
                        <div class="mytitle">
                            <h5>聚合通道1</h5><i class="fa fa-edit"></i><span>0kb/s</span>
                        </div>
                        <div class="myimg">
                            <div class="battery">
                                <div class="bat_bar"></div>
                                <div class="bat_txt"></div>
                            </div>
                            <img src="/img/nosignal.jpg" class="img-fluid">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mytitle">
                            <h5>聚合通道2</h5><i class="fa fa-edit"></i><span>0kb/s</span>
                        </div>
                        <div class="myimg">
                            <div class="battery">
                                <div class="bat_bar"></div>
                                <div class="bat_txt"></div>
                            </div>
                            <img src="/img/nosignal.jpg" class="img-fluid">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mytitle">
                            <h5>聚合通道3</h5><i class="fa fa-edit"></i><span>0kb/s</span>
                        </div>
                        <div class="myimg">
                            <div class="battery">
                                <div class="bat_bar"></div>
                                <div class="bat_txt"></div>
                            </div>
                            <img src="/img/nosignal.jpg" class="img-fluid">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mytitle">
                            <h5>聚合通道4</h5><i class="fa fa-edit"></i><span>0kb/s</span>
                        </div>
                        <div class="myimg">
                            <div class="battery">
                                <div class="bat_bar"></div>
                                <div class="bat_txt"></div>
                            </div>
                            <img src="/img/nosignal.jpg" class="img-fluid">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mytitle">
                            <h5>聚合通道5</h5><i class="fa fa-edit"></i><span>0kb/s</span>
                        </div>
                        <div class="myimg">
                            <div class="battery">
                                <div class="bat_bar"></div>
                                <div class="bat_txt"></div>
                            </div>
                            <img src="/img/nosignal.jpg" class="img-fluid">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mytitle">
                            <h5>聚合通道6</h5><i class="fa fa-edit"></i><span>0kb/s</span>
                        </div>
                        <div class="myimg">
                            <div class="battery">
                                <div class="bat_bar"></div>
                                <div class="bat_txt"></div>
                            </div>
                            <img src="/img/nosignal.jpg" class="img-fluid">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12" style="background-color: #202020; border-radius: 0 0 10px 10px; margin-bottom: 15px; padding-top: 15px; padding-bottom: 15px;">
                <div class="row">
                    <div class="col">
                        <div style="width: 100%;padding-bottom: 56.25%; position: relative; margin-bottom: 53px;">
                        
                            <div style="position: absolute;width: 100%;top:0;bottom:-38px;">
                                <div id="player" style="width:100%;height: 100%; background: #000;" ></div>
                                <video id="player_264" controls style="width:100%;height: 100%; background: #000; display:none;" muted></video>
                            </div>
                            <div style="position: absolute;width: 200px;top:15px;right:15px; " class="text-right">
                                <button type="button" id="stopPlay" class="btn btn-warning">
                                        STOP
                                </button>
                            </div>
                        </div>

                        <div class="card dark">
                            <div class="card-header"><cn>推流参数</cn><en>Push config</en></div>
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
                                            <input type="checkbox" zcfg="[#].enable" class="switch form-control bg-dark text-white">
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
                                        <cn>保存</cn><en>Save</en>
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
                        <div class="card dark mb-3 text-center" style="position:relative;">
                            <div id="time" style="font-size: 4rem; ">[00:00:00.0]</div>
                            <div class=" text-center" style="padding-bottom: 15px;">
                                <button type="button" id="startPush" class="btn btn-warning col-3">
                                    <i class="fa fa-video-camera"></i>
                                    <cn>推流</cn><en>Push</en>
                                </button>
                                <button type="button" id="stopPush" disabled="disabled" class="btn btn-default col-3">
                                    <i class="fa fa-stop"></i>
                                    <cn>停止</cn><en>Stop</en>
                                </button>
                            </div>
                            <button type="button" id="reboot" class="btn btn-warning" style="position:absolute; right:10px;bottom:10px; font-size:0.7rem;">
                                    <i class="fa fa-rotate-left"></i>
                                    <cn>重启</cn><en>Reboot</en>
                            </button>
                        </div>
                        <div class="card dark mb-3">
                            <div class="card-header" style="padding: 0;">
                                <ul class="nav nav-tabs md-tabs" id="myTab" role="tablist" style="padding: 10px 15px 0 15px;">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-toggle="tab" href="#cfg_video" role="tab"><cn>视频编码</cn><en>Video config</en></a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-toggle="tab" href="#cfg_audio" role="tab"><cn>音频编码</cn><en>Audio config</en></a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-toggle="tab" href="#cfg_push" role="tab"><cn>推流参数</cn><en>Push config</en></a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-toggle="tab" href="#cfg_intercom" role="tab"><cn>集成通信</cn><en>Intercom</en></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="cfg_video" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row mx-0">
                                            <div class="col px-0">
                                                <form>
                                                    <div class="form-group row">
                                                        <label class="col-4 text-right col-form-label"><cn>码率</cn><en>Bitrate</en></label>
                                                        <div class="col-8">
                                                            <input type="text" zcfg="encode.encV_cfg[0].bitrate" class="form-control bg-dark text-white">
                                                        </div>
                                                    </div>
                                                    <hr style="margin-top:10px; margin-bottom: 10px;" />
                                                    <div class="form-group row">
                                                        <label class="col-4 text-right col-form-label"><cn>分辨率</cn><en>Resolution</en></label>
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
                                                        <label class="col-4 text-right col-form-label"><cn>旋转</cn><en>Rotate</en></label>
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
                                                        <label class="col-4 text-right col-form-label">GOP<cn>(秒)</cn><en>(Sec)</en></label>
                                                        <div class="col-8">
                                                            <input type="text" zcfg="encode.encV_cfg[0].gop" class="form-control bg-dark text-white">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col px-0">
                                                <form>

                                                    <div class="form-group row">
                                                        <label class="col-4 text-right col-form-label"><cn>帧率</cn><en>Framerate</en></label>
                                                        <div class="col-8">
                                                            <input type="text" zcfg="encode.encV_cfg[0].framerate" class="form-control bg-dark text-white">
                                                        </div>
                                                    </div>
                                                    <hr style="margin-top:10px; margin-bottom: 10px;" />
                                                    <div class="form-group row">
                                                        <label class="col-4 text-right col-form-label"><cn>编码</cn><en>Codec</en></label>
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
                                                        <label class="col-4 text-right col-form-label"><cn>码率控制</cn><en>Rate control</en></label>
                                                        <div class="col-8">
                                                            <select zcfg="encode.encV_cfg[0].rcmode" id="rcmode" class="form-control bg-dark text-white">
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
                                                        <label class="col-4 text-right col-form-label"><cn>音源</cn><en>Audio Source</en></label>
                                                        <div class="col-8">
                                                            <select zcfg="encode.encA.source" class="form-control bg-dark text-white">
                                                                <option value="line">Line-In</option>
                                                                <option value="video" cn="视频输入" en="From video"></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr style="margin-top:10px; margin-bottom: 10px;" />
                                                    <div class="form-group row">
                                                        <label class="col-4 text-right col-form-label"><cn>采样率</cn><en>Samplerate</en></label>
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
                                                        <label class="col-4 text-right col-form-label"><cn>码率</cn><en>bitrate</en></label>
                                                        <div class="col-8">
                                                            <input type="text" zcfg="encode.encA_cfg[0].bitrate" class="form-control bg-dark text-white">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col px-0">
                                                <form>
                                                    <div class="form-group row">
                                                        <label class="col-4 text-right col-form-label"><cn>声道</cn><en>Channel</en></label>
                                                        <div class="col-8">
                                                            <select zcfg="encode.encA.channels" class="form-control bg-dark text-white">
                                                                <option value="1">单声道</option>
                                                                <option value="2">立体声</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr style="margin-top:10px; margin-bottom: 10px;" />
                                                    <div class="form-group row">
                                                        <label class="col-4 text-right col-form-label"><cn>编码格式</cn><en>Codec</en></label>
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
                                                        <label class="col-4 text-right col-form-label"><cn>算法策略</cn><en>Algorithm policy</en></label>
                                                        <div class="col-8">
                                                            <select zcfg="buffer.mode" class="form-control bg-dark text-white">
                                                                <option value="0" cn="画质优先" en="Quality first"></option>
                                                                <option value="1" cn="均衡" en="Balance"></option>
                                                                <option value="2" cn="流畅优先" en="Fluency first"></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col px-0">
                                                <form>
                                                    <div class="form-group row">
                                                        <label class="col-4 text-right col-form-label"><cn>延迟</cn><en>Latency</en></label>
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
                                                        <label class="col-4 text-right col-form-label"><cn>本机ID</cn><en>Local ID</en></label>
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
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr style="margin-top:10px; margin-bottom: 10px;" />
                                                    <div class="form-group row">
                                                        <label class="col-4 text-right col-form-label"><cn>延迟</cn><en>Latency</en></label>
                                                        <div class="col-8">
                                                            <select zcfg="intercom.buf" class="form-control bg-dark text-white">
                                                                <option value="8">200ms</option>
                                                                <option value="16">400ms</option>
                                                                <option value="24">600ms</option>
                                                                <option value="32">800ms</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr style="margin-top:10px; margin-bottom: 10px;" />
                                                    <div class="form-group row">
                                                        <label class="col-4 text-right col-form-label"><cn>麦克风增益</cn><en>Mic gain</en></label>
                                                        <div class="col-8">
                                                            <select zcfg="intercom.gain" class="form-control bg-dark text-white">
                                                                <option value="24">24db</option>
                                                                <option value="18">18db</option>
                                                                <option value="12">12db</option>
                                                                <option value="6">6db</option>
                                                                <option value="0">0db</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col px-0">
                                                <form>
                                                    <div class="form-group row">
                                                        <label class="col-4 text-right col-form-label"><cn>目标ID</cn><en>Target ID</en></label>
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
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr style="margin-top:10px; margin-bottom: 10px;" />
                                                    <div class="form-group row">
                                                        <label class="col-4 text-right col-form-label"><cn>自动静音</cn><en>VAD</en></label>
                                                        <div class="col-8">
                                                            <select zcfg="intercom.vad" class="form-control bg-dark text-white">
                                                                <option value="-1" cn="按键发言" en="Press to speak"></option>
                                                                <option value="0" cn="常开" en="Keep open"></option>
                                                                <option value="40" cn="低" en="Low"></option>
                                                                <option value="50" cn="中" en="Mid"></option>
                                                                <option value="65" cn="高" en="High"></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr style="margin-top:10px; margin-bottom: 10px;" />
                                                    <div class="form-group row">
                                                        <label class="col-4 text-right col-form-label">Tally</label>
                                                        <div class="col-8">
                                                        <input type="checkbox" zcfg="intercom.tally" class="switch form-control bg-dark text-white">
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
                                        <cn>保存</cn><en>Save</en>
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
                            <button type="button" id="saveName" class="btn btn-warning col-4"><cn>保存</cn><en>Save</en></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="configModal" tabindex="-1" aria-labelledby="configModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background: none; border:none;">
                <div class="card dark mb-3">
                    <div class="card-header" style="padding: 0;">
                        <ul class="nav nav-tabs md-tabs" role="tablist" style="padding: 10px 15px 0 15px;">
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link active" data-toggle="tab" href="#svr_sls" role="tab">SLS</a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-toggle="tab" href="#svr_pwd" role="tab"><cn>密码设置</cn><en>Password</en></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="svrConfig">
                            <div class="tab-pane fade active show" id="svr_sls" role="tabpanel" aria-labelledby="home-tab">
                                <textarea class="form-control bg-dark text-white" id="sls_config" rows="15"></textarea>
                            </div>
                            <div class="tab-pane fade" id="svr_pwd" role="tabpanel" aria-labelledby="home-tab">
                                <form id="passwd">
                                    <div class="form-group row">
                                        <label class="col-3 text-right col-form-label"><cn>旧密码</cn><en>Old</en></label>
                                        <div class="col-8">
                                            <input type="password" name="old" class="form-control bg-dark text-white">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 text-right col-form-label"><cn>新密码</cn><en>New</en></label>
                                        <div class="col-8">
                                            <input type="password" name="new1" class="form-control bg-dark text-white">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 text-right col-form-label"><cn>确认密码</cn><en>Confirm</en></label>
                                        <div class="col-8">
                                            <input type="password" name="new2" class="form-control bg-dark text-white">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class=" text-center">
                        <hr style="margin-top:10px; margin-bottom: 10px;" />
                        <div id="alertSvr" class="text-left"></div>
                        <button type="button" id="setServer" class="btn btn-warning col-4 mb-3">
                        <cn>保存</cn><en>Save</en>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script language="javascript" src="js/jessibuca.js"></script>
    <script type="text/javascript" language="javascript" src="js/confirm/jquery-confirm.min.js"></script>
    <script language="javascript" src="js/index.js"></script>
</body>

</html>