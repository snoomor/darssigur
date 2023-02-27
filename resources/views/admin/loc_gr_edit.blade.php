@extends('layouts.main')
@section('content')
<div class="site-section" id="section-about">
    <div class="overlay_popup" onclick="cancelDW();"></div>
    <br> <br> <br>
    <div class="container">
        <h2 class="text-primary text-center">Редактировать дочерний объект</h2>
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 col-lg-10 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="300">

                <form action="{{ route('locations.update', $location->ID) }}" method="post" class="p-5 bg-white" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="name_loc">Отредактируйе название</label>
                            <input value="{{ $location->NAME }}" name="name_loc" id="name_loc" class="form-control">
                            @error('name_loc')
                            <p class='text-danger'> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" value="Сохранить" class="btn btn-primary py-2 px-4 text-white">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <a href="{{ route('locations.edit', $location->PARENT_ID) }}"><input type="button" value="Отменить" class="btn btn-primary py-2 px-4 mb-2 text-white"></a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection