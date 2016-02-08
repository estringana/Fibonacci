<?php

namespace Acme\DBAdaptors;

/**
 * The following class implement the DB layer by using the file system
 * @category Free_Time
 * @package Fibonacci
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @author Alejandro Estringana <estringana@gmail.com>
 */
class FileSystemDB implements DBAdapter
{
      /**
     * @var Default path where the fibonacci number will be saved
     */
    const PATH_TO_VALUES = './';

    /**
    * Parth where the fibonacci numbers will be saved
    * @var string
    */
    protected $_path_to_values;

   /**
    * Constructor
    *
    * @param string $path_to_values OPTIONAL. Specifies a folder where we want to save the fibonacci numbers
    * 
    * @return void
    */
    function __construct($path_to_values = self::PATH_TO_VALUES)
    {
        $this->_path_to_values = $path_to_values;
    }

    /**
     * Save the value into the position specified
     * 
    * @param int $position of the fibonacci numbers we want to save
    * @param int $value of the fibonacci numbers we want to save
    *
    * @return void
    */
    public function save($position, $value)
    {
        file_put_contents(
            $this->_getPathToFileFromPosition($position), 
            $value
        );
    }

   /**
    * Check if the position exists on the DB
    * 
    * @param int $position of the fibonacci numbers we want to check
    *
    *
    * @return boolean
    */
    public function exists($position)
    {
        return file_exists($this->_getPathToFileFromPosition($position));
    }

    /**
    * Get the value on the position specified
    * 
    * @param int $position of the fibonacci numbers we want to get
    *
    * @throws \Acme\Exceptions\DB\PositionNotFoundException()
    *
    * @return sring
    */
    public function get($position)
    {
        if (! $this->exists($position)) {
            throw new \Acme\Exceptions\DB\PositionNotFoundException();            
        }

        return file_get_contents($this->_getPathToFileFromPosition($position));
    }

    /**
     * Return the path used as file system DB
     * 
    * @param int $position of the fibonacci numbers we want to get the path
    *
    * @return string
    */
    protected function _getPathToFileFromPosition($position)
    {
        return $this->_path_to_values.$position;
    }

     /**
     * Check if the path is a hidden file/directory
     * 
    * @param DirectoryIterator $filepath to be checked
    *
    * @return boolean
    */
    protected function _isHidden(\DirectoryIterator $filepath)
    {
        return $filepath->isDot();
    }

   /**
    * Remove all the fibonacci numbers generated
    * 
    * @return void
    */
    public function reset()
    {
        foreach (new \DirectoryIterator($this->_path_to_values) as $fileInfo) {
            if (! $this->_isHidden($fileInfo)) {
                unlink($fileInfo->getPathname());
            }
        }
    }

    /**
    * Return all the values on the db
    *
    * @return array
    */
    public function getAll()
    {
        $array_result = array();

        foreach (new \DirectoryIterator($this->_path_to_values) as $fileInfo) {
            if (! $this->_isHidden($fileInfo)) {
                $array_result[$fileInfo->getBasename()]
                    = file_get_contents($fileInfo->getPathname());
            }
        }

        return $array_result;
    }
}