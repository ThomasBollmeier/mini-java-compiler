<?php
/**
 * Created by PhpStorm.
 * User: TBoll
 * Date: 11.07.2018
 * Time: 18:14
 */

require_once "../vendor/autoload.php";

$parser = new tbollmeier\minijava\MiniJavaBaseParser();

$code = <<<CODE
class Main {
    /* This is a /* nested */ comment */
    public static void main(String[] args) {
        start = 1;
    }
}

class Person {
}

class Employee extends Person {
}
CODE;

echo $code . "\n";

$ast = $parser->parseString($code);

if ($ast !== false) {
    echo $ast->toXml();
} else {
    echo $parser->error();
}
