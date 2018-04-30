@extends('layouts.app')

@section('content')

<div class="container">

    <div class="col-md-9" style="float: none; margin: 0 auto;">

        <h2>Edit your recipe</h2>

        {!! Form::open(array('route' => array('recipes.update', $recipe->id))) !!}

        <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}">

        <div class="row group-vertical-padding">

            <div class="form-group col-md-12">

                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', $recipe->name, array('class'=>'form-control', 'id'=>'recipeNameInput',
                'required'=>'')) !!}

            </div>

        </div>

        <div class="row group-vertical-padding">

            <div class="col-md-7" style="padding-right: 0">
                {!! Form::label('direction', 'Directions') !!}

                <textarea class="form-control" id="recipeDirectionsInput" required="" name="direction"
                          rows="15" style="resize: vertical;">{!! $recipe->direction !!}</textarea>

            </div>

            <div class="col-md-4">

                {!! Form::label('image', 'Upload image') !!}

                {!! view('components.image_upload', ['placeholder' => 'public/images/' .$recipe->image]) !!}

            </div>

        </div>

        @component('recipes.recipe_ingredient_form')

        @foreach($ingredients as $ingredient)

        {!!view(

        'recipes.recipe_ingredient_form_item',

        [
        'id' => $ingredient->id,
        'name' => $ingredient->name,
        'quantity' => $ingredient->pivot->ingredient_quantity,
        ]

        )
        !!}

        @endforeach

        @endcomponent

        <div class="row group-vertical-padding">

            <div class="form-group col-md-12">
                <a href="#" class="btn btn-primary pull-right"
                   onclick="updateRecipe('{!! csrf_token() !!}', '{!! $recipe->id !!}')">
                    Save Recipe
                </a>

                <a href="{!! URL::previous() !!}" class="btn btn-default pull-right" style="margin-right: 10px;">
                    Cancel
                </a>

            </div>

        </div>

        {!! Form::close() !!}

    </div>

</div>

{!! Html::script('public/js/recipe.js') !!}

@endsection
