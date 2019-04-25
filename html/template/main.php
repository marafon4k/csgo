<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-COMpatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CSEURO.COM The best place to win CS:GO skins!">
    <meta property="og:description" content="CSEURO.COM The best place to win CS:GO skins!">
    <meta property="og:url" content="https://www.cseuro.COM/">
    <meta property="og:site_name" content="CSEURO.COM">
    <title>Главная - CSEURO.COM</title>
    <link href="template/css/bootstrap.min.new.css" rel="stylesheet">
    <link href="template/css/font-awesome.min.css" rel="stylesheet">
    <link href="template/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.COM/css?family=Raleway:400,800,900,600,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.COM/css?family=Exo+2:400,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href="template/css/mineNew.css" rel="stylesheet">
    <link href="template/css/chat.css" rel="stylesheet" type="text/css" media="all" />
    <link id="style" href="" rel="stylesheet">


    <link rel="shortcut icon" href="favicon.ico">
    <script src="template/js/jquery-1.11.1.min.js"></script>
    <script src="template/js/jquery.cookie.js"></script>
    <script src="template/js/socket.io-1.4.5.js"></script>
    <script src="template/js/bootstrap.min.js"></script>
    <script src="template/js/bootbox.min.js"></script>
    <script src="template/js/dataTables.bootstrap.js"></script>
    <script src="template/js/tinysort.js"></script>
    <script src="template/js/expanding.js"></script>
    <!--<script type="text/javascript" src="template/js/ciastka.js"></script>
<script type="text/javascript" src="/code.jquery.COM/jquery-2.1.1.min.js"></script>-
<script type="text/javascript" src="/jquery-ui.min.js"></script>
<script type="text/javascript" src="/jquery.bez.min.js"></script>
<script src="js/jquery.particleground.min.js"></script>-->
    <script type="text/javascript" src="https://rawgit.COM/notifyjs/notifyjs/master/dist/notify.js"></script>
    <script src="template/js/jcanvas.min.js"></script>
    <script src="template/js/plot.js"></script>
    <script src="template/js/graph.js?v=<?=time()?>"></script>
    <script>
        $.notify.defaults({
            // whether to hide the notification on click
            clickToHide: true,
            // whether to auto-hide the notification
            autoHide: true,
            // if autoHide, hide after milliseconds
            autoHideDelay: 4000,
            // show the arrow pointing at the element
            arrowShow: true,
            // arrow size in pixels
            arrowSize: 177,
            // position defines the notification position though uses the defaults below
            position: '...',
            // default positions
            elementPosition: 'bottom left',
            globalPosition: 'bottom left',
            // default style
            style: 'bootstrap',
            // default class (string or [string])
            className: 'error',
            // show animation
            showAnimation: 'slideDown',
            // show animation duration
            showDuration: 600,
            // hide animation
            hideAnimation: 'slideUp',
            // hide animation duration
            hideDuration: 600,
            // padding between element and notification
            gap: 2
        });



        var SETTINGS = ["confirm", "sounds", "dongers", "hideme"];

        function inlineAlert(x, y) {
            $("#inlineAlert").removeClass("note-success note-danger note-warning hidden");
            if (x == "success") {
                $("#inlineAlert").addClass("note-success").html("<i class='fa fa-check'></i><b> " + y + "</b>");
            } else if (x == "error") {
                $("#inlineAlert").addClass("note-danger").html("<i class='fa fa-exclamation-triangle'></i> " + y);
            } else if (x == "cross") {
                $("#inlineAlert").addClass("note-danger").html("<i class='fa fa-times'></i> " + y);
            } else {
                $("#inlineAlert").addClass("note-warning").html("<b>" + y + " <i class='fa fa-spinner fa-spin'></i></b>");
            }
        }

        function resizeFooter() {
            var f = $('.footer').outerHeight(true);
            var w = $(window).outerHeight(true);
            $('body').css('margin-bottom', f);
        }
        $(window).resize(function() {
            resizeFooter();
        });
        if (!String.prototype.format) {
            String.prototype.format = function() {
                var args = arguments;
                return this.replace(/{(\d+)}/g, function(match, number) {
                    return typeof args[number] != 'undefined' ? args[number] : match;
                });
            };
        }

        function setCookie(key, value) {
            var exp = new Date();
            exp.setTime(exp.getTime() + (365 * 24 * 60 * 60 * 1000));
            document.cookie = key + "=" + value + "; expires=" + exp.toUTCString();
        }

        function getCookie(key) {
            var patt = new RegExp(key + "=([^;]*)");
            var matches = patt.exec(document.cookie);
            if (matches) {
                return matches[1];
            }
            return "";
        }

        function formatNum(x) {
            if (Math.abs(x) >= 10000) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            return x;
        }
        $(document).ready(function() {
            $(".dice").hide();
            $(".coinflip").hide();
            $(".crash").hide();
            resizeFooter();
            for (var i = 0; i < SETTINGS.length; i++) {
                var v = getCookie("settings_" + SETTINGS[i]);
                if (v == "true") {
                    $("#settings_" + SETTINGS[i]).prop("checked", true);
                } else if (v == "false") {
                    $("#settings_" + SETTINGS[i]).prop("checked", false);
                }
            }
        });
    </script>
    <script>
        function showannounce() {
            $('#Agreement').modal('show');
        }
    </script>

    <style>
        .navbar {
            margin-bottom: 0px;
        }
        .progress-bar {
            transition: none !important;
            -webkit-transition: none !important;
            -moz-transition: none !important;
            -o-transition: none !important;
        }
        #case {
            max-width: 1050px;
            height: 99px;
            background-image: url("template/img/cases.png");
            background-repeat: no-repeat;
            background-position: 0px 0px;
            position: relative;
            margin: 0px auto;
        }
    </style>
    <script type="text/javascript" src="template/js/new.js?v=<?=time()?>"></script>
    <script src="template/js/lang.js?v=<?=time()?>"></script>
