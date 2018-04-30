@extends('layouts.app')
@section('content')

<div class="jumbotron">

    <div class="container">
        <div class="row" style="margin-bottom: 12px">
            <div class="col-lg-12">

                {!! Form::open(array('url' => '/', 'method' =>'GET')) !!}

                <div class="input-group input-group-lg" id="search-area">
                    <input type="text" class="form-control" name="q" placeholder="Search recipe or ingredient"
                           value="{{$query}}">

                    <span class=" input-group-btn">
                        <button class="btn btn-default" type="button">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                </div>

                {!! Form::close() !!}

            </div>
        </div>

        <div class="row">
            @foreach ($recipes as $recipe)

            <div class="col-sm-3">
                <div class="thumbnail">
                    <img class="image_preview" src="{!! asset('public/images/' .$recipe->image) !!}"
                         style="height: 200px; width: 200px; margin-top: 20px"/>

                    <div class="caption">
                        <h3>{!! $recipe->name !!}</h3>
                        <p>{!! $recipe->directions !!}</p>

                        <a href="{!! 'recipes/'. $recipe->id !!}" class="btn btn-primary" role="button">See</a>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</div>

@endsection
