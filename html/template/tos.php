<html lang="en"><head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="CSGOEURO.COM is the best place to win CS:GO skins!">
		<meta property="og:description" content="CSGOEURO.COM The best place to win CS:GO skins!">
		<meta property="og:url" content="http://www.CSGOEURO.COM/">
		<meta property="og:site_name" content="CSGOEURO.COM">
		<title>CSGOEURO.COM</title>
		<link href="template/css/bootstrap.min.new.css" rel="stylesheet">
<link href="template/css/font-awesome.min.css" rel="stylesheet">
<link href="template/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Raleway:400,800,900,600,300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Exo+2:400,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link href="template/css/mineNew.css" rel="stylesheet">
<link id="style" href="" rel="stylesheet">


<link rel="shortcut icon" href="favicon.ico">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="template/js/steamstatus.js"></script> 
<script src="template/js/jquery-1.11.1.min.js"></script>
<script src="template/js/jquery.cookie.js"></script>
<script src="template/js/socket.io-1.4.5.js"></script>
<script src="template/js/bootstrap.min.js"></script>
<script src="template/js/bootbox.min.js"></script>
<script src="template/js/jquery.dataTables.min.js"></script>
<script src="template/js/dataTables.bootstrap.js"></script>
<script src="template/js/tinysort.js"></script>
<script src="template/js/expanding.js"></script>
<script type="text/javascript" src="template/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="template/js/jquery.bez.js"></script>
<script type="text/javascript" src="template/js/jquery.particleground.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js" type="text/javascript"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet">
<style>

</style>
<script>
	var SETTINGS = ["confirm","sounds","dongers","hideme"];
	function inlineAlert(x,y){
		$("#inlineAlert").removeClass("alert-success alert-danger alert-warning hidden");
		if(x=="success"){
			$("#inlineAlert").addClass("alert-success").html("<i class='fa fa-check'></i><b> "+y+"</b>");
		}else if(x=="error"){
			$("#inlineAlert").addClass("alert-danger").html("<i class='fa fa-exclamation-triangle'></i> "+y);
		}else if(x=="cross"){
			$("#inlineAlert").addClass("alert-danger").html("<i class='fa fa-times'></i> "+y);
		}else{
			$("#inlineAlert").addClass("alert-warning").html("<b>"+y+" <i class='fa fa-spinner fa-spin'></i></b>");
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
			<a class="navbar-brand" style="padding-top:0px;padding-bottom:0px;padding-right:0px" href="./"><img alt="CSEURO.COM" class="logoo" src="template/img/logo.png"></a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="" style="margin-left:5px"><a href="/"><i class="fa fa-gamepad" aria-hidden="true"></i> Home</a></li>
				<li class=""><a href="/deposit"><i class="fa fa-money" aria-hidden="true"></i> Deposit</a></li>
				<li class=""><a href="/withdraw"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Withdraw</a></li>
				<li class=""><a href="/rolls"><i class="fa fa-check" aria-hidden="true"></i> Provably Fair</a></li>
				<li><a href="#" data-toggle="modal" data-target="#promoModal"><i class="fa fa-usd" aria-hidden="true"></i> Free coins</a>
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
				  	<div class="checkbox">
				    	<label>
				      		<input type="checkbox" id="settings_dongers">
				      		<strong>Display in $ amounts</strong>
				    	</label>
				  	</div>
				  	<div class="checkbox">
				    	<label>
				      		<input type="checkbox" id="settings_hideme">
				      		<strong>Hide my profile link in chat</strong>
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
				<h4 class="modal-title"><b>Activating a promotional code!</b></h4>
			</div>
			<div class="modal-body">
				
				<div class="form-group">
					<label for="exampleInputEmail1">Promo code</label>
					<input type='text' class='form-control' id='promocode' value=''>				</div>				  	
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" onclick="redeem()">Reedem</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="chatRules">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Chat Rules</b></h4>
			</div>
			<div class="modal-body" style="font-size:24px">				  
				<ol>
					<li>No Spamming</li>
					<li>No Begging for Coins</li>
					<li>No Posting Promo Codes</li>
					<li>No CAPS LOCK</li>
					<li>No Promo Codes in Profile Name</li>
					</ol>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success btn-block" data-dismiss="modal">Got it!</button>
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
</script><font color="white">
<div class="container" style="margin-bottom: 10%;"><h3 class="text-center">Terms of Service</h3><h4 style="margin: 5% 0%;">By using CSEURO.COM (henceforth to be referred to as "CSEURO"), you acknowledge and accept these Terms of Service in full and without reservation, you are agreeing to our Terms of Service and you are responsible for compliance with any applicable laws. These Terms of Service govern your use of this website.<br><br><i>You must be age 18 or older to play on CSEURO.</i></h4><h3>Ownership</h3><p>All materials on this website are intellectual property of CSEURO and you may not use any of the content seen here for commercial use without permission. Exclusive rights for Counter Strike: Global Offensive and its associated virtual items belong to Steam and the Valve Corporation.</p><h3>Acceptable Use</h3><p>You must not use CSEURO in any way that causes, or may cause, damage to the webite or impairment of the availability or accessibility of CSEURO or in any way which in unlawful, illegal, fraudulent or harmful. Do not use CSEURO.COM, as a source for item exchanging to gain benefits from trading items that are in different price ranges compared to steam and our site. On a site it is forbidden to be engaged in commercial activity! It is prohibited to sell game currency to other users!</p><h3>Item Values</h3><p>You are participating in games that allow you to deposit and receive intangible items. We display a value in coins to add the effect that these items have no physical value. These coins values are based on the Bitskins database. These values are subject to change without notice. Patterns on items are not taken into account. By using CSEURO you are accepting our item values and there will be no refund in case of a value issue.</p><h3>Bans, Timeouts & Conduct</h3><p>CSEURO reserves the right to remove/restricted accounts any user from our website with out and for any reason. Anyone attempting to scam other users maybe permenantly banned from using CSEURO. Players are asked to remain respectful at all times. Excessive spam, harassment, staff impersonation, solicitation, and defamation are strictly forbidden. Website advertisement, particularity of competing services, is not allowed.</p><h3>Maximum Bets</h3><p>Maximum bets are adjusted manually to maintain site solvency. The use of multiple accounts to bypass the maximum bet is strictly forbidden. A 1 hour warning will precede any decrease to the maximum bet. An increase to the maximum bet may occur at any time.</p><h3>Privacy Policy</h3><p>Steam profiles are used for identification purposes across the site. By using our service you acknowledge that your Steam profile, persona name, and avatar may be shared with other CSEURO users. CSEURO will never ask for, collect, or share the personal information of any of our users.</p><h3>Limitations of Liability</h3><p>CSEURO is not responsible for trade/account bans that may occur as a resulting of accepting items from our bots. CSEURO assumes no responsibility for missed bets as a result of network latency or disconnections. Always ensure a stable connection before placing bets. Avoid placing important bets at the last second. Use of our services is at your own risk. CSEURO, its employees and affiliates will never be held liable for your profits or losses while using this website. Variation These terms and conditions ("Terms of Service") are able to be revised and edited by CSEURO at any time. Revised terms and conditions will apply from their effective date once published to this website.</p><h3>Law and Jurisdiction</h3><p>These terms and conditions will be governed by and construed in accordance with the laws of Russian Federation, and any disputes relating to these terms and conditions will be subject to the exclusive jurisdiction of the courts of Russian Federation.</p><br><h4><i>CSEURO is not affiliated with Steam or the Valve Corporation.</i></h4></div>
<?php include "Templates/Footer.php"; ?>
</font>		
</body></html>
</html>