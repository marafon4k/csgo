<div class="modal fade" id="promoModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Redeem Codes</b></h4>
			</div>
			<div class="modal-body">
<div class="form-group">
<label for="exampleInputEmail1">Promo Code</label>
<input type="text" class="form-control" id="promocode" value=""> </div>
<div class="form-group">
<label for="exampleInputEmail1">Discount Code</label>
<input type="text" class="form-control" id="discountcode" value=""> </div>
</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" onclick="redeem()">Reedem</button>
			</div>
		</div>
	</div>
</div>











<script>
function redeem(){
	var code = $("#promocode").val();
	var dcode = $("#discountcode").val();
	if(code && !dcode) {
		$.ajax({
			url:"/redeem?code="+code,
			success:function(data){		
				try{
					data = JSON.parse(data);
					console.log(data);
					if(data.success){
						bootbox.alert("Success! You have received "+data.credits+" credits.");					
					}else{
						bootbox.alert(data.error);
					}
				}catch(err){
					bootbox.alert("Javascript error: "+err);
				}
			},
			error:function(err){
				bootbox.alert("AJAX error: "+err);
			}
		});
	} else if(dcode && !code) {
		$.ajax({
			url:"/dredeem?dcode="+dcode,
			success:function(data){		
				try{
					data = JSON.parse(data);
					console.log(data);
					if(data.success){
						bootbox.alert("Success! You have received "+data.credits+" credits.");					
					}else{
						bootbox.alert(data.error);
					}
				}catch(err){
					bootbox.alert("Javascript error: "+err);
				}
			},
			error:function(err){
				bootbox.alert("AJAX error: "+err);
			}
		});
	} else if(!code && !dcode) {
		bootbox.alert("You need to type a code.");
	} else {
		bootbox.alert("Only one code at a time!");
	}
}
</script>