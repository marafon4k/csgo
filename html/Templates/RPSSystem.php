<center>

<style>
.button {
    font-size: 10px;
    line-height: 20px;
    width: 150px;
    height: 40px;
    background: linear-gradient(#4EEDE3, #26D4C8);
    border: 3px solid #87FFF9;
    border-radius: 5px;
    text-shadow: 0 0 20px rgba(64, 255, 255, 0.9);
    -webkit-transition: .1s;
    transition: .1s;
    -webkit-transform: scale(1);
    transform: scale(1);
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    box-shadow: 0 0 50px rgb(0, 255, 255);
    overflow: hidden;
    font-weight: 700;
    text-transform: uppercase;
    text-align: center;
    color: #fff;
    display: inline-block;
}
</style>
<head>
<div style="font-size: 13px;background-color: #efefef; padding: 10px 20px; margin-right: 5px; color: #fff; border-radius: 10px;">
<h1><span style="color:black">Balance: <span id="Coins">0</span></span></h1>
	<input type="text" class="form-control input-lg" placeholder="Bet amount..." id="betAmount" value="0">
					<button type="button" class="btn btn-danger betshort" data-action="clear">Clear</button>
					<button type="button" class="btn btn-default betshort" data-action="10">+10</button>
					<button type="button" class="btn btn-default betshort" data-action="100">+100</button>
					<button type="button" class="btn btn-default betshort" data-action="1000">+1000</button>
					<button type="button" class="btn btn-default betshort" data-action="half">1/2</button>
					<button type="button" class="btn btn-default betshort" data-action="double">x2</button>
					<button type="button" class="btn btn-primary betshort" data-action="max">Max</button>
	<br>
	<br>

	<center><div>
		<button class="btn-lg  btn-block button" onclick="bet('Rock')">Rock</button>
		<button class="btn-lg  btn-block button" onclick="bet('Paper')">Paper</button>
		<button class="btn-lg  btn-block button" onclick="bet('Scissors')">Scissors</button>
	</div></center>

</div>	
	<h3><span id="Me"><img src='img/rps/null.png'></span><span style="color:red"> vs. </span><span id="Other"><img src='img/rps/null.png'></span></h3>
<br>
</center>
<center><button type="button" class="btn-lg betButton" id="hideorshow">Hide</button></center>
<div id="container" class="container">
<table class='table table-striped dataTable no-footer'><thead><th>Round ID</th><th>User</th><th>Bet</th><th>Roll</th><th>Profit</th><th>Result</th><th>Time</th></thead><tbody>
				<?php foreach($rps as $key => $value): ?>



					<tr><td>#<?=$value['id']?></td>
					<td><? echo '<a href="http://steamcommunity.com/profiles/'.$value['steamid'].'">'.$value['name'].'</a>';?></td>
					<td><?=$value['bet']?></td>
					<td><?if($value['roll'] == 1) {
						echo '<span style="color:orange">ROCK</span>';
					}else if($value['roll'] == 2) {
						echo '<span style="color:orange">PAPER</span>';
					}else{
						echo '<span style="color:orange">SCISSORS</span>';
					}
					?></td>
					<td><?if($value['result'] == 2){
						$Amountdubbled = 2*($value['amount']);
						echo '<span style="color:green">+'.$Amountdubbled.'</span>';
					}else if($value['result'] == 0){
						echo '<span style="color:red">-'.$value['amount'].'</span>';
					}else{
						echo '<span style="color:purple">0</span>';
					}
					?></td>
					<td><?php if($value['result'] == 2){
						echo '<span style="color:green">WON</span>';
					}else if($value['result'] == 0) {
						echo '<span style="color:red">LOST</span>';
					}else{
						echo '<span style="color:purple">TIED</span>';
					}
					?></td>
					<td><?=date('H:i:s', $value['time'])?>
				</tr>
				<?php endforeach; ?>
				</tbody></table>
</div>
<?php
	$secret = "cacat";
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" ></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

<script type="text/javascript" src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>

<script language="javascript" type="text/javascript" src="https://cseuro.com/Templates/rockps.js"></script>


<script language="javascript" type="text/javascript">

$.notify.defaults({
  // whether to hide the notification on click
  clickToHide: true,
  // whether to auto-hide the notification
  autoHide: true,
  // if autoHide, hide after milliseconds
  autoHideDelay: 2000,
  // show the arrow pointing at the element
  arrowShow: true,
  // arrow size in pixels
  arrowSize: 177,
  // position defines the notification position though uses the defaults below
  position: '...',
  // default positions
  elementPosition: 'bottom left',
  globalPosition: 'bottom left',
  // default style
  style: 'bootstrap',
  // default class (string or [string])
  className: 'error',
  // show animation
  showAnimation: 'slideDown',
  // show animation duration
  showDuration: 400,
  // hide animation
  hideAnimation: 'slideUp',
  // hide animation duration
  hideDuration: 200,
  // padding between element and notification
  gap: 3
});


	$('#hideorshow').click(function() {
	    $('#container').toggle();
	    if( $('#hideorshow').text() == "Hide") {
	    	$('#hideorshow').text('Show');
	    }else{
	    	$('#hideorshow').text('Hide');
	    }
	});

	var Secret = "cacat";

	updateLastRolls();

	function updateLastRolls() {
		setInterval(function() {
			$("#container").load(location.href+" #container>*","");
		}, 200);
	}

	$(document).on("click", ".betshort", function() {
		var bet_amount = str2int($("#betAmount").val());
		var action = $(this).data("action");
		if (action == "clear") {
			bet_amount = 0;
		} else if (action == "double") {
			bet_amount *= 2;
		} else if (action == "half") {
			bet_amount /= 2;
		} else if (action == "max") {
			bet_amount = Math.min(str2int($("#Coins").html()));
		} else if (action == "last") {
			bet_amount = 0;
		} else {
			bet_amount += parseInt(action);
		}
		$("#betAmount").val(bet_amount);
	});

function str2int(s) {
	s = s.replace(/,/g, "");
	s = s.toLowerCase();
	var i = parseFloat(s);
	if (isNaN(i)) {
		return 0;
	} else if (s.charAt(s.length - 1) == "k") {
		i *= 1000;
	} else if (s.charAt(s.length - 1) == "m") {
		i *= 1000000;
	} else if (s.charAt(s.length - 1) == "b") {
		i *= 1000000000;
	}
	return i;
}


function time() {
	return parseInt(new Date().getTime()/1000);
}

function getCookie(key){
	var patt = new RegExp(key+"=([^;]*)");
	var matches = patt.exec(document.cookie);
	if(matches){
		return matches[1];
	}
	return "";
}


</script>