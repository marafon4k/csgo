<html lang="en"><head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="CSEURO.COM The best place to win CS:GO skins!">
		<meta property="og:description" content="CSEURO.COM The best place to win CS:GO skins!">
		<meta property="og:url" content="https://cseuro.com/">
		<meta property="og:site_name" content="CSEURO.COM">
		<title>Deposit - CSEURO.COM</title>
		<link href="template/css/bootstrap.min.new.css" rel="stylesheet">
<link href="template/css/font-awesome.min.css" rel="stylesheet">
<link href="template/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Raleway:400,800,900,600,300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Exo+2:400,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link href="template/css/mineNew.css?v=5" rel="stylesheet">
<link id="style" href="" rel="stylesheet">


<link rel="shortcut icon" href="favicon.ico">

<script type="text/javascript" async="" src="/_Incapsula_Resource?SWJIYLWA=2977d8d74f63d7f8fedbea018b7a1d05&amp;ns=1"></script>
<script src="template/js/jquery-1.11.1.min.js"></script>
<script src="template/js/jquery.cookie.js"></script>
<script src="template/js/bootstrap.min.js"></script>
<script src="template/js/bootbox.min.js"></script>
<script src="template/js/jquery.dataTables.min.js"></script>
<script src="template/js/dataTables.bootstrap.js"></script>
<script src="template/js/tinysort.js"></script>
<script src="template/js/expanding.js"></script>
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
			var DEPOSIT = true;			
		</script>
		<script type="text/javascript" src="template/js/offers.js?v=<?=time()?>"></script>		
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
				<li class="active" style="margin-left:5px"><a href="/deposit"><i class="fa fa-money" aria-hidden="true"></i> Deposit</a></li>
				<li class=""><a href="/withdraw"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Withdraw</a></li>
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
				  	<div class="checkbox">
				    	<label>
				      		<input type="checkbox" id="settings_dongers">
				      		<strong>Display in $ amounts</strong>
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
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" onclick="redeem()">Reedem</button>
				 
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
</script>		

<div class="modal fade" id="confirmModal">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h4 class="modal-title"><b>Confirm Deposit</b></h4>
		            </div>
		            <div class="modal-body">                           
		                <label>Trade URL - <a href="https://steamcommunity.com/id/me/tradeoffers/privacy#trade_offer_access_url" target="_blank">find my trade url</a></label>
						<input type="text" class="form-control steam-input" id="tradeurl" value="<?=$_COOKIE['tradeurl']?>">
						<div class="checkbox">
					    	<label>
					      		<input type="checkbox" id="remember" checked=""> Remember trade URL
					    	</label>
						</div>By depositing/withdrawing you agree to our <a target="_blank" href="https://cseuro.com/tos">Terms of Service</a> and the <a target="_blank" href="https://cseuro.com/faq">Anti-Trade System</a>.</div>
		            <div class="modal-footer">
		            <button class="btn btn-danger" data-dismiss="modal">Close</button>
		            <button class="btn btn-success" id="offerButton" onclick="offer()">Confirm</button>                
		            </div>
		        </div> 
		    </div>
		</div>	

		
		<div class="text-center" style="margin-top: 50px;">

	
			

			<div style="display:inline-block">


							<div class="note note-info">
  <b><i class="fa fa-exclamation-circle"></i> AFTER TRADE CONFIRMATION CLICK "GET COINS"</b>
  <div class="alert alert-success text-center" style="margin-bottom:5px;margin-top:25px"><button type="button" class="close" data-dismiss="alert">×</button><b><i class="fa fa-exclamation-circle"></i> If you have problems with the deposit, write <a href="https://cseuro.com/support?new" target="_blank">here</a></b></div>
</div>
				<div id="inlineAlert" class="note note-success" style="font-weight:bold"><i class="fa fa-check"></i><b> Loaded 11 available items.</b></div>
				
				<div class="panel panel-default text-left" id="offerPanel" style="display:none">
				  	<div class="panel-heading">
						<h3 class="panel-title"><b>Trade sent <i class="fa fa-download"></i></b></h3>
				  	</div>
  					<div class="panel-body">
						<span id="offerContent" style="line-height:34px"></span>
						<div class="pull-right"><button class="btn btn-success" id="confirmButton" data-tid="0">Get coins</button></div>
					</div>
				</div>


				<div class="panel panel-default text-left fw-6">
					<div class="panel-heading">
						<h3 class="panel-title"><b>Inventory : <span id="left_number">0</span> items</b></h3>
					</div>
					<div class="panel-body">				
						
			            
			            
						<div style="margin-bottom:10px">						
							<div style="display:inline-block;float:right">
								<form class="form-inline">
									<select class="form-control" id="orderBy">
										<option value="0" selected>Default</option>
										<option value="1">Price descending</option>
										<option value="2">Acending price</option>
										<option value="3">Name A-Z</option>
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
						<h3 class="panel-title"><b>Deposit</b></h3>
					</div>
					<div class="panel-body">
						<button class="btn btn-success btn-lg" style="width:100%" onclick="showConfirm()" id="showConfirmButton">Deposit items<div style="font-size:12px"><span id="sum">0</span> coins</div></button>				
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
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter46205817 = new Ya.Metrika({ id:46205817, clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/46205817" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
</body></html>