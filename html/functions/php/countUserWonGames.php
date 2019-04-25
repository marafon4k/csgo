<?php

	function countUserWonGames($steamid)
	{
		include 'settings.php';

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) 
		{
			die("Connection failed: " . $conn->connect_error);
		}

		// won in side 1 (ct)
		$sql = "SELECT id FROM games WHERE player1='".$steamid."' AND player1_side='ct' AND winner='ct'";
		$result1 = $conn->query($sql);

		$wonInSide1_1 = mysqli_num_rows($result1);

		$sql2 = "SELECT id FROM games WHERE player2='".$steamid."' AND player2_side='ct' AND winner='ct'";
		$result2 = $conn->query($sql2);

		$wonInSide1_2 = mysqli_num_rows($result2);

		$wonInSide1 = $wonInSide1_1 + $wonInSide1_2;

		// won in side 2 (tt)
		$sql = "SELECT id FROM games WHERE player1='".$steamid."' AND player1_side='tt' AND winner='tt'";
		$result3 = $conn->query($sql);

		$wonInSide2_1 = mysqli_num_rows($result3);

		$sql2 = "SELECT id FROM games WHERE player2='".$steamid."' AND player2_side='tt' AND winner='tt'";
		$result4 = $conn->query($sql2);

		$wonInSide2_2 = mysqli_num_rows($result4);

		$wonInSide2 = $wonInSide2_1 + $wonInSide2_2;

		// won in total

		$wonInTotal = $wonInSide1 + $wonInSide2;
		return $wonInTotal;

		$conn->close();
	}

?>