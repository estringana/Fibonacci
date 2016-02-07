<?php
namespace Acme\DBAdaptors;
/**
 * Interface which define the adapter pattern
 * @category Free_Time
 * @package Fibonacci
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @author Alejandro Estringana <estringana@gmail.com>
 */
interface DBAdapter
{
    public function save($position, $value);
    public function get($position);
    public function reset();
    public function exists($position);
    public function getAll();
}