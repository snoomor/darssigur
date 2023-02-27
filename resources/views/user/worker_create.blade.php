@extends('layouts.main')
@section('content')
<div class="site-section" id="section-about">
  <div class="overlay_popup" onclick="cancelDW();"></div>
  <br> <br> <br>
  <div class="container">

    <div class="row mb-5">

      <div class="col-md-5 ml-auto mb-5 order-md-2" data-aos="fade-up" data-aos-delay="100">

        <h2 class="text-primary text-center">Регистрация нового работника</h2>
        <form action="{{ route('worker.store') }}" method="post" class="p-5 bg-white" enctype="multipart/form-data">
          @csrf
          <div class="row form-group">

            <div class="col-md-12">
              <label class="text-black" for="name">ФИО</label>
              <input value="{{ old('name') }}" name="name" id="name" class="form-control">
              @error('name')
              <p class='text-danger'> {{ $message }}</p>
              @enderror
            </div>
          </div>

          <!-- <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="position">Должность</label>
              <input value="Работник" name="position" disabled id="position" class="form-control">
              @error('position')
              <p class='text-danger'> {{ $message }}</p>
              @enderror
            </div>
          </div> -->

          <div id="photo">
            <div class="" id="photo_0">
              <div class="form-group"><label class="text-black" for="subject">Фото</label>
                <input value="{{ old('image') }}" type="file" name="image" class="form-control-file">
                @error('image')
                <p class='text-danger'> {{ $message }}</p>
                @enderror
              </div>
            </div>
          </div>
          <!-- 
            <div class="row form-group">
              <div class="col-md-12">
                <button type="button" onclick="addField();" class="btn btn-primary py-2 px-2 text-white"><i
                    class="bi bi-plus-circle"></i> Фото</button>
              </div>
            </div> -->

          <div class="row form-group">
            <div class="col-md-12">
              <input type="submit" value="Создать" class="btn btn-primary py-2 px-4 text-white">
            </div>
          </div>
        </form>

      </div>
      <div class="col-md-6 order-md-1" data-aos="fade-up">
        <h2 class="text-primary text-center">Список зарегистрированных работников</h2><br>
        <p class="text-primary text-left"><strong>Объект: {{$location->NAME}}</strong></p>

        @if (sizeof($data) > 0)
        @foreach($data as $dat)
        <div id="list" class="bon1 p-1 text-white bg-secondary border">{{$dat->NAME}}
          <div class='bon'>
            <a href="{{ route('worker.edit', $dat->ID) }}">
              <button type="button" class="btn p-0 flex-shrink-1 bd-highlight py-0 px-0 text-white bg-secondary">
                <i class="bi bi-pencil"></i></button></a>
            <button onclick="ShowPopup('{{$dat->ID}}');" type="button" class="btn py-0 px-0 ml-2 mr-1 text-white bg-secondary">
              <i class="bi bi-trash"></i></button>
          </div>
        </div>

        <div class="popup" id="popup_{{$dat->ID}}">
          <div class="object">
            <form action="{{ route('worker.delete', $dat->ID) }}" method="post">
              @csrf
              @method('delete')
              <h4 class="text-primary text-center"> Вы действительно хотите удалить этого работника? </h4>
              <div class="col text-center"><br>
                <input onclick="cancelDW();" type="button" value="Отменить" class="btn btn-primary py-2 px-4 text-white">
                <input type="submit" value="Удалить" class="btn btn-primary py-2 px-4 text-white">
              </div>
            </form>
          </div>
        </div>
        @endforeach
        @else
        <h5 class="text-primary text-left">Работники еще не добавлены</h5>
        @endif
      </div>


    </div>
  </div>
</div>
@endsection