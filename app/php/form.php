<?php

$fields = array('name' => 'Name', 'company' => 'Company', 'email' => 'Email', 'phone' => 'Phone');
$sendTo = 'kuzmin1913@gmail.com';
$from = $fields['email'];
// $from = '';
$subject = 'New Message Received';
$okMessage = 'SUCCESS';
$errorMessage = 'ERROR';

try
{
    $emailText = "Message from ___:<br>";

    foreach ($_POST as $key => $value) {

        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value"."<br>";
        }
    }

    $headers = array('Content-Type: text/html; charset="UTF-8";',
        'From: ' . $from,
        'Reply-To: ' . $from,
        'Return-Path: ' . $from,
    );

    mail($sendTo, $subject, $emailText, implode("\n", $headers));

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
else {
    echo $responseArray['message'];
}

?>