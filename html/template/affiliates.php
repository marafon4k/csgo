<div class="col-xs-12">		

<div class='alert alert-success text-center'>
		Your promocode is: <b><span id='thecode'><?=$affiliates['code']?></span> - <a href='#' id='changecode'>update</a></b>
	</div>     
	<table class="table">
		<tr><td>Affiliate level</td><td><?=$affiliates['level']?></td></tr>
		<tr><td>Visitors</td><td><?=$affiliates['visitors']?></td></tr>
		<tr><td>Depositors</td><td><?=$affiliates['depositors']?></td></tr>
		<tr><td>Total bet:</td><td><?=$affiliates['total_bet']?></td></tr>
		<tr><td>Lifetime Earnings</td><td><?=$affiliates['lifetime_earnings']?></td></tr>
		<tr><td>Available Now</td><td id='avail'><?=$affiliates['available']?></td></tr> 
	</table>

	<div class="text-right">
	    <button class="btn btn-success btn-block" style="background: #5cb85c; color: #fff; width: 400px; margin: 0 auto;" id="collect">Collect coins</button>
	</div>

	<br>
	<table id='referrals' class='table table-striped dataTable no-footer'>
		<thead>
			<th>SteamID</th>
			<th>Total bet</th>
			<th>Commision</th>
		</thead>
		<tbody>
			<?php foreach($affiliates['reffers'] as $key => $value): ?>
			<tr>
				<th><?=$value['player']?><?=($value['total_bet'] > 0)?"<i class='fa fa-check text-success'></i>":""?></th>
				<th><?=$value['total_bet']?></th>
				<th><?=$value['comission']?></th>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>			
</div>
		