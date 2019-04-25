
$(function() {
    var app = new App();

    $("#newticket").click(function () {
        $(".support .table").hide();
        $(".support .nticket").show();
        $("#newticket").css('display', 'none');
        $("#listticket").css('display', 'block');
    });

    $("#listticket").click(function () {
        $(".support .table").show();
        $(".support .nticket").hide();
        $("#newticket").css('display', 'block');
        $("#listticket").css('display', 'none');
    });

    $("#sendTicket").click(function() {
        var title = $("#title").val();
        var message = $("#message").val();

        $.ajax({
            url : '/support/sendTicket',
            type : 'POST',
            data: {
                title : title,
                message : message
            },
            dataType : 'json',
            success : function(json, textStatus, jqXHR) {
                if(json.success != undefined) {
                    app.swal({
                        title: "Done",
                        text: 'Ticket succesfully created',
                        type: "success",
                        showCancelButton: false,
                        confirmButtonText: "ОК"
                    },function(){
                        window.location = json.success;
                    });
                } else if(json.error != undefined) {
                    app.swal({
                        title: "Error",
                        text: json.error,
                        type: "error"
                    });
                }
            }
        });
    });

});

