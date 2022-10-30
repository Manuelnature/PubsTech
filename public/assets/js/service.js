var price_list;

function setServiceList(all_pricing){
    price_list = all_pricing;
    console.log(price_list);
}

$('#txt_vehicle_type_id').change(function(e) {
    e.preventDefault();
    calculatePriceForServices();
});

$('#txt_service_id').change(function(e) {
    e.preventDefault();
    calculatePriceForServices();

    if($('#txt_service_id').val().length == 0){
        $("#txt_total_price").val("");
        return;
      }
});

function calculatePriceForServices(){
    var vehicle_type_id = $('#txt_vehicle_type_id').val();

    var service_ids = $('#txt_service_id').val();

    // const service_ids = [$('#txt_service_id').val()];
    console.log('vehicle_type_id '+ vehicle_type_id);
    console.log('service_ids '+service_ids);

    if(service_ids.length == 0){
        return;
    }


    var total_amount = 0;
    var washer_percentage_price = 0;
    var total_washer_percentage_price = 0;

    price_list.forEach(function(pricing) {

        service_ids.forEach(function(service_id){
            // services["id"] == service_id &&
            // var service =

            if(pricing["vehicle_type_id"] == vehicle_type_id && pricing["service_id"] == service_id){
                var amount = pricing["price"];
                var washer_percentage = pricing["washer_percentage"];
                total_amount = parseInt(total_amount) + parseInt(amount);
                washer_percentage_price = parseFloat(washer_percentage / 100) * parseFloat(amount);
                total_washer_percentage_price = parseFloat(total_washer_percentage_price) + parseFloat(washer_percentage_price);
            }
        });
    });
    console.log(total_amount);
    console.log(washer_percentage_price);
    console.log(total_washer_percentage_price);

    var total_amount_to_two_decimal_places = total_amount.toFixed(2);
    var washer_price_to_two_decimal_places = total_washer_percentage_price.toFixed(2);

    var total_amount_separated_with_comma = total_amount_to_two_decimal_places.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    var washer_price_separated_with_comma = washer_price_to_two_decimal_places.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


    var total_service_amount = total_amount_separated_with_comma;
    var total_washer_price = washer_price_separated_with_comma;

    $("#txt_total_price").val(total_service_amount);

    $("#txt_washer_commission").val(total_washer_price);
}





$('#txt_edit_vehicle_type_id').change(function(e) {
    e.preventDefault();
    calculateEditPriceForServices();
});


$('#txt_edit_service_id').change(function(e) {
    e.preventDefault();
    calculateEditPriceForServices();

    if($('#txt_edit_service_id').val().length == 0){
        $("#txt_edit_total_price").val("");
        return;
      }
});

function calculateEditPriceForServices(){
    var vehicle_type_id = $('#txt_edit_vehicle_type_id').val();

    var service_ids = $('#txt_edit_service_id').val();

    console.log('vehicle_type_id '+ vehicle_type_id);
    console.log('service_ids '+service_ids);

    if(service_ids.length == 0){
        return;
    }


    var total_amount = 0;
    var washer_percentage_price = 0;
    var total_washer_percentage_price = 0;

    price_list.forEach(function(pricing) {
        // console.log(service["price"]);
        service_ids.forEach(function(service_id){
            // services["id"] == service_id &&
            // var service =

            if(pricing["vehicle_type_id"] == vehicle_type_id && pricing["service_id"] == service_id){
                var amount = pricing["price"];
                var washer_percentage = pricing["washer_percentage"];
                total_amount = parseInt(total_amount) + parseInt(amount);
                washer_percentage_price = parseFloat(washer_percentage / 100) * parseFloat(amount);
                total_washer_percentage_price = parseFloat(total_washer_percentage_price) + parseFloat(washer_percentage_price);
            }
        });
    });
    console.log(total_amount);
    console.log(washer_percentage_price);
    console.log(total_washer_percentage_price);

    var total_amount_to_two_decimal_places = total_amount.toFixed(2);
    var washer_price_to_two_decimal_places = total_washer_percentage_price.toFixed(2);

    var total_amount_separated_with_comma = total_amount_to_two_decimal_places.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    var washer_price_separated_with_comma = washer_price_to_two_decimal_places.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


    var total_service_amount = total_amount_separated_with_comma;
    var total_washer_price = washer_price_separated_with_comma;

    $("#txt_edit_total_price").val(total_service_amount);

    $("#txt_edit_washer_commission").val(total_washer_price);
}
