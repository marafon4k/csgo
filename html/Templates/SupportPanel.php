<? if(isset($_GET['closed'])) { ?>
	<? foreach ($tickets as $key => $value) { ?>
	<div class="panel panel-info text-left">
		<div class="panel-heading">
			<h4><?=$value['title']?></h4>
		</div>
			<? foreach ($value['messages'] as $key2 => $value2) { ?>
			<div class="panel-body">
				<div class="col-md-4">
					<div class="alert alert-<?=($user['steamid']==$value2['user'])?'success':'warning'?> bubble text-center"><img class="rounded" src="<? getUserSteamAvatar($value2['user']); ?>" width="50px"> <br /><br /> <? echo getUserSteamNickname($value2['user']); ?></div>
				</div>
				<div class="col-md-8">
					<div class="alert alert-<?=($user['steamid']==$value2['user'])?'success':'warning'?> bubble" height="auto"><?=$value2['message']?></div>
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
				<div class="alert alert-<?=($user['steamid']==$value['user'])?'success':'warning'?> bubble text-center"><img class="rounded" src="<? getUserSteamAvatar($value['user']); ?>" width="50px"> <br /><br /> <? echo getUserSteamNickname($value['user']); ?></div>
			</div>
			<div class="col-md-8">
				<div class="alert alert-<?=($user['steamid']==$value['user'])?'success':'warning'?> bubble" height="auto"><?=$value['message']?></div>
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
				<td><? if($value['cat'] == 1) { echo 'Deposit / Withdraw'; } elseif($value['cat'] == 2)  { echo 'Rates'; } elseif($value['cat'] == 3) { echo 'Advertising'; } elseif($value['cat'] == 4) { echo 'Donations'; } elseif($value['cat'] == 5) { echo 'Other'; }  ?></td>
				<td><img class="rounded" src="<? getUserSteamAvatar($value['user']); ?>" width="25px"> <? echo getUserSteamNickname($value['user']); ?></td>
				<td><span class='text-<?=($value['status']>=1)?'danger':'success'?>'><?=($value['status']>=1)?'CLOSED':'OPEN'?></span></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

 <? } ?>