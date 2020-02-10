var notificationService;
var notificationServiceInterval;
var startNew = 0;
var pontos = $("#malditosPontos").val();
// $("#testeDeNotifcacao").load(pontos+"Controle/notificacaoControle.php?function=getStorageNotifications" , function(){
//     notificationServiceInterval = setInterval(doNotificationListener, 1000);
// });

// setTimeout(function () {
//     clearInterval(notificationServiceInterval);
// }, 5000);
function doNotificationListener() {
    var lastNotification = $(".last_notification:first").val();
    if(lastNotification == 'undefined'){
        lastNotification = 0;
    }
    if(startNew == 0) {
        notificationService = $.ajax({
            url: pontos + "Controle/notificacaoControle.php?function=getNotification&lastNotification=" + lastNotification,
            success: function (data) {
                $("#testeDeNotifcacao").prepend(data);
                if(data!= '') {
                    $(".forToast").each(function(){
                        if($(this).attr("exibido")== 0){
                            var conteudo = $(this).html();
                            M.toast({html: conteudo, displayLength: 60000});
                            $(this).attr()
                        }
                    });
                }
                startNew=0;
            }
        });
        startNew=1;
    }
}

function stopNotificationService() {
    notificationService.abort();
    clearInterval(notificationServiceInterval);
    startNew=0;
}