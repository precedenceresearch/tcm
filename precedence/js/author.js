$(document).ready(function () {
    //form validation rules
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    });
    
    // validate signup form on keyup and submit 

    $("#category-form").validate({
        rules: {
            fname: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            desig: {
                required: true,
            },
            descp: {
                required: true,
            },
            status: {
                required: true
            },
        },
        messages: {
            fname: {
                required: "Name is required",
            },
            email: {
                required: "Email Id is required",
                email:"Invalid Email Id",
            },
            desig: {
                required: "Designation is required",
            },
            descp: {
                required: "Description is required",
            },
            status: {
                required: "Please select the Status"
            },
        },
        errorElement: "span",
        submitHandler: function(form) {
                var formData = new FormData(form);
                saveFormDatas(form);
        }
    });
});
