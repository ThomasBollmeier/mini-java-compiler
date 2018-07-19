<?php
/**
 * Created by PhpStorm.
 * User: TBoll
 * Date: 11.07.2018
 * Time: 18:14
 */

namespace tbollmeier\minijava;

require_once "../vendor/autoload.php";
use tbollmeier\parsian\input\CharInput;
use PHPUnit\Framework\TestCase;

define("DEBUG", false);

class ParserTest extends TestCase {

    private $parser;

    protected function setUp()
    {
        parent::setUp();
        $this->parser = new MiniJavaParser();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->parser = null;
    }

    public function testParseFiles()
    {
        $this->parseFile("BinarySearch");
        $this->parseFile("BinaryTree");
        $this->parseFile("BubbleSort");
        $this->parseFile("Factorial");
        $this->parseFile("LinearSearch");
        $this->parseFile("LinkedList");
        $this->parseFile("QuickSort");
        $this->parseFile("TreeVisitor");
    }

    private function parseFile($fileName)
    {
        $ast = $this->parser->parseFile("data\\$fileName.minijava");

        $this->assertNotFalse($ast, $this->parser->error());

        if (DEBUG && $ast !== false) {
            echo $ast->toXml();
        }
    }

    private function showTokens(CharInput $charIn)
    {
        $lexer = $this->parser->getLexer();
        $tokenStream = $lexer->createTokenInput($charIn);

        $tokenStream->open();
        while ($tokenStream->hasMoreTokens()) {
            $token = $tokenStream->nextToken();
            echo $token . "\n";
        }
        $tokenStream->close();

    }

}
