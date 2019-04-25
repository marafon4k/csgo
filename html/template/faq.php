<html lang="en"><head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="CSEURO.COM The best place to win CS:GO skins!">
		<meta property="og:description" content="CSEURO.COM The best place to win CS:GO skins!">
		<meta property="og:url" content="https://www.cseuro.com/">
		<meta property="og:site_name" content="CSEURO.COM">
		<title>FAQ - CSEURO.COM</title>
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
<script src="template/js/theme.js"></script>
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
        <div style="padding-top: 10px;">
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
</div>
<script>
function saveSettings(){
	for(var i=0;i<SETTINGS.length;i++){
		setCookie("settings_"+SETTINGS[i],$("#settings_"+SETTINGS[i]).is(":checked"));
	}
	$("#settingsModal").modal("hide");
	if($("#settings_dongers").is(":checked")){
		$("#balance").html("por favor, summary");
	}else{
		$("#balance").html("por favor, summary");
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
					bootbox.alert("Success! you will be credited "+data.credits+" credits.");					
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
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&amp;subset=cyrillic" rel="stylesheet">

        <style>

            body {
                font-family: 'Roboto', sans-serif;
                background-color: hsla(0, 0%, 98%, 1);
            }
            
            .box-answer {
                padding: 20px 30px 15px 30px;
                font-size: 14px;
                background-color: hsla(0, 0%, 100%, 1);
                box-shadow: 0px 1px 0px 0px hsla(0, 0%, 0%, 0.05);
                border-radius: 5px;
            }

        </style>

<div class="container" style="margin-bottom: 20%"><div class="col-md-3" style="position: static; top: 50px"><div class="list-group"><li class="list-group-item active">Getting Started</li>
<a href="#q1" class="list-group-item">What is CSEURO.com?</a>
<a href="#q15" class="list-group-item">Are there any fees?</a>
<li class="list-group-item active">Deposits</li> 
<a href="#q2" class="list-group-item">How much are credits worth?</a>
<a href="#q3" class="list-group-item">How are prices determined?</a>
<a href="#q4" class="list-group-item">My items are not showing up for deposit?</a>
<a href="#q5" class="list-group-item">I've deposited but haven't received my credits!?</a>
<a href="#q6" class="list-group-item">Will I be refunded if I decline a withdraw?</a>
<a href="#q7" class="list-group-item">Why did the bot cancel my trade offer?</a>
<li class="list-group-item active">Withdraws</li> 
<a href="#q13" class="list-group-item">Can I withdraw skins right after depositing?</a>
<a href="#q14" class="list-group-item">What is the Anti-Trade System?</a><li class="list-group-item active">Provably Fair</li>
<a href="#q8" class="list-group-item">What is Provably Fair?</a><a href="#q9" class="list-group-item">How does it work?</a>
<a href="#q10" class="list-group-item">How do I verify a roll?</a><li class="list-group-item active">Affiliates</li>
<a href="#q11" class="list-group-item">How does the affiliate system work?</a>
<a href="#q12" class="list-group-item">What is affiliate level?</a><li class="list-group-item active">Match Betting</li>
<a href="#q16" class="list-group-item">Can I change my pick before the match starts?</a>
<a href="#q17" class="list-group-item">Can I cancel my bet?</a>
<a href="#q18" class="list-group-item">Why was the match cancelled?</a>
<a href="#q19" class="list-group-item">The match started before the bets closed, what happens now?</a>
<a href="#q20" class="list-group-item">The match has been postponed, what now?</a>
<a href="#q21" class="list-group-item">A team was disqualified, but the win was coins were already drawn. What now?</a></div></div>
<div class="col-md-9">
<h4 id="q1" style="margin-top:0px" class="text-warning">What is CSEURO.com?</h4>
<p>CSEURO.com is a brand new way to gamble CS:GO skins. We are NOT a jackpot site – instead players deposit skins for credits and bet those credits on a roulette inspired game:</p>
<p>Bet 1-7 (red) or 8-14 (black) for DOUBLE your credits. Bet 0 (green) for FOURTEEN times your credits.</p>
<p>It doesn't matter how big your inventory is, or how much you bet, your odds are always the same.</p>
<p>Bets occur in real time, across the entire site, meaning you bet, win, and lose along with other players.</p>
<p>All rolls are generated using a provably fair system – ensuring a fair roll each and every time.</p>
<h4 id="q15" class="text-warning">Are there any fees?</h4>
<p>Fees matter from the game type on our site. As for our roulette there are completely no fees. Only a 5% fee exists for the coinflip, this fee is taken from every flip/game.</p>
<h4 id="q2" class="text-warning">How much are credits worth?</h4>
<p>Credits have no real-life value. Instead they are exchanged for CS:GO items from our public shop. Every 1000 credits will buy you roughly $1 worth of items. See below for more information.</p><h4 id="q3" class="text-warning">How are prices determined?</h4><p>Baseline prices are determined using publicly available data from SteamAnalyst. Some items are not accepted due to price, volatility, or popularity. Furthermore the following discounts are applied:</p><table class="table"><tr><th>Price</th><th>Discount (Deposit)</th><th>Discount (Withdraw)</th></tr><tr><td>0.00$ - 0.50$</td><td>Not Accepted</td><td>Not Accepted</td></tr><tr><td>0.50$ - 5.00$</td><td>2% off</td><td>0% off</td></tr><tr><td>5.00$ - 20.00$</td><td>2% plus</td><td>0% plus</td></tr><tr><td>20.00$+</td><td>2% off</td><td>0% off</td></tr><tr><td>Stickers and music kits</td><td>70% off</td><td>70% off</td></tr><tr><td>Case Key</td><td>0% plus</td><td>0% plus</td></tr></table><!--<p>These are not fees – instead they are applied equally to both deposits and withdrawals.</p>--><p>Discounts exist to discourage a flood of low-value items and to provide a discount to those withdrawing low-value items over the more popular, big ticket items.</p><h4 id="q4" class="text-warning">My items are not showing up for deposit?</h4><p>First, make sure your inventory is set to public.</p><p>By default CSEURO.com loads items from cache. Occasionally this may become out of date. To load directly from Steam (and update the cache) click the “force reload” button.</p><h4 id="q5" class="text-warning">I've deposited but haven't received my credits!?</h4><p>After accepting the trade offer you must “confirm” the deposit by clicking the confirm button under the “incoming trade offer” panel. This allows our system to verify that the offer has been accepted – only then will the credits be forwarded to your account.</p><h4 id="q6" class="text-warning">Will I be refunded if I decline a withdraw?</h4><p>Yes. If you decline the trade offer for any reason (or it expires) you will be refunded the full amount after “confirming” with our system.</p><h4 id="q7" class="text-warning">Why did the bot cancel my trade offer?</h4><p>Our bots automatically cancel trade offers older than 5 minutes to make room for new trade offers. If you're unable to respond within 10 minutes simply “confirm” the old trade offer and try again.</p><h4 id="q8" class="text-warning">What is Provably Fair?</h4><p>Provably fair is a way of generating random numbers using cryptography such that the results can be verified by a third party. This means the operators cannot manipulate the outcome of any roll. In short, we use the results of a state run lottery to seed our RNG (random number generator) – for a detailed explanation see below.</p><h4 id="q9" class="text-warning">How does it work?</h4><p>Each roll is computed using the SHA-256 hash of 3 distinct inputs.</p><p>First, is the server seed. This is a precomputed value generated by CSEURO.com.</p><h4 id="q10" class="text-warning">How do I verify a roll?</h4><p>You can execute PHP code straight from your web browser with tools like <a href="http://www.phptester.net/" target="_blank">PHP Tester</a>. Simply copy-paste the following code into the window and replace the server_seed, lotto, and round_id values for your own. Execute the code to verify the roll.</p><pre>$server_seed = "39b7d32fcb743c244c569a56d6de4dc27577d6277d6cf155bdcba6d05befcb34";<br>$lotto = "0422262831";<br>$round_id = "1";<br>$hash = hash("sha256",$server_seed."-".$lotto."-".$round_id);<br>$roll = hexdec(substr($hash,0,8)) % 15;<br>echo "Round $round_id = $roll";</pre><p>Notice how any change to the lottery results radically changes the rolls.</p><p>Note that you'll be unable to verify rolls until the server seed is disclosed at 00:00 (MSK).</p><h4 id="q11" class="text-warning">How does the affiliate system work?</h4><p>The affiliate system lets anyone earn credits by referring new players to the site. Visit the affiliate dashboard to generate your unique referral code. Share with friends, in forum signatures, or on social media.</p><p>When new players use your referral code they'll earn 100 FREE credits. And you'll earn credits every time your referrals place a bet – regardless if they win or lose.</p><h4 id="q12" class="text-warning">What is affiliate level?</h4><p>Your affiliate level determines how much (%) you'll earn from each referral. Your affiliate level is determined by the amount of unique depositors you've referred:</p></p><table class="table"><tr><th>Unique Depositors</th><th>Affiliate Level</th></tr><tr><td>0+</td><td><b style="color: #cd7f32">Bronze</b> (1 coin per 300 bet)</td></tr><tr><td>50+</td><td><b style="color: #c0c0c0">Silver</b> (1 coin per 200 bet)</td></tr><tr><td>200+</td><td><b style="color: #ffd700">Gold</b> (1 coin per 100 bet)</td></tr><tr><td>500+</td><td><b style="color: #8c8c8c">Platinum</b> (1 coin per 95 bet)</td></tr><tr><td>750+</td><td><b style="color: #ff0505">Ruby</b> (1 coin per 90 bet)</td></tr><tr><td>1000+</td><td><b style="color: #6257ff">Sapphire</b> (1 coin per 85 bet)</td></tr><tr><td>2500+</td><td><b style="color: #58ff74">Emerald</b> (1 coin per 80 bet)</td></tr><tr><td>5000+</td><td><b style="color: #f43dff">Amethyst</b> (1 coin per 75 bet)</td></tr><tr><td>10000+</td><td><b style="color: #19d0d4">Diamond</b> (1 coin per 70 bet)</td></tr></table><p>You can track your visitor statistics from the dashboard. A green check mark indicates that the player has made at least one deposit (the amount of the deposit does not matter). While you'll earn a % from all visitors only those who've made at least one deposit count towards the affiliate level.</p><p>Note that for privacy reasons complete steam id's are obscured.</p><p>When leveling up your new % is applied to all previous earnings. For example, if you've earned 100k as Bronze affiliate, your earnings will instantly jump to 200k when reaching Silver, and then 300k when reaching Gold – even if none of your referrals or new depositors placed any bets during that time.</p><h4 id="q13" class="text-warning">Can I withdraw skins right after depositing?</h4><p>If you never played on our site before then you won't be able to withdraw without playing on our site due to the Anti-Trade System. You can read more about it in the next point.</p><h4 id="q14" class="text-warning">What is the Anti-Trade System?</h4><p>The Anti-Trade system is to prevent users that just deposit to withdraw other items without even playing on the site.</p><p>We call them traders, they want to make profit from such situation. To prevent this we have added a system where you need to place bets worth half of the amount you want to withdraw.</p><p>Each withdraw will lower your available coins to withdraw and of course balance.</p><h4 id="q16" class="text-warning">Can I change my pick before the match starts?</h4><p>Yes of course, you can change it by placing atleast 1 coin on the other side and by this all your previous bet coins also go on this side.</p><h4 id="q17" class="text-warning">Can I cancel my bet?</h4><p>No, you cannot cancel your bet. Although as mentioned previously you can change the team you bet on.</p><h4 id="q18" class="text-warning">Why was the match cancelled?</h4><p>We can cancel the match bets on our site at any time.</p><p>We will do it when the match itself is cancelled, a team has gave the game a way by forfeit, someone from one of the teams received a VAC ban while playing the match or in similar situations like this. At worse if something went wrong by our site(the reason will be provided).</p><p>At any case the coins will be returned to the users account.</p><h4 id="q19" class="text-warning">The match started before the bets closed, what happens now?</h4><p>It matters how long has the match been on for before the bets has closed, but mostly the bets will be cancled and coins returned.</p><h4 id="q20" class="text-warning">The match has been postponed, what now?</h4><p>The bet will be game as cancelled and all coins will be returned.</p><h4 id="q21" class="text-warning">A team was disqualified, but the win was coins were already drawn. What now?</h4><p>If the coins were already drawn then sadly, but we cannot reverse this and the result will be left as they were.</p><p>Such disqualification can be for example if a team cheated in a game, but it was found some time later after the game.</p></div></div>
<?php include "Templates/Footer.php"; ?>		
</body></html>