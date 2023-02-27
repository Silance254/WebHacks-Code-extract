# WebHacks-Code-extract
Hereby, I provide you with free source code for common features used in web-based applications so that you can save time when performing routine tasks.



HACK 1:
here is a sample code in PHP that you can use to link an e-commerce website with MPESA express as a payment gateway. The code assumes that you have already obtained an MPESA API key and secret from Safaricom, and that you have the necessary credentials to make requests to their API.

NB: Here's a breakdown of what the code does:

First, we set the API endpoint URL and our MPESA API credentials.

Next, we set the transaction details, including the amount to be charged, the customer's phone number, your business short code, and a unique transaction reference number.

We also set the callback URL where MPESA will send the payment status notification.

We then set the request headers, which include:

The authorization header with our API key and secret, and

The content type header to indicate that we are sending JSON data in the request body.

We then create the request body as an associative array, which includes the various parameters required by the MPESA API to initiate a payment request. These include the business short code, password, timestamp, transaction type, amount, phone number, callback URL, account reference, transaction description, and remark.

We then convert the request body to JSON format using the json_encode() function.

We make the API request using the cURL library, which allows us to send an HTTP POST request to the MPESA API endpoint with the request headers and body that we have set up.

We then parse the API response using json_decode() to convert the JSON-formatted response into an associative array that we can work with.

We check if the API request was successful by looking for the 'ResponseCode' key in the response JSON. If the response code is 0, then the request was successful, and we redirect the customer to the payment page using the checkout URL returned by the MPESA API.

If the API request failed, we display an error message to the customer.


(NB: This code is just a starting point, and you will need to customize it to fit your specific e-commerce website and payment flow. You may also need to add additional error handling and validation code to ensure that the payment process is as smooth and error-free as possible for your customers) wish you luck in whatever you are handling!! #code is a pulse
