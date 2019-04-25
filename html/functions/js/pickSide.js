function pickSide(side)
{
	if(side=='ct')
	{
		document.getElementById('tt').style.opacity = 0.5;
		document.getElementById('ct').style.opacity = 1;
		document.getElementById('side').value = 'ct';
	}
	if(side=='tt')
	{
		document.getElementById('tt').style.opacity = 1;
		document.getElementById('ct').style.opacity = 0.5;
		document.getElementById('side').value = 'tt';
	}
}