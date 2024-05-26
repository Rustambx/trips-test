@extends('layouts.admin')

@section('content')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ $employee->name }}</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('employees.update', $employee->id) }}" method="post" class="form-horizontal">
                            @method('PATCH')
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="name" name="name" value="{{ $employee->name }}" placeholder="Text" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Должность</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="position_id" id="selectLg" class="form-control-lg form-control">
                                        <option value="0">Выберите Должность</option>
                                        @foreach($positions as $position)
                                            <option value="{{$position->id}}" @if($position->id == $employee->position_id) selected @endif>
                                                {{$position->name}}
                                            </option>
                                        @endforeach
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

