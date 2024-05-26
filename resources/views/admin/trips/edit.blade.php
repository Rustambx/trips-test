@extends('layouts.admin')

@section('content')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body card-block">
                        <form action="{{ route('trips.update', $trip->id) }}" method="post" class="form-horizontal">
                            @method('PATCH')
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-start_time" class=" form-control-label">Время начала</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="datetime-local" id="start_time" name="start_time" value="{{ $trip->start_time }}" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="end_time-input" class=" form-control-label">Время окончания</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="datetime-local" id="end_time" name="end_time" value="{{ $trip->end_time }}" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="employee_id" class=" form-control-label">Сотрудник</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="employee_id" id="employee_id" class="form-control-lg form-control">
                                        <option value="0">Выберите Сотрудника</option>
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">
                                                {{$employee->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Доступные Автомобили</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="car_id" id="car_id" class="form-control" required>

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

