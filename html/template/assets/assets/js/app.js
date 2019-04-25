$(function() {
  var isClosed = false;
  var trigger = $('#menu-openclose-glyph');
  var chat = $('#messages');
  var csrf_token = $('meta[name="csrf_token"]').attr('content');
  var username = $('meta[name="username"]').attr('content');
  var money = $('meta[name="money"]').attr('content');

  var pgurl = 'http://csgorebel.com/' + location.pathname.split('/')[1];

  var window_size = $(window).width() - 300;
  var menu_size = $(window).height() - 200;

  if ($(window).width() > 480){
    $('.content').animate({
      'width': window_size 
    }, 500);
  }
  
  $('.sidebar-nav').css('height', menu_size);

  $('.submit_withdraw').on('click', function () {

    var id_withdraw = $(this).attr('with-id');

    $.post("/ajax/SubmitWithdraw", {id: id_withdraw}, function(data) {
      alert("Succes");
    });
    
  });
  
  $(".spincrement").spincrement();

  checkStatus();
  setInterval(function () {
    checkStatus();
  }, 400000)

 /* setInterval(function () {
    checkBets();
  }, 5000) */
  
  
  function checkStatus() {
    $.post("/ajax/SteamStatus", function(data) {
      $("#steamcom").css('color', data.steamColor);
      var str5 = data.steam;
      var str6 = 'Steam: '+data.steam;
      var tooltipcom = document.getElementById('steamcom');
      tooltipcom.setAttribute('data-tooltip', str6 );
      $("#steamcom").css('color', data.steamColor);
     


      var str1 = data.api;
      var str2 = 'API: '+data.api;
      var tooltipapi = document.getElementById('steamapi');
      tooltipapi.setAttribute('data-tooltip', str2 );
      $("#steamapi").css('color', data.apiColor);
      


      var str3 = data.log;
      var str4 = 'Login: '+data.log;
      var tooltiplog = document.getElementById('steamlog');
      tooltiplog.setAttribute('data-tooltip', str4 );
      $("#steamlog").css('color', data.logColor);
    
    });
  }
/*  function checkBets() {
    $.post("/ajax/checkBets", {_token:csrf_token}, function(data) {
    	var betr = data.betr;
    	var betj = data.betj;
     
      if (betr == 0) {
        document.getElementById('betR').style.display = 'none';
      } else {
        var betRfix = betr.toFixed(2);
        document.getElementById('betR').style.display = 'inline';
        $("#betR").html(betRfix);

     } 
      if (betj == 0) {
        document.getElementById('betJ').style.display = 'none';
      } else {
        var betJfix = betj.toFixed(2);
        document.getElementById('betJ').style.display = 'inline';
        $("#betJ").html(betJfix);
      }
    });
  } */
		 
     $("#sidebar-wrapper ul li").each(function(){
       var self = this;
       if(window.location.pathname == '/' && $(self).find('a').attr("href") == 'http://csgorebel.com'){
         var name = $(self).find('img').attr('src');
         name = name.slice(0, -4);
         $(self).find('img').attr('src', name+'-selected.png');
       }else {

         if ($(self).find('a').attr("href") == pgurl || $(self).find('a').attr("href") == '') {
           if ($(self).find('a').attr('id') == 'steamkeys' || $(self).find('a').attr('id') == 'promo') {
             $(self).find('i').css('color', '#3EEA6F');
           } else {
             var name = $(self).find('img').attr('src');
             name = name.slice(0, -4);
             $(self).find('img').attr('src', name + '-selected.png');
           }
         }
       }
     })

  
  /*if(document.location == 'http://csgorebel.com/'){
    $('#sidebar-wrapper .sidebar-nav li:first').addClass('active');
    var attr =$('#sidebar-wrapper .sidebar-nav li:first .sidebar-icon').attr('src').replace('.png','-selected.png');
    $('#sidebar-wrapper .sidebar-nav li:first .sidebar-icon').attr('src', attr);
  }else{
    $('#sidebar-wrapper .sidebar-nav li:has(a[href="'+ document.location + '"])').addClass('active');
    var attr =$('#sidebar-wrapper .sidebar-nav li:has(a[href="'+ document.location + '"]) .sidebar-icon').attr('src').replace('.png','-selected.png');
    $('#sidebar-wrapper .sidebar-nav li:has(a[href="'+ document.location + '"]) .sidebar-icon').attr('src', attr);
  }*/

  if($.cookie('menu') == 'open' || $.cookie('menu') == undefined){
    $("#login").css('display', 'none');
    $(".menu-name").css('display', 'block');
    $("#footer").css('display', 'block');
    $(".wrapper").removeClass("toggled");
    $("#menu-openclose-glyph").css('margin-left', '20px');
    trigger.removeClass('glyphicon-chevron-right');
    trigger.addClass('glyphicon-chevron-left');
    isClosed = true;
  }

  var mute = $('meta[name="muted"]');

  if($.cookie('mute') == 0 || $.cookie('mute') == undefined){
    $(".menu-name .fa").addClass("fa-volume-up");
    mute.attr('content', 'false');
    $('#mute').attr('muted', '0');

  }else{
    $(".menu-name .fa").addClass("fa-volume-off");
    mute.attr('content', 'true');
    $('#mute').attr('muted', '1');

  }

  var app = new App();


  $(".menu-name .fa").click(function () {
    var self = this;
    if($(self).hasClass('fa-volume-up')){
      $(self).removeClass("fa-volume-up");
      $(self).addClass("fa-volume-off");
      $.cookie('mute', '1');
      mute.attr('content', 'true');
      if(lang == 'ru') var mutedLabel = 'Sound muted'
      else var mutedLabel = 'Sound Muted'
      noty({
        text: mutedLabel,
        layout: 'topRight',
        type: 'success',
        timeout: 2000,
        closeWith: ['click'],
      });
    }else{
      $(self).addClass("fa-volume-up");
      $(self).removeClass("fa-volume-off");
      $.cookie('mute', '0');
      mute.attr('content', 'false');
      if(lang == 'ru') var unmutedLabel = 'Sound unmuted'
      else var unmutedLabel = 'Sound Unmuted'
      noty({
        text: unmutedLabel,
        layout: 'topRight',
        type: 'success',
        timeout: 2000,
        closeWith: ['click'],
      });
    }
  })

  $(".mfp-close").click(function(e) {
    $('.modal').hide('slow');
  });

  $("#close-shop").click(function(e) {
    $('#buyModal').hide('slow');
  });

  $("#menu-toggle").click(function(e) {
    e.preventDefault();

    if(isClosed) {
      $(".menu-name").css('display', 'none');
      $("#login").css('display', 'block');
      $("#footer").css('display', 'none');
      $(".wrapper").addClass("toggled");
      $("#menu-openclose-glyph").css('margin-left', '80px');
      trigger.removeClass('glyphicon-chevron-left');
      trigger.addClass('glyphicon-chevron-right');
      isClosed = false;
      $.cookie('menu', 'closed');
    } else {
      $(".menu-name").css('display', 'block');
      $("#footer").css('display', 'block');
      $(".wrapper").removeClass("toggled");
      $("#login").css('display', 'none');
      $("#menu-openclose-glyph").css('margin-left', '20px');
      trigger.removeClass('glyphicon-chevron-right');
      trigger.addClass('glyphicon-chevron-left');
      isClosed = true;
      $.cookie('menu', 'open');
    }


  });
});



var App = function() {
  return App.fn.init();
};

App.prototype = App.fn = {
  init : function() {
    this.csrf_token = $('meta[name="csrf_token"]').attr('content');
    this.money = $('meta[name="money"]').attr('content');
    this.steam_id = $('meta[name="steam_id"]').attr('content');

    App.fn.socket.connect();

    return this;
  }, getMoney : function() {
    return this.money;
  }, getSteamId : function() {
    return this.steam_id;
  }, swal : function(params, callback) {
    swal(params, callback);

    return this;
  }, confirm : function(params, callback) {
    if(params.showCancelButton == undefined)
      params.showCancelButton = true;

    swal(params, callback);

    return this;
  }, prompt : function(params, callback) {
    swal(params, callback);

    return this;
  }, post : function(url, data, callback) {
    data._token = this.csrf_token;
	$.ajax({
                url: url,
                method: 'POST',
                data: data,
                async: false,
                beforeSend: function() {
                    inProgress = true;}
            }).done(function(data){
    //$.post(url, data, 'json').done(function(json) {
      if(data.err) {
        callback(null, data.error);
      } else if(data.redirect != undefined) {
        window.location.href = data.redirect;
      }

      if(data.swal != undefined) {
        App.fn.swal(data.swal);
      }

      if(data.success != undefined) {
        callback(data.success, null);
      } else {
        callback(data, null);
      }
    });
  }, socket : {
    connect : function() {
      this.api_url = $('meta[name="api:url"]').attr('content');

      this.socket = io.connect('http://csgorebel.com:3775', {secure: false});
      App.fn.socket.subscription();
    }, emit : function(event, data) {
      this.socket.emit(event, data);
    }, on : function(event, callback) {
      this.socket.on(event, callback);
    }, subscription : function() {
      var self = this;
    }
  }
};
