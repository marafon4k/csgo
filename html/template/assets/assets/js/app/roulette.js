
var START = true;
  var csrf_token = $('meta[name="csrf_token"]').attr('content');
var decimal_places = 2;
var decimal_factor = decimal_places === 0 ? 1 : Math.pow(10, decimal_places);

var cycle = new Howl({
    urls: ['/assets/sound/kolesodouble.mp3']
})
var bet = new Howl({
    urls: ['/assets/sound/stavkadouble.mp3']
})


lastnumberdub = 0;

function getRandomArbitary(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;

}


if (START) {
    var socket = io.connect(':7777', {'reconnection': false});
    socket
        .emit('chats')
        .on('connect', function () {
            $('#loader').hide();


        })
        .on('disconnect', function () {
            $('#loader').show();
        })
        .on('new.bet', function (data) {
            var mute = $('meta[name="muted"]').attr('content');
            if(mute == 'false') bet.play(); 
            
            data = JSON.parse(data);

            $('title').text('CSGORebel.com - '+data.all+' - Win CS:GO skins')


            



            var el = $(data.html);

            if(data.operation == 'red') {
                $(".entrants.red-ch").append(el);
                var red_all_bet = $(".red-all-bet").text();
                $('.red-all-bet').prop('number', red_all_bet).animateNumbers(data.red);
            }
            if(data.operation == 'zero') {
                $(".entrants.zero-ch").append(el);
                var zero_all_bet = $(".zero-all-bet").text();
                $('.zero-all-bet').prop('number', zero_all_bet).animateNumbers(data.zero);
            }
            if(data.operation == 'black') {
                $(".entrants.black-ch").append(el);
                var black_all_bet = $(".black-all-bet").text();
                $('.black-all-bet').prop('number', black_all_bet).animateNumbers(data.black);
            }

        })
        .on('slider', function (data) {
            $(".past-wins").addClass("faded");
            if (ngtimerStatus) {

                $('.bonus-game-timer').css({transition: "600ms ease", transform: "rotateY(180deg)"});
                $('.bonus-game-pre-end').css({transition: "600ms ease", transform: "rotateY(360deg)"});
                ngtimerStatus = false;
   
                if (data.showSlider) {

                    setTimeout(function () {
                        var mute = $('meta[name="muted"]').attr('content');
                        if(mute == 'false') cycle.play();
                        var doubleGameRoulettenumber = {
                            0: [62, 83],
                            1: [38, 58],
                            2: [-6, 10],
                            3: [303, 323],
                            4: [255, 275],
                            5: [207, 227],
                            6: [159, 19],
                            7: [110, 130],
                            8: [15, 35],
                            9: [327, 347],
                            10: [-81, -60],
                            11: [231, 251],
                            12: [183, 203],
                            13: [135, 156],
                            14: [87, 107]
                        };

                        lastnumberdub = parseFloat(doubleGameRoulettenumber[data.number][0]) + parseFloat(getRandomArbitary(1, 20));
                        $('.game-roulette-numbers').attr('style', 'transition: transform ' + (data.time - 5) + 's; display: block; transform: rotate3d(0, 0, 1, ' + (parseFloat(lastnumberdub) + 2160) + 'deg);');


                    }, 500);
                }
                var timeout = data.showSlider ? 6 : 0;

                setTimeout(function () {
                    var element = $('.bonus-game-end').first();
                    element.text(data.number);
                    element.removeClass('black');
                    element.removeClass('red');
                    element.removeClass('zero');
                    element.addClass(data.color);
                    element.css({transition: "600ms ease", transform: "rotateY(360deg)"});
                    $('.bonus-game-pre-end').css({transition: "600ms ease", transform: "rotateY(180deg)"});
                    
                    var lastWinners = $('.stat')

                    var el = $(
                        "<li class='game-roulette-history-item " + data.color + "'><span>" + data.number + "</span></li>"
                    )
                    lastWinners.prepend(el)
                    el.fadeIn(1000)
                    lastWinners.find(".game-roulette-history-item:nth-of-type(15)").remove();
                    var doubleGameRoulettenumber = {
                        0: [62, 83],
                        1: [38, 58],
                        2: [-6, 10],
                        3: [303, 323],
                        4: [255, 275],
                        5: [207, 227],
                        6: [159, 19],
                        7: [110, 130],
                        8: [15, 35],
                        9: [327, 347],
                        10: [-81, -60],
                        11: [231, 251],
                        12: [183, 203],
                        13: [135, 156],
                        14: [87, 107]
                    };
                    //if (lastnumberdub > 0) {
                        $('.game-roulette-numbers').attr('style', 'display: block; transform: rotate3d(0, 0, 1, ' + parseFloat(lastnumberdub) + 'deg);');
                    //} else {

                        //$('.game-roulette-numbers').attr('style', 'display: block; transform: rotate3d(0, 0, 1, ' + parseFloat(doubleGameRoulettenumber[data.number][0]) + parseFloat(getRandomArbitary(1, 20)) + 'deg);');

                    //}
                    var token = $('meta[name="csrf_token"]').attr('content');

                    $.post('/getBalance',{_token: token}, function (data) {
                        var win = parseFloat(data) - parseFloat($('.update_balance').attr("data-balance"));
                        if (data > $('.update_balance').attr("data-balance") && data != 0) {
                            noty({
                                text: '<strong>Congratulate</strong><br>You won ' + win.toFixed(2) + '',
                                layout: 'topRight',
                                type: 'success',
                                timeout: 4000,
                                closeWith: ['click'],
                            });
                        }
                        $('.update_balance').attr("data-balance", data);
                        var balanceNow = $('.update_balance').text();
                        /*
                         * decimal_factor,
                         *
                         numberStep: function(now, tween) {
                         var floored_number = Math.floor(now) / decimal_factor,
                         target = $(tween.elem);

                         if (decimal_places > 0) {
                         // force decimal places even if they are 0
                         floored_number = floored_number.toFixed(decimal_places);

                         // replace '.' separator with ','
                         floored_number = floored_number.toString().replace('.', ',');
                         }
                         }
                         */
                        $('.update_balance').prop('number', balanceNow).animateNumbers(data);
                        $('#balance').prop('number', balanceNow).animateNumbers(data);
                    });

                }, 1000 * timeout);

            }
        })

        .on('newGame', function (data) {
            var token = $('meta[name="csrf_token"]').attr('content');

            $.post('/getBalance', {_token: token}, function (data) {
                $('.update_balance').attr("data-balance", data);
                var balanceNow = $('.update_balance').text();
                $('.update_balance').prop('number', balanceNow).animateNumbers(data);
                $('#balance').prop('number', balanceNow).animateNumbers(data);
            });
            var element = $('.bonus-game-end').first();
            element.text(0);
            element.attr('style', 'transition: transform 2s;transform: rotateY(180deg);');
            element.removeClass('black');
            element.removeClass('red');
            element.removeClass('zero');
            $('.bonus-game-timer.front').attr('data-left-seconds', '40');
            $('.bonus-game-timer.front circle').attr('style', 'stroke-dashoffset:0;transition: stroke-dashoffset 1s linear');
            $('.bonus-game-pre-end').css({transition: "600ms ease", transform: "rotateY(180deg)"});
            $('.bonus-game-timer').css({transition: "600ms ease", transform: "rotateY(360deg)"});
            $('.curr-game .parts-g .scroll').html('');
            $(".red-ch").html('');
            $(".zero-ch").html('');
            $(".black-ch").html('');
            $('.red-all-bet').animateNumbers(0);
            $('.zero-all-bet').animateNumbers(0);
            $('.black-all-bet').animateNumbers(0);
            $(".past-wins").removeClass("faded");
            timerStatus = true;
            ngtimerStatus = true;
        })

        .on('timer', function (time) {
            if (timerStatus) {
                $('.bonus-game-end, .bonus-game-pre-end').css({transition: "600ms ease", transform: "rotateY(180deg)"});
                timerStatus = false;


                var counter = time;
                var id;

                id = setInterval(function () {
                    counter--;
                    if (counter < 0) {
                        clearInterval(id);
                    } else {
                        var tmlf = counter.toString();

                        if (tmlf < 10) {
                            var tmlf = 0 + tmlf;
                        }
                        $('.bonus-game-timer.front').first().attr('data-left-seconds', tmlf);
                        $('.bonus-game-timer-svg circle').attr('style', 'stroke-dashoffset:' + (-1) * (40 - counter.toString()) * (410 / 39) + ';transition: stroke-dashoffset 1s linear')
                    }
                }, 1000);


            }
        })

    var declineTimeout,
        timerStatus = true,
        ngtimerStatus = true;
}


