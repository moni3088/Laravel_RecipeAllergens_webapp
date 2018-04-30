$('#ingredient_name').on('keypress', function(key) {

    var enterKey = 13;

    if(key.which == enterKey) {
        $('#ingredient_allergen').focus();
    }

});

$('#ingredient_allergen').on('keypress', function(key) {

    var enterKey = 13;

    if(key.which == enterKey) {
        saveIngredient();
    }

});

function saveIngredient() {

    var token = $('#token').val();
    var ingredient_name = $('#ingredient_name').val();
    var allergen_name = $('#ingredient_allergen').val();

    var form_data = new FormData();
    form_data.append("_token", token);
    form_data.append("ingredient_name", ingredient_name);
    form_data.append("allergen_name", allergen_name);

    $.ajax({

        method: "POST",
        url: "/admin/ingredients",
        contentType: false,
        processData: false,
        data: form_data

    }).done(function (id) {

        var row = $(
            "<tr>" +
            "<td>" + id + "</td>" +
            "<td>" + ingredient_name + "</td>" +
            "<td>" + allergen_name + "</td>" +
            "</tr>"
        );

        $('table > tbody > tr').first().after(row)

        $('#ingredient_name').val("").focus();
        $('#ingredient_allergen').val("");

    });

}