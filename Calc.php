<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Калькулятор</h1>
<form method="post">
    <div class="inputs">
        <input type="number" name="a" placeholder="Введіть перше число">
        <select name="operation">
            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
            <option value="sqrt">√</option>
            <option value="pow">^</option>
            <option value="percent">%</option>
        </select>
        <input type="number" name="b" placeholder="Введіть друге число">
    </div>
    <button type="submit" class="button">Обчислити</button>
</form>

<?php

class Calc {

    private function checkNumber($number) {
        if (!is_numeric($number)) {
            throw new Exception("Невірний формат числа: $number");
        }
    }

    public function add($a, $b) {
        $this->checkNumber($a);
        $this->checkNumber($b);
        return $a + $b;
    }

    public function subtract($a, $b) {
        $this->checkNumber($a);
        $this->checkNumber($b);
        return $a - $b;
    }

    public function multiply($a, $b) {
        $this->checkNumber($a);
        $this->checkNumber($b);
        return $a * $b;
    }

    public function divide($a, $b) {
        $this->checkNumber($a);
        $this->checkNumber($b);
        if ($b == 0) {
            throw new Exception("Ділення на нуль!");
        }
        return $a / $b;
    }

    public function modulo($a, $b) {
        $this->checkNumber($a);
        $this->checkNumber($b);
        return $a % $b;
    }

    public function sqrt($a) {
        $this->checkNumber($a);
        if ($a < 0) {
            throw new Exception("Не можна добувати квадратний корінь з від'ємного числа!");
        }
        return sqrt($a);
    }

    public function pow($a, $b) {
        $this->checkNumber($a);
        $this->checkNumber($b);
        return pow($a, $b);
    }

    public function percent($a, $b) {
        $this->checkNumber($a);
        $this->checkNumber($b);
        return $a * $b / 100;
    }
}

class CalcDispatcher {

private $calc;

public function __construct() {
    $this->calc = new Calc();
}

public function display() {
?>

<?php
if (isset($_POST['a']) && isset($_POST['b']) && isset($_POST['operation'])) {
    try {
        $a = $_POST['a'];
        $b = $_POST['b'];
        $operation = $_POST['operation'];

        $result = null;
        switch ($operation) {
            case 'add':
                $result = $this->calc->add($a, $b);
                break;
            case 'subtract':
                $result = $this->calc->subtract($a, $b);
                break;
            case 'multiply':
                $result = $this->calc->multiply($a, $b);
                break;
            case 'divide':
                $result = $this->calc->divide($a, $b);
                break;
            case 'sqrt':
                $result = "√($a) = " . $this->calc->sqrt($a) . "<br>√($b) = " . $this->calc->sqrt($b);
                break;
            case 'pow':
                $result = $this->calc->pow($a, $b);
                break;
            case 'percent':
                $result = $this->calc->percent($a, $b);
                break;
        }

        echo "<p class='result'>Результат: $result</p>";
    } catch (Exception $e) {
        echo "<p style='color: red'>" . $e->getMessage() . "</p>";
    }
}
    ?>

    <?php
}
}

$dispatcher = new CalcDispatcher();
$dispatcher->display();

?>

<div class="footer">
    <a href="index.html" class="button">Назад</a>
</div>
</body>
</html>