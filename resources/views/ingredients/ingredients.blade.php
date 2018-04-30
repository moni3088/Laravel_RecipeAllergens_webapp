@extends('layouts.app')

@section('header')

<h1>Ingredients List</h1>
@stop

@section('content')

<div class="container">
    
    <table class="table table-bordered table-responsive" style="margin-top: 10px;">

        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Allergen</th>
        </tr>
        </thead>

        <tr>

            <input type="hidden" name="_token" id="token" value="{!!  csrf_token()  !!}">
            <td>#</td>
            <td><input id="ingredient_name"></td>
            <td><input id="ingredient_allergen"></td>

        </tr>

        @foreach($ingredients as $ingredient)

        <tr>
            <td>{!! $ingredient->id !!}</td>
            <td>{!! $ingredient->name !!}</td>
            <td>{!! $ingredient->getAllergenNamesText() !!}</td>

        </tr>

        @endforeach

    </table>

</div>

{!! Html::script('public/js/ingredients.js') !!}

@stop
