@extends('layouts.app')

@section('content')

<div class="container col-md-offset-1 col-md-10">

    <div class="jumbotron" id="jumbotron-show-recipe">

        <div class="row">
            <div class="container col-md-8">
                <div class="recipe-header">
                    <h2 class="recipe-title">{{$recipe->name }}</h2>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4 pull-right">
                <img src="{{ asset('public/images/' . $recipe->image) }}" alt="" width="100%" height="100%">
            </div>

            <div class="col-md-8">
                <h3>Directions</h3>
                <p style="font-size: 16px; white-space: pre-wrap;">{!! $recipe->direction !!}</p>
            </div>

        </div>

        <div class="row">

            <div class="container">

                <h3>Ingredients</h3>

                <table class="table table-striped" style="margin-top: 10px">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Allergen</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($ingredients as $ingredient)

                    <tr>
                        <td>{!! $ingredient->name !!}</td>
                        <td>{!! $ingredient->pivot->ingredient_quantity !!}</td>
                        <td>{!! $ingredient->getAllergenNamesText() !!}</td>
                    </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-12" style="margin-bottom: 15px">

            <a href="{!! URL::previous() !!}" class="btn btn-default">Back</a>

            @if (Auth::user() && (Auth::user()->isAuthorOfRecipe($recipe) || Auth::user()->isAdmin()))

            <a href="{!! route('recipes.edit', $recipe->id) !!}" class="btn btn-primary pull-right">Edit</a>

            <a href="#"
               class="btn btn-danger pull-right"
               style="margin-right:10px;"
               onclick="deleteRecipe('{!! csrf_token() !!}', '{!! $recipe->id !!}')">Delete</a>

            @endif

        </div>

    </div>

</div>

{!! Html::script('public/js/recipe.js') !!}

@endsection
