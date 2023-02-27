@extends('layouts.main')
@section('content')
<div class="site-section bg-dark overlay" id="section-how-it-works">
    <br><br>
    <div class="container">


       
        <div class="row justify-content-center mb-5">

            <div class="col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="300">
                <form method="POST" class="p-5 bg-white" action="{{ route('login') }}">
                    @csrf

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="email">Логин</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <p class='text-danger'> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="subject">Пароль</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <p class='text-danger'> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Запомнить меня</label>
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <input type="submit" value="Войти" class="btn btn-primary  py-2 px-4 text-white">
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>


<footer class="site-footer bg-dark"></footer>
@endsection