<?php

namespace Acme\Generator;

use Acme\Exceptions\InvalidPositionException;
use Acme\DBAdaptors\DBAdapter;

/**
 * Main class of fibonacci which generates fibonacci numbers
 * @category Free_Time
 * @package Fibonacci
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @author Alejandro Estringana <estringana@gmail.com>
 */
class Fibonacci
{ 
    protected $_db;    

    function __construct(DBAdapter $db)
    {
        $this->_db = $db;
    }    

    protected function isValidPosition($position)
    {
        return $position > 0;
    }

    protected function _generate($positionToGenerate)
    {
        if ($positionToGenerate > 2 ) {
            $previous_position = $positionToGenerate - 1;
            $previous_to_previous_position = $positionToGenerate - 2;

            $this->_generateIfNotExist($previous_position);
            $this->_generateIfNotExist($previous_to_previous_position);    

            $this->_db->save(
                $positionToGenerate,
                $this->_db->get($previous_position) + 
                 $this->_db->get($previous_to_previous_position)
            );
        } else {
            $this->_db->save($positionToGenerate, 1);        
        }
    }    

    protected function _generateIfNotExist($position)
    {
        if (! $this->_db->exists($position) ) {
            $this->_generate($position);
        }
    }    

    public function generate($positionToGenerate)
    {
        $result = false;    

        if (! $this->isValidPosition($positionToGenerate)) {
            throw new InvalidPositionException();
        }    

        $this->_generateIfNotExist($positionToGenerate);

        return (int) $this->_db->get($positionToGenerate);
    }
}
