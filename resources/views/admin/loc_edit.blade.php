@extends('layouts.main')
@section('content')
<div class="site-section" id="section-about">
    <div class="overlay_popup" onclick="cancelDW();"></div>
    <br> <br> <br>

    <div class="container">
        <h2 class="text-primary text-center">Редактировать объект</h2>
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 col-lg-10 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="300">

                <form action="{{ route('locations.update', $location[0]->ID) }}" method="post" class="p-5 bg-white" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="name_loc">Название объекта</label>
                            <input value="{{$location[0]->NAME }}" name="name_loc" id="name_loc" class="form-control">
                            @error('name_loc')
                            <p class='text-danger'> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <a href="{{ route('locations.gr.create', $location[0]->ID)}}">
                                <button type="button" class="btn btn-primary py-2 px-2 text-white"><i class="bi bi-plus-circle"></i> Добавить дочерний объект</button></a>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <a href="{{ route('locations.create') }}"><input type="button" value="Отменить" class="btn btn-primary py-2 px-4 text-white"></a>
                            <input type="submit" value="Сохранить" class="btn btn-primary py-2 px-4 text-white">
                        </div>
                    </div>

                </form>
                <div class='col-md-12'>
                    @if(sizeof($groupings) > 0)
                    <label class="text-black">Список дочерних объектов</label>

                    @foreach($groupings as $grouping)
                    <div id="list" class="bon1 p-1 text-white bg-secondary border">{{$grouping->ID}} | {{$grouping->NAME}}
                        <div class='bon'>
                            <a href="{{ route('locations.gr.edit', $grouping->ID) }}">
                                <button type="button" class="btn p-0 flex-shrink-1 bd-highlight py-0 px-0 text-white bg-secondary">
                                    <i class="bi bi-pencil"></i></button></a>
                            <button onclick="ShowPopup('{{$grouping->ID}}');" type="button" class="btn py-0 px-0 ml-2 mr-1 text-white bg-secondary">
                                <i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <label class="text-black mb-4">Нет дочерних объектов</label>
                    @endif

                    <br>
                </div>
            </div>
        </div>
    </div>
    @foreach($groupings as $grouping)
    <div class="popup" id="popup_{{$grouping->ID}}">
        <div class="object">
            <form action="{{ route('locations.delete', $grouping->ID) }}" method="post">
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
</div>
@endsection