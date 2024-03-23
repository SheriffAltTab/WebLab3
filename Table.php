<?php

class TableMultiplication {
    private $number;

    public function __construct($number) {
        $this->number = $number;
    }

    public function calculate() {
        $result = [];
        for ($i = 1; $i <= $this->number; $i++) {
            $result[$i] = [];
            for ($j = 1; $j <= $this->number; $j++) {
                $result[$i][$j] = $i * $j;
            }
        }
        return $result;
    }

    public function printTable() {
        $table = $this->calculate();
        echo "<table>";
        echo "<tr><th></th>";
        for ($i = 1; $i <= $this->number; $i++) {
            echo "<th>$i</th>";
        }
        echo "</tr>";
        foreach ($table as $i => $row) {
            echo "<tr><td>$i</td>";
            foreach ($row as $j => $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
}

$table1 = new TableMultiplication(5);
$table1->printTable();

echo "<br>";

$table2 = new TableMultiplication(10);
$table2->printTable();
