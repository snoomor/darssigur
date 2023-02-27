@extends('layouts.main')
@section('content')
<div class="site-section overlay" id="section-how-it-works">
    <br><br>
    <div class="container">

        <div class="row justify-content-center mb-5">

            <div class="mt-5 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="300">
                <div class="bg-white text-center">
                    <p class="fs-7 text-primary" >404</p>
                    <h3 >Страница не найдена!</h3>
                    <a  class="text-secondary" href="{{ route('user.create') }}"><p>Вернуться на главную</p></a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection