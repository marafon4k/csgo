function refreshGames()
{
	document.getElementById('refreshIcon').className += 'refreshbtn';
	$('#game-list-container').load(document.URL +  ' #game-list-container');
	setTimeout(function(){ document.getElementById('refreshIcon').className = 'refreshbtn'; }, 1000);
}