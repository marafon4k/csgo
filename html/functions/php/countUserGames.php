<?php

	function countUserGames($steamid)
	{
		include 'settings.php';

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) 
		{
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT id FROM games WHERE player1='".$steamid."'";
		$result = $conn->query($sql);

		$won1 = mysqli_num_rows($result);

		$sql2 = "SELECT id FROM games WHERE player2='".$steamid."'";
		$result2 = $conn->query($sql2);

		$won2 = mysqli_num_rows($result2);

		return $won1 + $won2;

		$conn->close();
	}

?>