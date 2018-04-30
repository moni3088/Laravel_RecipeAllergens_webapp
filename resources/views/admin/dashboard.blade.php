@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">

            <div class="panel panel-default">

                <div class="panel-heading">Pending recipes</div>

                <ul class="list-group">

                    @foreach ($recipes as $recipe)

                    <li class="list-group-item list-group-recipe" style="height: auto; overflow: hidden">

                        <div class="row">

                            <div class="col-md-9">

                                <div class="recipe_name">
                                    <a href="{!! route('recipes.show', $recipe->id) !!}">{!! $recipe->name !!}</a>
                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="btn-group pull-right">

                                    {!! Form::open([ 'method' => 'PUT', 'route' => [
                                    'admin.dashboard.pending_recipes.approve', $recipe->id ] ]) !!}

                                    <button type="submit" class="btn btn-xs btn-success">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>

                                    {!! Form::close() !!}

                                    {!! Form::open([ 'method' => 'PUT', 'route' => [
                                    'admin.dashboard.pending_recipes.reject', $recipe->id ] ]) !!}

                                    <button type="submit" class="btn btn-xs btn-danger">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>

                                    {!! Form::close() !!}

                                </div>

                            </div>
                            
                        </div>

                    </li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>

</div>

@endsection
