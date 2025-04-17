$(document).ready(function () {
    //form validation rules
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    });
    
    // validate signup form on keyup and submit 

    $("#press-form").validate({
        rules: {
            presstitle: {
                required: true
            },
            pressurl: {
                required: true
            },
            pubdate:{
                required: true
            },
        },
        messages: {
            presstitle: {
                required: "Press Release title is required"
            },
            pressurl: {
                required: "Press Release URL is required"
            },
            pubdate:{
                required: "Publish date is required"
            },
        },
        errorElement: "span",
        submitHandler: function(form) {
                var formData = new FormData(form);
                saveFormDatas(form);
        }
    });
});
