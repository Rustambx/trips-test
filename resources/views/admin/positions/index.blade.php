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
                        <a href="{{route('positions.create')}}" class="btn btn-primary">Создать Должность</a>
                    </div>
                    <div class="card-header">
                        <strong class="card-title">Список Должностей</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Категории</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($positions)
                                @foreach($positions as $position)
                                    <tr>
                                        <td>
                                            <a href="{{ route('positions.edit', $position->id) }}">{{ $position->name }}</a>
                                        </td>
                                        <td>
                                            @foreach($position->categories as $category)
                                                {{ $category->name }},
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-success">Редактировать</a>
                                            <br>
                                            <br>
                                            <form method="post" action="{{ route('positions.destroy', $position->id) }}">
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
