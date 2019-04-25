function redeem() 
{
	var steamid = $("#steamid").val();
	var code = $("#codeRef").val();
	$.ajax(
	{
		url: 'redeem.php', 
		type: 'POST', 
		data: '&steamid=' + steamid + '&code=' + code, 
		dataType: 'text', 
		success: function (data) 
		{
			document.getElementById('redeemMsg').innerHTML = data;
			$("#redeemMsg").fadeIn();
		}
	});
}