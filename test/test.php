<?php
/**
 * Created by PhpStorm.
 * User: TBoll
 * Date: 11.07.2018
 * Time: 18:14
 */

require_once "../vendor/autoload.php";
use tbollmeier\parsian\Parser;
use tbollmeier\parsian\input\CharInput;

$parser = new tbollmeier\minijava\MiniJavaParser();

function showTokens(Parser $parser, CharInput $charIn)
{
    $lexer = $parser->getLexer();
    $tokenStream = $lexer->createTokenInput($charIn);

    $tokenStream->open();
    while ($tokenStream->hasMoreTokens()) {
        $token = $tokenStream->nextToken();
        echo $token . "\n";
    }
    $tokenStream->close();

}

/**
 * @param $parser
 * @param $filePath
 */
function showAst(Parser $parser, $filePath): void
{
    $ast = $parser->parseFile($filePath);

    if ($ast !== false) {
        echo $ast->toXml();
    } else {
        echo $parser->error();
    }
}

showAst($parser, "data\TreeVisitor.minijava");
