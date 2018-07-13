<?php
/**
 * Created by PhpStorm.
 * User: TBoll
 * Date: 11.07.2018
 * Time: 18:14
 */

require_once "../vendor/autoload.php";

$parser = new tbollmeier\minijava\MiniJavaParser();

$code = <<<CODE
class Main {
    /* This is a /* nested */ comment */
    public static void main(String[] args) {
        System.out.println (42);
    }
}

class Person {
    
    boolean isMale;
    int age;
    
    public int getAge() {
        return age;
    }
    
    public boolean isMale() {
        return isMale;
    }
    
}

class Employee extends Person {

    int[] elements;
    
    public int set_element(int i, int value) {
        elements[i] = value;
        return 0;
    }

}
CODE;

echo $code . "\n";

$ast = $parser->parseString($code);

if ($ast !== false) {
    echo $ast->toXml();
} else {
    echo $parser->error();
}