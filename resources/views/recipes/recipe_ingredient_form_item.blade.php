<tr id='{!! "ingredient_row_" . $id !!}' style='border-bottom: 1px solid #ddd; border-top: 0'>

    <td style='border-top: 0'>{!! $name !!}</td>

    <td style='border-top: 0; padding-right: 0;'>
        
        {!! $quantity !!}

        <a href='#' class='btn btn-xs btn-danger pull-right' onclick='{!! "removeIngredient(" . $id . ")" !!}'
           style='width: 25px; height: 25px; margin-top: 3px'>x</a>

    </td>

</tr>
