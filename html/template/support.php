<html lang="en"><head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="CSEURO.COM The best place to win CS:GO skins!">
		<meta property="og:description" content="CSEURO.COM The best place to win CS:GO skins!">
		<meta property="og:url" content="https://www.cseuro.com/">
		<meta property="og:site_name" content="CSGO-Bet.pl">
		<title>Поддержка - CSEURO.COM</title>
		<link href="template/css/bootstrap.min.new.css" rel="stylesheet">
<link href="template/css/font-awesome.min.css" rel="stylesheet">
<link href="template/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Raleway:400,800,900,600,300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Exo+2:400,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link href="template/css/mineNew.css?v=5" rel="stylesheet">
<link id="style" href="" rel="stylesheet">

		<link rel="shortcut icon" href="favicon.ico">

		<script src="template/js/jquery-1.11.1.min.js"></script>
		<script src="template/js/jquery.cookie.js"></script>
		<script src="template/js/bootstrap.min.js"></script>
		<script src="template/js/bootbox.min.js"></script>
		<script src="template/js/jquery.dataTables.min.js"></script>
		<script src="template/js/dataTables.bootstrap.js"></script>
		<script src="template/js/tinysort.js"></script>
		<script src="template/js/expanding.js"></script>
<style>

</style>
<script>
	var SETTINGS = ["confirm","sounds","dongers","hideme"];
	function inlineAlert(x,y){
		$("#inlineAlert").removeClass("note-success note-danger note-warning hidden");
		if(x=="success"){
			$("#inlineAlert").addClass("note-success").html("<i class='fa fa-check'></i><b> "+y+"</b>");
		}else if(x=="error"){
			$("#inlineAlert").addClass("note-danger").html("<i class='fa fa-exclamation-triangle'></i> "+y);
		}else if(x=="cross"){
			$("#inlineAlert").addClass("note-danger").html("<i class='fa fa-times'></i> "+y);
		}else{
			$("#inlineAlert").addClass("note-warning").html("<b>"+y+" <i class='fa fa-spinner fa-spin'></i></b>");
		}
	}
	function resizeFooter(){
		var f = $('.footer').outerHeight(true);
		var w = $(window).outerHeight(true);
		$('body').css('margin-bottom',f);
	}
	$(window).resize(function(){
		resizeFooter();
	});
	if (!String.prototype.format) {
	  String.prototype.format = function() {
	    var args = arguments;
	    return this.replace(/{(\d+)}/g, function(match, number) { 
	      return typeof args[number] != 'undefined'
	        ? args[number]
	        : match
	      ;
	    });
	  };
	}
	function setCookie(key,value){
		var exp = new Date();
		exp.setTime(exp.getTime()+(365*24*60*60*1000));
		document.cookie = key+"="+value+"; expires="+exp.toUTCString();
	}
	function getCookie(key){
		var patt = new RegExp(key+"=([^;]*)");
		var matches = patt.exec(document.cookie);
		if(matches){
			return matches[1];
		}
		return "";
	}
	function formatNum(x){
		if(Math.abs(x)>=10000){
			return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}
		return x;
	}
	$(document).ready(function(){
		resizeFooter();
		for(var i=0;i<SETTINGS.length;i++){
			var v = getCookie("settings_"+SETTINGS[i]);
			if(v=="true"){
				$("#settings_"+SETTINGS[i]).prop("checked",true);	
			}else if(v=="false"){
				$("#settings_"+SETTINGS[i]).prop("checked",false);	
			}			
		}
	});
