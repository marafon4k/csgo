<html lang="en"><head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin support - cseuro.com</title>		
		<link href="https://cseuro.com/template/css/bootstrap.min.new.css" rel="stylesheet">
		<link href="https://cseuro.com/template/css/font-awesome.min.css" rel="stylesheet">
		<link href="https://cseuro.com/template/css/dataTables.bootstrap.min.css" rel="stylesheet">

		<link href="https://cseuro.com/template/css/mineNew.css?v=5" rel="stylesheet">
		<link id="style" href="" rel="stylesheet">

		<link rel="shortcut icon" href="favicon.ico">

		<script src="https://cseuro.com/template/js/jquery-1.11.1.min.js"></script>
		<script src="https://cseuro.com/template/js/jquery.cookie.js"></script>
		<script src="https://cseuro.com/template/js/bootstrap.min.js"></script>
		<script src="https://cseuro.com/template/js/bootbox.min.js"></script>
		<script src="https://cseuro.com/template/js/jquery.dataTables.min.js"></script>
		<script src="https://cseuro.com/template/js/dataTables.bootstrap.js"></script>
		<script src="https://cseuro.com/template/js/tinysort.js"></script>
		<script src="https://cseuro.com/template/js/expanding.js"></script>
		<script src="https://cseuro.com/template/js/theme.js"></script>
		<?php include "Templates/Settings.php"; ?>
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
                    var body = $("#text"+tid).val();
                    var close = $("#check"+tid).is(":checked")?1:0;
                    var conf = "Are you sure you wish to submit this reply?";                       
                    bootbox.confirm(conf,function(result){
                        if(result){
                            $.ajax({
                                url:"/support_reply",
                                type:"POST",
                                data:{"tid":tid,"reply":body,"close":close},
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
			<a class="navbar-brand" style="padding-top:0px;padding-bottom:0px;padding-right:0px" href="./"><img alt="CSEURO.COM" class="logoo" src="template/img/logo.png"></a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
        <div style="float:right;    padding-top: 10px;">
			<ul class="nav navbar-nav">
			<li class=""><a href="/main">Главная</a></li>
				<li class="active"><a href="/adminsupport">Admin Ticket</a></li>
				<li class=""><a href="/coins">Coins</a></li>
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
				<button type="button" class="btn btn-panelbet" data-dismiss="modal">Close</button>
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
				  	
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-panelbet" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-panelbet" onclick="saveSettings()">Save changes</button>
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
<div class="container">
<? if(isset($_GET['closed'])) { ?>
	<? foreach ($tickets as $key => $value) { ?>
	<div class="panel panel-info text-left">
		<div class="panel-heading">
			<h4><?=$value['title']?></h4>
		</div>
			<? foreach ($value['messages'] as $key2 => $value2) { ?>
			<div class="panel-body">
				<div class="col-md-4">
					<div class="note note-<?=($user['steamid']==$value2['user'])?'success':'warning'?> bubble text-center"><img class="rounded" src="<? getUserSteamAvatar($value2['user']); ?>" width="50px"> <br /><br /> <? echo getUserSteamNickname($value2['user']); ?></div>
				</div>
				<div class="col-md-8">
					<div class="note note-<?=($user['steamid']==$value2['user'])?'success':'warning'?> bubble" height="auto"><?=$value2['message']?></div>
				</div>
			</div>
			<? } ?>
	</div>
	<? } ?>
<? } elseif(isset($_GET['id'])) { ?>

	<div class="panel panel-info text-left">
		<div class="panel-heading">
			<h4><?=$ticket['title']?></h4>
		</div>
		<? foreach($ticket['messages'] as $key => $value): ?>
		<div class="panel-body">
			<div class="col-md-4">
				<div class="note note-<?=($user['steamid']==$value['user'])?'success':'warning'?> bubble text-center"><img class="rounded" src="<? getUserSteamAvatar($value['user']); ?>" width="50px"> <br /><br /> <? echo getUserSteamNickname($value['user']); ?></div>
			</div>
			<div class="col-md-8">
				<div class="note note-<?=($user['steamid']==$value['user'])?'success':'warning'?> bubble" height="auto"><?=$value['message']?></div>
			</div>
		</div>
	<? endforeach; ?>
	</div>

	<div class="panel panel-info text-left">
		<div class="panel-heading">
			<h4>Reply</h4>
		</div>
		<div class="panel-body">
				<textarea id="text<?=$ticket['id']?>" class="form-control" rows="3" placeholder="Reply..."></textarea>
				<label><input id="check<?=$ticket['id']?>" type="checkbox"> Close Ticket</label>
				<button data-x="<?=$ticket['id']?>" type="button" class="btn btn-success btn-block support_button">Reply</button>
		</div>
	</div>

<? } else { ?>


	<table class='table table-striped dataTable no-footer'>
		<thead>
			<tr>
				<th>Ticket</th>
				<th>Title</th>
				<th>Category</th>
				<th>User</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($ticketlist as $key => $value): ?>
			<tr onclick="window.location.href = 'adminsupport?id=<?=$value['id']?>';">
				<td><?=$value['id']?></td>
				<td><?=$value['title']?></td>
				<td><? if($value['cat'] == 1) { echo 'Deposit / Withdraw'; } elseif($value['cat'] == 2)  { echo 'Rates'; } elseif($value['cat'] == 3) { echo 'Adversitmen'; } elseif($value['cat'] == 4) { echo 'Other'; }  ?></td>
				<td><img class="rounded" src="<? getUserSteamAvatar($value['user']); ?>" width="25px"> <? echo getUserSteamNickname($value['user']); ?></td>
				<td><span class='text-<?=($value['status']>=1)?'danger':'success'?>'><?=($value['status']>=1)?'CLOSED':'OPEN'?></span></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

 <? } ?>
</div>
</div>
	<?php include "Templates/Agreement.php"; ?>
	<?php include "Templates/Footer.php"; ?>			
	
</body></html>