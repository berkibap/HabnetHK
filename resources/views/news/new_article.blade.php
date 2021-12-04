<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="icon" type="image/gif" sizes="18x17" href="assets/img/home_icon.gif">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="/assets/css/tinymce.css">
    <link rel="stylesheet" href="/assets/css/untitled.css">
    <script src="https://cdn.tiny.cloud/1/to3tbscnpe7aalph1kekfwfuwe8lsn1i8gc7ebox4r2we94f/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        @include("partials.sidebar")
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">@include("partials.navbar")
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Yeni Haber Yaz</h3>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12">
                      <div class="card">
                            <div class="card-body">
                               <form id="news-form">
                                   <div class="mb-3" style="width:40rem;">
                                       <label>Haber Başlığı</label>
                                       <input type="text" class="form-control" id="title" placeholder="Haberinin başlığı ne?">
                                   </div>
                                   <div class="mb-3" style="width:40rem;">
                                       <label>Kısa Açıklama</label>
                                       <input type="text" class="form-control" id="shortstory" placeholder="Haberin kısaca neyden bahsediyor?">
                                   </div>
                                   <div class="mb-3"  style="width:40rem;">
                                       <label>Haber Resmi Bağlantısı</label>
                                       <input type="text" class="form-control" placeholder="http://admin.habnet.st/...">
                                       <small>Resim yüklemek için <a href="/news/upload-image" target="_blank">tıkla</a></small>
                                   </div>
                                   <div class="mb-3">
                                       <label>Haber Metni</label>
                                       <div id="editor"></div>

                                   </div>

                                   <div class="mb-3">
                                       <button class="btn btn-primary"><i class="fas fa-retweet"></i >Paylaş</button>
                                   </div>
                               </form>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-white sticky-footer">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Icon Panel 2021 - Designed by Bop</span>
            </div>
        </div>
    </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <!-- Modal -->
    <div class="modal fade" id="user-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="user-modal-title"></h5>
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">

                </div>

            </div>
        </div>
    </div>

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="/assets/js/theme.js"></script>
    <script src="/assets/js/tinymce.js"></script>
    <script src="/assets/js/chart.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /><script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>

    <script>
        let editor;
    ClassicEditor
        .create( document.querySelector( '#editor' )).then(newEditor => {
            editor = newEditor;
        })
        .catch( error => {
            console.error( error );
        } );
        $('#news-form').submit(e => {
            e.preventDefault();
            let title = $('input#title').val()
            let shortstory = $('input#shortstory').val()
            let image = $('input#image').val()
            let longstory = editor.getData();
            $.ajax({
                url: "/api/news/new-article",
                method:"POST",
                data: {
                    _token: "{{csrf_token()}}",
                    title: title,
                    shortstory: shortstory,
                    image:image,
                    longstory:longstory,
                    user_id: "{{$currentUser->id}}"
                }
            }).done(data => {
                if(data.msg == "ok") {
                    toastr["success"]("Haber başarıyla paylaşıldı...", "Tamamlandı");
                    $('#news-form')[0].reset();
                    editor.setData(" ");
                }
            })
        })
        let saveUser = id => {
            let email = $('#user-form input#email').val();
            let motto = $('#user-form input#motto').val();

            $.ajax({
                url: "/api/user/" + id,
                method: 'POST',
                data: {
                    _token: "{{csrf_token()}}",
                    id: id,
                    staffId: "{{$currentUser->id}}",
                    email: email,
                    motto: motto,
                    ip: "{{request()->ip()}}"
                }
            }).done(data => {
                if (data.msg == "ok") {
                    toastr["success"]("Kullanıcı bilgileri başarıyla kaydedildi.", "İşlem tamamlandı")
                }
            })
        }
        $('[data-toggle="tooltip"]').tooltip();
        //setup before functions
        var typingTimer; //timer identifier
        var doneTypingInterval = 3 * 1000; //time in ms, 5 second for example
        var $input = $('#search-user-input');

        //on keyup, start the countdown
        $input.on('keyup', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });

        //on keydown, clear the countdown 
        $input.on('keydown', function () {
            clearTimeout(typingTimer);
        });
        let dismissModal = id => {
            $(id).modal('hide');
        }
        $('#search-user-form').submit(e => {
            e.preventDefault();
            searchUser($('#search-user-input').val())
            clearTimeout(typingTimer)
        })
        //user is "finished typing," do something
        function doneTyping() {
            searchUser($input.val());
        }
        let searchUser = username => {
            $.ajax({
                url: "/api/user/search/" + username,
            }).done(data => {
                $('#search-user-results').empty();

                if (data.count == 0) {
                    $('#search-user-results').html("<b>Hiçbir kullanıcı bulunamadı.</b>")
                } else {
                    data.users.forEach(user => {
                        $('#search-user-results').append(`
                            <tr>
                                <td><img src="https://habnet.st/habbo-imaging/avatarimage.php?figure=${user.look}&head_direction=2&direction=2&action=wav"></td>
                                <td>${user.username}</td>
                                <td><a href="#" class="btn btn-primary" onclick="dismissModal('#search-user-modal');setTimeout(() => {$('#user-modal').modal('show');  userModal(${user.id}); },500);">Yönet</a></td>
                            </tr>
                        `)
                    })
                }
            })
        }
        let resetPass = id => {
            $.ajax({
                url: "/api/user/reset-pass/" + id,
                data: {
                    "_token": "{{csrf_token()}}"
                }
            }).done(data => {
                if (data.msg == "ok") {
                    toastr["success"](
                        "Kullanıcının e-posta adresine şifre sıfırlama bağlantısı gönderildi.",
                        "Tamamlandı")
                } else {
                    toatr["error"]("Bir hata oluştu, lütfen tekrar deneyin.", "Hata")
                }
            })
        }
        let userModal = id => {
            $('#user-modal .modal-body').empty();
            $('#user-modal .modal-body').html(`<i style="fas fa-reload"></i>`);
            $.ajax({
                url: "/api/user/modal/" + id
            }).done(data => {
                $("#user-modal .modal-body").html(data);
            });
        }
        let banModal = id => {
            $.ajax({
                url: "/api/user/ban-modal/" + id
            }).done(data => {
                $("body").prepend(data);
            });
        }
    </script>
</body>

</html>

</html>