@extends('layouts.app')

@section ('content')

<div class="container">

    <div class="col-md-6" style="float: none; margin: 0 auto;">
        <h2>Add new ingredient</h2>

        {!! Form::open(array('route' => 'ingredients.store','method'=>'POST')) !!}

        @if(count($errors))
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <br/>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name','Ingredient Name',['class'=>'control-label cd-md-2']) !!}

                {!! Form::text('name', old('name'), ['class'=>'form-control']) !!}

                <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group {{ $errors->has('allergic_component') ? 'has-error' : '' }}">
                {!! Form::label('allergic_component', 'Allergenic component', ['class'=>'control-label cd-md-2']) !!}

                {!! Form::text('allergic_component', old('allergic_component'), ['class'=>'form-control']) !!}

                <span class="text-danger">{{ $errors->first('allergic_component') }}</span>

            </div>

        </div>

        <div class="row">

            <div class="form-group col-md-12">
                {!! Form::submit('Save Ingredient', array('class'=>'btn btn-primary pull-right')) !!}

                <a href="{!! URL::previous() !!}" class="btn btn-default pull-right" style="margin-right: 10px;" onclick="createRecipe()">
                    Cancel
                </a>
                
            </div>

        </div>

        {!! Form::close() !!}

    </div>

</div>
@stop
