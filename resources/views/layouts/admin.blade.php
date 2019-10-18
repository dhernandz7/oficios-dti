<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Documentos DTI</title>
  <link rel="stylesheet" href="/css/admin.css">
  <link rel="shortcut icon" type="image/png" href="/favicon.ico">
</head>
<body id="page-top">
  <div id="app">
    <div id="wrapper">
      <ul class="navbar-nav sidebar-mineco sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book"></i>
          </div>
          <div class="app-name sidebar-brand-text mx-3"></div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
          <router-link :to="'dashboard'" class="nav-link">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </router-link>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">MÓDULOS</div>
        @can('admin')
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#administracion" aria-expanded="true" aria-controls="administracion">
            <i class="fas fa-fw fa-users"></i>
            <span>Usuarios</span>
          </a>
          <div id="administracion" class="collapse" aria-labelledby="administracion" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Administración</h6>
              <router-link :to="{name: 'roles'}" class="collapse-item">Roles</router-link>
              <router-link :to="{name: 'permisos'}" class="collapse-item">Permisos</router-link>
              <router-link :to="{name: 'usuarios'}" class="collapse-item">Usuarios</router-link>
            </div>
          </div>
        </li>
        @endcan
        @can('documentos')
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-file-pdf"></i>
            <span>Documentos</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">ACCESO</h6>
              @can('oficios')
              <router-link :to="{name: 'oficios'}" class="collapse-item">Oficios</router-link>
              @endcan
              @can('dictamenes')
              <router-link :to="{name: 'dictamenes'}" class="collapse-item">Dictámenes</router-link>
              @endcan
              @can('memorandum')
              <router-link :to="{name: 'memorandums'}" class="collapse-item">Memorándum</router-link>
              @endcan
              @can('providencia')
              <router-link :to="{name: 'providencias'}" class="collapse-item">Providencias</router-link>
              @endcan
              @can('memorial')
              <router-link :to="{name: 'memoriales'}" class="collapse-item">Memoriales</router-link>
              @endcan
            </div>
          </div>
        </li>
        @endcan
        <!--hr class="sidebar-divider d-none d-md-block"-->
        <!--div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div-->
      </ul>

      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bell fa-fw"></i>
                  <span class="badge badge-danger badge-counter">0</span>
                </a>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                  <h6 class="dropdown-header">ALERTAS</h6>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-warning">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500"><span>now()</span></div>
                      Sin alertas
                    </div>
                  </a>
                  <a class="dropdown-item text-center small text-gray-500" href="#">Mostrar todas las alertas</a>
                </div>
              </li>
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-envelope fa-fw"></i>
                  <span class="badge badge-danger badge-counter">0</span>
                </a>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                  <h6 class="dropdown-header">Mensajes</h6>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <img class="rounded-circle" src="img/undraw_posting_photo.svg" alt="">
                      <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                      <div class="text-truncate">Sistema</div>
                      <div class="small text-gray-500">No tienes ningún mensaje</div>
                    </div>
                  </a>
                  <a class="dropdown-item text-center small text-gray-500" href="#">Leer todos los mensajes</a>
                </div>
              </li>
              <div class="topbar-divider d-none d-sm-block"></div>
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="user mr-2 d-none d-lg-inline text-gray-600 small"></span>
                  <i class="fa fa-user"></i>
                  <!--<img class="img-profile rounded-circle" src="img/undraw_posting_photo.svg">-->
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <router-link :to="{name: 'perfil'}" class="dropdown-item">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Perfil
                  </router-link>
                  <div class="dropdown-divider"></div>
                  <button class="logout dropdown-item">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cerrar sesión
                  </button>
                </div>
              </li>
            </ul>
          </nav>
          <div class="container-fluid">
            <app-component></app-component>
          </div>
        </div>
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Oficios DTI 2019</span>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <form action="/logout" method="post" id="logout">
    @csrf
  </form>
  <script src="/js/admin.js"></script>
  <script>
    $(document).ready(function() {
      if(localStorage.getItem('nombre') == null) {
        localStorage.setItem('nombre', "{{Auth::user()->name}}");
      }
      if(localStorage.getItem('id') == null) {
        localStorage.setItem('id', "{{Auth::user()->id}}");
      }
      if(localStorage.getItem('iniciales') == null) {
        localStorage.setItem('iniciales', "{{Auth::user()->iniciales}}");
      }
      if(localStorage.getItem('app-name-aj') == null) {
        localStorage.setItem('app-name-aj', "{{config('app.name')}}");
      }
      $('.logout').click(function(){
        $('#logout').submit();
        localStorage.removeItem('nombre');
        localStorage.removeItem('id');
        localStorage.removeItem('iniciales');
      });
      $(".user").html(localStorage.getItem('nombre'));
      $(".app-name").html(localStorage.getItem('app-name-aj').replace("AJ", "<sup>AJ</sup>"));
    });
  </script>
</body>
</html>
