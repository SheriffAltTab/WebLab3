<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список країн</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Список країн</h1>
<div class="table-container">
    <?php

    class Country {
        private $name;
        private $population;
        private $capital;

        public function __construct($name, $population, $capital) {
            $this->name = $name;
            $this->population = $population;
            $this->capital = $capital;
        }

        public function getName() {
            return $this->name;
        }

        public function getPopulation() {
            return $this->population;
        }

        public function getCapital() {
            return $this->capital;
        }
    }

    $countries = [
        new Country("United Kingdom", 67220000, "London"),
        new Country("United States of America", 332403650, "Washington D.C."),
        new Country("France", 65273111, "Paris"),
        new Country("Germany", 84270000, "Berlin"),
        new Country("Canada", 38012777, "Ottawa"),
    ];

    echo "<table border='1'>";
    echo "<tr><th>Назва</th><th>Населення</th><th>Столиця</th></tr>";
    foreach ($countries as $country) {
        echo "<tr><td>{$country->getName()}</td><td>{$country->getPopulation()}</td><td>{$country->getCapital()}</td></tr>";
    }
    echo "</table>";

    ?>
</div>
<div class="footer">
    <a href="index.html" class="button">Назад</a>
</div>
</body>
</html>
