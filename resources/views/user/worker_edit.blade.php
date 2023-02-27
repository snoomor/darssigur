@extends('layouts.main')
@section('content')
<div class="site-section" id="section-about">
  <br> <br> <br>
  <div class="container">
    <h2 class="text-primary text-center">Редактировать профиль работника</h2>
    <div class="row mb-5">
      <div class="col-md-5 ml-auto mb-5 order-md-2" data-aos="fade-up" data-aos-delay="100">

        <form action="{{ route('worker.update', $worker->ID) }}" method="post" class="p-5 bg-white" enctype="multipart/form-data">
          @csrf
          @method('patch')

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="name">ФИО</label>
              <input id="name" name="name" class="form-control" value="{{$worker->NAME}}">
              @error('name')
              <p class='text-danger'> {{ $message }}</p>
              @enderror
            </div>
          </div>

          <div id="photo">
            <div id="photo_0" class="">
              <div class="form-group"> <label class="text-black" for="subject">Фото</label>
                <input type="file" name="image" class="form-control-file">
                @error('image')
                <p class='text-danger'> {{ $message }}</p>
                @enderror
              </div>
            </div>
          </div>

          <!-- <div class="row form-group">
            <div class="col-md-12">
              <button type="button" onclick="addField();" class="btn btn-primary py-2 px-2 text-white"><i class="bi bi-plus-circle"></i> Фото</button>
            </div>
          </div> -->

          <div class="row form-group">
            <div class="col-md-12">
              <a href="{{ route('worker.create') }}"><input type="button" value="Отменить" class="btn btn-primary py-2 px-4 mb-2 text-white"></a>
              <input type="submit" value="Сохранить" class="btn btn-primary py-2 mb-2 px-4 text-white">
            </div>
          </div>

        </form>
      </div>

      <div class="col-md-6 order-md-1" data-aos="fade-up"><br><br>

        @if($photo != '')
        <div id="p_l_{{$worker->ID}}" class="text-center">
          <h5 class="text-primary">Текущее фото</h5>
          <label class="text-black" for="subject">Загрузите новое фото, чтобы обновить</label>
          <div class="wrapper ex exmpl">
            <img src="data:image/jpeg;base64,{{base64_encode($photo->HIRES_RASTER);}}">
          </div>
        </div>
        @else
        <h5 class="text-primary">Еще нет фото</h5>
        @endif

      </div>

    </div>
  </div>
</div>
@endsection