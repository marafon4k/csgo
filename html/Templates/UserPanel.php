			<style>
				.sign-in {
				    font-size: 10px;
				    line-height: 30px;
				    margin: 0px auto 0;
				    width: 150px;
				    height: 40px;
				    background: linear-gradient(#d62521, #440b09);
				    border: 3px solid #d62521;
				    border-radius: 5px;
				    text-shadow: 0 0 20px rgba(255, 255, 255, .3);
				    -webkit-transition: .1s;
				    transition: .1s;
				    -webkit-transform: scale(1);
				    transform: scale(1);
				    cursor: pointer;
				    -webkit-user-select: none;
				    -moz-user-select: none;
				    -ms-user-select: none;
				    user-select: none;
				    box-shadow: 0 0 50px rgb(222, 42, 42);
				    overflow: hidden;
				    font-weight: 700;
				    text-transform: uppercase;
				    text-align: center;
				    color: #fff;
				}
			</style>
			<? if($user): ?>
				<ul class="nav navbar-nav navbar-right">
						
					 <center><img class="rounded" src="<?=$user['avatar']?>"> <b><span style="color:black"><?=$user['name']?></span></b>    <a href="/exit" class="logout-link"><i class="fa fa-power-off"></i></a>
					 <br>
					 <a href="/profile"> My profile </a></center>
				</ul>
			<? else: ?>
			<?php if($_GET['page'] == 'main') {?>
				<ul class="nav navbar-nav navbar-right">
	            	<a href="/login" style="cursor:pointer;"><div class="sign-in">Login with Steam</div></a>
				</ul>
			<?php }else{ ?>
			<ul class="nav navbar-nav navbar-right">
            	<a style="cursor:pointer;"><div>Login with Steam</div></a>
			</ul>
			<?php } ?>
			<? endif; ?>

<script>
	$(document).ready(function(){

		$('.sign-in').click(function(){
			$('#Agreement').modal('show');
		});


	});
</script>