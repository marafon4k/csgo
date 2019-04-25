var systemObj = {
    init: loadSystem,
    info: {},
    setLoading: setLoading
};

systemObj.init();

function loadSystem() {
    $.ajax({
        url: '/ajax/system-info',
        type: "GET",
        cache: false,
        success: function (data) {
            systemObj.info = data;
            $(document).trigger("systemLoad");
        },
        error: function (data) {
            console.log(data)
        }
    });
}

$(document).on("systemLoad", function() {
    socket.emit('join', {id: id, name: nickName, session: session});
    userObj.init();
    linksObj.init();
    chatObj.init();
    notifyObj.init();
    if(typeof rouletteObj != 'undefined' && linksObj.page == 'index') rouletteObj.init();
    if(typeof rouletteObj != 'undefined' && linksObj.page == 'user/deposit') userObj.initInventory();
    if(typeof rouletteObj != 'undefined' && linksObj.page == 'shop') shopObj.init();
});

function setLoading(parent) {
    var classList = String(parent.classList);
    if(classList.indexOf('dimmer-load') >= 0) {
        $(parent).find('.loader-indicator').remove();
        $(parent).removeClass('dimmer-load');
    } else {
        $(parent).addClass('dimmer-load');
        var loader = document.createElement('div');
        loader.className = 'loader-indicator';
        $(parent).prepend(loader);
    }
}