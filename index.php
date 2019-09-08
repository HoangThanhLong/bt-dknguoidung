<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post">
    <fieldset>
        <legend>Details</legend>
        Tên người dùng <input type="text" name="name">
        <br><br>
        Email <input type="text" name="email">
        <br><br>
        Điện thoại <input type="text" name="phone">
        <br><br>
        <input type="submit" name="submit">
    </fieldset>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
}
if (empty($name) || empty($email) || empty($phone))
    echo "Input please";
else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    echo "Email wrong, please again!";
else {
    if (file_exists('mongan.json')) {
        //lấy file json
        $current_data = file_get_contents('mongan.json');
        //chuyển file json thành mảng
        $array_data = json_decode($current_data, true);
        $mogan = array(
            "name" => $name,
            "email" => $email,
            "phone" => $phone);
        array_push($array_data, $mogan);
        // chuyển mảng thành định dạng file json
        $final = json_encode($array_data);
        file_put_contents('mongan.json', $final);
        echo "Good";
    } else
        echo "Faile, again!";
}
function registerUser($name, $email, $phone)
{
    $array = [];
    array_push($array, "$name", "$email", "$phone");
    return $array;
}
registerUser($name, $email, $phone);
?>
</body>
</html>
