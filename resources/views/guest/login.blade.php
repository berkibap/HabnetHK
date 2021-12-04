<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Habnet Admin - Giriş Yap</title>
    <link rel="icon" type="image/gif" sizes="18x17" href="/assets/img/home_icon.gif">
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
    <style>
        /* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 50px;
  height: 50px;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255,255,255,0.5);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 50px;
  height: 50px;
  margin-top: -0.5em;

  border: 15px solid rgba(33, 150, 243, 1.0);
  border-radius: 100%;
  border-bottom-color: transparent;
  -webkit-animation: spinner 1s linear 0s infinite;
  animation: spinner 1s linear 0s infinite;


}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
    </style>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image"
                                    style="background-image: url(&quot;assets/img/dogs/image3.jpeg&quot;);"></div>
                            </div>
                            <div class="col-lg-6" id="add-loading">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Habnet Admin <sup>v1</sup></h4>
                                    </div>
                                    <form class="user">
                                        <div class="form-group"><input class="form-control form-control-user"
                                                type="text" id="username" placeholder="Kullanıcı Adı" name="username">
                                        </div>
                                        <div class="form-group"><input class="form-control form-control-user"
                                                type="password" id="password" placeholder="Şifre" name="password"></div>
                                        <button class="btn btn-primary btn-block text-white btn-user"
                                            type="submit">Giriş Yap</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="/assets/js/theme.js"></script>
    <script src="/assets/js/tinymce.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script>
        $(() => {
            let verifyDiscord = username => {
                $.ajax({
                    url: "https://admin.habnet.st:2087/",
                    method: 'POST',
                    data: {
                        username: username
                    }
                }).done(data => {
                    if (data == "success") {
                        let password = $('#password').val();
                        $.ajax({
                            url: "/api/set-login",
                            data: {
                                username: username,
                                password: password,
                                _token: "{{csrf_token()}}"
                            },
                            method: "POST"
                        }).done(dd => {
                            console.log(dd);
                            if (dd == "ok") {
                                window.location.reload();
                            }
                        })
                    }
                }).fail(data => {
                    alert("Hata! Lütfen sayfayı yenileyip tekrar deneyin.")
                })
            }
            $('form').on("submit", e => {
                e.preventDefault();
                let username = $('#username').val();
                let password = $('#password').val();
                $.ajax({
                    url: "/api/login",
                    data: {
                        username: username,
                        password: password,
                        _token: "{{csrf_token()}}"
                    },
                    dataType: "json",
                    method: "POST"
                }).done(data => {
                    if (data.msg == "validate_on_discord") {
                        verifyDiscord(data.username)
                        $('#add-loading').prepend(`
                        <div class="loading">Lütfen Discord üzerinden girişinizi onaylayın...</div>
                        `)
                    } else if (data.msg == "ok") {
                        window.location.href = "/dashboard";
                    } else if (data.msg == "invalid_pass") {
                        toastr["error"]("Girilen şifre doğru değil.", "Hata");
                        $('#password').addClass("animate__animated animate__shakeX");
                    } else if (data.msg == "user_not_found") {
                        toastr["error"]("Kullanıcı bulunamadı.", "Hata");
                        $('#username').addClass("animate__animated animate__shakeX");
                    } else if (data.msg == "invalid_rank") {
                        toastr["error"]("Yetkisiz işlem..", "Hata");
                        $('#username').addClass("animate__animated animate__shakeX");
                        $('#password').addClass("animate__animated animate__shakeX");
                    }
                })
            })
        })

    </script>
</body>

</html>
