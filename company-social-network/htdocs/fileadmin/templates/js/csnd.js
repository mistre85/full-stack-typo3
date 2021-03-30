var CSND = {


    contentElement:{
        post:{
            comment:{
                init: function () {
                    this.initSubmit();
                    this.initDeleteComment();
                },

                initSubmit: function(){
                    /* Intercetto la submit del bottone nell' HTML "PostCard" */
                    $(".comment-form").submit(function (event) {
                        /* Con il prevent mi assicuro che una volta intercettata la summit blocco la possibile intercettazione di ulteriori submit */
                        event.preventDefault();
                        /* Metto nella variabile "commentForm" tutto l'oggetto del Form */
                        let commentForm = $(this);
                        /* Da questo oggetto recupero il testo della Textarea sfruttando la classe che ho aggiunto in "PostCard.html" */
                        let postText = commentForm.find(".post-text").val();
                        /*
                            Sfruttanto l'additionalAttributes="{data-postuid: post.uid}" messo nel form, recuper dal suffisso data il valore del parametro postuid
                            (Sfruttando una funzionalita di Jquery che splitta il parametro data-postuid )
                        */
                        let postUid = commentForm.data('postuid');
                        /* metto nell'oggetto data i valori che mi serviranno nella chiamata Ajax ovvero il postUid ed il testo della textarea */
                        let data = {
                            postUid: postUid,
                            postText: postText
                        }
                        /* effettuo la chiamata Ajax che devo andare a costruire in quanto la funzionalità non era presente */
                        $.post('/rest/content/post/add', data, function (response) {
                            /* Invece di ricaricare tutta la lista dei Commenti, dato che sono in un for, faccio l'append del singolo commento */
                            console.log('passo da ajax');
                            $(".comment-list").append(response.message);
                        });
                    })
                },

                initDeleteComment: function(commentUid) {

                    $('.delete-comment-button-' + commentUid).click(function (event) {
                        let data = {
                            commentUid: $(this).data('comment-uid'),
                            userUid: $(this).data('user-uid')
                        }

                        $(this).button('loading');
                        $.post('/rest/content/comment/remove', data, function(response){
                            if(response.status == 'ok'){
                                $("comment-delete-" + data.commentUid).fadeOut('slow');
                            }else{
                                //errore
                            }
                        });
                    })
                }
            }

        },
        user: {
            loadUserStatusView: {
                init: function () {
                    $.get('/rest/content/status', function (response) {
                        //return response.message;
                        $("#toggle-user-status-view").html(response.message);
                    })
                }
            },
            toggleUserStatusView: {
                init: function () {
                    var buttonToggleUserStatus = $("#button-toggle-User-Status");
                    var data = {}
                    buttonToggleUserStatus.click(function () {
                        $.post('/rest/user/dashboard', data, (response) => {
                            CSND.contentElement.user.loadUserStatusView.init();
                        })
                    });
                }

            },
            toggleUserStatus: {
                init: function () {
                    var buttonToggleUserStatus = $("#button-toggle-User-Status");
                    var data = {}
                    buttonToggleUserStatus.click(function () {
                        console.log('pppp');
                        $.post('/rest/user/dashboard', data, (response) => {
                            if (response) {
                                buttonToggleUserStatus.removeClass("btn-default glyphicon glyphicon-eye-close").addClass("btn-success glyphicon glyphicon-eye-open");
                                buttonToggleUserStatus.html(" OnLine");
                            } else {
                                buttonToggleUserStatus.removeClass("btn-success glyphicon glyphicon-eye-open").addClass("btn-default glyphicon glyphicon-eye-close");
                                buttonToggleUserStatus.html(" OffLine");
                            }
                        })
                    });
                }

            },
            getUserId:{
                init: function () {
                    $.get('/rest/user/getUid', function (response) {
                        console.log(response.message);
                    })
                }
            }

        }

    }
}