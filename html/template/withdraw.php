
<html lang="en"><head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="CSEURO.COM The best place to win CS:GO skins!">
		<meta property="og:description" content="CSEURO.COM The best place to win CS:GO skins!">
		<meta property="og:url" content="https://www.cseuro.com/">
		<meta property="og:site_name" content="CSEURO.COM">
		<title>CSEURO.COM</title>
		<link href="/template/css/bootstrap.min.new.css" rel="stylesheet">
<link href="/template/css/font-awesome.min.css" rel="stylesheet">
<link href="/template/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Raleway:400,800,900,600,300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Exo+2:400,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link href="/template/css/mineNew.css?v=5" rel="stylesheet">
<link id="style" href="" rel="stylesheet">

<link rel="shortcut icon" href="favicon.ico">

<script type="text/javascript" src="https://www.gstatic.com/recaptcha/api2/r20160328144503/recaptcha.js"></script>
<script src="/template/js/jquery-1.11.1.min.js"></script>
<script src="/template/js/jquery.cookie.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/bootbox.min.js"></script>
<script src="/template/js/jquery.dataTables.min.js"></script>
<script src="/template/js/dataTables.bootstrap.js"></script>
<script src="/template/js/tinysort.js"></script>
<script src="/template/js/expanding.js"></script>
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
			.reject{
				opacity:0.5;
			}
			.reject .price{
				background-color: #d21 !important;
				left: 0px !important;
			}
		</style>
		<script type="text/javascript">
			var DEPOSIT = false;			
		</script>
		<script src="https://www.google.com/recaptcha/api.js"></script>	
		<script type="text/javascript" src="/template/js/offers.js?v=106"></script>
		<script>
			function xxx(){
				$(".norobots").slideUp();
				loadLeft();
			}

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
			<a class="navbar-brand" style="padding-top:0px;padding-bottom:0px;padding-right:0px" href="./"><img alt="CSGODually.com" class="logoo" src="/template/img/logo.png"></a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
        <div style="padding-top: 10px;">
			<ul class="nav navbar-nav">
				<li class=""><a href="/"><i class="fa fa-gamepad" aria-hidden="true"></i> Home</a></li>
				<li class=""><a href="/deposit"><i class="fa fa-money" aria-hidden="true"></i> Deposit</a></li>
				<li class="active" style="margin-left:5px"><a href="/withdraw"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Withdraw</a></li>
				<li class=""><a href="/rolls"><i class="fa fa-check" aria-hidden="true"></i> Provably Fair</a></li>
				<li><a href="#" data-toggle="modal" data-target="#promoModal"><i class="fa fa-usd" aria-hidden="true"></i> Free coins</a>
				<li class=""><a href="/support?new"><i class="fa fa-ticket"></i>&nbsp;Support</a></li>
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
				<a href="#login" role="button" data-toggle="modal"><img style="margin-top:3px;" src="/template/img/green.png"></a>
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
				<h4 class="modal-title"><b>Введите промокод!</b></h4>
			</div>
			<div class="modal-body">
				
				<div class="form-group">
					<label for="exampleInputEmail1">Промокод</label>
					<input type='text' class='form-control' id='promocode' value=''>				
				<button type="button" class="btn btn-success" onclick="redeem()">Принять</button>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Введите бонусный код</label>
					<input type='text' class='form-control' id='promocode2' value=''>				
				<button type="button" class="btn btn-info" onclick="redeempromo()">Активировать бонусный код</button>
				</div>				  	
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
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
					bootbox.alert("Успешно! Вам начислено "+data.credits+" монет.");					
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
function redeempromo(){
	var code2 = $("#promocode2").val();
	$.ajax({
		url:"/redeempromo?promocode="+code2,
		success:function(data){		
			try{
				data = JSON.parse(data);
				console.log(data);
				if(data.success){
					bootbox.alert("Успешно! Вам начислено "+data.credits+" монет.");					
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
</script>
		<div class="modal fade" id="confirmModal">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <div class="close" data-dismiss="modal">×</div>
		                <h4 class="modal-title"><b>Подтверждение</b></h4>
		            </div>
		            <div class="modal-body">                           
		                <label>Трейд-ссылка - <a href="https://steamcommunity.com/id/me/tradeoffers/privacy#trade_offer_access_url" target="_blank">Найти мою трейд-ссылку</a></label>
						<input type="text" class="form-control steam-input" id="tradeurl" value="<?=$_COOKIE['tradeurl']?>">
						<div class="checkbox">
					    	<label>
					      		<input type="checkbox" id="remember" checked=""> Запомнить Трейд-ссылку
					    	</label>
						</div>При вводе/выводе Вы соглашаетесь с нашими <a target="_blank" href="https://cseuro.com/tos">Условиями использования</a> и <a target="_blank" href="https://cseuro.com/faq">Системой Анти-Трейда</a>.</div>
		            <div class="modal-footer">
		            <button class="btn btn-danger" data-dismiss="modal">Закрыть</button>
		            <button class="btn btn-success" id="offerButton" onclick="offer()">Подтвердить</button>                
		            </div>
		        </div> 
		    </div>
		</div>	   					
		<div class="text-center" style="margin-top: 50px;">					
			<div style="display:inline-block">
<div class="note note-danger text-center">
  <b><i class="fa fa-exclamation-triangle"></i>Не пытайтесь изменить торговое предложение, отправленное нашими роботами - эти сделки будут отклонены без каких-либо возвратов!</b>
</div>
				
<div class="note note-info text-center norobots">
<b>Для того, чтобы предотвратить использование ботов доступ к банку, пожалуйста, заполните следующую CAPTCHA, чтобы продолжить:</b><br><br>
<div class="g-recaptcha" style="display:inline-block" data-sitekey=" " data-theme="dark" data-callback="xxx"></div>
</div>

<div id="inlineAlert" class="note" style="font-weight:bold"></div>

				
				
				<div class="panel panel-default text-left" id="offerPanel" style="display:none">
				  	<div class="panel-heading">
						<h3 class="panel-title"><b>Предложение обмена отправлено<i class="fa fa-download"></i></b></h3>
				  	</div>
  					<div class="panel-body">
						<span id="offerContent" style="line-height:34px"></span>
						<div class="pull-right"><button class="btn btn-success" id="confirmButton" data-tid="0">завершено</button></div>
						<div><b style="color:red">Пожалуйста, нажмите на кнопку подтвердить после принятия торговли.</b></div>
					</div>
					<br>
					
				</div>

				<div class="panel panel-default text-left fw-6">
					<div class="panel-heading">
						<h3 class="panel-title"><b>Банк : <span id="left_number">0</span> предметов</b></h3>
					</div>
					<div class="panel-body">				
						
			            <div class="btn-group" id="botFilter" style="margin-bottom:10px">
			            	<label class="btn btn-bot active" data-bot="0">Все</label>
			            	<?php
			            		foreach ($bots as $key) {
			            	?>
			            	<label class="btn btn-bot" data-bot="<?=$key?>">Bot <?=$key?></label>
			            	<?
			            		}
			            	?>
			            </div>
			            
						<div style="margin-bottom:10px">						
							<div style="display:inline-block;float:right">
								<form class="form-inline">
									<select class="form-control" id="orderBy">
										<option value="0">По умолчанию</option>
										<option value="1" selected>Цена по убыванию</option>
										<option value="2">Цена по возрастанию</option>
										<option value="3">Имена A-Z</option>
									</select>
								</form>
							</div>				
	  						<div style="overflow:hidden;padding-right:2px">
	    						<input type="text" class="form-control" id="filter" placeholder="Search..." style="width:100%">
	   						</div>
   						</div>  																										
						<div id="left" class="slot-group noselect">
							<span class="reals"></span>
							<span class="bricks">
								<div class="placeholder"></div>
								<div class="placeholder"></div>
								<div class="placeholder"></div>
								<div class="placeholder"></div>
								<div class="placeholder"></div>
								<div class="placeholder"></div>
								<div class="placeholder"></div>
								<div class="placeholder"></div>
								<div class="placeholder"></div>
								<div class="placeholder"></div>
								<div class="placeholder"></div>
								<div class="placeholder"></div>
							</span>		
						</div>						
					</div>						
				</div>
				<div class="panel panel-default text-left fw-4" style="vertical-align:top">
					<div class="panel-heading">
						<h3 class="panel-title"><b>Вывод</b></h3>
                    </div>
                    <div class="panel-body">
					<?php if($user['id'] >= 1){ ?>
                        <?php if($user['checkdep'] >= 5000){ ?>

                        <button class="btn btn-danger btn-lg" style="width:100%" onclick="showConfirm()" id="showConfirmButton">Вывести предметы<div style="font-size:12px"><span id="sum">0</span> Монет | Баланс : <span id="avail">0</span></div></button>   
                        <?php }else{ ?>
                        <button class="btn btn-danger btn-lg" style="width:100%; background-color:transparent; color:#d9534f" id="showConfirmButton" disabled>Ты должен внести<div style="font-size:12px"><span id="sum">5$</span> Чтобы получить доступ к выводу<br>Ты внес <?php echo $user['checkdep']; ?>/5000</div></button>
                        <?php }} ?>
                        <div id="right" class="slot-group noselect">
                            <span class="reals"></span>
                            <span class="bricks">
								<div class="placeholder"></div>
								<div class="placeholder"></div>
								<div class="placeholder"></div>
								<div class="placeholder"></div>
								<div class="placeholder"></div>
								<div class="placeholder"></div>
								<div class="placeholder"></div>
								<div class="placeholder"></div>								
							</span>								
						</div>																										
					</div>						
				</div>
			</div>
		</div>
<?php include "Templates/Footer.php"; ?>			
	
</body></html>