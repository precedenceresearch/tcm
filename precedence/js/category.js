$(document).ready(function () {
    //form validation rules
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    });
    
    // validate signup form on keyup and submit 

    $("#category-form").validate({
        rules: {
            cattitle: {
                required: true,
            },
            status: {
                required: true
            },
        },
        messages: {
            cattitle: {
                required: "Category title is required",
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
