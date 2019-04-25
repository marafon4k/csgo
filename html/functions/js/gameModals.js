function winModal()
{
	swal({title: "Congratulations!",text: "You won! Your winnings has been added to your account.",type: "success",showCancelButton: false,confirmButtonClass: 'btn-success',confirmButtonText: 'Okay!'});
}

function loseModal()
{
	swal({title: "Unlucky...", text: "You lost this time... What about playing again?", type: "error", showCancelButton: false, confirmButtonClass: 'btn-danger', confirmButtonText: 'Okay!'});
}