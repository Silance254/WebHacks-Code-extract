<?php
// Set the API endpoint URL and credentials
$endpoint = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$api_key = 'YOUR_API_KEY';
$api_secret = 'YOUR_API_SECRET';

// Set the transaction details
$amount = 1000; // The amount to be charged in Kenyan Shillings (KES)
$phone_number = '254712345678'; // The customer's phone number in international format (without the + sign)
$business_short_code = 'YOUR_BUSINESS_SHORT_CODE'; // Your MPESA business short code
$transaction_reference = '123456'; // A unique transaction reference number

// Set the callback URL where MPESA will send the payment status notification
$callback_url = 'https://yourwebsite.com/mpesa/callback.php';

// Set the request headers
$headers = array(
    'Authorization: Basic ' . base64_encode($api_key . ':' . $api_secret),
    'Content-Type: application/json'
);

// Set the request body
$request_body = array(
    'BusinessShortCode' => $business_short_code,
    'Password' => base64_encode($business_short_code . $api_key . $api_secret),
    'Timestamp' => date('YmdHis'),
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $amount,
    'PartyA' => $phone_number,
    'PartyB' => $business_short_code,
    'PhoneNumber' => $phone_number,
    'CallBackURL' => $callback_url,
    'AccountReference' => 'YOUR_BUSINESS_NAME',
    'TransactionDesc' => 'YOUR_TRANSACTION_DESCRIPTION',
    'Remark' => 'YOUR_REMARK'
);

// Convert the request body to JSON format
$request_body_json = json_encode($request_body);

// Make the API request using cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Parse the API response
$response_json = json_decode($response, true);

// Check if the API request was successful
if(isset($response_json['ResponseCode']) && $response_json['ResponseCode'] == '0') {
    // The API request was successful, so redirect the customer to the payment page
    $checkout_url = $response_json['CheckoutRequestID'];
    header('Location: https://sandbox.safaricom.co.ke/mpesa/stkpush?checkoutRequestID=' . $checkout_url . '&merchantRequestID=' . $transaction_reference);
} else {
    // The API request failed, so display an error message to the customer
    echo 'Payment request failed: ' . $response_json['errorMessage'];
}
?>
