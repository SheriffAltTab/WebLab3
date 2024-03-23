<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Форма користувача</title>
</head>
<body>
<h1>Форма користувача</h1>
<form action="User.php" method="post">
    <label for="lastName">Прізвище:</label>
    <input type="text" id="lastName" name="lastName" required>
    <br>
    <label for="firstName">Ім'я:</label>
    <input type="text" id="firstName" name="firstName" required>
    <br>
    <label for="age">Вік:</label>
    <input type="number" id="age" name="age" required>
    <br>
    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <br>
    <button type="submit">Готово</button>
</form>

<?php
class User {
    private $lastName;
    private $firstName;
    private $age;
    private $email;

    public function __construct($lastName, $firstName, $age, $email) {
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->age = $age;
        $this->email = $email;
    }

    public function setData($lastName, $firstName, $age, $email) {
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->age = $age;
        $this->email = $email;
    }

    public function getData() {
        echo "<p>Прізвище: $this->lastName</p>";
        echo "<p>Ім'я: $this->firstName</p>";
        echo "<p>Вік: $this->age</p>";
        echo "<p>E-mail: $this->email</p>";
    }
}

if (isset($_POST["lastName"]) && isset($_POST["firstName"]) && isset($_POST["age"]) && isset($_POST["email"])) {
    $lastName = $_POST["lastName"];
    $firstName = $_POST["firstName"];
    $age = $_POST["age"];
    $email = $_POST["email"];

    if (!empty($lastName) && !empty($firstName) && !empty($age) && !empty($email)) {
        $user = new User($lastName, $firstName, $age, $email);
        $user->getData();
    } else {
        echo "<p>Всі поля повинні бути заповнені!</p>";
    }
}
?>
</body>
</html>