</script>
		<style>
        textarea{
            margin-bottom: 5px;
        }
        .panel-body .alert:last-child{
            margin-bottom: 0px;
        }
        .bubble{
            margin-bottom: 5px !important;
        }
		
		</style>
		<script type="text/javascript">
            var reload = true;
            $(document).ready(function(){
                $(".support_button").on("click",function(){
                    var tid = $(this).data("x");
                    var title = $("#ticketTitle").val();
                    var cat = $("#ticketCat").val();
                    var body = $("#text"+tid).val();
                    var close = $("#check"+tid).is(":checked")?1:0;
                    var flag = $("#flag"+tid).is(":checked")?1:0;
                    var lmao = $("#lmao"+tid).is(":checked")?1:0;
                    var conf = "Вы действительно хотите отправить этот вопрос?";
                    if(tid==0){
                        if(title.length==0){
                            bootbox.alert("Название не может быть пустым.");
                            return;
                        }else if(cat==0){
                            bootbox.alert("Отдел не может быть пустым.");
                            return;
                        }else if(body.length==0){
                            bootbox.alert("Описание не может быть пустым.");
                            return;
                        }
                        conf = "Вы уверены, что хотите подтвердить этот запрос?<br><br><b style='color:red'>ПРЕДУПРЕЖДЕНИЕ: Неправильное использование этой системы приведет недельной блокировке.</b>";
                    }                        
                    bootbox.confirm(conf,function(result){
                        if(result){
                            $.ajax({
                                url:"/support_new",
                                type:"POST",
                                data:{"tid":tid,"title":title,"reply":body,"close":close,"cat":cat,"flag":flag,"lmao":lmao},
                                success:function(data){
                                    try{
                                        data = JSON.parse(data);
                                        if(data.success){
                                            bootbox.alert(data.msg,function(){
                                                if(reload){
                                                   location.reload(); 
                                               }                                                
                                            });                     
                                        }else{
                                            bootbox.alert(data.error);
                                        }
                                    }catch(err){
                                        bootbox.alert("Javascript error: "+err);
                                    }
                                },
                                error:function(err){
                                    bootbox.alert("AJAX error: "+err.statusText);
                                }
                            });
                        }
                    });                                        
                    return false;
                });             
            });			
		</script>	
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
			<a class="navbar-brand" style="padding-top:0px;padding-bottom:0px;padding-right:0px" href="./"><img alt="CSGORampage.com" class="logoo" src="template/img/logo.png"></a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
        <div style="padding-top: 10px;">
			<ul class="nav navbar-nav">
				<li class=""><a href="/"><i class="fa fa-gamepad" aria-hidden="true"></i> Home</a></li>
				<li class=""><a href="/deposit"><i class="fa fa-money" aria-hidden="true"></i> Deposit</a></li>
				<li class=""><a href="/withdraw"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Withdraw</a></li>
				<li class=""><a href="/rolls"><i class="fa fa-check" aria-hidden="true"></i> Provably Fair</a></li>
				<li><a href="#" data-toggle="modal" data-target="#promoModal"><i class="fa fa-usd" aria-hidden="true"></i> Free coins</a>
				<li class="active" style="margin-left:5px"><a href="/support?new"><i class="fa fa-ticket"></i>&nbsp;Support</a></li>
			</ul>
			<? if($user): ?>
				<ul class="nav navbar-nav navbar-right">
				<div class="pull-right">
					<div class="user-info">
                    <ul class="nav">
                        <li><a href="/profile" class="ajax-modal"><i class="fa fa-university" aria-hidden="true"></i></a></li>
                        <li><a href="/exit"><i class="fa fa-power-off" aria-hidden="true"></i></a></li>
                    </ul>    
					</div>
                </div>
				<div class="pull-right user_avatar">
                    <a target="_blank" href="https://steamcommunity.com/profiles/<?=$user['steamid']?>"><img src="<?=$user['avatar']?>" alt="" class="img-responsive-menu"></a>
                </div>
				<div class="pull-right userdata">
                    <div class="username-menu"><b><?php echo htmlspecialchars($user['name'])?></b></div>
                </div>
				</ul>
			<? else: ?>
			<ul class="nav navbar-nav navbar-right">
				<a href="#login" role="button" data-toggle="modal"><img style="margin-top:3px;" src="template/img/green.png"></a>
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
				<b><?=($user)?$user['steamid']:''?></b>			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
				      		<strong>Confirm all bets over 10,000 coins</strong>
				    	</label>
				  	</div>
				  	<div class="checkbox">
				    	<label>
				      		<input type="checkbox" id="settings_sounds" checked>
				      		<strong>Enable sounds</strong>
				    	</label>
				  	</div>
				  	
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" onclick="saveSettings()">Save changes</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="promoModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Redeem Promo Code!</b></h4>
			</div>
			<div class="modal-body">
				
				<div class="form-group">
					<label for="exampleInputEmail1">Promo code</label>
					<input type='text' class='form-control' id='promocode' value=''>				</div>				  	
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-panelbet" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-panelbet" onclick="redeem()">Reedem</button>
			</div>
		</div>
	</div>