$(document).ready(function () {

    $('.game-roulette-select-item').click(function () {
        var bet = $(this).attr('data-bet');

        $(".game-roulette-select-item").removeClass('selected');
        $(this).addClass('selected');

        $("#roulette-make-bet").attr('data-bet-type', bet);
    });

    $('#roulette-make-bet').click(function () {
        var operation = $(this).attr('data-bet-type');
        var sum = $('#dub-input').val();
        var token = $('meta[name="csrf_token"]').attr('content');
        $.post('/newbet', {operation: operation, sum: sum, _token: token}, function (data) {

            if (data.status == 'error_game') {
                noty({
                    text: '<strong>Error</strong><br>' + data.msg ,
                    layout: 'topRight',
                    type: 'error',
                    timeout: 4000,
                    closeWith: ['click'],
                });


            }
            if (data.status == 'error_steam') {
                noty({
                    text: '<strong>Error</strong><br>' + data.msg,
                    layout: 'topRight',
                    type: 'error',
                    timeout: 4000,
                    closeWith: ['click'],
                });

            }

            $.post('/getBalance', {_token: token}, function (data) {
                $('.update_balance').attr("data-balance", data);
                var balanceNow = $('.update_balance').text();
                $('.update_balance').prop('number', balanceNow).animateNumbers(data);
                $('#balance').prop('number', balanceNow).animateNumbers(data);
            });
        });
    });
    $('.operation').click(function () {
        var operation = $(this).attr('data-method');
        var betField = $('#dub-input');
        var repeat = $(this).attr('data-value');
        var sum = $(this).attr('data-value');
        if (betField.val() == '') {
            betField.val(0);
        }

        switch (operation) {
            case "clear":
                betField.val(0);
                break;
            case "plus":
                betField.val(parseFloat(betField.val()) + parseFloat(sum));
                break;
            case "multiply":
                betField.val(parseFloat(betField.val()) * 2);
                break;
            case "divide":
                betField.val(parseFloat(betField.val()) / 2);
                break;
            case "max":
                betField.val(parseFloat($(".update_balance").html()));
                break;
        }
    });
});


