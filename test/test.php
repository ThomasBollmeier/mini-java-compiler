<?php
/**
 * Created by PhpStorm.
 * User: TBoll
 * Date: 11.07.2018
 * Time: 18:14
 */

require_once "../vendor/autoload.php";

$parser = new tbollmeier\minijava\MiniJavaParser();

function showTokens(tbollmeier\parsian\Parser $parser, $code)
{
    $lexer = $parser->getLexer();
    $tokenStream = $lexer->createTokenInput(new \tbollmeier\parsian\input\StringCharInput($code));

    $tokenStream->open();
    while ($tokenStream->hasMoreTokens()) {
        $token = $tokenStream->nextToken();
        echo $token . "\n";
    }
    $tokenStream->close();

}

/**
 * @param $parser
 * @param $code
 */
function showAst($parser, $code): void
{
    $ast = $parser->parseString($code);

    if ($ast !== false) {
        echo $ast->toXml();
    } else {
        echo $parser->error();
    }
}

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
    Person manager;
    boolean isFemale;
    
    public int set_element(int i, int value) {
        elements[i] = value + elements.length;
        manager = new Person();
        isFemale = !(new Person().isMale());
        return 0;
    }

}
CODE;

echo $code . "\n";

//showTokens($parser, $code);
showAst($parser, $code);
