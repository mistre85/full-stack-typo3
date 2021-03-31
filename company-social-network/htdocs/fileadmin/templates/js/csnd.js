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


            initSubmit: function () {

                $(".comment-form").submit(function (event) {

                    event.preventDefault();

                    let commentForm = $(this);
                    let postText = commentForm.find('.post-text').val();
                    let postUid = commentForm.data('postuid');
                    let commentButton = commentForm.find('.comment-button');

                    //todo: aggiungere controlli di validazione

                    let data = {
                        postUid: postUid,
                        postText: postText
                    }

                    commentButton.button('loading');

                    $.post('/rest/content/comment/add', data, function (response) {

                        //if (response.status == "ok") {
                        $(".comments-list").prepend(response.message);
                        //} else {

                        //}
                    }).fail(function () {

                    });
                })
            },

            initDeleteComment: function (commentUid) {

                $('.delete-comment-button-' + commentUid).click(function (event) {

                    let data = {
                        commentUid: $(this).data('comment-uid'),
                        userUid: $(this).data('user-uid')
                    }

                    $(this).button('loading');
                    $.post('/rest/content/comment/remove', data, function (response) {

                        if (response.status == "ok") {
                            $(".comment-delete-" + response.data.commentUid).fadeOut('slow');
                        } else {
                            //errore
                        }

                        $(this).button('reset');
                    });
                })

            },

            initLikeButton: function (postUid) {

                let data = {
                    postUid: postUid
                }

                $(".like-button-" + postUid).click(function () {

                    let button = $(this);
                    button.button('loading');

                    $.post('/rest/post/like', data, function (response) {

                        if (response.status = "ok") {

                            button.button('reset');

                            $(".like-result-" + response.data.postUid).html(response.data.html.likes);
                            $(".like-button-" + response.data.postUid).replaceWith(response.data.html.button);
                        }
                    })
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