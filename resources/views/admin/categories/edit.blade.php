@extends('layouts.admin')

@section('content')
    <h1> Edit Category </h1>

    {!! Form::model($category, ['method' => 'PATCH', "action" => ["AdminCategoriesController@update", $category->id]]) !!}

    <div class = "form-group">
        {!! Form::label('name', 'Name', ['class' => 'label-control']) !!}
        @if($errors->has('name')) <p class="error">{{$errors->first('name') }}</p> @endif
        {!! Form::text('name',$category->name, ['class' => 'form-control']) !!}
    </div>

    <div class = 'form-group'>
        {!! Form::submit('Update Category', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

    {!! Form::model($category, ['method' => 'DELETE', "action" => ["AdminCategoriesController@destroy", $category->id]]) !!}

    {!! Form::submit('Delete Category', ['class' => 'btn btn-danger']) !!}

    {!! Form::close() !!}
@stop
