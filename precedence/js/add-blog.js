$(document).ready(function () {
    //form validation rules
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    });
    
    // validate signup form on keyup and submit 

    $("#blog-form").validate({
        rules: {
            blogtitle: {
                required: true
            },
            blogurl: {
                required: true
            },
            pubdate:{
                required: true
            },
        },
        messages: {
            blogtitle: {
                required: "Blog title is required"
            },
            blogurl: {
                required: "Blog URL is required"
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
