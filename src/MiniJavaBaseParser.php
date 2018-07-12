<?php
/* This file has been generated by the Parsian parser generator 
 * (see http://github.com/thomasbollmeier/parsian)
 * 
 * DO NOT EDIT THIS FILE!
 */
namespace tbollmeier\minijava;

use tbollmeier\parsian as parsian;


class MiniJavaBaseParser extends parsian\Parser
{
    public function __construct()
    {
        parent::__construct();

        $this->configLexer();
        $this->configGrammar();
    }

    private function configLexer()
    {

        $lexer = $this->getLexer();

        $lexer->addCommentType("//", "\n");
        $lexer->addCommentType("/*", "*/", true);


        $lexer->addSymbol("{", "LBRACE");
        $lexer->addSymbol("}", "RBRACE");
        $lexer->addSymbol("(", "LPAR");
        $lexer->addSymbol(")", "RPAR");
        $lexer->addSymbol("[", "LSQBR");
        $lexer->addSymbol("]", "RSQBR");
        $lexer->addSymbol("=", "EQ");
        $lexer->addSymbol(";", "SEMICOLON");

        $lexer->addTerminal("/[a-zA-Z_][a-zA-Z_0-9]*/", "ID");
        $lexer->addTerminal("/\d+/", "INT");

        $lexer->addKeyword("class");
        $lexer->addKeyword("public");
        $lexer->addKeyword("static");
        $lexer->addKeyword("void");
        $lexer->addKeyword("main");
        $lexer->addKeyword("String");
        $lexer->addKeyword("class");
        $lexer->addKeyword("extends");
        $lexer->addKeyword("this");

    }

    private function configGrammar()
    {

        $grammar = $this->getGrammar();

        $grammar->rule("goal",
            $this->seq_1(),
            true);
        $grammar->rule("main_class",
            $this->seq_2(),
            false);
        $grammar->rule("class_decl",
            $this->seq_3(),
            false);
        $grammar->rule("statement",
            $this->alt_1(),
            false);
        $grammar->rule("block_stmt",
            $this->seq_5(),
            false);
        $grammar->rule("assignment",
            $this->seq_6(),
            false);
        $grammar->rule("expr",
            $this->alt_2(),
            false);

    }

    private function alt_1()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($grammar->ruleRef("block_stmt"))
            ->add($grammar->ruleRef("assignment"));
    }

    private function alt_2()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($grammar->term("ID"))
            ->add($grammar->term("INT"))
            ->add($grammar->term("THIS"));
    }


    private function seq_1()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("main_class"))
            ->add($grammar->many($grammar->ruleRef("class_decl")));
    }

    private function seq_2()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("CLASS"))
            ->add($grammar->term("ID", "clsname"))
            ->add($grammar->term("LBRACE"))
            ->add($grammar->term("PUBLIC"))
            ->add($grammar->term("STATIC"))
            ->add($grammar->term("VOID"))
            ->add($grammar->term("MAIN"))
            ->add($grammar->term("LPAR"))
            ->add($grammar->term("STRING"))
            ->add($grammar->term("LSQBR"))
            ->add($grammar->term("RSQBR"))
            ->add($grammar->term("ID", "args"))
            ->add($grammar->term("RPAR"))
            ->add($grammar->term("LBRACE"))
            ->add($grammar->ruleRef("statement"))
            ->add($grammar->term("RBRACE"))
            ->add($grammar->term("RBRACE"));
    }

    private function seq_3()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("CLASS"))
            ->add($grammar->term("ID", "clsname"))
            ->add($grammar->opt($this->seq_4()))
            ->add($grammar->term("LBRACE"))
            ->add($grammar->term("RBRACE"));
    }

    private function seq_4()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("EXTENDS"))
            ->add($grammar->term("ID", "super"));
    }

    private function seq_5()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("LBRACE"))
            ->add($grammar->many($grammar->ruleRef("statement")))
            ->add($grammar->term("RBRACE"));
    }

    private function seq_6()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("ID"))
            ->add($grammar->term("EQ"))
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->term("SEMICOLON"));
    }


}