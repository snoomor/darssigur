@extends('layouts.main')
@section('content')
<div class="site-section" id="section-about">
  <br> <br> <br>
  <div class="container">
    <h2 class="text-primary text-center">Редактировать профиль пользователя</h2>
    <div class="row justify-content-center mb-5">
      <div class="col-md-10 col-lg-8 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="300">

        <form action="{{ route('user.update', $user->id) }}" method="post" class="p-5 bg-white" enctype="multipart/form-data">
          @csrf
          @method('patch')

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="name">ФИО</label>
              <input value="{{$user->name}}" name="name" id="name" class="form-control">
              @error('name')
              <p class='text-danger'> {{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="email">Почта</label>
              <input value="{{$user->email}}" name="email_hid" class="hide">
              <input disabled value="{{$user->email}}" name="email" id="email" class="form-control">
              @error('email')
              <p class='text-danger'> {{ $message }}</p>
              @enderror
            </div>
          </div>

          <input id='location_id_hide' hidden name="location_id"
          @if($cur_loc[0]->PARENT_ID != 0)
          value="{{ $cur_loc[0]->ID }}"
          @endif
          >
          <div class="row form-group">
            <div class="col-md-12">
              <div class="b-pass">
                <label class="text-black" for="location_id">Объект</label>
                <select name="location_id" id="location_id" 
                @if($cur_loc[0]->PARENT_ID != 0)
                  disabled='disabled'
                @endif class="form-control">
                  @foreach($locations as $location)
                   <option
                    @if($location->ID == $cur_loc[0]->PARENT_ID OR $location->ID == $cur_loc[0]->ID)
                      selected
                    @endif
                    value="{{ $location->ID }}">{{ $location->NAME }}</option>
                  @endforeach
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
              <button onclick="ShowGroupings();" type="button" class="btn btn-primary py-2 px-2 text-white"><i class="bi bi-plus-circle"></i> Добавить группу</button>
            </div>
          </div>

          @foreach ($data as $key=>$location)
          <div id='groupings_{{$key}}' 
          @if ($cur_loc[0]->PARENT_ID != 0 AND $cur_loc[0]->PARENT_ID != $key)
          class='hide'
          @elseif ($cur_loc[0]->PARENT_ID == 0)
          class='hide'
          @endif
          >
            @if(sizeof($location['groupings']) > 0)
            @foreach ($location['groupings'] as $grouping)
            <div>
              <label><input value="{{$grouping->ID}}" type="radio" name="groupings"
              @if($grouping->ID == $cur_loc[0]->ID) checked @endif
              > {{$grouping->NAME}}</label>
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
              <select value="{{$user->role}}" name="role" id="role" class="form-control">
                <option selected value="user">Пользователь</option>
                <option @if ($user->role == 'admin')
                  selected
                  @endif
                  value="admin">Администратор</option>
              </select>
              @error('role')
              <p class='text-danger'> {{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black">Доступ</label>
              <p>При изменении доступов у ранее заведенных работников этим пользователем доступы НЕ изменятся.
                Меняются в ручную в Sigur.</p>
              @foreach ($devices as $device)
              <div>
                <label><input value="{{$device->ID}}" type="checkbox" 
                @if (in_array($device->ID, $cur_dev)) checked 
                @endif
                name="devices[]"> {{$device->NAME}}</label>
              </div>
              @endforeach
              @error('devices')
              <p class='text-danger'> {{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="row form-group">
            <div class="relat col-md-12">

              <label class="text-black" for="password">Пароль</label>
              <p>При заполнении этого поля пароль будет изменен на введенный вами, 
                а также пользователю будет отправлено сообщение о смене пароля с новыми данными для входа.
                Оставьте поле пустым, если не хотите менять текущий пароль.</p><br>
              <div class="">
                <div class="b-pass">
                  <input value="" name="password" type="password" id="password" class="form-control">
                </div>
                <div class="l-pass" onclick="ShowPass();">
                  <input value="" name="password" type="password" id="showpass" disabled class="pass form-control">
                </div>
                @error('password')
                <p class='text-danger'> {{ $message }}</p>

                @enderror
              </div>
            </div>

          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <a href="{{ route('user.create') }}"><input type="button" value="Отменить" class="btn btn-primary py-2 px-4 mb-2 text-white"></a>
              <input type="submit" value="Сохранить" class="btn btn-primary py-2 mb-2 px-4 text-white">
            </div>
          </div>

        </form>


      </div>

    </div>
  </div>
</div>
@endsection