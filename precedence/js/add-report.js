$(document).ready(function () {
    //form validation rules
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    });
    
    // validate signup form on keyup and submit 

    $("#report-form").validate({
        rules: {
            reptitle: {
                required: true
            },
            repurl: {
                required: true
            },
            pubdate:{
                required: true
            },
            repcategory:{
                required: true
            },
            metatitle:{
                required: true
            }
        },
        messages: {
            reptitle: {
                required: "Report title is required"
            },
            repurl: {
                required: "Report URL is required"
            },
            pubdate:{
                required: "Publish date is required"
            },
            repcategory:{
                required: "Category is required"
            },
            metatitle:{
                required: "Meta Title is required"
            }
        },
        errorElement: "span",
        submitHandler: function(form) {
                var formData = new FormData(form);
                saveFormDatas(form);
        }
    });
});