</head>

<body style="margin-bottom: 62px;">
    <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="padding-top:0px;padding-bottom:0px;padding-right:0px" href="./"><img alt="CSEURO.COM" class="logoo" src="template/img/logo.png">
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <div style="padding-top: 10px;">
                    <ul class="nav navbar-nav">
                        <li class="active" style="margin-left:5px"><a href="/"><i class="fa fa-gamepad" aria-hidden="true"></i> Home</a>
                        </li>
                        <li class=""><a href="/deposit"><i class="fa fa-money" aria-hidden="true"></i> Deposit</a>
                        </li>
                        <li class=""><a href="/withdraw"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Withdraw</a>
                        </li>
                        <li class=""><a href="/rolls"><i class="fa fa-check" aria-hidden="true"></i> Provably Fair</a>
                        </li>
                        <li><a href="#" data-toggle="modal" data-target="#promoModal"><i class="fa fa-usd" aria-hidden="true"></i> Free coins</a>
                    </ul>
                    <? if($user): ?>
                    <ul class="nav navbar-nav navbar-right">
                        <div class="pull-right">
                            <div class="user-info">
                                <ul class="nav">
                                    <li><a href="/profile" class="ajax-modal"><i class="fa fa-university" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="/exit"><i class="fa fa-power-off" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="pull-right user_avatar">
                            <a target="_blank" href="https://steamcommunity.com/profiles/<?=$user['steamid']?>"><img src="<?=$user['avatar']?>" alt="" class="img-responsive-menu"></a>
                        </div>
                        <div class="pull-right userdata">
                            <div class="username-menu"><b><?php echo htmlspecialchars($user['name'])?></b>
                            </div>
                        </div>
                    </ul>
                    <? else: ?>
                    <ul class="nav navbar-nav navbar-right">
                        <a href="#login" role="button" data-toggle="modal"><img style="margin-top:3px;" src="template/img/green.png">
                        </a>
                    </ul>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="modal fade" id="my64id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><b>My Steam64Id</b></h4>
                </div>
                <div class="modal-body">
                    <b><?=($user)?$user['steamid']:''?></b> </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-panelbet" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="login" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><b style="color: red;">Agreement on the use of the site</b></h4>
                </div>
                <div class="modal-body">
                    <p>Dear users, continuing to use our site ("CSEURO.COM") you agree to the <a target="_blank" href="/tos">user agreement</a> and acknowledge that you are 18 years or more.</p>
                    <p>If you do not agree with it and/or you are under 18, then immediately withdraw all the money from your account and do not continue the game, otherwise your account may be restricted/removed as a violation of the <a target="_blank" href="/tos">user agreement</a>.</p>
                    <h4 style="color: red">Additional - READ IT, DON'T SKIP IT!</h4>
                    <p>This part is regarding your safety while using our site so please take a look if you haven't yet.</p>
                    <ul>
                        <li>Most so-called "scripts" most likely aren't going to help you, instead steal your coins</li>
                        <li>Don't provide vulnerable information to other people</li>
                        <li>Hacks for our site? Don't trust in "easy" coins, their just gonna take what you have yourself</li>
                        <li>People contacting you claiming to be admins, mods or other on our site are most likely impersonators. If they ask you do something suspicious then just DON'T DO IT!</li>
                        <li>Simply don't easily trust random people who you COMe across the internet!</li>
                    </ul>
                    <p>Those who didn't read this(or are reading it after they got scammed) or didn't simply listen to this, please know that upon losing your coins by getting "scammed" we don't recover your coins!</p>
                </div>
                <div class="modal-footer">
                    <a style="text-decoration:none" href="/login">
                        <button class="btn btn-danger btn-block" type="button">I accept and confirm!</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="settingsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><b>Settings</b></h4>
                </div>
                <div class="modal-body">
                    <form>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="settings_confirm" checked>
                                <strong>Confirm bids above 1000 coins</strong>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="settings_sounds" checked>
                                <strong>Enable sounds</strong>
                            </label>
                        </div>
                        <!--<div class="checkbox">
				    	<label>
				      		<input type="checkbox" id="settings_dongers">
				      		<strong>Show balance in $</strong>
				    	</label>
				  	</div>-->
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="settings_hideme">
                                <strong>Hide profile link in chat</strong>
                            </label>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-panelbet" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-panelbet" onclick="saveSettings()">Save settings</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="promoModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b>Enter your promotional code!</b></h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Promotional code</label>
                        <input type='text' class='form-control' id='promocode' value=''>
                        <button type="button" class="btn btn-success" onclick="redeem()">Accept</button>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter bonus code</label>
                        <input type='text' class='form-control' id='promocode2' value=''>
                        <button type="button" class="btn btn-info" onclick="redeempromo()">Activate the bonus code</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="chatRules">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b>Chat rules</b></h4>
                </div>
                <div class="modal-body" style="font-size:14px">
                    <ol>
                        <li> The chat is unlocked after 2000 delivered coins. </li>
                        <li> Do not spam - this will lead to a chat ban! </li>
                        <li> Do not beg for coins - this will lead to a chat banana! </li>
                        <li> Do not publish promotional codes in chat - this will lead to a chat banana! </li>
                        <li> Do not advertise - this can lead to lifetime blocking! </li>
                        <li> Technical problems are not solved in the chat, but through the support page. </li>
                        <li> You can contact the owner by mail to admin@cseuro.com. </li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-block" data-dismiss="modal">I got it!</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        function saveSettings() {
            for (var i = 0; i < SETTINGS.length; i++) {
                setCookie("settings_" + SETTINGS[i], $("#settings_" + SETTINGS[i]).is(":checked"));
            }
            $("#settingsModal").modal("hide");
            if ($("#settings_dongers").is(":checked")) {
                $("#balance").html("please reload");
            } else {
                $("#balance").html("please reload");
            }
        }

        function redeem() {
            var code = $("#promocode").val();
            $.ajax({
                url: "/redeem?code=" + code,
                success: function(data) {
                    try {
                        data = JSON.parse(data);
                        console.log(data);
                        if (data.success) {
                            bootbox.alert("Successfully! You are credited " + data.credits + " coins.");
                        } else {
                            bootbox.alert(data.error);
                        }
                    } catch (err) {
                        bootbox.alert("Javascript error: " + err);
                    }
                },
                error: function(err) {
                    bootbox.alert("AJAX error: " + err);
                }
            });
        }

        function redeempromo() {
            var code2 = $("#promocode2").val();
            $.ajax({
                url: "/redeempromo?promocode=" + code2,
                success: function(data) {
                    try {
                        data = JSON.parse(data);
                        console.log(data);
                        if (data.success) {
                            bootbox.alert("Successfully! You are credited " + data.credits + " coins.");
                        } else {
                            bootbox.alert(data.error);
                        }
                    } catch (err) {
                        bootbox.alert("Javascript error: " + err);
                    }
                },
                error: function(err) {
                    bootbox.alert("AJAX error: " + err);
                }
            });
        }
    </script>
    <ul id="contextMenu" class="dropdown-menu" role="menu" style="display:none">
        <li><a tabindex="-1" href="#" data-act="0">Username</a>
        </li>
        <li><a tabindex="-1" href="#" data-act="1">Reply</a>
        </li>
        <li><a tabindex="-1" href="#" data-act="2">Выдать мут</a>
        </li>
        <li><a tabindex="-1" href="#" data-act="3">Send coins</a>
        </li>
        <li><a tabindex="-1" href="#" data-act="4">Ignore</a>
        </li>
        <li><a tabindex="-1" href="#" class="clearChat">Clear chat</a>
        </li>
    </ul>
    <div class="container">
        <div id="mainpage" class="col-xs-9">
            <!--<div class="ipsGrid ipsGrid_collapsePhone ipsWidget_stats ipsWidget_inner">
						<div class="text-center" style="margin-top: 25px;">
				<div id="statsbg">
				<span class="ipsType_large ipsWidget_statsCount" id="red">2</span><br>
				<span class="ipsType_light ipsType_medium title">Admin</span>
                <div class="pulse"></div>
              </div>
				</div>
				<div class="text-center" style="margin-top: 25px;">
				<div id="statsbg">
				<span class='steamstatus'></span><a href="http://steamstat.us/" target="_blank">Check Status</a><br>
				<span class="ipsType_light ipsType_medium title">Steam server</span>
                <div class="pulse"></div>
              </div>
				</div>
				<div class="text-center" style="margin-top: 25px;">
				<div id="statsbg">
				<span class="ipsType_large ipsWidget_statsCount" id="red">2</span><br>
				<span class="ipsType_light ipsType_medium title">Активных бота</span>
                <div class="pulse"></div>
              </div>
				</div>
		</div>-->
            <div class="note note-warning">
                <center><b><i class="fa fa-exclamation-circle"></i> *BETA* Use the "FREE" code to get 500 coins and start playing!</b>
                </center>
            </div>

            <?php if($user [ 'checkdep'] < "5000") { ?>
            <div font color="green" class="note note-info">
                <center><b><font color="yellow">After depositing you will be able to withdraw <?=$user['balance']?> coins.</b>
                </center>
                </font>
            </div>
            <?php } ?>

            <div class="games">
                <div class="roulette">

                    <div class="well text-center" style="margin-bottom:55px;margin-top:25px;padding: 32px 20px 20px 20px;">
                        <div id="case" style="margin-bottom: -15px; background-position: 0px 0px;">
                            <div id="pointer"></div>
                            <div id="caseblack"></div>
                        </div>
                        <div id="past"></div>
                        <div class="progress text-center" style="height:50px;margin-bottom:5px;margin-top:5px">
                            <span id="banner"></span>
                            <div class="progress-bar progress-bar-danger" id="counter"></div>
                        </div>
                        <div class="form-group">
                            <div class="input-btn bet-buttons">
                                <span style="padding: 12px 20px;margin-right: 5px; background: #0b1417;font-size: 14px;margin-top: -3px;border-radius: 7px;/* height: 42px; *//* bordeR: 0; */;color: #fff;text-align: center;font-size: 12px;height: 36px;border: 2px solid #d3be0a;">
						<img src="template/css/img/coins.png"  width="25" height="25">
						<span>Balance: </span>
                                <span id="dongers"></span>
                                <span id="balance">0</span> <i style="cursor:pointer; margin-left: 5px;" class="fa fa-refresh noselect" id="getbal"></i>
                                </span>
                                <button type="button" style="" id="oneplusbutton2" class="btn btn-success btn-lg betshort" data-action="clear">+50</button>
                                <input type="text" class="form-control input-lg" placeholder="Сумма ставки..." id="betAmount">
                                <button type="button" class="btn btn-clear betshort" data-action="clear">Clear</button>
                                <button type="button" class="btn btn-panelbet betshort" data-action="10">+10</button>
                                <button type="button" class="btn btn-panelbet betshort" data-action="100">+100</button>
                                <button type="button" class="btn btn-panelbet betshort" data-action="1000">+1000</button>
                                <button type="button" class="btn btn-panelbet betshort" data-action="half">1/2</button>
                                <button type="button" class="btn btn-panelbet betshort" data-action="double">x2</button>
                                <button type="button" class="btn btn-max betshort" data-action="max">Max</button>
                            </div>
                        </div>
                    </div>
                    <div class="text-center" style="/* padding:5px; *//* margin-bottom:5px; */">
                        <div style="margin: -33px 0px;">
                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="col-xs-4 betBlock" style="padding-right:0px">
                            <div class="panel panel-default bet-panel" id="panel11-7-b">
                                <div class="panel-heading" style="padding: 0px;">
                                    <button class="btn btn-danger btn-lg  btn-block betButton" data-lower="1" data-upper="7"><strong>BET ON RED</strong>
                                    </button>
                                </div>
                            </div>
                            <div class="panel-default bet-panel" id="panel1-7-t">
                                <div class="panel-body" style="padding:0px" id="panel1-7">
                                    <div class="panel-body" style="padding:0px" id="panel1-7-m">
                                        <div class="panel total-row">
                                            <div class="text-left">Your bet: <span class="mytotal">0</span>
                                            </div>
                                            <div class="text-right">Total bet: <span class="total">0</span>
                                            </div>
                                        </div>
                                        <ul class="list-group betlist"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-4 betBlock">
                            <div class="panel panel-default bet-panel" id="panel0-0-b">
                                <div class="panel-heading" style="padding: 0px;">
                                    <button class="btn btn-success btn-lg  btn-block betButton" data-lower="0" data-upper="0"><strong>BET ON GREEN</strong> </button>
                                </div>
                            </div>
                            <div class="panel-default bet-panel" id="panel0-0-t">
                                <div class="panel-body" style="padding:0px" id="panel0-0">
                                    <div class="panel-body" style="padding:0px" id="panel0-0-m">
                                        <div class="panel total-row">
                                            <div class="text-left">Your bet: <span class="mytotal">0</span>
                                            </div>
                                            <div class="text-right">Total bet: <span class="total">0</span>
                                            </div>
                                        </div>
                                        <ul class="list-group betlist"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-4 betBlock" style="padding-left:0px">
                            <div class="panel panel-default bet-panel" id="panel8-14-b">
                                <div class="panel-heading" style="padding: 0px;">
                                    <button class="btn btn-inverse btn-lg  btn-block betButton" data-lower="8" data-upper="14"><strong>BET ON BLUE</strong>
                                    </button>
                                </div>
                            </div>
                            <div class="panel-default bet-panel" id="panel8-14-t">
                                <div class="panel-body" style="padding:0px" id="panel8-14">
                                    <div class="panel-body" style="padding:0px" id="panel8-14-m">
                                        <div class="panel total-row">
                                            <div class="text-left">Your bet: <span class="mytotal">0</span>
                                            </div>
                                            <div class="text-right">Total bet: <span class="total">0</span>
                                            </div>
                                        </div>
                                        <ul class="list-group betlist"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-3" style="margin-left: 15px;">
            <!--<div class="panel panel-default" style="margin-bottom: -10px;margin-left: 0px;">
					<div class="text-center" style="margin-top: 25px;">
					<span class="mode roulette_mode active" style="cursor: pointer; text-align: center; padding: 17px; display: inline-block; width: 100%; border-radius: 10px 10px 0px 0px;" onclick="changeMode('roulette')">
						<i class="fa fa-dot-circle-o" aria-hidden="true"></i> <span class="m-text">Roulette</span><sup class="alert alert-danger" style="margin:0;border:0;padding:0;position:absolute;margin-top:21px;color:green;">ONLINE</sup>
					</span>
					<span class="mode coinflip_mode" style="cursor: pointer; text-align: center; padding: 17px; display: inline-block; width: 100%; border-radius: 0px 0px 10px 10px;" onclick="changeMode('coinflip')">
						<i class="fa fa-gg" aria-hidden="true"></i> <span class="m-text">Coinflip </span><span style="margin:0;border:0;padding:0;margin-top:21px;color:red;"> OFFLINE</span>
					</span>
					<!--<span class="mode crash_mode" style="cursor: pointer; text-align: center; padding: 17px; display: inline-block; width: 100%; border-radius: 0px 0px 10px 10px;" onclick="changeMode('crash')">
						<i class="fa fa-line-chart" aria-hidden="true"></i> <span class="m-text">Crash </span><span style="margin:0;border:0;padding:0;margin-top:21px;color:red;"> OFFLINE</span>
					</span>
				</div>
			</div>-->
            <div id="pullout">
                <div id="tab1" class="tab-group" style="height: 515px;">
                    <div style="    margin: 0px;
    font-size: 13px;
    padding: 20px;
    padding-bottom: 10px;
    text-align: center;
    background: url(template/css/img/chat.png);
    height: 86px;border-radius: 8px 8px 0 0;
	background-repeat: no-repeat;">
                        <div class="pull-right res">
                            <span style="font-family: 'Exo 2', sans-serif;
    font-size: 14px;
    color: red;    line-height: 16px;"><br><br /><br /><? if($user): ?><a href="#" style="color:red;" data-toggle="modal" data-target="#settingsModal">Settings</a> | <a href="#" style="color:red;" data-toggle="modal" data-target="#chatRules">Rules</a> |<? endif; ?> <strong>Online:</strong> <span id="isonline">0</span></span>
                        </div>
                    </div>
                    <div style="width: 106,5%;
