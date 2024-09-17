<?php
$to = "bravisx7@gmail.com"; // Ваш електронний адрес
$product = "Звернення"; // Тема листа

$name = stripslashes(htmlspecialchars($_POST['name'])); //Отримуємо значення ім'я
$email = stripslashes(htmlspecialchars($_POST['email'])); //Отримуємо значення пошта
$last_name = stripslashes(htmlspecialchars($_POST['last_name'])); //Отримуємо значення призвіща
$message = stripslashes(htmlspecialchars($_POST['message'])); //Отримуємо значення повідомлення

//Перевіряємо чи всі поля заповнені
if (empty($name) || empty($email)) {
    echo '<h1 style="color:red;">Будь ласка, заповніть всі поля</h1>';
    echo '<meta http-equiv="refresh" content="2; url=http://' . $_SERVER['SERVER_NAME'] . '">';
} 

else {
    $subject = 'Тема - "' . $product . '"'; // Заголовок листа
    $sender = "<test@gmail.com>"; // Адреса відправника
    $header = "Content-type:text/plain;charset=utf-8\r\nFrom: {$sender}\r\n"; //Встановлюємо заголовок для листа

    //Створюємо текст для листа
    $message = "
    Ім'я: {$name}\n
    Прізвище: {$last_name}\n
    Пошта: {$email}\n
    Повідомлення: {$message}\n\n
    Час відправки: " . date("m.d.Y H:i:s") . "\n\n
    Інформація про відправника:\n
    IP відправника: {$_SERVER['REMOTE_ADDR']}\n
    Встановлена мова: {$_SERVER['HTTP_ACCEPT_LANGUAGE']}\n
    Браузер і ОС: {$_SERVER['HTTP_USER_AGENT']}\n";

    //Відправляємо користувача на сторінку подяки
    $success_url = 'form.html?name=' . $name . '&last_name=' . $last_name . '&email=' . $email . '&message=' . $message . '';

    //Перевіряємо чи відправлено лист
    $verify = mail($to, $subject, $message, $header);
    if ($verify == 'true') {
        echo("<script>document.location.href = '{$success_url}';</script>");
        echo '<h1 style="color:green;">Ваше повідомлення прийнято!</h1>';
        exit;
    } else {
        echo '<h1 style="color:red;">Виникла помилка!</h1>';
    }
}
?>
