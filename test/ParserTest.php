<?php
/**
 * Created by PhpStorm.
 * User: TBoll
 * Date: 11.07.2018
 * Time: 18:14
 */

require_once "../vendor/autoload.php";
use tbollmeier\parsian\input\CharInput;
use PHPUnit\Framework\TestCase;

define("DEBUG", false);

class ParserTest extends TestCase {

    private $parser;

    protected function setUp()
    {
        parent::setUp();
        $this->parser = new tbollmeier\minijava\MiniJavaParser();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->parser = null;
    }

    public function testParseFiles()
    {
        $this->parseFile("data\BinarySearch.minijava");
        $this->parseFile("data\Factorial.minijava");
        $this->parseFile("data\TreeVisitor.minijava");
    }

    private function parseFile($filePath)
    {
        $ast = $this->parser->parseFile($filePath);

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
