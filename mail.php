<?php
$to      = 'vivek.cpp@gmail.com';
$subject = 'Fake sendmail test';
$message = 'If we can read this, it means that our fake Sendmail setup works!';
$headers = 'From: vivek.cpp@gmail.com' . "\r\n" .
           'Reply-To: vivek.cpp@gmail.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

$this_mail = mail($to, $subject, $message, $headers);

if($this_mail) {
    echo 'Email Sent Successfully';
} else {
    echo "NOt Sent";
}

?>