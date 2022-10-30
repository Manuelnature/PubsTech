
$('#txt_debt_amount').on("keypress change", function(e) {
    // e.preventDefault();
    console.log('Debt');

    calculateAmountLeft();
});

$('#txt_amount_paid').on("keypress change", function(e) {
    console.log('Paid');

    calculateAmountLeft();
});


$('#txt_debt_amount').on("keydown keyup change", function(e) {
    // e.preventDefault();
    calculateAmountLeft();

    console.log('Afaaaaaaaa');
    if($('#txt_debt_amount').val().length == 0){

      $("#txt_debt_amount").val("");
      return;
    }

});

$('#txt_amount_paid').on("keydown keyup change", function(e) {
    // e.preventDefault();
    calculateAmountLeft();

    console.log('Afaaaaaaaa');
    if($('#txt_amount_paid').val().length == 0){

      $("#txt_amount_paid").val("");
      return;
    }

});



function calculateAmountLeft(){

    var debt_amount = $('#txt_debt_amount').val();

    var amount_paid = $('#txt_amount_paid').val();
    var amount_left = debt_amount - amount_paid;
    $('#txt_amount_left').val(amount_left);

    if(amount_left == debt_amount){
        $('#selected_status').val("Not Paid");
        document.getElementById('selected_status').innerHTML = "Not Paid";
    }
    else if(amount_left < debt_amount && amount_left != 0) {
        $('#selected_status').val("Partly Paid");
        document.getElementById('selected_status').innerHTML = "Partly Paid";
    }
    else if(amount_left == 0){
        $('#selected_status').val("Fully Paid");
        document.getElementById('selected_status').innerHTML = "Fully Paid";
    }

}






$('#txt_edit_debt_amount').on("keypress change", function(e) {
    // e.preventDefault();
    console.log('Debt');

    calculateEditAmountLeft();
});

$('#txt_edit_amount_paid').on("keypress change", function(e) {
    console.log('Paid');

    calculateEditAmountLeft();
});


$('#txt_edit_debt_amount').on("keydown keyup change", function(e) {
    // e.preventDefault();
    calculateEditAmountLeft();

    console.log('Afaaaaaaaa');
    if($('#txt_edit_debt_amount').val().length == 0){

      $("#txt_edit_debt_amount").val("");
      return;
    }

});

$('#txt_edit_amount_paid').on("keydown keyup change", function(e) {
    // e.preventDefault();
    calculateEditAmountLeft();

    console.log('Afaaaaaaaa');
    if($('#txt_edit_amount_paid').val().length == 0){

      $("#txt_edit_amount_paid").val("");
      return;
    }

});

function calculateEditAmountLeft(){

    var debt_amount = $('#txt_edit_debt_amount').val();

    var amount_paid = $('#txt_edit_amount_paid').val();
    var amount_left = debt_amount - amount_paid;
    $('#txt_edit_amount_left').val(amount_left);

    if(amount_left == debt_amount){
        $('#selected_payment_status').val("Not Paid");
        // document.getElementById('selected_payment_status').innerHTML = "Not Paid";
    }
    else if(amount_left < debt_amount && amount_left != 0) {
        $('#selected_payment_status').val("Partly Paid");
        // document.getElementById('selected_payment_status').innerHTML = "Partly Paid";
    }
    else if(amount_left == 0){
        $('#selected_payment_status').val("Fully Paid");
        // document.getElementById('selected_payment_status').innerHTML = "Fully Paid";
    }

}


