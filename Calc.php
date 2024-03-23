<?php

class Calc {
    private $errors = [];

    public function add($a, $b) {
        if (!is_numeric($a) || !is_numeric($b)) {
            $this->errors[] = 'Введені не числа.';
            return;
        }
        return $a + $b;
    }

    public function subtract($a, $b) {
        if (!is_numeric($a) || !is_numeric($b)) {
            $this->errors[] = 'Введені не числа.';
            return;
        }
        return $a - $b;
    }

    public function multiply($a, $b) {
        if (!is_numeric($a) || !is_numeric($b)) {
            $this->errors[] = 'Введені не числа.';
            return;
        }
        return $a * $b;
    }

    public function divide($a, $b) {
        if (!is_numeric($a) || !is_numeric($b)) {
            $this->errors[] = 'Введені не числа.';
            return;
        }
        if ($b === 0) {
            $this->errors[] = 'Ділення на 0 неможливе.';
            return;
        }
        return $a / $b;
    }

    public function modulo($a, $b) {
        if (!is_numeric($a) || !is_numeric($b)) {
            $this->errors[] = 'Введені не числа.';
            return;
        }
        return $a % $b;
    }

    public function sqrt($a) {
        if (!is_numeric($a)) {
            $this->errors[] = 'Введене не число.';
            return;
        }
        if ($a < 0) {
            $this->errors[] = 'Корінь квадратний з від`ємного числа не існує.';
      return;
    }
    return sqrt($a);
  }

  public function pow($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
      $this->errors[] = 'Введені не числа.';
      return;
    }
    return pow($a, $b);
  }

  public function getErrors() {
    return $this->errors;
  }
}

class CalcDispatcher {
  private $calc;

  public function __construct() {
    $this->calc = new Calc();
  }

  public function display() {
    $result = null;
    $errors = [];

    if (isset($_POST['operation']) && isset($_POST['a']) && isset($_POST['b'])) {
      $operation = $_POST['operation'];
      $a = $_POST['a'];
      $b = $_POST['b'];

      switch ($operation) {
        case '+':
          $result = $this->calc->add($a, $b);
          break;
        case '-':
          $result = $this->calc->subtract($a, $b);
          break;
        case '*':
          $result = $this->calc->multiply($a, $b);
          break;
        case '/':
          $result = $this->calc->divide($a, $b);
          break;
        case '%':
          $result = $this->calc->modulo($a, $b);
          break;
        case 'sqrt':
          $result = $this->calc->sqrt($a);
          break;
        case '^':
          $result = $this->calc->pow($a, $b);
          break;
      }

      $errors = $this->calc->getErrors();
    }

    ?>

    <!DOCTYPE html>
    <html lang="uk">
    <head>
      <meta charset="UTF-8">
      <title>Калькулятор</title>
    </head>
    <body>
      <h1>Калькулятор</h1>
      <form method="post">
        <input type="number" name="a" placeholder="Введіть перше число">
        <select name="operation">
          <option value="+">+</option>
          <option value="-">-</option>
          <option value="*">*</option>
          <option value="/">/</option>
            <option value="%">%</option>
            <option value="sqrt">√</option>
            <option value="^">^</option>
        </select>
          <input type="number" name="b" placeholder="Введіть друге число">
          <button type="submit">Рахувати</button>
      </form>

      <?php if ($errors): ?>
          <ul class="errors">
              <?php foreach ($errors as $error): ?>
                  <li><?= $error ?></li>
              <?php endforeach; ?>
          </ul>
      <?php endif; ?>

      <?php if (isset($result)): ?>
          <p>Результат: <?= $result ?></p>
      <?php endif; ?>
    </body>
      </html>

      <?php
  }
}

$dispatcher = new CalcDispatcher();
$dispatcher->display();

?>
