//GLOBALE
CSND = {

    debug: true,

    user: {
        //
        status: {
            online: false,
            toggle: function () {
                $.post('/rest/user/status/toggle', function (response) {
                    if (response.status == "ok") {
                        this.online = response.online;
                        CSND.contentElement.userStatus.setOnline();
                    } else {
                        CSND.contentElement.userStatus.setOffline();
                    }
                });
            }
        }
    },
    //??
    contentElement: {

        userStatus: {

            tsb: $("#toggle-status-button"), //non è creato al docready

            initEvent: function () {

                this.tsb = $("#toggle-status-button");

                $(".status-info #toggle-status-button").click(() => {
                    CSND.user.status.toggle();
                });
            },

            setOnline: function () {

                var st = this.tsb.find("#status-text");
                var sl = this.tsb.find("#status-label");
                var si = this.tsb.find("#status-icon");
                var sbi = this.tsb.find("#status-button-icon");
                var sbl = this.tsb.find("#status-button-label");

                st.text("online");
                this.tsb.removeClass("btn-success").addClass("btn-default");
                sl.removeClass("label-default").addClass("label-success");
                si.removeClass("glyphicon-eye-close").addClass("glyphicon-eye-open");
                sbi.removeClass("glyphicon-eye-open").addClass("glyphicon-eye-close");
                sbl.text("Passa offline");
            },

            setOffline: function () {

                var st = this.tsb.find("#status-text");
                var sl = this.tsb.find("#status-label");
                var si = this.tsb.find("#status-icon");
                var sbi = this.tsb.find("#status-button-icon");
                var sbl = this.tsb.find("#status-button-label");

                st.text("offline");
                this.tsb.removeClass("btn-default").addClass("btn-success");
                sl.removeClass("label-success").addClass("label-default");
                si.removeClass("glyphicon-eye-open").addClass("glyphicon-eye-close");
                sbi.removeClass("glyphicon-eye-close").addClass("glyphicon-eye-open");
                sbl.text("Passa online");
            }
        },

        userStatusView: {
            init: function () {

                $("#toggle-status-button").click(function () {

                    $("#toggle-status-button").button('loading');

                    $.post('/rest/user/status/toggle', function (response) {

                        if (response.status = "ok") {

                            $.get('/rest/content/user/status', function (response) {

                                $("#user-status-view").html(response.message);
                            });
                        }
                    });
                });
            }
        },

        postList: {

            init: function () {
                $(".comment-form").submit(function (event) {

                    event.preventDefault();

                    let commentForm = $(this);
                    let postText = commentForm.find('.post-text').val();
                    let postUid = commentForm.data('postuid');

                    //todo: aggiungere controlli di validazione

                    let data = {
                        postUid: postUid,
                        postText: postText
                    }

                    $.post('/rest/content/post/add', data, function (response) {
                        $(".comments-list").append(response.message);
                    });
                });
            },

           deleteComment: function (uid) {

            $(".deleteComment-"+uid).click(function () {

                
                let buttonDelete = $(this);
                let commentUid = buttonDelete.val();                
                alert(commentUid);
                //todo: aggiungere controlli di validazione

                let data = {
                    commentUid: commentUid                   
                }

                $.post('/rest/content/comment/delete', data, function (response) {
                    if(response.esito == 'ok'){
                        $(".commento-utente-"+response.idCommento).remove().fadeOut('slow');
                    }
                    
                });
            });


           }



        }
    },

    log: function (message) {

        if (this.debug) {
            console.log(message);
        }
    }

}

//document ready globale
$(document).ready(function () {

    CSND.contentElement.userStatus.initEvent();

    CSND.log("init event js");
});


