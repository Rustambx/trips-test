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
                        <a href="{{route('employees.create')}}" class="btn btn-primary">Создать Сотрудника</a>
                    </div>
                    <div class="card-header">
                        <strong class="card-title">Список Сотрудников</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Должность</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($employees)
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>
                                            <a href="{{ route('employees.edit', $employee->id) }}">{{ $employee->name }}</a>
                                        </td>
                                        <td>
                                            {{ $employee->position->name }}
                                        </td>
                                        <td>
                                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-success">Редактировать</a>
                                            <br>
                                            <br>
                                            <form method="post" action="{{ route('employees.destroy', $employee->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger" type="submit">Удалить</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <p>Должностей нет</p>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
@endsection
