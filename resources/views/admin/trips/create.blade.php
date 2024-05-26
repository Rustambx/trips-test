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
                        <form action="{{ route('trips.store') }}" method="post" class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-start_time" class=" form-control-label">Время начала</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="datetime-local" id="start_time" name="start_time" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="end_time-input" class=" form-control-label">Время окончания</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="datetime-local" id="end_time" name="end_time" class="form-control">
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

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var employeeSelect = document.getElementById('employee_id');
            var startTimeInput = document.getElementById('start_time');
            var endTimeInput = document.getElementById('end_time');

            if (employeeSelect && startTimeInput && endTimeInput) {
                employeeSelect.addEventListener('change', function() {
                    var employeeId = this.value;
                    var startTime = startTimeInput.value;
                    var endTime = endTimeInput.value;

                    fetch(`/admin/trips/available-cars?employee_id=${employeeId}&start_time=${startTime}&end_time=${endTime}`)
                        .then(response => response.json())
                        .then(data => {
                            var carSelect = document.getElementById('car_id');
                            carSelect.innerHTML = '';
                            data.forEach(car => {
                                var option = document.createElement('option');
                                option.value = car.id;
                                option.textContent = car.name; // Здесь используем name, так как у нас только одна модель Car
                                carSelect.appendChild(option);
                            });
                        });
                });
            }
        });

    </script>
@endsection
