<?php

	function getBanReason($steamid)
	{
		include 'settings.php';

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) 
		{
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT ban_reason FROM users WHERE steamid='".$steamid."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				if(!empty($row['ban_reason']))
				{
					$banreason = $row['ban_reason'];
				}
				if(empty($banreason))
				{
					$banreason = '<i>No reason given.</i>';
				}

				echo $banreason;
			}
		}

		$conn->close();
	}

?>