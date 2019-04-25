function addGame() 
{
	var side = $("#side").val();
	var steamid = $("#steamid").val();
	var amount = $("#amount").val();
	var buttonText = document.getElementById('createGameButton').innerHTML;

	if(buttonText=='Are you sure?')
	{
		$.ajax(
		{
			url: '/addGame', 
			type: 'GET', 
			data: 'side=' + side + '&steamid=' + steamid + '&amount=' + amount, 
			dataType: 'json', 
			success: function (data) 
			{
				document.getElementById('game-alert').innerHTML = data.msg;
				$("#game-alert").fadeIn();
				refreshGames();
				document.getElementById('createGameButton').innerHTML = 'Create Game';
			}
		});
	}

	if(buttonText=='Create Game')
	{
		document.getElementById('createGameButton').innerHTML = 'Are you sure?';
	}
}