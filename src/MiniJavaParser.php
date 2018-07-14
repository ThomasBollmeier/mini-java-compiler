<?php
/**
 * Created by PhpStorm.
 * User: TBoll
 * Date: 13.07.2018
 * Time: 22:03
 */

namespace tbollmeier\minijava;


class MiniJavaParser extends MiniJavaBaseParser
{
    public function __construct()
    {
        parent::__construct();
        //$this->getLexer()->enableMultipleTypesPerToken();
    }
}