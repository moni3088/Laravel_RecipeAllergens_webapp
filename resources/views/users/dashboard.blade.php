@extends('layouts.app')

@section('content')

<input type="hidden" name="_token" id="token" value="{!!  csrf_token()  !!}">

<div class="container">
    <div class="row">

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">My Recipes</div>

                <div class="panel-body">

                    <ul class="list-group">

                        @foreach ($recipes as $recipe)

                        <li class="list-group-item list-group-recipe" style="height: auto; overflow: hidden">

                            <a href="{!! route('recipes.show', $recipe->id) !!}" aria-hidden="true">

                                <div class="row">

                                    <div class="col-md-9">

                                        <div class="recipe_name">
                                            {!! $recipe->name !!}
                                        </div>

                                    </div>

                                    <div class="col-md-3 pull-right">

                                        <div
                                            class="text-right text-capitalize recipe_status {!! $recipe->getStatusCSSClass() !!}">
                                            {!! $recipe->status !!}
                                        </div>

                                    </div>

                                </div>
                            </a>

                        </li>

                        @endforeach

                    </ul>

                    <div class="button pull-right">
                        <a href="{!! route('recipes.create') !!}" class="btn btn-primary">Add recipe</a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-6">

            <div class="panel panel-default">
                <div class="panel-heading">My Allergies</div>

                <div class="panel-body">

                    <ul class="list-group">

                        @foreach ($allergies as $allergy)

                        <li class="list-group-item">

                            <div class="row">
                                
                                <div class="col-md-12">

                                    {!! $allergy->name !!}
                                    
                                    <button class="btn btn-xs btn-danger pull-right" onclick="removeAllergy('{!! $allergy->id !!}')">
                                        <span class="glyphicon glyphicon-remove" style="padding-bottom: 3px; padding-top: 3px;"></span>
                                    </button>

                                </div>

                            </div>

                        </li>

                        @endforeach

                    </ul>

                        <div class="pull-right" >

                            {!! Form::select('allergy', $allergies_to_pick) !!}

                            <button class="btn btn-ms btn-primary" style="margin-left: 6px;" onclick="addAllergy()">
                                Add Allergy
                            </button>

                        </div>

                </div>

            </div>

        </div>

    </div>

</div>

{!! Html::script('public/js/user_home.js') !!}

@endsection
