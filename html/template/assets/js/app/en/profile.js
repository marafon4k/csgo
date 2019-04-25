$(function() {
  var app = new App();

  $("#tradeUrlBtnSave").click(function(e) {
    var btn = $(this);
    var errors = $('.error-message');
    var link = $("#tradeUrl").val();

    btn.text('Saving..');

    errors.text("");

    app.post("/ajax/tradeUrlSave", {tradeUrl : link}, function(success, error) {
        if(error != undefined) {
          errors.text(error);
        } else if(success != undefined) {
          btn.html('<i class="fa fa-check"></i> Saved');
        }
      });
  });
});