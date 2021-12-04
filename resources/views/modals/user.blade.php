
       <div class="row">
          <div class="col-8">
            <form action="" id="user-form" data-id="{{$user->username}}">
              <div class="mb-3">
                <label for="username" class="form-label">Kullanıcı adı</label>
                <input type="text" class="form-control disabled" disabled id="username" value="{{$user->username}}">
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">E-Posta adresi</label>
                <input type="email" class="form-control" id="email" value="{{$user->mail}}">
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Motto</label>
                <input type="text" class="form-control" id="motto" value="{{$user->motto}}">
              </div>
              <div class="mb-3">
                <b>Son giriş tarihi:</b> {{date('d-m-Y H:s:i', $user->last_online)}} @if($user->online == "1") <b>Online</b> @endif
              </div>
              <div class="mb-3">
                <b>Kayıt Tarihi:</b> {{date('d-m-Y H:s:i', $user->account_created)}}
              </div>
              <div class="mb-3">
                <b>Son IP Adresi:</b>{{$user->ip_current}}
              </div>
              <div class="mb-3">
                <b>Kayıt IP Adresi:</b>{{$user->ip_register}}
              </div>
              <div class="mb-3">
                <button class="btn btn-primary" type="submit">Kaydet</button>
              </div>
            </form>
          </div>
          <div class="col-4 d-block">
            <div class="avatarimage d-block">
              <div class="row"> <img id="userAvatar"
                  src="https://habnet.st/habbo-imaging/avatarimage.php?figure={{$user->look}}size=l&head_direction=4&direction=4"
                  alt="look" id="look" data-head-dir="4" data-dir="4"></div>
              <div class="row">
                <button id="rotateAvatarBtn" class="btn-transparent"
                  style="background: url(/assets/img/arrow-left-icon.png) no-repeat center center; width:28px; height:21px;border:0;"></button>
                  <b>İşlemler</b>
                  <div class="mb-3">
                  <button class="btn btn-primary" onclick="resetPass({{$user->id}})">Şifre sıfırlama e-postası gönder</button>
                  <button class="btn btn-danger" onclick="banModal({{$user->id}})">Yasakla</button>

              </div>
              </div>
            </div>
          </div>
        </div>
      
<script>
  $('#user-form').submit(e => {
    e.preventDefault();
    saveUser($('#user-form').data('id'));
  })
  $("#rotateAvatarBtn").click(e => {
    let newDir = parseInt($('#userAvatar').attr("data-dir")) + 1;
    if (newDir > 8) newDir = 0;
    let newHeadDir = parseInt($('#userAvatar').attr("data-head-dir")) + 1;
    if (newHeadDir > 8) newHeadDir = 0;
    $('#userAvatar').attr("src",
      `https://habnet.st/habbo-imaging/avatarimage.php?figure={{$user->look}}size=l&head_direction=${newHeadDir}&direction=${newDir}`
      )
    $('#userAvatar').attr("data-dir", newDir);
    $('#userAvatar').attr("data-head-dir", newHeadDir);
  })
  $(() => {
    $('[data-dismiss="modal"]').click(e => {
      $(".modal").modal({show:false});
    })
  })
</script>