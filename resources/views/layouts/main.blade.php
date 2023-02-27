<!DOCTYPE html>
<html lang="ru">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dars Sigur</title>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="/js/all.js"></script>
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="200">
  <header class=" bg-dark site-navbar py-3 js-site-navbar site-navbar-target" role="banner" id="site-navbar">

    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <p class="navbar-brand">
        <h2 class=" text-primary">Dars Sigur</h2>
        </p>
        

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          @auth
          <ul class="navbar-nav mr-auto">
            <li>
              <p class="nav-link text-primary font-weight-normal pl-4 pt-4">Вы вошли как {{ auth()->user()->name }}</p>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
          @can('view', auth()->user())
          <li class="nav-item">
              <p class="nav-link text-primary font-weight-normal pt-4"><a href="{{ route('toworkers.edit', session('guest_id')) }}">Работники на объектах</a></p>
            </li>
            <li class="nav-item">
              <p class="nav-link text-primary font-weight-normal pt-4"><a href="{{ route('locations.create') }}">Объекты</a></p>
            </li>
          <li class="nav-item">
              <p class="nav-link text-primary font-weight-normal pt-4"><a href="{{ route('user.create') }}">Пользователи</a></p>
            </li>
          @endcan
            <li class="nav-item">
              <p class="nav-link text-primary font-weight-normal pt-4"><a href="{{ route('logout') }}">Выход</a></p>
            </li>
          </ul>
          @endauth
        </div>
      </nav>
    </div>
  </header>
  @if (session()->has('flashmessage'))
  <div class="myalert alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
    <strong>{{session('flashmessage')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @yield('content')
</body>

</html>