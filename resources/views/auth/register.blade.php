<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Регистрация Artemblog</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Регистрация Artemblog" />
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
          />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
          />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
          />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="/admin/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="register-page bg-body-secondary">
    <div class="register-box">
      <!-- /.register-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header">
          <a
            href="/"
            class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover"
>
            <h1 class="mb-0"><b>Artem</b>blog</h1>
          </a>
        </div>
        <div class="card-body register-card-body">
          <p class="register-box-msg">Регистрация</p>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
          <form action="{{ route("register.post") }}" method="POST">
              @csrf
              <div class="mb-1">
                <div class="input-group">
                  <div class="form-floating">
                    <input id="registerFullName" name="name" type="text" class="form-control" placeholder="" value="{{ old('name') }}" required/>
                    <label for="registerFullName">Логин</label>
                  </div>
                  <div class="input-group-text"><span class="bi bi-person"></span></div>
                </div>
                  @error('name')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
              <div class="mb-1">
                <div class="input-group">
                  <div class="form-floating">
                    <input id="registerEmail" type="email" class="form-control" placeholder="" name="email" value="{{ old('email') }}" required/>
                    <label for="registerEmail">Email</label>
                  </div>
                  <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                </div>
                  @error('email')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
              <div class="mb-1">
                <div class="input-group">
                  <div class="form-floating">
                    <input id="registerPassword" type="password" class="form-control" placeholder="" name="password" required/>
                    <label for="registerPassword">Пароль</label>
                  </div>
                  <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                </div>
                  @error('password')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <div class="mb-1">
                  <div class="input-group">
                      <div class="form-floating">
                          <input id="registerPassword" type="password" class="form-control" placeholder="" name="password_confirmation" required/>
                          <label for="registerPassword">Подтверждение пароля</label>
                      </div>
                      <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                  </div>
                  @error('password_confirmation')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

            <!--begin::Row-->
            <div class="row">
              <div class="col-12 d-inline-flex align-items-center">
                <div class="form-check mb-1">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="pd_confirm" required/>
                  <label class="form-check-label" for="flexCheckDefault">
                    Я соглашаюсь на обработку <a href="#">Персональных данных</a>
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-12 mb-1">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </form>
          <!-- /.social-auth-links -->
          <p class="text-center mt-0">
            <a href="{{ route('login') }}" class="link-primary text-center"> Я уже зарегистрирован </a>
          </p>
        </div>
        <!-- /.register-card-body -->
      </div>
    </div>
    <!-- /.register-box -->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
          ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
          ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
          ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="/admin/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
    scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
          const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
          if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
              OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
                  theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