</div>
<script>
function saveSettings(){
	for(var i=0;i<SETTINGS.length;i++){
		setCookie("settings_"+SETTINGS[i],$("#settings_"+SETTINGS[i]).is(":checked"));
	}
	$("#settingsModal").modal("hide");
	if($("#settings_dongers").is(":checked")){
		$("#balance").html("please reload");
	}else{
		$("#balance").html("please reload");
	}
}
function redeem(){
	var code = $("#promocode").val();
	$.ajax({
		url:"/redeem?code="+code,
		success:function(data){		
			try{
				data = JSON.parse(data);
				if(data.success){
					bootbox.alert("Success! You've received "+data.credits+" credits.");					
				}else{
					bootbox.alert(data.error);
				}
			}catch(err){
				bootbox.alert("Javascript error: "+err);
			}
		},
		error:function(err){
			bootbox.alert("AJAX error: "+err);
		}
	});
}
</script>		<div class="container" style="/* margin-bottom:20%; */">
<div class="note note-warning">Вы имеете <a href="?open"><?=$open?> открытых запросов</a> и <a href="?closed"><?=$closed?> закрытых запросов</a>.</div>
<? if(isset($_GET['new'])) { ?>
<div class="panel panel-info text-left">
<div class="panel-heading">
<input id="ticketTitle" type="text" class="form-control" placeholder="Тема..." maxlength="100">
</div>
<div class="panel-body">
<select class="form-control" id="ticketCat">
    <option value="0">Жалоба</option>
    <option value="1">Пополнение/Вывод</option>
    <option value="2">Ставки</option>
    <option value="3">Реклама</option>
    <option value="4">Владельцу</option>
</select>
<br>
<textarea id="text0" class="form-control" rows="10" placeholder="Опишите вопрос..."></textarea><br>
<button data-x="0" type="button" class="btn btn-danger btn-block support_button">Apply</button>
</div>
</div>
<? } elseif(isset($_GET['closed'])) { ?>
<? foreach ($tickets as $key => $value) { ?>
<div class="panel panel-info text-left"><div class="panel-heading"><h4><?=$value['title']?></h4></div><div class="panel-body">
<? foreach ($value['messages'] as $key2 => $value2) { ?>
<div class="alert alert-<?=($user['steamid']==$value2['user'])?'info':'warning'?> bubble"><?=$value2['message']?></div>
<? } ?>
</div></div>
<? } ?>
<? } elseif(isset($_GET['open'])) { ?>
<div class="panel panel-info text-left"><div class="panel-heading"><h4><?=$ticket['title']?></h4></div><div class="panel-body">
<? foreach($ticket['messages'] as $key => $value): ?>
<div class="alert alert-<?=($user['steamid']==$value['user'])?'info':'warning'?> bubble"><?=$value['message']?></div>
<? endforeach; ?>
<div class="alert alert-info"><textarea id="text<?=$ticket['id']?>" class="form-control" rows="3" placeholder="Reply..."></textarea><label><input id="check<?=$ticket['id']?>" type="checkbox"> Close Ticket</label><button data-x="<?=$ticket['id']?>" type="button" class="btn btn-success btn-block support_button">Reply</button></div></div></div>
<? } else { ?>

<div class="panel panel-info">
  <div class="panel-heading"><h4>Как отправлять coinsы пользователям?</h4></div>
  <div class="panel-body">
    <p>Чтобы отправить coinsы другим пользователям, воспользуйтесь командой в чате: "/send [steam64id] [amount]".</p>

    <p>Например, чтобы отправить 100 coins пользователю с steam64id 76561197960287930 Вы должны написать команду в чат: "/send 	76561197960287930 100" (пример).</p>

    <p>Вы можете отправить coinsы другому пользователю и другим способом, нажмите на изображение (аватар) пользователя правой кнопкой мыши, выберите пункт "Передать coinsы", после укажите после появившегося текста в поле ввода сообщения сумму coins и отправьте.</p>

    <p>Узнать свой steam64id Вы можете с помощью сайта <a target="_blank" href="https://steamid.io/lookup">steamid.io</a></p>

  </div>
</div>
<div class="panel panel-info">
  <div class="panel-heading"><h4>Как получить больше coins? Могу я получить их бесплатно?</h4></div>
  <div class="panel-body">
    <p>coinsы можно получить путем внесения на веб-сайт предметов из игры Counter-Strike: Global Offensive.</p>
	<p>Если Вы уже активировали бесплатные 500 coins с помощью промокода, то единственным способ получить больше coins - сделать депозит.</p>

    <b>НЕ ОБРАЩАЙТЕСЬ в поддержку с просьбой выдать Вам coins!</b>
  </div>
</div>
<div class="panel panel-info">
  <div class="panel-heading"><h4>Как мне создать собственный реферальный код?</h4></div>
  <div class="panel-body">
    <p>Чтобы создать Ваш собственный реферальный код, перейдите на страницу <a target="_blank" href="/profile">Рефералов</a>.</p>
  </div>
</div>
<div class="panel panel-info">
  <div class="panel-heading"><h4>Я принял предложение обмена, но не получил coinsы!?</h4></div>
  <div class="panel-body">
    После того, как Вы приняли предложение обмена Вам необходимо проверить статус Вашего обмена с помощью кнопки "Проверить статус".
	Если после нажатия кнопки Вам говорят, что Вы не приняли обмен, то попробуйте еще раз через пару минут.
	Если проблема не решилась в течении часа, то напишите в поддержку, указав все данные от обмена со страницы <a href="/profile">история обменов</a>, либо же прикрепив комментарий, который прислал наш бот вместе с обменом и скриншот обмена.
  </div>
</div>
<div class="panel panel-info">
  <div class="panel-heading"><h4>Error when sending trade offer. Mobile Verification not enabled or Steam Lagging.</h4></div>
  <div class="panel-body">
    <b>Possible solutions:</b>
	<br>
	- Wait 7 days after you active your Steam Mobile Verification.
	<br>
	- Make your Steam Profile & Inventory public..
	<br>
	- Check if the trade url you set is correct.
	<br>
	- Check if steam isn't delayed. Steam Status
	<br>
	If you are sure that none of these reasons are the problem then please retry a few times in a different hour.
  </div>
</div>
<div class="panel panel-info">
  <div class="panel-heading"><h4>Я постоянно получаю "соединение потеряно ..."!</h4></div>
  <div class="panel-body">
    <b>Пожалуйста, сделайте следующие пункты, а затем попробовать..</b>
	<br>
	- Пожалуйста, сделайте следующие пункты, а затем попробовать.
	<br>
	- Очистить все ваши куки браузера и кэш.
	<br>
	- Перезагрузите маршрутизатор.
	<br>
	Затем обновите сайт, пока вы вдруг не подключитесь.
  </div>
</div>
<a class="btn btn-danger btn-lg btn-block" href="?new">Вам все ещё нужна дополнительная помощь? Отправить запрос для поддержки</a>
 <? } ?>
		</div>
</style>
    </div>
<?php include "Templates/Footer.php"; ?>		
	
</body></html>