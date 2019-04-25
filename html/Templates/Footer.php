<footer class="container footer">
	<div class="">
		<!--<div class="pull-left" style="overflow:hidden">
			<a href="http://steamcommunity.com/groups/" target="_blank"><img src="/css/img/code.png"></a>
		</div>
	
		<div class="pull-right" style="overflow:hidden;">
			<a href="http://steamcommunity.com/groups/" target="_blank"><img src="/css/img/code.png"></a>
		</div>-->
		<ul class="list-inline menu" style="    display: inline-block;
    margin-top: 11px;
    margin-left: 50px;
    padding: 20px;
    border-bottom: 1px solid #515563;
">
<?php if($user ['rank'] == "1" || $user ['rank'] == "2" || $user ['rank'] == "100") { ?>
			<li><a href="/adminsupport">Admin support</a></li>
			<?php }else{ ?>
			<?php } ?>
			<li><a href="/faq">FAQ</a></li>
			<li><a href="/tos">Terms of Use</a></li>
			<li><a href="/contact">Contact Us</a></li>
			<li><a href="http://steampowered.com" target="_target">Powered by Steam</a></li>
		</ul>
	</div>	
</footer>	