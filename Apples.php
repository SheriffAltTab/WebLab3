<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Використання класів яблука</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Яблука</h1>

<?php

class Apple
{
    public $color;
    public $size;
    public static $apples = [];
    public $fallen_time;

    public function __construct($color)
    {
        $this->color = ucfirst($color);
        $this->size = 1;
        $this->fallen_time = time();
        self::$apples[] = $this;
    }

    public function eat($percent)
    {
        $this->size -= $percent / 100;
        if ($this->size <= 0) {
            $this->size = 0;
        }
    }

    public function fall_to_ground()
    {
        $this->fallen_time = time();
    }

    public static function lost_hour()
    {
        $current_time = time();
        foreach (self::$apples as $apple) {
            $fallen_hours = ($current_time - $apple->fallen_time) / 3600;
            if ($fallen_hours >= 5) {
                $apple->size = 0;
            }
        }
    }

    public function is_spoiled()
    {
        return $this->size <= 0;
    }

    public function __toString()
    {
        $status = $this->is_spoiled() ? "зіпсоване" : "можна з'їсти";
        return "<p>Яблуко: {$this->color}, розмір: {$this->size}, стан: {$status}</p>";
    }
}


$apple_1 = new Apple('green');


echo $apple_1;

$apple_1->eat(50);
echo "<p>Яблуко вкусили, залишилось: {$apple_1->size}</p>";

$apple_1->fall_to_ground();
echo "<p>Яблуко впало</p>";
echo "<p>Яблуко вкусили, залишилось: ";
$apple_1->eat(25);
echo $apple_1->size . "</p>";

Apple::lost_hour();

echo $apple_1;

$apple_2 = new Apple('red');


echo $apple_2;





$apple_1->fall_to_ground();
echo "<p>Яблуко впало</p>";
echo "<p>Яблуко вкусили, залишилось: ";
$apple_1->eat(100);
echo $apple_1->size . "</p>";

Apple::lost_hour();

echo $apple_1;
?>

<div class="footer">
    <a href="index.html" class="button">Назад</a>
</div>
</body>
</html>