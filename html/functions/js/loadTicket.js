function loadTicket(id)
{
	$("#contactDetails").load("ticketDetails.php?id=" + id);
	$("#contactDetails").fadeIn();
}