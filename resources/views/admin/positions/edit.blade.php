@extends('layouts.admin')

@section('content')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ $position->name }}</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('positions.update', $position->id) }}" method="post" class="form-horizontal">
                            @method('PATCH')
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="name" name="name" value="{{ $position->name }}" placeholder="Text" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="categories" class=" form-control-label">Категории</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="categories[]" id="categories" class="form-control-lg form-control" multiple>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if($position->categories->contains($category->id)) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
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

