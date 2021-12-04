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
                        <h3 class="text-dark mb-0">Haber Listesi</h3>
                        <a class="btn btn-primary text-white" href="/news/new-article">Yeni Haber Oluştur</a>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <p class="text-primary m-0 font-weight-bold"></p>
                                    <div class="btn btn-transparent" onclick="refreshList();"><i class="fa fa-sync"
                                            id="reload-news-icon"></i></div>
                                </div>
                                <div class="card-body">

                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Başlık</th>
                                                <th>Özet</th>
                                                <th>Paylaşan</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody id="news-list-body"></tbody>
                                    </table>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script>
        $(() => {
            refreshList()
        })
        let deleteNews = id => {
            $.ajax({
                url: "/api/news/delete/" + id,
                data: {
                    id: id,
                    _token: "{{csrf_token()}}"
                },
                method: "DELETE"
            }).done(data => {
                if (data.msg == "ok") {
                    toastr["success"]("Haber başarıyla silindi.", "Başarılı");
                    $(`tr[data-id=${id}]`).remove();
                    refreshList();
                }
            })
        }
        let refreshList = () => {
            $('#reload-news-icon').addClass("fa-spin")
            $.ajax({
                url: "/api/news/list",
                data: {
                    id: "{{$currentUser->id}}",
                    "_token": "{{csrf_token()}}"
                }
            }).done(data => {
                $('#reload-news-icon').removeClass("fa-spin")
                $('#news-list-body').empty();
                if (data.count > 0) {
                    data.list.forEach(item => {
                        $('#news-list-body').append(`
                            <tr data-id="${item.id}">
                                <td>${item.id}</td>
                                <td>${item.title}</td>
                                <td>${item.shortstory}</td>
                                <td>${item.staff_username}</td>
                                <td>
                                <div class="dropdown">
  <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-angle-down"></i>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="/news/item/${item.id}"><i class="fas fa-newspaper-o"></i> Detaya Git</a>
    <a class="dropdown-item" href="javascript:deleteNews(${item.id})"><i class="fas fa-times"></i> Sil</a>
  </div>
</div>
                                </td>
                            </tr>
                        `)
                    })
                }
            }).fail(data => {
                alert("An error occured")
            })
        }
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