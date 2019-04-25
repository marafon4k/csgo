<table id='zgarci' class='table table-striped dataTable no-footer'><thead><th>Game ID</th><th>Bet</th><th>Result</th><th>Amount Won</th></thead><tbody>
				<?php foreach($mineshistory as $key => $value): ?>
					<tr><td><?=$value['id']?></td>
						<td><?=$value['amount']?></td>
						<td><?=$value['result']?></td>
						<td><?=$value['amountWon']?></td>
					</tr>
				<?php endforeach; ?>
				</tbody></table>