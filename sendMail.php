<?php

$message = "повідомлення.";
$firstName = "Rostyslav";

// Використовуємо змінну $firstName у тексті
$text1 = "firstName : {$firstName}";

// Інформація для листа
$to = "recipient@example.com";
$subject = "Заголовок листа";
$message = "текст листа";
$headers = "From: r.r.strakhov@student.khai.edu";

// Об'єднання інформації для виведення
$text = "{$to}\n{$subject}\n{$message}\n{$headers}";

echo nl2br(htmlspecialchars($text));

// Відправка листа
mail($to, $subject, $message, $headers);
?>
