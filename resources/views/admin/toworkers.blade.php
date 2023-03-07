@extends('layouts.main')
@section('content')
<div class="site-section" id="section-about">
  <br> <br> <br>
  <div class="container">
    <h2 class="text-primary text-center">Перейти к объекту</h2>
    <div class="row justify-content-center mb-5">
      <div class="col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="300">
        <p class="text-primary text-center"><strong>Выберите объект, чтобы посмотреть или отредактировать работников на этой точке.</strong></p>
        <form action="{{ route('toworkers.update', session('guest_id')) }}" method="post" class="p-3 bg-white" enctype="multipart/form-data">
          @csrf
          @method('patch')
          <div class="row form-group">
            <div class="col-md-12">
            <div>
              <div class="b-pass">
              <input id='location_id_hide' disabled hidden name="location_id">
                <label class="text-black" for="location_id">Объект</label><select name="location_id" id="location_id" class="form-control">
                  <option value="0"></option>
                  @foreach ($data as $location)
                  <option value="{{ $location['location'][0]->ID }}">{{ $location['location'][0]->NAME }}</option>
                  @endforeach
                </select>
              </div>
              <div onclick="UpdateGrouping();" class="l-pass">
                <input disabled class="update form-control">
              </div>
              </div>
              @error('location_id')
              <p class='text-danger'> {{ $message }}</p>
              @enderror
              <br>

              <div class="row form-group">
                <div class="col-md-12">
                  <button onclick="ShowGroupings();" type="button" class="btn btn-primary py-2 px-2 text-white"><i class="bi bi-plus-circle"></i> Выбрать группу</button>
                </div>
              </div>

              @foreach ($data as $key=>$location)
              <div id='groupings_{{$key}}' class='hide'>
                @if(sizeof($location['groupings']) > 0)
                @foreach ($location['groupings'] as $grouping)
                <div>
                  <label><input value="{{$grouping->ID}}" type="radio" name="groupings"> {{$grouping->NAME}}</label>
                </div>
                @endforeach
                @else
                <p>Нет групп внутри объекта</p>
                @endif
              </div>
              @endforeach

              <div class="row form-group">
                <div class="col-md-12"><br>
                  <input type="submit" value="Вперед" class="btn btn-primary py-2 mb-2 px-4 text-white">
                </div>
              </div>

        </form>


      </div>

    </div>
  </div>
</div>
@endsection