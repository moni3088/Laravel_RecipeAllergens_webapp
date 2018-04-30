function addAllergy() {

    var token = $('#token').val();
    var allergy_id = $("select[name='allergy']").val();

    var form_data = new FormData();
    form_data.append("_token", token);
    form_data.append("allergy_id", allergy_id);

    $.ajax({

        method: "POST",
        url: "/dashboard/add_allergy",
        contentType: false,
        processData: false,
        data: form_data

    }).done(function (redirectUrl) {
        
        window.location.href = redirectUrl;

    });

}

function removeAllergy(allergy_id) {

    var token = $('#token').val();

    var form_data = new FormData();
    form_data.append("_token", token);
    form_data.append("allergy_id", allergy_id);

    $.ajax({

        method: "POST",
        url: "/dashboard/remove_allergy",
        contentType: false,
        processData: false,
        data: form_data

    }).done(function (redirectUrl) {

        window.location.href = redirectUrl;

    });
    
}