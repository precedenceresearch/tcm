paypal.Buttons({
    createOrder: function(data, actions) {
        var form = document.querySelector('#contactForm');
        
        // Check if the name field is not empty and valid
        
        // var paypalInput = document.querySelector('#payptt');
        // if (paypalInput!="paypal") {
        //     alert('Please Select Paypal Option');
        //     return false;
        // }
        
        var paylinkPaypal = document.querySelector("#paylinkPaypal");
        
        if(paylinkPaypal=="DPLink"){
        var nameInput = document.querySelector('#name');
        if (!nameInput.value.trim()) {
            alert('Please enter your name.');
            return false;
        }
        
        // Check if the email field is not empty and valid
        var emailInput = document.querySelector('#email');
        if (!emailInput.value.trim()) {
            alert('Please enter your email.');
            return false;
        }
        if (!emailInput.checkValidity()) {
            alert('Please enter a valid email.');
            return false;
        }
        
        // Check if the country field is not empty and valid
        var countryInput = document.querySelector('#country');
        if (!countryInput.value.trim()) {
            alert('Please select a country.');
            return false;
        }
        
        // Check if the phone number field is not empty and valid
        var phoneInput = document.querySelector('input[name="phone_no"]');
        if (!phoneInput.value.trim()) {
            alert('Please enter your phone number.');
            return false;
        }
        if (!phoneInput.checkValidity()) {
            alert('Please enter a valid phone number.');
            return false;
        }
        }

        // All fields are valid, proceed to create the PayPal order
        
        // Serialize the form data to send it as JSON
        var formData = new FormData(form);
        var jsonData = {};
        formData.forEach(function(value, key) {
            jsonData[key] = value;
        });

        return fetch('https://www.towardspackaging.com/payment/paypal/order/create/create-paypal-order.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            // Send the serialized form data as JSON in the request body
            body: JSON.stringify(jsonData)
        }).then(function(res) {
            if (!res.ok) {
                throw new Error('Network response was not ok');
            }
            return res.json();
        }).then(function(orderData) {
             //alert(orderData.id);
            return orderData.id;
        }).catch(function(error) {
            console.error('Error creating PayPal order:', error.message);
            //alert('Kindly activate your Paypal keys so that payments can be processed.');
            alert('PayPal order creation failed, Please confirm the fields are correct. Try one more later, please.'+error);
        });
    },
onApprove: function(data, actions) {
    return fetch('https://www.towardspackaging.com/payment/paypal/order/capture/capture-paypal-order.php?orderID=' + data.orderID, {
        method: 'post',
        headers: {
            'Content-Type': 'application/json',
        },
    }).then(function(res) {
        if (!res.ok) {
            throw new Error('Network response was not ok');
        }
        return res.json();
    }).then(function(responseData) {
        //alert(responseData.add_id);
        if (responseData.status === 'COMPLETED') {
            //console.log(responseData.order_id);
            var randomN = responseData.randomNo;
            // alert('Payment successful!');
            window.location.href = 'https://www.towardspackaging.com/paypal-thanks/'+responseData.transaction_id+'/'+randomN+'';
            // Replace this with your logic for a successful payment
        } else {
            alert('Payment was not Successfully Done, Please try again.!');
            //exit;
            // Replace this with your logic for a failed payment
        }
    }).catch(function(error) {
       alert(error);
       alert("Hello");
        // alert(error);
        // //console.error('Error capturing PayPal order:', error.message);
        // alert('Error capturing PayPal order. Please try again later.');
        // console.log(error); // Log the error to the console
    });
},
}).render('#paypal-button-container');