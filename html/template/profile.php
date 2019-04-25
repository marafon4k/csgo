<html lang="en"><head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="CSEURO.COM The best place to win CS:GO skins!">
		<meta property="og:description" content="CSEURO.COM The best place to win CS:GO skins!">
		<meta property="og:url" content="https://www.cseuro.com/">
		<meta property="og:site_name" content="CSEURO.COM">
		<title>CSEURO </title>
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
		
		</style>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#referrals").DataTable({
					"searching":false,
					"pageLength":100,
					"lengthChange":false,
				});
				$("#collect").on("click",function(){
					$this = $(this);
					$this.attr("disabled",true);
					$.ajax({
					url:"/collect",
					type:"POST",
					success:function(data){
						try{
							data = JSON.parse(data);
							if(data.collected == 0){
							bootbox.alert("You can not get 0 coins!");
							} else if(data.success){
								$("#avail").html(0);
								bootbox.alert(data.collected+" have been credited to your account!");
								//inlineAlert("success","You collected "+data.collected+" credits!");							
							}else{
								bootbox.alert(data.error);
								//inlineAlert("error",data.error);
							}
						}catch(err){
							bootbox.alert("Javascript error: "+err);
						}
					},
					error:function(err){
						bootbox.alert("AJAX error: "+err.statusText);
					},
					complete:function(){
						$this.attr("disabled",false);
					}
					});
				});
				$("#changecode").on("click",function(e){
					e.preventDefault();
					bootbox.prompt("Change promocode:",function(result){                
						if(result){
							$.ajax({
								url:"/changecode",
								data:{"code":result},
								type:"POST",
								success:function(data){
									try{
										data = JSON.parse(data);
										if(data.success){
											bootbox.alert("Promocode changed to: "+data.code);
											$("#thecode").html(data.code);						
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
	
	<?php include "Templates/Bodyif.php"; ?>	
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
				<button type="button" class="btn btn-panelbet" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-panelbet" onclick="redeem()">Reedem</button>
			</div>
		</div>
	</div>
</div>
</nav>
<script>
function saveSettings(){
	for(var i=0;i<SETTINGS.length;i++){
		setCookie("settings_"+SETTINGS[i],$("#settings_"+SETTINGS[i]).is(":checked"));
	}
	$("#settingsModal").modal("hide");
	if($("#settings_dongers").is(":checked")){
		$("#balance").html("Please restart");
	}else{
		$("#balance").html("Please restart");
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
					bootbox.alert("Success! you are credited "+data.credits+" credits.");					
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
</script><div class="page-content">
                <div class="col-md-9">
                    
                    <br>
                    <div class="widget-user mbl">
                        <div class="header">
                            <div class="header-content clearfix">
                                <div class="user-img col-sm-3">
                                    <img class="img-circle img img-profilee" src="<?=$user['avatar']?>">
                                </div>
                                <div class="user-info col-sm-9">
                                    <h2><?php echo htmlspecialchars($user['name'])?></h2>
                                    <p>
                                        </p><table border="0" style="line-height:200%;background-color: transparent;color: #fff;">
                                            <tbody>
                                            <tr>
                                                <td width="110">SteamID64:</td>
                                                <td style="font-weight:bold;"><?=($user)?$user['steamid']:''?></td>
                                            </tr> 
                                            <tr>
                                                <td>Real name:</td>
                                                <td style="font-weight:bold;"><?=$user['realname']?></td>
                                            </tr>
											<tr>
                                                <td>Country:</td>
                                                <td><?=$user['country']?></td>
                                            </tr>
                                            <tr>
                                                <td>Rank:</td>
                                                <td><span class="badge badge-default"><i class="fa icon-graduation"></i> <abbr title="<?=$affiliates['depositors']?>"> <?=$affiliates['level']?> </abbr> </span></td>
                                            </tr>
                                        </tbody></table>
                                    <p></p>
                                    <p>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="stats">
                            <div class="row">
                                <div class="stat-item col-xs-4">
                                    <span id="number-blogs"><h3><?=$user['betrate']?></h3></span>
                                    <p>ROLLS</p>
                                </div>

                                <div class="stat-item col-xs-4">
                                    <span id="number-following"><h3><b><?=$affiliates['lifetime_earnings']?></b> Coins</h3></span>
                                    <p>PROFIT</p>
                                </div>

                                <div class="stat-item col-xs-4">
									<span id="dongers"></span>
                                    <span id="balance"><h3><?=$user['balance']?></h3> </span>
                                    <p>COINS</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="affiliate">
                        <div class="panel-tos">
                            <div class="caption">Affiliate program - set promo code and collect coins!</div>
                        </div>
						<div class='note note-success text-center'>Your promocode is: <b><span id='thecode'><?=$affiliates['code']?></span> - <a href='#' id='changecode'>update</a></b></div>       
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        Visitors <span class="label label-info"><b><?=$affiliates['visitors']?></b></span>
                                    </div>
                                    <div class="col-md-4">
                                        Total bet <span class="label label-info"><b><?=$affiliates['total_bet']?></b></span>
                                    </div>
									<div class="col-md-4">
                                        Available Now <span class="label label-info"><b><?=$affiliates['available']?></b></span>
                                    </div>
									<div class="pull-right">
                                        <button id="collect" type="submit" class="btn btn-success btn-block">Collect coins</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="affiliate">
                        <div class="panel-tos">
                            <center><h3>Transfers history</h3></center>
<table class='table table-striped dataTable no-footer'><thead><th>Transfer ID</th><th>From</th><th>To</th><th>Amount</th><th>Note</th><th>Time</th></thead><tbody>
				<?php foreach($transfers as $key => $value): ?>
					<tr><td><?=$value['id']?></td><td><?=($value['from1'] == $user['steamid'])?'YOU':'<a href="http://steamcommunity.com/profiles/'.$value['from1'].'/" target="_blank">'.$value['to1'].'</a>'?></td><td><?=($value['to1'] == $user['steamid'])?'YOU':'<a href="http://steamcommunity.com/profiles/'.$value['to1'].'/"" target="_blank">'.$value['to1'].'</a>'?></td><td><?=$value['amount']?></td><td></td><td><?=date('d-m-Y H:i:s', $value['time'])?></td></tr>
				<?php endforeach; ?>
				</tbody></table>
                        </div>
                        <div class="panel-body">

						
                            </div>
                        </div>
                </div>
                <div style="clear:both"></div>
            </div>
<footer class="container footer">
	<div class="">
		<div class="pull-left" style="overflow:hidden">
		<!--	<a href="https://www.facebook.com/CSEURO.COM" target="_blank"><img class="rounded" src="template/img/social/facebook_icon.png"></a>  -->
		<!--	<a href="https://twitter.com/CSEURO.COM" target="_blank"><img class="rounded" src="template/img/social/twitter_icon.png"></a>  -->
			<!-- <a href="#" target="_blank"><img class="rounded" src="template/img/social/youtube icon.png"></a> -->
			<!-- <a href="#" target="_blank"><img class="rounded" src="template/img/social/reddit icon.png"></a> -->
			<!-- <a href="#" target="_blank"><img class="rounded" src="template/img/social/twitch icon.png"></a>
			<a href="http://steamcommunity.com/groups/CSEURO.COM" target="_blank"><img src="template/img/logo_footer.png"></a>-->
		</div>
		<div class="pull-right" style="overflow:hidden;">
			<!--<a href="http://steamcommunity.com/groups/CSEURO.COM" target="_blank"><img src="template/img/code.png"></a>-->

		</div>
		<ul class="list-inline menu" style="    display: inline-block;
    margin-top: 11px;
    margin-left: 50px;
    padding: 20px;
    border-bottom: 1px solid #515563;
">
			<li><a href="/tos">Terms of use</a></li>
			<li><a href="/support?new">Support</a></li>
			<li><a href="http://steampowered.com" target="_target">Powered by Steam</a></li>
		</ul>
	</div>	
</footer>		
	</body>
</html>