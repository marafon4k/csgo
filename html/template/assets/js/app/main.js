$(function() {
  var app = new App();

  var steam_id = $('meta[name="steam_id"]').attr('content');

  var money = $('meta[name="money"]').attr('content');
  
  var game_area_table = $("#game-area-table");

  app.socket.on('create-game', function(game) {
    app.post('/ajax/getListGame', {game_id : game.id}, function(html, error) {
      if(error != undefined) {
        app.swal({
          title: "Error",
          text: error,
          type: "error"
        });
      } else if(html != undefined) {
        game_area_table.append(html);
        game_area_table.find('[data-game]').sortElements(function(a, b) {
          return parseInt($(a).attr("data-bet")) < parseInt($(b).attr("data-bet")) ? 1 : -1;
        });
      }
    });
  });

  app.socket.on('join-game', function(game) {
    var old_tr = $('[data-game="' + game.id + '"]');
    old_tr.find(".game-status").html('<a href="#" class="game-status-text grey-text">Game started</a>');
  });

  app.socket.on('end-game', function(game) {
    $('[data-game="' + game.id + '"]').empty();
  });

  var current_team = 't';

  gameList(app);

  $("#refresh-action").click(function(e) {
    gameList(app, true);
  });

  $("#create-game-action").click(function(e) {
    if(steam_id == 0){
      app.swal({
        title: "Errpr",
        text: "You are not logged in",
        type: "error"
      });
      return false;
    }
    app.post("/ajax/check/create-game", {}, function(success, error) {
      if(error != undefined) {
        app.swal({
          title: "Error",
          text: error,
          type: "error"
        });
      } else if(success != undefined) {
        $('#create-game').show('slow');
        current_team = 't';
      }
    });
  });

  $("#createGame").click(function() {
    var bet = $("#slider").slider("value");
    var self = this;
    if(steam_id == 0){
      app.swal({
        title: "Error",
        text: "You are not logged in",
        type: "error"
      });
      return false;
    }
    app.post('/ajax/createGame', {'bet' : bet, 'chose' : current_team} , function(success, error) {
      if(error != undefined) {
        app.swal({
          title: "Error",
          text: json.error,
          type: "error"
        });
        self.disabled = false;
      } else if(success != undefined) {
        window.location.href = success;
      }
    });
  });

  $("body").on('click', '.joinGame', function() {
    var game_id = $(this).data("game_id");
    var bet = $(this).data("bet");
    if(steam_id == 0){
      app.swal({
        title: "Error",
        text: "You are not logged in",
        type: "error"
      });
      return false;
    }

    app.confirm({
      title : "Are you sure you want to take part in the game?",
      text : "You will bet <i class=\"fa fa-diamond\"></i> " + bet,
      confirmButtonText : "Join the game",
      cancelButtonText : "Cancel",
      html : true,
      showLoaderOnConfirm: true
    }, function(isConfirm) {
      if(isConfirm) {
        app.post('/ajax/joinGame/' + game_id, {}, function(success) {
          if(success.error != undefined) {
            app.swal({
              title: "Error",
              text: success.error,
              type: "error"
            });
          } else if(success.success != undefined) {
            window.location.href = success.redirect;
          }
        });
      }
    });
    return false;
  });

  $("#ctchoosen").click(function() {
    $("#counterterrorist-shadow").css('display', 'block');
    $("#terrorist-shadow").css('display', 'none');
    current_team = 'ct';
  });

  $("#tchoosen").click(function() {
    $("#counterterrorist-shadow").css('display', 'none');
    $("#terrorist-shadow").css('display', 'block');
    current_team = 't';
  });

  $("#slider").slider({
    value : 0,
    min : 0.10,
    max : app.getMoney(),
    step : 0.01,
    create : function(event, ui) {
      var val = $("#slider").slider("value");
      $("#item-total-price-create").html('<i class="fa fa-diamond"></i>' + val);
    }, slide : function(event, ui) {
      $("#item-total-price-create").html('<i class="fa fa-diamond"></i>' + ui.value);
    }
  });
  

  function gameList(preloader) {
    if(preloader) {
      //<center><img class="preload-game-area" src="/assets/images/220.gif"></center>
      $('#game-area-table').html('<div id="loading" style="width: 100%; background: #141C20; height: 300px;text-align:center;"><img style="margin-top: 40px;" src="/assets/images/loading_2.gif"></div>');
    }
    app.post("/ajax/gameList", {}, function(success) {
      if(success != undefined) {
        $('#game-area-table').html(success);
      }
    });
  }
});

function docSize(){
  var window = document.body.clientWidth;
  var window_width = window/1.3;
  window = (window - 1000)/4;
  if (window < 0 ) window = 0;
  $('.content').css('margin-left', window+'px');
  $('.content').css('width', window_width+'px');
  //document.getElementById('fixed').style.right = window + 'px';
}
