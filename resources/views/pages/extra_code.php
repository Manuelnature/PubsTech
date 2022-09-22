
                                @php
                                if($user->first_name != NULL || $user->first_name != ""){
                                    $first_name = $user->first_name;
                                }
                                else{
                                    $first_name = "";
                                }
                                if($user->last_name != NULL || $user->last_name != ""){
                                    $last_name = $user->last_name;
                                }
                                else{
                                    $last_name = "";
                                }
                                if($user->email != NULL || $user->email != ""){
                                    $email = $user->email;
                                }
                                else{
                                    $email = "";
                                }
                                if($user->phone_number != NULL || $user->phone_number != ""){
                                    $phone_number = $user->phone_number;
                                }
                                else{
                                    $phone_number = "";
                                }
                                if($user->role != NULL || $user->role != ""){
                                    $role = $user->role;
                                }
                                else{
                                    $role = "";
                                }
                            @endphp




if (link.data('first_name') != NULL || link.data('first_name') != "") {
    var first_name = link.data('first_name')
} else {
    var first_name = ""
}
if (link.data('last_name') != NULL || link.data('last_name') != "") {
    var last_name = link.data('last_name')
} else {
    var last_name = ""
}
if (link.data('email') != NULL || link.data('email') != "") {
    var email = link.data('email')
} else {
    var email = ""
}
if (link.data('phone_number') != NULL || link.data('phone_number') != "") {
    var phone_number = link.data('email')
} else {
    var phone_number = ""
}
if (link.data('role') != NULL || link.data('role') != "") {
    var role = link.data('role')
} else {
    var role = ""
}


if (first_name != NULL || first_name != "") {
            modal.find('#txt_first_name').val(first_name);
        } else {
            modal.find('#txt_first_name').val("");
        }
        if (last_name!= NULL || last_name != "") {
            modal.find('#txt_last_name').val(last_name);
        } else {
            modal.find('#txt_last_name').val("");
        }
        if (email != NULL || email != "") {
            modal.find('#txt_email').val(email);
        } else {
            modal.find('#txt_email').val("");
        }
        if (phone_number != NULL || phone_number != "") {
            modal.find('#txt_phone_number').val(phone_number);
        } else {
            modal.find('#txt_phone_number').val("");
        }
        if (role != NULL || role != "") {
            modal.find('#txt_role').val(role);
        } else {
            modal.find('#txt_role').val("");
        }


        if (first_name != undefined || first_name != "") {
            modal.find('#txt_first_name').val(first_name);
        } else {
            modal.find('#txt_first_name').val("");
        }
        if (last_name!= undefined || last_name != "") {
            modal.find('#txt_last_name').val(last_name);
        } else {
            modal.find('#txt_last_name').val("");
        }
        if (email != undefined || email != "") {
            modal.find('#txt_email').val(email);
        } else {
            modal.find('#txt_email').val("");
        }
        if (phone_number != undefined || phone_number != "") {
            modal.find('#txt_phone_number').val(phone_number);
        } else {
            modal.find('#txt_phone_number').val("");
        }
        if (role != undefined || role != "") {
            modal.find('#txt_role').val(role);
        } else {
            modal.find('#txt_role').val("");
        }

