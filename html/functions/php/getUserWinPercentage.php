<?php

	function getUserWinPercentage($steamid)
	{
		$totalGames = countUserGames($steamid);
		$totalGamesWon = countUserWonGames($steamid);
		
		if($totalGames == 0)
		{
			echo '0%';
		}

		elseif($totalGames > 0)
		{
			echo round($totalGamesWon / $totalGames * 100).'%';
		}
	}

?>