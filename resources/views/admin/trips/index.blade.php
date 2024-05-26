@extends('layouts.admin')

@section('content')
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    @if(session('status'))
                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                            {{ session()->get('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    <div class="card-body">
                        <a href="{{route('trips.create')}}" class="btn btn-primary">Создать Поездку</a>
                    </div>
                    <div class="card-header">
                        <strong class="card-title">Список Поездок</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Время начала</th>
                                <th>Время окончания</th>
                                <th>Сотрудник</th>
                                <th>Автомобиль</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($trips)
                                @foreach($trips as $trip)
                                    <tr>
                                        <td>
                                            {{ $trip->start_time }}
                                        </td>
                                        <td>
                                            {{ $trip->end_time }}
                                        </td>
                                        <td>
                                            {{ $trip->employee->name }}
                                        </td>
                                        <td>
                                            {{ $trip->car->name }}
                                        </td>
                                        <td>
                                            <a href="{{ route('trips.edit', $trip->id) }}" class="btn btn-success">Редактировать</a>
                                            <br>
                                            <br>
                                            <form method="post" action="{{ route('trips.destroy', $trip->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger" type="submit">Удалить</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <p>Поездок нет</p>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
@endsection
