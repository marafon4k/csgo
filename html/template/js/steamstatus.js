/*
           ______________________________________
  ________|            CRASH SCRIPTSV2           |_______
  \       |          Developed by DethraLz       |      /
   \      |  steamcommunity.com/id/DethraLz      |     /
   /      |______________________________________|     \
  /__________)                                (_________\


*/
refresh();
       
function refresh()
{
   
    $.ajax({
        type: "GET",
        url: "http://www.csgowoof.com/steamstatus.php", //YourWebsite URL
        error: function(err) {
            console.log(err);
        },
        success: function(result) {
            $("span.steamstatus").html(result);
        }
    });
 
    setTimeout(refresh, 1000);
}