<?php
namespace App\Doctrine;

use Doctrine\ORM\Query\Lexer;

/**
 * Allows usage of rand() in doctrine
 */
class Rand extends \Doctrine\ORM\Query\AST\Functions\FunctionNode
{

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return 'RAND()';
    }
}