<div class="container">
<center><h3>Roulette history</h3></center>
<table id='zgarci' class='table table-striped dataTable no-footer'><thead><th>Roll ID</th><th>Amount</th><th>Color</th></thead><tbody>
				<?php foreach($roulettehistory as $key => $value): ?>
					<tr><td><?=$value['id']?></td>
						<td><?=$value['amount']?></td>
						<td><?php if($value['lower'] == '1' && $value['upper'] == '7'){
							echo '<b><div class="td-val ball-1">RED</div></b>';
						}else if($value['lower'] == '8' && $value['upper'] == '14'){
							echo '<b><div class="td-val ball-8">BLACK</div></b>';
						}else {
							echo '<b><div class="td-val ball-0">GREEN</div></b>';
						}


						?></td>
					</tr>
				<?php endforeach; ?>
				</tbody></table>
</div>