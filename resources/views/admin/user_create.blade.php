@extends('layouts.main')
@section('content')
<div class="site-section" id="section-about">
  <div class="overlay_popup" onclick="cancelDW();"></div>
  <br> <br> <br>
  <div class="container">



    <div class="row mb-5">

      <div class="col-md-5 ml-auto mb-5 order-md-2" data-aos="fade-up" data-aos-delay="100">

        <h2 class="text-primary text-center">Регистрация нового пользователя</h2>
        <form action="{{ route('user.store') }}" method="post" class="p-5 bg-white">
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

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="email">Почта</label>
              <input value="{{ old('email') }}" name="email" id="email" class="form-control">
              @error('email')
              <p class='text-danger'> {{ $message }}</p>
              @enderror
            </div>
          </div>
          <input id='location_id_hide' disabled hidden name="location_id">
          <div class="row form-group">
            <div class="col-md-12">
              <div class="b-pass">
                <label class="text-black" for="location_id">Объект</label>
                <select name="location_id" id="location_id" class="form-control">
                  <option value="0"></option>
                  @foreach ($data as $location)
                  <option value="{{ $location['location'][0]->ID }}">{{ $location['location'][0]->NAME }}</option>
                  @endforeach
                </select>

              </div>
              <div onclick="UpdateGrouping();" class="l-pass">
                <input disabled class="update form-control">
              </div>
              @error('location_id')
              <p class='text-danger'> {{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <button onclick="ShowGroupings();" type="button" class="btn btn-primary py-2 px-2 text-white"><i class="bi bi-plus-circle"></i> Добавить управляемую группу</button>
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
            <div class="col-md-12">
              <label class="text-black" for="role">Роль</label>
              <select name="role" id="role" class="form-control">
                <option value="user">Пользователь</option>
                <option value="admin">Администратор</option>
              </select>
              @error('role')
              <p class='text-danger'> {{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="row form-group">
            <div class="relat col-md-12">
              <label class="text-black" for="password1">Пароль</label><br>
              <div class="">
                <div class="b-pass">
                  <input name="password" type="password" id="password" class="form-control">
                </div>
                <div class="l-pass" onclick="ShowPass();">
                  <input id="showpass" disabled class="pass form-control">
                </div>
                @error('password')
                <p class='text-danger'> {{ $message }}</p>
                @enderror
              </div>
            </div>

          </div>
          <div class="row form-group">
          <div class="col-md-12">
            <label><input value="send" checked type="checkbox" name="send"> Отправить логин и пароль на почту</label>
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
        <h2 class="text-primary text-center">Список зарегистрированных пользователей</h2><br><br>
        @foreach($users as $user)
        <div id="list" class="bon1 p-1 text-white bg-secondary border">{{$user->id}} | {{$user->name}} | {{$user->email}}
          <div class='bon'>
            <a href="{{ route('user.edit', $user->id) }}">
              <button type="button" class="btn p-0 flex-shrink-1 bd-highlight py-0 px-0 text-white bg-secondary">
                <i class="bi bi-pencil"></i></button></a>
            <button onclick="ShowPopup('{{$user->id}}');" type="button" class="btn py-0 px-0 ml-2 mr-1 text-white bg-secondary">
              <i class="bi bi-trash"></i></button>
          </div>
        </div>

        <div class="popup" id="popup_{{$user->id}}">
          <div class="object">
            <form action="{{ route('user.delete', $user->id) }}" method="post">
              @csrf
              @method('delete')
              <h4 class="text-primary text-center"> Вы действительно хотите удалить этого пользователя? </h4>
              <div class="col text-center"><br>
                <input onclick="cancelDW();" type="button" value="Отменить" class="btn btn-primary py-2 px-4 text-white">
                <input type="submit" value="Удалить" class="btn btn-primary py-2 px-4 text-white">
              </div>
            </form>
          </div>
        </div>
        @endforeach

        <div class="mt-3 d-flex justify-content-center">
          {{ $users->links() }}
        </div>
      </div>


    </div>
  </div>
</div>
@endsection