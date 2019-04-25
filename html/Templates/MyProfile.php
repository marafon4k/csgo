<div class="container">
<h1><b style="color: #ff0000;"><?php echo $user['name']?>'s profile</b></h1>
<img class="rounded" height="50" width="50" src="<?=$user['avatar']?>">
<td><b style="color: #ffcc01;">Balance: <b></td><td style="font-weight:700;color: #d1d1d1;"><b><?php echo $user['balance']; ?> coins</h4></b></td></br>
<td><b style="color: #ffcc01;">SteamID64: <b></td><td style="font-weight:700;color: #d1d1d1;"><b><?php echo $user['steamid']; ?></h4></b></td></br>
                                                <td><b style="color: #ffcc01;">COUNTRY:<b></td>
                                                <td style="font-weight:700;color: #d1d1d1;"><b><?=$user['country']?></b></td>
<!--<h4><a href="#" data-toggle="modal" data-target="#moreCredits"><i class="fa fa-gift fa-fw"></i> Join steam group and get credits</a></h4>-->
<h4><a href="#" data-toggle="modal" data-target="#settingsModal"><i class="fa fa-cog fa-fw"></i> Settings</a></h4>
<!--<?php if($user['rank'] == 100 ){?>
<h4><a href="#" data-toggle="modal" data-target="#createCodeModal"><i class="fa fa-gift fa-fw"></i> Create Discount Code</a></h4>
<?php } ?>
</div>-->


<div class="container">
			<center><h3>Affiliates</h3></center>
						<div class='alert alert-success text-center'>Your promocode is: <b><span id='thecode'><?=$affiliates['code']?></span> - <a href='#' id='changecode'>update</a></b></div>     
			<table class="table">

				<tr><td>Affiliate level</td><td><?=$affiliates['level']?></td></tr>
				<tr><td>Visitors</td><td><?=$affiliates['visitors']?></td></tr>
				<tr><td>Depositors</td><td><?=$affiliates['depositors']?></td></tr>
				<tr><td>Total bet:</td><td><?=$affiliates['total_bet']?></td></tr>
				<tr><td>Lifetime Earnings</td><td><?=$affiliates['lifetime_earnings']?></td></tr>
				<tr><td>Available Now</td><td id='avail'><?=$affiliates['available']?></td></tr> 

				</td></tr>
			</table>
		<div class="text-right">
			<button class="btn btn-success btn-block" style="background: #5cb85c; color: #fff; width: 400px; margin: 0 auto;" id="collect">Collect coins</button>
		</div>
						<br>		
</div>

<br><table id='referrals' class='table table-striped dataTable no-footer'><thead><th>SteamID</th><th>Total bet</th><th>Commision</th></thead>
				<? foreach($affiliates['reffers'] as $key => $value): ?>
				<tr><th><?=$value['player']?><?=($value['total_bet'] > 0)?"<i class='fa fa-check text-success'></i>":""?></th><th><?=$value['total_bet']?></th><th><?=$value['comission']?></th></tr>
				<? endforeach; ?>
				<tbody></tbody></table>			
		</div>

<br>
<div class="container">
<center><h3>Trades history</h3></center>
<table class='table table-striped dataTable no-footer'><thead>
					<th>Trade number</th>
					<th>Bot</th>
					<th>Code</th>
					<th>Coins</th>
					<th>Status</th>
					<th>Accept</th>
					</thead><tbody>
					<?php foreach($offers as $key => $value): ?>
					<tr><td><?=$value['id']?></td><td>BOT #<?=$value['bot_id']?></td><td><?=$value['code']?></td><td><span class='text-<?=($value['summa']>0)?'success':'danger'?> muted'><?=($value['summa']>0)?'+'.$value['summa']:$value['summa']?></b></span></td><td><span class='text-<?=($value['status']>=1)?'success':'danger'?>'><?=($value['status']>=1)?'Completed':'Error'?></span></td><td><i class='fa fa-<?=($value['status']>=1)?'check':'close'?> text-<?=($value['status']>=1)?'success':'danger'?>'></i></td></tr>
					<?php endforeach; ?>
					</tbody></table>
</div>					
<br>
<div class="container">
<center><h3>Transfers history</h3></center>
<table class='table table-striped dataTable no-footer'><thead><th>Transfer ID</th><th>From</th><th>To</th><th>Amount</th><th>Note</th><th>Time</th></thead><tbody>
				<?php foreach($transfers as $key => $value): ?>
					<tr><td><?=$value['id']?></td><td><?=($value['from1'] == $user['steamid'])?'YOU':'<a href="http://steamcommunity.com/profiles/'.$value['from1'].'/" target="_blank">'.$value['to1'].'</a>'?></td><td><?=($value['to1'] == $user['steamid'])?'YOU':'<a href="http://steamcommunity.com/profiles/'.$value['to1'].'/"" target="_blank">'.$value['to1'].'</a>'?></td><td><?=$value['amount']?></td><td></td><td><?=date('Y-m-d H:i:s', $value['time'])?></td></tr>
				<?php endforeach; ?>
				</tbody></table>
</div>







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
							if(data.success){
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

<div class="modal fade" id="moreCredits" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header hidden">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title"><b>Get More Credits</b></h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold;font-size:14px;margin-bottom:10px;"><a target="_blank" href="http://steamcommunity.com/groups/cs_euro">Join our Steam Group</a> to get 100 coins.</span>-->
				<br><button style="margin-top:10px;" type="button" class="btn btn-success" onclick="redeemgroup()">Redeem</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
function redeemgroup() {
    $.ajax({
        url: "/redeemgroup",
        success: function(data) {
            try {
                data = JSON.parse(data);
                if (data.success) {
                    bootbox.alert("You have received " + data.credits + " credits.");
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

 function imageredeem() {
    $.ajax({
        url: "/imageredeem",
        success: function(data) {
            try {
                data = JSON.parse(data);
                if (data.success) {
                    bootbox.alert("You have received " + data.credits + " credits.");
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

<?php include "Templates/CreateCodeModal.php"; ?>