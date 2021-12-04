<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="icon" type="image/gif" sizes="18x17" href="assets/img/home_icon.gif">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/tinymce.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
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
                    <h3 class="text-dark mb-0">Ana Sayfa</h3>
                </div>
                <div class="row">
                    <div class="col-md-2 col-xl-2 mb-4">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                            <span>kayıtlı kullanıcı</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0">
                                            <span>{{\App\Models\User::count()}}</span></div>
                                    </div>
                                    <div class="col-auto"><img src="assets/img/signup_icon.gif"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-xl-2 mb-4">
                        <div class="card shadow border-left-success py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1">
                                            <span>toplam kredi</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0">
                                            <span>{{number_format(\App\Models\User::sum("credits"),0, ".", ".")}}</span>
                                        </div>
                                    </div>
                                    <div class="col-auto"><img src="assets/img/purse_icon.gif"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-xl-2 mb-4">
                        <div class="card shadow border-left-duckets py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-duckets font-weight-bold text-xs mb-1">
                                            <span>Toplam Elmas</span></div>
                                        <?php
                                                    $diamonds = DB::table("users_currency")->where("type", "5")->sum("amount");
                                                ?>
                                        <div class="text-dark font-weight-bold h5 mb-0">
                                            <span>{{number_format($diamonds,0, ".", ".")}}</span></div>
                                    </div>
                                    <div class="col-auto"><img src="assets/img/signup_icon.gif"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-xl-2 mb-4">
                        <div class="card shadow border-left-duckets py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-duckets font-weight-bold text-xs mb-1">
                                            <span>Toplam EP</span></div>
                                        <?php
                                                    $ep = DB::table("users_currency")->where("type", "0")->sum("amount");
                                                ?>
                                        <div class="text-dark font-weight-bold h5 mb-0">
                                            <span>{{number_format($ep,0, ".", ".")}}</span></div>
                                    </div>
                                    <div class="col-auto"><img src="assets/img/signup_icon.gif"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-xl-2 mb-4">
                        <div class="card shadow border-left-warning py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-warning font-weight-bold text-xs mb-1">
                                            <span>Çevrim içi kullanıcılar</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0">
                                            <span>{{number_format(\App\Models\User::where("online","1")->count(),0, ".", ".")}}</span>
                                        </div>
                                    </div>
                                    <div class="col-auto"><img src="assets/img/signup_icon.gif"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-xl-2 mb-4">
                        <div class="card shadow border-left-duckets py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-duckets font-weight-bold text-xs mb-1">
                                            <span>Çevrim içi personeller</span></div>
                                        <?php
                                            use Illuminate\Support\Facades\DB;
                                            $list = DB::table("users")->select(DB::raw("group_concat(username) as list"))->where([
                                                ["rank",">=", "4"],
                                                ["online", "1"]
                                            ])->first()->list;

                                        ?>
                                        <div class="text-dark font-weight-bold h5 mb-0" data-toggle="tooltip"
                                            data-placement="right" title="{{$list}}"><span>{{number_format(\App\Models\User::where(
                                            [
                                                ["online","1"],
                                                ["rank", ">=", "4"]
                                                ])->count(),0, ".", ".")}}</span></div>
                                    </div>
                                    <div class="col-auto"><img src="assets/img/signup_icon.gif"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Çevrim içi kulanıcı sayısı</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Dropdown Header:</div>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-area">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <canvas id="myAreaChart" style="display: block; width: 667px; height: 320px;"
                                        width="667" height="320" class="chartjs-render-monitor"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xl-6 mb-4">
                        <div class="card shadow">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <p class="text-primary m-0 font-weight-bold">Son kayıt olan 10 kullanıcı </p>
                                <div class="btn btn-transparent" onclick="refreshUserList();"><i class="fa fa-sync"
                                        id="reload-user-icon"></i></div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                </div>
                                <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                    aria-describedby="dataTable_info">
                                    <table class="table my-0" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>ID</th>
                                                <th>Kullanıcı Adı</th>
                                                <th>Motto</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody id="users-table"></tbody>

                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 mb-4">
                        <div class="card shadow">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <p class="text-primary m-0 font-weight-bold">Son yasaklanan 10 kullanıcı </p>
                                <div class="btn btn-transparent" onclick="refreshBanList();"><i class="fa fa-sync"
                                        id="reload-ban-icon"></i></div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                </div>
                                <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                    aria-describedby="dataTable_info">
                                    <table class="table my-0" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>Ban ID</th>
                                                <th>Kullanıcı Adı</th>
                                                <th>Sebep</th>
                                                <th>Yasaklayan Personel</th>
                                                <th>Yasaklama Tarihi</th>
                                                <th>İşlemler</th>

                                            </tr>
                                        </thead>
                                        <tbody id="bans-table"></tbody>

                                    </table>
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

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/tinymce.js"></script>
    <script src="/assets/js/chart.min.js"></script>
    <script src="/assets/js/area-chart.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script>
       let saveUser = id => {
           let email = $('#user-form input#email').val();
           let motto = $('#user-form input#motto').val();

           $.ajax({
            url: "/api/user/"+id,
            method:'POST',
            data:   {
                _token: "{{csrf_token()}}",
                id: id,
                staffId: "{{$currentUser->id}}",
                email: email,
                motto: motto,
                ip: "{{request()->ip()}}"
            }
           }).done(data => {
               if(data.msg == "ok") {
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
        $(function () {
            refreshBanList();
            refreshUserList();
        })
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
        let refreshUserList = () => {
            $("#reload-user-icon").addClass("fa-spin");
            $('#users-table').empty();
            $.ajax({
                url: "/api/dashboard/user-list",
            }).done(data => {
                $("#reload-user-icon").removeClass("fa-spin");
                data.users.forEach(user => {
                    let item = `
                        <tr>    
                                        <td><img src="https://habnet.st/habbo-imaging/avatarimage.php?figure=${user.look}&size=s&head_direction=2&direction=2&action=wav"></td>
                                        <td>${user.id}</td>
                                        <td>${user.username}</td>
                                        <td>${user.motto}</td>
                                        <td>
                                            <div class="btn-group" role="group"><button onclick="userModal(${user.id});" data-toggle="modal" data-target="#user-modal" class="btn btn-primary" type="button" data-toggle="tooltip" title="Düzenle"><i class="fa fa-pencil"></i></button><button onclick="banModal(${user.id})" class="btn btn-danger" data-toggle="tooltip" title="Yasakla" type="button"><i class="fa fa-ban"></i></button></div>
                                        </td>
                                    </tr>`
                    $('#users-table').append(item);
                })
            }).fail(data => console.log);
            $('[data-toggle="tooltip"]').tooltip();
        }
        let refreshBanList = () => {
            $("#reload-ban-icon").addClass("fa-spin");
            $('#bans-table').empty();
            $.ajax({
                url: "/api/dashboard/ban-list",
            }).done(data => {
                $("#reload-ban-icon").removeClass("fa-spin");
                data.bans.forEach(ban => {
                    let item = `
                        <tr>    
                                        
                                        <td>${ban.id}</td>
                                        <td>${ban.username}</td>
                                        <td>${ban.ban_reason}</td>
                                        <td>${ban.staff_username}</td>
                                        <td>${ban.timestamp}</td>
                                        <td>${ban.ban_expire}</td>
                                        <td>
                                            <div class="btn-group" role="group"><button class="btn btn-primary" type="button" data-toggle="tooltip" title="Düzenle"><i class="fa fa-pencil"></i></button><button class="btn btn-danger" data-toggle="tooltip" title="Yasakla" type="button"><i class="fa fa-ban"></i></button></div>
                                        </td>
                                    </tr>`
                    $('#bans-table').append(item);
                })
            }).fail(data => console.log);
            $('[data-toggle="tooltip"]').tooltip();
        }
        setInterval(() => {
            refreshUserList();
            refreshBanList();
        }, 60 * 1000)
    </script>
</body>

</html>