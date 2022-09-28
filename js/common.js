function validate_email(input_box, err_email){
    let pattern = /[a-z]/;
    let msg1 = "Invalid email";
    let msg2 = "Email is required";
    let email = input_box.val();
    let temp_email = validate_text(email, pattern, msg1, msg2);
    
    if(!email.valid){
        border_box_invalid(input_box);
        err_email.html(temp_email.message);
        return "";
    }
    
    border_box_valid(input_box);
    err_email.html("");
    return temp_email.message;
}
function validate_password(input_box, err_passsword){
    let pattern = /[a-z]/;
    let msg1 = "Password range invalid, 8-28 chars";
    let msg2 = "Password is required";
    let passsword = input_box.val();
    let temp_password = validate_text(passsword, pattern, msg1, msg2);
    
    if(!temp_password.valid){
        border_box_invalid(input_box);
        err_passsword.html(temp_password.message);
        return "";
    }
    
    border_box_valid(input_box);
    err_passsword.html("");
    return temp_password.message;
}
function validate_url(input_box, err_url){
    let pattern = /[a-z]/;
    let msg1 = "Invalid URL";
    let msg2 = "URL is required";
    let url = input_box.val();
    let temp_url = validate_text(url, pattern, msg1, msg2);
    
    if(!temp_url.valid){
        border_box_invalid(input_box);
        err_url.html(temp_url.message);
        return "";
    }
    
    border_box_valid(input_box);
    err_url.html("");
    return temp_url.message;
}
function validate_text(text, pattern, msg1, msg2){
    if(text == ""){
        return {"valid": false, "message": msg1};
    }else if(!text.match(pattern)){
        return {"valid": false, "message": msg2};
    }else{
        return {"valid": true, "message": text};
    }    
}
function border_box_invalid(input_box){
    input_box.css({"border-box":"red"});
}
function border_box_valid(input_box){
    input_box.css({"border-box":"lightblue"});
}   

function send_data(){
    
}
