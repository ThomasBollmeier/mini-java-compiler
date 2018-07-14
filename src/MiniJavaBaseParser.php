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


        $lexer->addSymbol("&&", "AND");
        $lexer->addSymbol("<", "LT");
        $lexer->addSymbol("+", "PLUS");
        $lexer->addSymbol("-", "MINUS");
        $lexer->addSymbol("*", "MULT");
        $lexer->addSymbol("{", "LBRACE");
        $lexer->addSymbol("}", "RBRACE");
        $lexer->addSymbol("(", "LPAR");
        $lexer->addSymbol(")", "RPAR");
        $lexer->addSymbol("[", "LSQBR");
        $lexer->addSymbol("]", "RSQBR");
        $lexer->addSymbol("=", "EQ");
        $lexer->addSymbol("\.", "DOT");
        $lexer->addSymbol(";", "SEMICOLON");
        $lexer->addSymbol(",", "COMMA");
        $lexer->addSymbol("!", "EXCL_MARK");

        $lexer->addTerminal("/System\.out\.println/", "PRINT");
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
        $lexer->addKeyword("public");
        $lexer->addKeyword("return");
        $lexer->addKeyword("int");
        $lexer->addKeyword("boolean");
        $lexer->addKeyword("if");
        $lexer->addKeyword("else");
        $lexer->addKeyword("while");
        $lexer->addKeyword("length");
        $lexer->addKeyword("this");
        $lexer->addKeyword("true");
        $lexer->addKeyword("false");
        $lexer->addKeyword("new");
        $lexer->addKeyword("int");

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
        $grammar->rule("main_signature",
            $this->seq_3(),
            false);
        $grammar->rule("class_decl",
            $this->seq_4(),
            false);
        $grammar->rule("var_decl",
            $this->seq_6(),
            false);
        $grammar->rule("method_decl",
            $this->seq_7(),
            false);
        $grammar->rule("method_signature",
            $this->seq_8(),
            false);
        $grammar->rule("type",
            $this->alt_1(),
            false);
        $grammar->rule("statement",
            $this->alt_2(),
            false);
        $grammar->rule("block_stmt",
            $this->seq_13(),
            false);
        $grammar->rule("if_stmt",
            $this->seq_14(),
            false);
        $grammar->rule("while_stmt",
            $this->seq_15(),
            false);
        $grammar->rule("print_stmt",
            $this->seq_16(),
            false);
        $grammar->rule("assignment",
            $this->seq_17(),
            false);
        $grammar->rule("expr",
            $grammar->ruleRef("binary_expr"),
            false);
        $grammar->rule("binary_expr",
            $this->seq_19(),
            false);
        $grammar->rule("operator",
            $this->alt_3(),
            false);
        $grammar->rule("op_expr",
            $this->seq_21(),
            false);
        $grammar->rule("base_expr",
            $this->alt_6(),
            false);
        $grammar->rule("bool_expr",
            $this->alt_7(),
            false);
        $grammar->rule("constructor_call",
            $this->seq_23(),
            false);
        $grammar->rule("negation",
            $this->seq_26(),
            false);
        $grammar->rule("group",
            $this->seq_27(),
            false);
        $grammar->rule("elem_access",
            $this->seq_28(),
            false);
        $grammar->rule("call",
            $this->seq_29(),
            false);

    }

    private function alt_1()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($this->seq_11())
            ->add($grammar->term("BOOLEAN"))
            ->add($grammar->term("ID"));
    }

    private function alt_2()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($grammar->ruleRef("block_stmt"))
            ->add($grammar->ruleRef("if_stmt"))
            ->add($grammar->ruleRef("while_stmt"))
            ->add($grammar->ruleRef("print_stmt"))
            ->add($grammar->ruleRef("assignment"));
    }

    private function alt_3()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($grammar->term("AND"))
            ->add($grammar->term("LT"))
            ->add($grammar->term("PLUS"))
            ->add($grammar->term("MINUS"))
            ->add($grammar->term("MULT"));
    }

    private function alt_4()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($this->seq_22())
            ->add($grammar->oneOrMore($this->alt_5()));
    }

    private function alt_5()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($grammar->ruleRef("elem_access"))
            ->add($grammar->ruleRef("call"));
    }

    private function alt_6()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($grammar->term("INT"))
            ->add($grammar->ruleRef("bool_expr"))
            ->add($grammar->term("ID"))
            ->add($grammar->term("THIS"))
            ->add($grammar->ruleRef("constructor_call"))
            ->add($grammar->ruleRef("negation"))
            ->add($grammar->ruleRef("group"));
    }

    private function alt_7()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($grammar->term("TRUE"))
            ->add($grammar->term("FALSE"));
    }

    private function alt_8()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($this->seq_24())
            ->add($this->seq_25());
    }


    private function seq_1()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("main_class"))
            ->add($grammar->many($grammar->ruleRef("class_decl")));
    }

    private function seq_10()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("COMMA"))
            ->add($grammar->ruleRef("type"))
            ->add($grammar->term("ID"));
    }

    private function seq_11()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("INT"))
            ->add($grammar->opt($this->seq_12()));
    }

    private function seq_12()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("LSQBR", "array"))
            ->add($grammar->term("RSQBR"));
    }

    private function seq_13()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("LBRACE"))
            ->add($grammar->many($grammar->ruleRef("statement")))
            ->add($grammar->term("RBRACE"));
    }

    private function seq_14()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("IF"))
            ->add($grammar->term("LPAR"))
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->term("RPAR"))
            ->add($grammar->ruleRef("statement"))
            ->add($grammar->term("ELSE"))
            ->add($grammar->ruleRef("statement"));
    }

    private function seq_15()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("WHILE"))
            ->add($grammar->term("LPAR"))
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->term("RPAR"))
            ->add($grammar->ruleRef("statement"));
    }

    private function seq_16()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("PRINT"))
            ->add($grammar->term("LPAR"))
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->term("RPAR"))
            ->add($grammar->term("SEMICOLON"));
    }

    private function seq_17()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("ID"))
            ->add($grammar->opt($this->seq_18()))
            ->add($grammar->term("EQ"))
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->term("SEMICOLON"));
    }

    private function seq_18()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("LSQBR"))
            ->add($grammar->ruleRef("expr", "idx"))
            ->add($grammar->term("RSQBR"));
    }

    private function seq_19()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("op_expr", "op1"))
            ->add($grammar->opt($this->seq_20()));
    }

    private function seq_2()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("CLASS"))
            ->add($grammar->term("ID", "clsname"))
            ->add($grammar->term("LBRACE"))
            ->add($grammar->ruleRef("main_signature"))
            ->add($grammar->term("LBRACE"))
            ->add($grammar->ruleRef("statement"))
            ->add($grammar->term("RBRACE"))
            ->add($grammar->term("RBRACE"));
    }

    private function seq_20()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("operator"))
            ->add($grammar->ruleRef("expr", "op2"));
    }

    private function seq_21()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("base_expr"))
            ->add($grammar->opt($this->alt_4()));
    }

    private function seq_22()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("DOT"))
            ->add($grammar->term("LENGTH"));
    }

    private function seq_23()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("NEW"))
            ->add($this->alt_8());
    }

    private function seq_24()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("INT"))
            ->add($grammar->term("LSQBR"))
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->term("RSQBR"));
    }

    private function seq_25()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("ID"))
            ->add($grammar->term("LPAR"))
            ->add($grammar->term("RPAR"));
    }

    private function seq_26()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("EXCL_MARK"))
            ->add($grammar->ruleRef("expr"));
    }

    private function seq_27()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("LPAR"))
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->term("RPAR"));
    }

    private function seq_28()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("LSQBR"))
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->term("RSQBR"));
    }

    private function seq_29()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("DOT"))
            ->add($grammar->term("ID"))
            ->add($grammar->term("LPAR"))
            ->add($grammar->opt($this->seq_30()))
            ->add($grammar->term("RPAR"));
    }

    private function seq_3()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("PUBLIC"))
            ->add($grammar->term("STATIC"))
            ->add($grammar->term("VOID"))
            ->add($grammar->term("MAIN"))
            ->add($grammar->term("LPAR"))
            ->add($grammar->term("STRING"))
            ->add($grammar->term("LSQBR"))
            ->add($grammar->term("RSQBR"))
            ->add($grammar->term("ID", "args"))
            ->add($grammar->term("RPAR"));
    }

    private function seq_30()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->many($this->seq_31()));
    }

    private function seq_31()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("COMMA"))
            ->add($grammar->ruleRef("expr"));
    }

    private function seq_4()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("CLASS"))
            ->add($grammar->term("ID", "clsname"))
            ->add($grammar->opt($this->seq_5()))
            ->add($grammar->term("LBRACE"))
            ->add($grammar->many($grammar->ruleRef("var_decl")))
            ->add($grammar->many($grammar->ruleRef("method_decl")))
            ->add($grammar->term("RBRACE"));
    }

    private function seq_5()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("EXTENDS"))
            ->add($grammar->term("ID", "super"));
    }

    private function seq_6()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("type"))
            ->add($grammar->term("ID"))
            ->add($grammar->term("SEMICOLON"));
    }

    private function seq_7()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("PUBLIC"))
            ->add($grammar->ruleRef("type"))
            ->add($grammar->ruleRef("method_signature"))
            ->add($grammar->term("LBRACE"))
            ->add($grammar->many($grammar->ruleRef("var_decl")))
            ->add($grammar->many($grammar->ruleRef("statement")))
            ->add($grammar->term("RETURN"))
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->term("SEMICOLON"))
            ->add($grammar->term("RBRACE"));
    }

    private function seq_8()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("ID"))
            ->add($grammar->term("LPAR"))
            ->add($grammar->opt($this->seq_9()))
            ->add($grammar->term("RPAR"));
    }

    private function seq_9()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("type"))
            ->add($grammar->term("ID"))
            ->add($grammar->many($this->seq_10()));
    }


}
