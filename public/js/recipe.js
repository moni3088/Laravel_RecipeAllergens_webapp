var addedIngredients = [];
var removedIngredientIds = [];

const idNewPrefix = 'new_';
const rowIdPrefix = "ingredient_row_";

function addIngredient() {

    event.preventDefault();

    var nameField = $('#ingredient_name');
    var quantityField = $('#ingredient_quantity');

    var name = nameField.val();
    var quantity = quantityField.val();

    if (name == "" || quantity == "") {
        return;
    }

    // E.g. 'new_id_1'
    var itemId = idNewPrefix + (addedIngredients.length + 1);

    addedIngredients.push({id: itemId, name: name, quantity: quantity});

    // E.g. 'ingredient_row_new_id_1'
    var rowId = rowIdPrefix + itemId;

    var row = $(
        "<tr id='" + rowId + "' style='border-bottom: 1px solid #ddd; border-top: 0'>" +

        "<td style='border-top: 0'>" + name + "</td>" +

        "<td style='border-top: 0; padding-right: 0;'>" + quantity +

        "<a href='#' class='btn btn-xs btn-danger pull-right' onclick='removeIngredient(\"" + itemId + "\")'" +
        "style='width: 25px; height: 25px; margin-top: 3px'>x</a>" +

        "</td>" +

        "</tr>"
    );

    $('#ingredient_list').append(row);

    nameField.val("");
    quantityField.val("");

    nameField.focus();

    // Scroll added row in sight
    $('html,body').animate({
        scrollTop: $('#' + rowId).offset().top
    }, 500);
}

function removeIngredient(id) {

    event.preventDefault();
    
    if (('' + id).includes(idNewPrefix)) {
        
        console.log(addedIngredients);

        // Remove added ingredient from the array
        addedIngredients.forEach(function (ingredient, i) {

            if (ingredient['id'] == id) {
                addedIngredients.splice(i, 1);
            }
            
        });
        
        console.log(addedIngredients);

    } else {
        removedIngredientIds.push(id)
    }

    $('#' + rowIdPrefix + id).remove();

}

function createRecipe() {

    event.preventDefault();

    var recipeName = $('#recipeNameInput').val();
    var recipeDirections = $('#recipeDirectionsInput').val();
    
    var imageFileName = "";

    //search for a direct child input within the image upload and get the property files
    var uploadedImages = $(".image_upload > input[type='file']").prop('files');

    var uploaded_file = uploadedImages.length > 0;
    if (uploaded_file) {
        //get first file
        imageFileName = uploadedImages[0];
    }

    //required token for session
    var token = $('#token').val();

    var form_data = new FormData();
    form_data.append("_token", token);
    form_data.append("name", recipeName);
    form_data.append("directions", recipeDirections);
    form_data.append("image", imageFileName);
    form_data.append("addedIngredients", JSON.stringify(addedIngredients));

    //through the method POST send the form_data for route /recipes
    $.ajax({

        method: "POST",
        url: "/recipes",
        processData: false,
        contentType: false,
        data: form_data

    }).done(function (data) {

        window.location.href = data;
    });

}

function updateRecipe(token, id) {

    var recipeName = $('#recipeNameInput').val();
    var recipeDirections = $('#recipeDirectionsInput').val();

    var imageFileName = "";

    var uploadedImages = $(".image_upload > input[type='file']").prop('files');

    if (uploadedImages.length > 0) {
        imageFileName = uploadedImages[0];
    }

    var form_data = new FormData();
    form_data.append("_method", 'put');
    form_data.append("name", recipeName);
    form_data.append("directions", recipeDirections);
    form_data.append("image", imageFileName);
    form_data.append("addedIngredients", JSON.stringify(addedIngredients));
    form_data.append("removedIngredientIds", JSON.stringify(removedIngredientIds));

    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': token}
    });

    $.ajax({

        method: "POST",
        url: "/recipes/" + id,
        processData: false,
        contentType: false,
        data: form_data

    }).done(function (redirectUrl) {
        window.location.href = redirectUrl;
    });

}

function deleteRecipe(token, id) {

    $.ajax({

        method: "DELETE",
        url: "/recipes/" + id,
        data: {"_token": token}

    }).done(function (redirectUrl) {
        window.location.href = redirectUrl;
    });

}
