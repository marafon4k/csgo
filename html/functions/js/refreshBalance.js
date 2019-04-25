function refreshBalance()
{
	$('#balanceRcontainer').load(document.URL +  ' #balanceR');
	setTimeout(function()
	{ 
		var balance = document.getElementById('balanceR').innerHTML;
		document.getElementById('balanceContainer').innerHTML = '<span id="balance2" data-from="0" data-to="' + balance + '" data-speed="250" data-refresh-interval="2">' + balance + '</span>';
	}, 100);
}