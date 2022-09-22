var prod_list;

function setProductList(all_products){
      prod_list = all_products;
      console.log(prod_list);
}

$('#txt_product_id').change(function(e) {
    e.preventDefault();
    calculatePriceForRetail();
});

$('#txt_quantity').on("keydown keyup change", function(e) {
    // e.preventDefault();
    calculatePriceForRetail();

    if($('#txt_quantity').val().length == 0){

      $("#txt_total_amount").val("");
      return;
    }

});

$('#txt_quantity_modal').on("keydown keyup change", function(e) {

    calculatePriceForRetailModal();

    if($('#txt_quantity_modal').val().length == 0){

      $("#txt_total_amount_modal").val("");
      return;
    }
});

//============This also works perfectly ==================
/* $('#txt_quantity_modal').bind('input',function(){
    console.log(prod_list);
    console.log($('#txt_product_id_modal').val());
    calculatePriceForRetailModal();

    if($('#txt_quantity_modal').val().length == 0){

            $("#txt_total_amount_modal").val("");
            return;
        }
}); */


function calculatePriceForRetail(){
    var product_id = $('#txt_product_id').val();

    var quantity = $('#txt_quantity').val();

    if(quantity.length == 0){
        return;
    }

    var quantity_int = parseInt(quantity);

    var amount;
    // var currency;
    prod_list.forEach(function(product) {
        // console.log(product["price_per_item"]);
        if(product["id"] == product_id){
            amount = product["price_per_item"];
            // currency = product["currency"];
            // break;
        }
    });

    if(amount.length == 0){
        return;
        }
    var amount_int = parseInt(amount);

    var cost = amount_int * quantity_int;
    // console.log("Final Cost is ");
    // console.log(cost);
    // $("#txt_cost_id").val(currency.concat(" ").concat(cost));
    var cost_to_two_decimal_places = cost.toFixed(2);
    console.log(cost_to_two_decimal_places);
    var cost_separated_with_comma = cost_to_two_decimal_places.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    console.log(cost_separated_with_comma);

    var total_cost = cost_separated_with_comma;
    $("#txt_total_amount").val(total_cost);
}


function calculatePriceForRetailModal(){
    var product_id = $('#txt_product_id_modal').val();

    var quantity = $('#txt_quantity_modal').val();
    if(quantity.length == 0){
        return;
    }

    var quantity_int = parseInt(quantity);

    var amount;

    prod_list.forEach(function(product) {
        if(product["id"] == product_id){
            amount = product["price_per_item"];
        }
    });

    if(amount.length == 0){
        return;
        }
    var amount_int = parseInt(amount);

    var cost = amount_int * quantity_int;

    var cost_to_two_decimal_places = cost.toFixed(2);
    console.log(cost_to_two_decimal_places);
    var cost_separated_with_comma = cost_to_two_decimal_places.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    console.log(cost_separated_with_comma);

    var total_cost = cost_separated_with_comma;
    $("#txt_total_amount_modal").val(total_cost);
}
