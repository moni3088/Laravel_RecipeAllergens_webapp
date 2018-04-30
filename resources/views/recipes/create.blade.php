@extends('layouts.app')

@section('content')

<div class="container">

    <div class="col-md-9" style="float: none; margin: 0 auto;">

        <h2>Create recipe</h2>

        <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}">

        <div class="row group-vertical-padding">

            <div class="form-group col-md-12">

                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, array('class'=>'form-control', 'id'=>'recipeNameInput',
                'required'=>'')) !!}

            </div>

        </div>

        <div class="row group-vertical-padding">

            <div class="col-md-7" style="padding-right: 0">
                {!! Form::label('direction', 'Directions') !!}

                <textarea class="form-control" id="recipeDirectionsInput" required="" name="direction"
                          rows="15" style="resize: vertical;"></textarea>

            </div>

            <div class="col-md-4">

                {!! Form::label('image', 'Upload image') !!}

                {!! view('components.image_upload', ['placeholder' => 'public/assets/placeholder_food_200.png']) !!}

            </div>

        </div>

        @component('recipes.recipe_ingredient_form')
        @endcomponent

        <div class="row group-vertical-padding">

            <div class="form-group col-md-12">

                <a href="" class="btn btn-primary pull-right" onclick="createRecipe()">
                    Save Recipe
                </a>

                <a href="{!! URL::previous() !!}" class="btn btn-default pull-right" style="margin-right: 10px;">
                    Cancel
                </a>

            </div>
        </div>

    </div>

</div>

{!! Html::script('public/js/recipe.js') !!}

@endsection