var color = [
    [1,'red'],
    [14,'black'],
    [2,'red'],
    [13,'black'],
    [3,'red'],
    [12,'black'],
    [4,'red'],
    [0,'green'],
    [11,'black'],
    [5,'red'],
    [10,'black'],
    [6,'red'],
    [9,'black'],
    [7,'red'],
    [8,'black']
];

function WIN_MASS(number){
    switch(number){
        case 0: return 7; break;
        case 1: return 0; break;
        case 2: return 2; break;
        case 3: return 4; break;
        case 4: return 6; break;
        case 5: return 9; break;
        case 6: return 11; break;
        case 7: return 13; break;
        case 8: return 14; break;
        case 9: return 12; break;
        case 10: return 10; break;
        case 11: return 8; break;
        case 12: return 5; break;
        case 13: return 3; break;
        case 14: return 1; break;
    }
}

Array.prototype.mul = function(k) {
    var res = [];
    for (var i = 0; i < k; i++) res = res.concat(this.slice(0));
    return res;
}

var carousel = color.mul(20);
var elem = '';

for(var yi = 1; yi < carousel.length; yi++) {
    elem += '<span class="item item-'+carousel[yi][1]+'">';
    elem += '<span class="rollitem">';
    elem += carousel[yi][0];
    elem += '</span>';
    elem += '</span>';
}
$(document).ready(function(){
    $('#roulette .carusel').html(elem);
});

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function WIN(number){
    var _width = $('#roulette').css('width').split("px");
    var num_elem_center = Math.ceil((_width[0] / 75) / 2);
    var bar = ((_width[0] / 2) - (num_elem_center * 75)) / 2;
    var _default = 8970;
    var win = _default - bar + (75 * (number - num_elem_center));
    return win;
}

function RouletteStart(win){
    var rand = WIN(WIN_MASS(win));
    $('.carusel').css({'transform': 'none','transition': 'none'});
    setTimeout(function(){$('.carusel').css({'transform': 'translate3d(-'+getRandomInt(rand, rand)+'px, 0px, 0px)', 'transition':'6s ease'})}, 30);
    $('#roulette-start').trigger("play");
    RouletteFinish(win);
}

function RouletteFinish(win){
    $('.carusel').one('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function(e) {
        $('#roulette-finish').trigger("play");
        $('#past div:first').remove();
        $('#past').append('<div class="ball ball-'+color[WIN_MASS(win)][1]+'">'+color[WIN_MASS(win)][0]+'</div>');
    });
}



(function($) {
    $.fn.countdown = function(prop) {
        var options = $.extend({
            seconds: 0,
            freeze: false
        }, prop);
        var left, m, s, positions;
        init(this, options);
        positions = this.find(".position");
        var start = Math.floor(new Date / 1e3);
        (function tick() {
            left = start - Math.floor(new Date / 1e3) + options.seconds;
            if (left < 0) {
                left = 0
            }
            m = Math.floor(left / 60);
            updateDuo(0, 1, m);
            s = left - m * 60;
            updateDuo(2, 3, s);
            if (!options.freeze) setTimeout(tick, 1e3)
        })();

        function updateDuo(minor, major, value) {
            switchDigit(positions.eq(minor), Math.floor(value / 10) % 10);
            switchDigit(positions.eq(major), value % 10)
        }
        return this
    };

    function init(elem, options) {
        elem.addClass("countdownHolder");
        $.each(["Minutes", "Seconds"],
            function(i) {
                $('<span class="count' + this + '"><span class="position"><span class="digit static">0</span></span><span class="position"><span class="digit static">0</span></span></span>').appendTo(elem);
                if (this != "Seconds") {
                    elem.append('<span class="countDiv countDiv' + i + '">:</span>')
                }
            })
    }

    function switchDigit(position, number) {
        var digit = position.find(".digit");
        if (digit.is(":animated")) {
            return false
        }
        if (position.data("digit") == number) {
            return false
        }
        position.data("digit", number);
        var replacement = $("<span>", {
            "class": "digit",
            css: {
                //  top: "-2.1em",
                //   opacity: 0
            },
            html: number
        });
        digit.before(replacement).removeClass("static").animate({
            //    top: "2.5em",
            // opacity: 0
        }, "fast", function() {
            digit.remove()
        });
        replacement.delay(100).animate({
            //  top: 0,
            // opacity: 1
        }, "fast", function() {
            //  replacement.addClass("static")
        })
    }
})(jQuery);