height: 80px;
margin: 10px -10px -80px -10px;
">

                    </div>
                    <div class="divchat" id="chatArea"></div>
                    <form id="chatForm">
                        <div style="/* margin: 5px; */">
                            <div class="input-group" style="margin-bottom: 5px">
                                <input type="text" class="form-control" placeholder="Введите текст..." id="chatMessage" maxlength="200">
                                <div class="input-group-btn dropup">
                                    <button id="Smiles" type="submit" class="btn btn-default dropdown-toggle" aria-label="Smiles" style="    width: 102px;
    height: 40px;
    background: url(template/css/img/send.png);
    float: right;
    border: 0;
    border-radius: 0 8px 8px 0;
	margin-top: 3px;">

                                    </button>
                                </div>
                            </div>
                            <!--<input type="checkbox" id="scroll"><span>Приостановить чат</span></label>-->
                            <!--<div class="panel panel-default">
			<div class="panel-body" style="margin-top: 5px;">
				<div><span class="settings-header">ROOM</span>
				<ul class="nav settings-header" style="padding-top: 5px; display: inline-block;">
					<li class="dropdown">
						<img id="changeLang1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" src="https://cseuro.com/template/img/lang/en.png">
						<ul class="dropdown-menu" role="menu" style="min-width: 32px;margin-left: 24%;">
						<li><a onclick="changeLang(2)"><img src="https://cseuro.com/template/img/lang/ru.png"></a></li>
						<li><a onclick="changeLang(1)"><img src="https://cseuro.com/template/img/lang/en.png"></a></li>

						</ul>
					</li>
				</ul>

				<input type="checkbox" id="scroll"><span>Pause chat</span></label>

			</div>
		</div>-->
                        </div>
                    </form>
                </div>
                <div id="tab2" class="tab-group hidden"></div>
                <div id="tab3" class="tab-group hidden"></div>
            </div>
            <div class="panel-default">
            </div>

        </div>
    </div>

    <?php include "Templates/Footer.php"; ?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter46205817 = new Ya.Metrika({
                        id: 46205817,
                        clickmap: true,
                        trackLinks: true,
                        accurateTrackBounce: true
                    });
                } catch (e) {}
            });
            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function() {
                    n.parentNode.insertBefore(s, n);
                };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";
            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/46205817" style="position:absolute; left:-9999px;" alt="" />
        </div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
</body>

</html>