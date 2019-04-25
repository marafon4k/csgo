function sendMessage() 
{
	var steamid = $("#steamid").val();
	var message = $("#message").val();
	if (message)
	{
		$.ajax(
		{
			url: 'addChatMessage.php', 
			type: 'POST', 
			data: '&steamid=' + steamid + '&message=' + message, 
			dataType: 'text', 
			success: function (data) 
			{
				$('#chatMessages').load(document.URL +  ' #chatMessages');
				document.getElementById('message').value = '';
				$('#chatScrollable').animate({scrollTop:$(document).height()}, 1000);
			}
		});
	}
}