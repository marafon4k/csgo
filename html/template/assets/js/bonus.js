$(function() {

    var token = $('meta[name="csrf_token"]').attr('content');

    $('#prize-vk').click(function () {
        $.post('/bonus/get_vk', {_token: token}, function (data) {

            if(!data.success){
                noty({
                    text: '<strong>Error</strong><br>' + data.error ,
                    layout: 'topRight',
                    type: 'error',
                    timeout: 4000,
                    closeWith: ['click'],
                });
            }else{
                noty({
                    text: '<strong>Congratulations</strong><br>You received 0.25 <i style="color: black" class="fa fa-diamond"></i>',
                    layout: 'topRight',
                    type: 'success',
                    timeout: 4000,
                    closeWith: ['click'],
                });

                $.post('/getBalance', {_token: token}, function (data) {
                    $('.update_balance').attr("data-balance", data);
                    var balanceNow = $('.update_balance').text();
                    $('.update_balance').prop('number', balanceNow).animateNumbers(data);
                    $('#balance').prop('number', balanceNow).animateNumbers(data);
                });
            }
        });
    });

    $('#prize-steam').click(function () {
        $.post('/bonus/get_steam', {_token: token}, function (data) {

            if(!data.success){
                noty({
                    text: '<strong>Error</strong><br>' + data.error ,
                    layout: 'topRight',
                    type: 'error',
                    timeout: 4000,
                    closeWith: ['click'],
                });
            }else{
                noty({
                    text: '<strong>Congratulations</strong><br>You received 0.25 <i style="color: black" class="fa fa-diamond"></i>',
                    layout: 'topRight',
                    type: 'success',
                    timeout: 4000,
                    closeWith: ['click'],
                });

                $.post('/getBalance', {_token: token}, function (data) {
                    $('.update_balance').attr("data-balance", data);
                    var balanceNow = $('.update_balance').text();
                    $('.update_balance').prop('number', balanceNow).animateNumbers(data);
                    $('#balance').prop('number', balanceNow).animateNumbers(data);
                });
            }
        });
    });

});