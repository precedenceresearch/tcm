$(document).ready(function () {
    //form validation rules
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    });
    
    // validate signup form on keyup and submit 

    $("#paylink-form").validate({
        rules: {
            rcode: {
                required: true
            },
            rname: {
                required: true
            },
            cname:{
                required: true
            },
            invoice:{
                required: true
            },
            ccompanyname:{
                required: true
            },
            amount:{
                required: true,
                number: true
            },
            
        },
        messages: {
            rcode: {
                required: "Report code is required"
            },
            rname: {
                required: "Report name is required"
            },
            cname:{
                required: "Client name is required"
            },
            invoice:{
                required: "Invoice is required"
            },
            ccompanyname:{
                required: "Client company name is required"
            },
            amount:{
                required: "Amount is required",
                number: "Invalid Amount"
            },
        },
        errorElement: "span",
        submitHandler: function(form) {
                var formData = new FormData(form);
                saveFormDatas(form);
        }
    });
});
