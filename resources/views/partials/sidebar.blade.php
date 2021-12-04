
<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
    <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
            <div class="sidebar-brand-icon"><i class="fas fa-user-shield"></i></div>
            <div class="sidebar-brand-text mx-3"><span>habnet<sup>hk</sup></span></div>
        </a>
        <hr class="sidebar-divider my-0">
        <ul class="nav navbar-nav text-light" id="accordionSidebar">
            @if(\App\Models\HkPermissions::checkPermission($currentUser->rank, "dashboard")) <li class="nav-item"
                role="presentation"><a class="nav-link active" href="/dashboard"><i
                        class="fas fa-tachometer-alt"></i><span>Ana Sayfa</span></a></li> @endif
            @if(\App\Models\HkPermissions::checkPermission($currentUser->rank, "manage_users"))
            <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown"
                    aria-expanded="false" href="#"><i class="fa fa-users"></i>Kullanıcı Yönetici</a>
                <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="#"
                        data-toggle="modal" data-target="#search-user-modal">Kullanıcı Ara</a>
                        <a class="dropdown-item" role="presentation" href="/users/detailed-search">Detaylı Kullanıcı Arama</a>
                <a class="dropdown-item" role="presentation" href="/users/chatlogs/search">Chatlog Ara</a></div>
                
            </li>@endif
                @if(\App\Models\HkPermissions::checkPermission($currentUser->rank, "manage_news"))
            <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown"
                    aria-expanded="false" href="#"><i class="fa fa-newspaper-o"></i>Haber Yönetimi</a>
                <div class="dropdown-menu" role="menu">
                    <a class="dropdown-item" role="presentation" href="/news/list" >Tüm Haberler</a>
                    <a class="dropdown-item" role="presentation" href="/news/new-article">Yeni Haber Yaz</a>
                </div>    
                
            </li>@endif
            @if(\App\Models\HkPermissions::checkPermission($currentUser->rank, "ingame_management"))
            <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown"
                    aria-expanded="false" href="#"><i class="fa fa-gamepad"></i>Oyun İçi Yönetimi</a>
                <div class="dropdown-menu" role="menu">
                @if(\App\Models\HkPermissions::checkPermission($currentUser->rank, "badge_management"))<a class="dropdown-item" role="presentation" href="/ingame/upload-badge" >Rozet Yükle</a>
                    <a class="dropdown-item" role="presentation" href="/ingame/badge-list">Rozet Listesi</a>@endif
                    @if(\App\Models\HkPermissions::checkPermission($currentUser->rank, "manage_permissions"))<a class="dropdown-item" role="presentation" href="/ingame/badge-list">Yetki Yönetimi</a>@endif
                </div>    
                
            </li>@endif
             @if(\App\Models\HkPermissions::checkPermission($currentUser->rank, "logs"))
            <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown"
                    aria-expanded="false" href="#"><i class="fas fa-toolbox"></i>Kayıtlar</a>
                <div class="dropdown-menu" role="menu">
                    @if(\App\Models\HkPermissions::checkPermission($currentUser->rank, "view_hk_logs"))<a class="dropdown-item" role="presentation" href="/logs/hk-logs">HK Kayıtları</a>@endif
                    @if(\App\Models\HkPermissions::checkPermission($currentUser->rank, "trade_logs"))<a class="dropdown-item" role="presentation" href="/logs/trade-logs">Takas Kayıtları</a>@endif
                    @if(\App\Models\HkPermissions::checkPermission($currentUser->rank, "staff_logs"))<a class="dropdown-item" role="presentation" href="/logs/staff-logs">Personel Kayıtları</a>@endif
                    @if(\App\Models\HkPermissions::checkPermission($currentUser->rank, "view_chatlogs"))<a class="dropdown-item" role="presentation" href="/logs/hk-logs">Konuşma Kayıtları</a>@endif
                    @if(\App\Models\HkPermissions::checkPermission($currentUser->rank, "purchase_logs"))<a class="dropdown-item" role="presentation" href="/logs/purchase-logs">Satın Alma Kayıtları</a>@endif
                </div>    
                
            </li>@endif
        </ul>
        <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle"
                type="button"></button></div>
    </div>
</nav>
@if(\App\Models\HkPermissions::checkPermission($currentUser->rank, "manage_users"))
<div class="modal" id="search-user-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="search-user-modal-title">Kullanıcı Ara</h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="search-user-form">
                    <div class="mb-3">
                        <label for="">Kullanıcı adı</label>
                        <input type="text" class="form-control" id="search-user-input"
                            placeholder="Aramak için bir şeyler yazın...">
                    </div>
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Kullanıcı Adı</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody id="search-user-results"></tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endif