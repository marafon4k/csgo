
<html lang="en"><head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="CSEURO.COM The best place to win CS:GO skins!">
		<meta property="og:description" content="CSEURO.COM The best place to win CS:GO skins!">
		<meta property="og:url" content="https://cseuro.com/">
		<meta property="og:site_name" content="CSEURO.COM">
		<title>Проверка честности - CSEURO.COM</title>
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
			function formatNum(x) {
				if(Math.abs(x)>=10000) return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
			
		</style>
		<script type="text/javascript">

			
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
			<a class="navbar-brand" style="padding-top:0px;padding-bottom:0px;padding-right:0px" href="./"><img alt="CSGODually.com" class="logoo" src="template/img/logo.png"></a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
        <div style="padding-top: 10px;">
			<ul class="nav navbar-nav">
				<li class=""><a href="/"><i class="fa fa-gamepad" aria-hidden="true"></i> Home</a></li>
				<li class=""><a href="/deposit"><i class="fa fa-money" aria-hidden="true"></i> Deposit</a></li>
				<li class=""><a href="/withdraw"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Withdraw</a></li>
				<li class="active" style="margin-left:5px"><a href="/rolls"><i class="fa fa-check" aria-hidden="true"></i> Provably Fair</a></li>
				<li><a href="#" data-toggle="modal" data-target="#promoModal"><i class="fa fa-usd" aria-hidden="true"></i> Free coins</a>
				<li class=""><a href="/support?new"><i class="fa fa-ticket"></i>&nbsp;Support</a></li>

				<?php if($user ['rank'] == "1" || $user ['rank'] == "2" || $user ['rank'] == "100") {
				echo'<li class=""><a href="/adminsupport">Admin panel</a></li>';
				}
                ?>
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
				<button type="button" class="close" data-dismiss="modal">&times;</button>
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
				<button type="button" class="close" data-dismiss="modal">&times;</button>
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
					bootbox.alert("Successfully! You are credited "+data.credits+" coins.");					
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
</script>		<div class="container">
				<?php if(isset($_GET['id'])) { ?>
				<table class="table table-striped">
					<thead><tr>
					<th>Time</th>
					<th>Round</th>
					<th>0</th>
					<th>1</th>
					<th>2</th>
					<th>3</th>
					<th>4</th>
					<th>5</th>
					<th>6</th>
					<th>7</th>
					<th>8</th>
					<th>9</th>
					</tr></thead>
					<tbody>
					<? foreach($rolls as $key => $value) { ?>
					<tr><td><?=$value['time']?></td><td><?=$value['start']?>_</td>
					<?php for($i = 0; $i <= 9; $i++) {
						if($value['rolls'][$i]) {
							$r = $value['rolls'][$i];
							if($r['roll'] == 0) {
								$z = ' class="td-val ball-0" id="'.$r['id'].'"';
							} elseif(($r['roll'] > 0) && ($r['roll'] < 8)) {
								$z = ' class="td-val ball-1" id="'.$r['id'].'"';
							} elseif(($r['roll'] > 7) && ($r['roll'] < 15)) {
								$z = ' class="td-val ball-8" id="'.$r['id'].'"';
							}
							echo '<td'.$z.'>'.$r['roll'].'</td>';
						} else {
							echo '<td></td>';
						}
					} ?>
					<? } ?>
					</tbody></table>
				<?php } else { ?>

					
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><b>Контроль Честности <i class="fa fa-lock"></i></b></h3>
				</div>
				<div class="panel-body">

					


				<p>Все числа CSEURO.COM генерируются с использованием доказуемо-справедливой системы. Это означает, что администраторы сайта не смогут изменить исход какого-либо раунда. Игроки могут воспроизвести любой прошедший раунд, используя код::
				</p>

				                    <pre>$server_seed = "ce315577167d1c34bc28ceecfc700197";
$round_id = "1";
$hash = hash("sha256",$server_seed."-".$round_id);
$roll = hexdec(substr($hash,0,8)) % 15;
echo "Round $round_id = $roll";</pre>

				<p>
					
					Вы можете выполнить PHP код прямо из вашего веб-браузера с помощью инструмента такого как <a href="http://www.phptester.net/" target="_blank">PHP Tester</a>. 
					Просто скопируйте и вставьте код в окно, замените server_seed, 
					lotto, и round_id на нужные значения. Выполните код, чтобы убедится в честности рулетки.

				</p>

				<p>
				Для получения дополнительной информации о контроле честности <a href="/faq">посетите FAQ страницу</a>.
				</p>

				</div>
			</div>

						<table class='table table-striped'>
						<thead><tr><th>Date</th><th>Код сервера</th><th>Лотерея</th><th>Раунд</th></tr></thead>
						<tbody>
						<? foreach($rolls as $key => $value): ?>
							<tr><td><?=$value['date']?></td><td><b class='text-<?=($key==0)?'danger':'success'?>'><?=($key==0)?"<i class='fa fa-lock fa-fw'></i> КОД СЕРВЕРА В ДАННЫЙ МОМЕНТ ИСПОЛЬЗУЕТСЯ </b>":"<i class='fa fa-check-circle fa-fw'></i> ".$value['seed'].""?></td><td><?=$value['time']?></td><td><a href='?id=<?=$value['id']?>'><?=$value['rolls']?></a></td></tr>
						<? endforeach; ?>
						</tbody></table>
						<?php } ?>
						</div>	
<?php include "Templates/Footer.php"; ?>		
	</body>
</html>