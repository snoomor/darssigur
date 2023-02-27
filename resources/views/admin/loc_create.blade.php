@extends('layouts.main')
@section('content')
<div class="site-section" id="section-about">
  <div class="overlay_popup" onclick="cancelDW();"></div>
  <br> <br> <br>
  <div class="container">

    <div class="row mb-5">

      <div class="col-md-5 ml-auto mb-5 order-md-2" data-aos="fade-up" data-aos-delay="100">

        <h2 class="text-primary text-center">Регистрация нового объекта</h2>
        <form action="{{ route('locations.store', 0) }}" method="post" class="p-5 bg-white">
          @csrf

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="name_loc">Название</label>
              <input value="{{ old('name_loc') }}" name="name_loc" id="name_loc" class="form-control">
              @error('name_loc')
              <p class='text-danger'> {{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <input type="submit" value="Создать" class="btn btn-primary py-2 px-4 text-white">
            </div>
          </div>
        </form>

      </div>
      <div class="col-md-6 order-md-1" data-aos="fade-up">
        <h2 class="text-primary text-center">Список зарегистрированных объектов</h2><br><br>
        @foreach($locations as $location)
        <div id="list" class="bon1 p-1 text-white bg-secondary border">{{$location->ID}} | {{$location->NAME}}
          <div class='bon'>
            <a href="{{ route('locations.edit', $location->ID) }}">
              <button type="button" class="btn p-0 flex-shrink-1 bd-highlight py-0 px-0 text-white bg-secondary">
                <i class="bi bi-pencil"></i></button></a>
            <button onclick="ShowPopup('{{$location->ID}}');" type="button" class="btn py-0 px-0 ml-2 mr-1 text-white bg-secondary">
              <i class="bi bi-trash"></i></button>
          </div>
        </div>

        <div class="popup" id="popup_{{$location->ID}}" >
          <div class="object">
            <form action="{{ route('locations.delete', $location->ID) }}" method="post">
              @csrf
              @method('delete')
              <h4 class="text-primary text-center"> Вы действительно хотите удалить выбранный объект? </h4>
              <div class="col text-center"><br>
                <input onclick="cancelDW();" type="button" value="Отменить" class="btn btn-primary py-2 px-4 text-white">
                <input type="submit" value="Удалить" class="btn btn-primary py-2 px-4 text-white">
              </div>
            </form>
          </div>
        </div>
        @endforeach

        <div class="mt-3 d-flex justify-content-center">
        {{ $locations->links() }}
        </div>
      </div>


    </div>
  </div>
</div>
@endsection