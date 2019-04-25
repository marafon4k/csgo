<?php

	function getUserRank($steamid)
	{
		include 'settings.php';

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) 
		{
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT admin, ban FROM users WHERE steamid='".$steamid."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc())
			{
				if($row['admin']==0)
				{
					$rank = 'User';
				}
				if($row['admin']==1)
				{
					$rank = '<span style="color:green">Admin</span>';
				}
				if($row['ban']==1)
				{
					$rank = '<span style="color:red">Banned</span>';
				}
			}

			echo $rank;
		} 
		else 
		{
			echo 'error';
		}

		$conn->close();
	}

?>