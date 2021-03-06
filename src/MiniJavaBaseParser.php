<?php
/** Copyright 2018- Thomas Bollmeier <entwickler@tbollmeier.de>
 *
 *   Licensed under the Apache License, Version 2.0 (the "License");
 *   you may not use this file except in compliance with the License.
 *   You may obtain a copy of the License at
 *
 *       http://www.apache.org/licenses/LICENSE-2.0
 *
 *   Unless required by applicable law or agreed to in writing, software
 *   distributed under the License is distributed on an "AS IS" BASIS,
 *   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *   See the License for the specific language governing permissions and
 *   limitations under the License.
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
            $this->goal(),
            true);
        $grammar->rule("main_class",
            $this->main_class(),
            false);
        $grammar->rule("main_signature",
            $this->main_signature(),
            false);
        $grammar->rule("class_decl",
            $this->class_decl(),
            false);
        $grammar->rule("var_decl",
            $this->var_decl(),
            false);
        $grammar->rule("method_decl",
            $this->method_decl(),
            false);
        $grammar->rule("method_signature",
            $this->method_signature(),
            false);
        $grammar->rule("type",
            $this->type(),
            false);
        $grammar->rule("statement",
            $this->statement(),
            false);
        $grammar->rule("block_stmt",
            $this->block_stmt(),
            false);
        $grammar->rule("if_stmt",
            $this->if_stmt(),
            false);
        $grammar->rule("while_stmt",
            $this->while_stmt(),
            false);
        $grammar->rule("print_stmt",
            $this->print_stmt(),
            false);
        $grammar->rule("assignment",
            $this->assignment(),
            false);
        $grammar->rule("expr",
            $grammar->ruleRef("binary_expr"),
            false);
        $grammar->rule("binary_expr",
            $this->binary_expr(),
            false);
        $grammar->rule("operator",
            $this->operator(),
            false);
        $grammar->rule("operand_expr",
            $this->operand_expr(),
            false);
        $grammar->rule("base_expr",
            $this->base_expr(),
            false);
        $grammar->rule("bool_expr",
            $this->bool_expr(),
            false);
        $grammar->rule("constructor_call",
            $this->constructor_call(),
            false);
        $grammar->rule("negation",
            $this->negation(),
            false);
        $grammar->rule("group",
            $this->group(),
            false);
        $grammar->rule("elem_access",
            $this->elem_access(),
            false);
        $grammar->rule("call",
            $this->call(),
            false);

    }

    private function alt_1()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($grammar->ruleRef("elem_access"))
            ->add($grammar->ruleRef("call"));
    }

    private function alt_2()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($this->seq_9())
            ->add($this->seq_10());
    }

    private function base_expr()
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

    private function bool_expr()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($grammar->term("TRUE"))
            ->add($grammar->term("FALSE"));
    }

    private function operator()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($grammar->term("AND"))
            ->add($grammar->term("LT"))
            ->add($grammar->term("PLUS"))
            ->add($grammar->term("MINUS"))
            ->add($grammar->term("MULT"));
    }

    private function statement()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($grammar->ruleRef("block_stmt"))
            ->add($grammar->ruleRef("if_stmt"))
            ->add($grammar->ruleRef("while_stmt"))
            ->add($grammar->ruleRef("print_stmt"))
            ->add($grammar->ruleRef("assignment"));
    }

    private function type()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($this->seq_4())
            ->add($grammar->term("BOOLEAN"))
            ->add($grammar->term("ID"));
    }


    private function assignment()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("ID"))
            ->add($grammar->opt($this->seq_6()))
            ->add($grammar->term("EQ"))
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->term("SEMICOLON"));
    }

    private function binary_expr()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("operand_expr", "op1"))
            ->add($grammar->opt($this->seq_7()));
    }

    private function block_stmt()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("LBRACE"))
            ->add($grammar->many($grammar->ruleRef("statement")))
            ->add($grammar->term("RBRACE"));
    }

    private function call()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("DOT"))
            ->add($grammar->term("ID"))
            ->add($grammar->term("LPAR"))
            ->add($grammar->opt($this->seq_11()))
            ->add($grammar->term("RPAR"));
    }

    private function class_decl()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("CLASS"))
            ->add($grammar->term("ID", "clsname"))
            ->add($grammar->opt($this->seq_1()))
            ->add($grammar->term("LBRACE"))
            ->add($grammar->many($grammar->ruleRef("var_decl")))
            ->add($grammar->many($grammar->ruleRef("method_decl")))
            ->add($grammar->term("RBRACE"));
    }

    private function constructor_call()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("NEW"))
            ->add($this->alt_2());
    }

    private function elem_access()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("LSQBR"))
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->term("RSQBR"));
    }

    private function goal()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("main_class"))
            ->add($grammar->many($grammar->ruleRef("class_decl")));
    }

    private function group()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("LPAR"))
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->term("RPAR"));
    }

    private function if_stmt()
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

    private function main_class()
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

    private function main_signature()
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

    private function method_decl()
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

    private function method_signature()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("ID"))
            ->add($grammar->term("LPAR"))
            ->add($grammar->opt($this->seq_2()))
            ->add($grammar->term("RPAR"));
    }

    private function negation()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("EXCL_MARK"))
            ->add($grammar->ruleRef("expr"));
    }

    private function operand_expr()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("base_expr"))
            ->add($grammar->many($this->alt_1()))
            ->add($grammar->opt($this->seq_8()));
    }

    private function print_stmt()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("PRINT"))
            ->add($grammar->term("LPAR"))
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->term("RPAR"))
            ->add($grammar->term("SEMICOLON"));
    }

    private function seq_1()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("EXTENDS"))
            ->add($grammar->term("ID", "super"));
    }

    private function seq_10()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("ID"))
            ->add($grammar->term("LPAR"))
            ->add($grammar->term("RPAR"));
    }

    private function seq_11()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->many($this->seq_12()));
    }

    private function seq_12()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("COMMA"))
            ->add($grammar->ruleRef("expr"));
    }

    private function seq_2()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("type"))
            ->add($grammar->term("ID"))
            ->add($grammar->many($this->seq_3()));
    }

    private function seq_3()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("COMMA"))
            ->add($grammar->ruleRef("type"))
            ->add($grammar->term("ID"));
    }

    private function seq_4()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("INT"))
            ->add($grammar->opt($this->seq_5()));
    }

    private function seq_5()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("LSQBR", "array"))
            ->add($grammar->term("RSQBR"));
    }

    private function seq_6()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("LSQBR"))
            ->add($grammar->ruleRef("expr", "idx"))
            ->add($grammar->term("RSQBR"));
    }

    private function seq_7()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("operator"))
            ->add($grammar->ruleRef("operand_expr", "op2"));
    }

    private function seq_8()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("DOT"))
            ->add($grammar->term("LENGTH"));
    }

    private function seq_9()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("INT"))
            ->add($grammar->term("LSQBR"))
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->term("RSQBR"));
    }

    private function var_decl()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("type"))
            ->add($grammar->term("ID"))
            ->add($grammar->term("SEMICOLON"));
    }

    private function while_stmt()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("WHILE"))
            ->add($grammar->term("LPAR"))
            ->add($grammar->ruleRef("expr"))
            ->add($grammar->term("RPAR"))
            ->add($grammar->ruleRef("statement"));
    }


}
