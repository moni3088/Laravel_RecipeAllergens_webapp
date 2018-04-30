<div class="row" style="margin-top: 12px">

    <div class="form-group col-md-12">

        <h4>Ingredients</h4>

        <table class="table">
            <col width="30%">
            <col width="20%">
            <thead>

            <tr>
                <th style="padding-left: 0">Name</th>
                <th>Quantity</th>
            </tr>

            <tr>

                <td style="padding-left: 0">
                    {!! Form::text('ingredients', null, array('class'=>'form-control', 'id'=>'ingredient_name',
                    'required'=>''))
                    !!}
                </td>

                <td style="padding-right: 0">

                    <div class="col-md-10" style="padding-left:0; padding-right: 0">

                        {!! Form::text('quantity', null, array('class'=>'form-control',
                        'id'=>'ingredient_quantity',
                        'required'=>'')) !!}

                    </div>

                    <a href="#" class="btn btn-xs btn-success pull-right" onclick="addIngredient()"
                       style="width: 25px; height: 25px; margin-top: 3px">
                        <span class="glyphicon-plus"/>
                    </a>

                </td>

            </tr>

            </thead>

            <tbody id="ingredient_list">

            {{ $slot }}

            </tbody>

        </table>

    </div>

</div>