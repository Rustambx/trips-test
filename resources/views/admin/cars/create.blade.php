@extends('layouts.admin')

@section('content')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong></strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('cars.store') }}" method="post" class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="name" name="name" placeholder="Text" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="model" class=" form-control-label">Модель</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="model" name="model" placeholder="Text" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Категория</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="category_id" id="selectLg" class="form-control-lg form-control">
                                        <option value="0">Выберите Категорию</option>
                                        @foreach($categories as $cateogory)
                                            <option value="{{$cateogory->id}}">
                                                {{$cateogory->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Водители</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="driver_id" id="selectLg" class="form-control-lg form-control">
                                        @if($drivers->isEmpty())
                                            <option value="0">Доступных водителей нет</option>
                                        @else
                                            <option value="0">Выберите Водителя</option>
                                            @foreach($drivers as $driver)
                                                <option value="{{$driver->id}}">
                                                    {{$driver->name}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <input type="submit" value="Сохранить" class="btn btn-primary btn-sm">
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
