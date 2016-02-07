<?php

namespace Acme\DBAdaptors;

class FileSystemDB implements DBAdapter
{
    const PATH_TO_VALUES = './';

    protected $_path_to_values;

    function __construct($path_to_values = self::PATH_TO_VALUES)
    {
        $this->_path_to_values = $path_to_values;
    }

    public function save($position, $value)
    {
        file_put_contents(
            $this->_getPathToFileFromPosition($position), 
            $value
        );
    }

    public function exists($position)
    {
        return file_exists($this->_getPathToFileFromPosition($position));
    }

    public function get($position)
    {
        if (! $this->exists($position)) {
            throw new \Acme\Exceptions\DB\PositionNotFoundException();            
        }

        return file_get_contents($this->_getPathToFileFromPosition($position));
    }

    protected function _getPathToFileFromPosition($position)
    {
        return $this->_path_to_values.$position;
    }

    public function reset()
    {
        foreach (new \DirectoryIterator($this->_path_to_values) as $fileInfo) {
            if (! $fileInfo->isDot()) {
                unlink($fileInfo->getPathname());
            }
        }
    }

    public function getAll()
    {
        $array_result = array();

        foreach (new \DirectoryIterator($this->_path_to_values) as $fileInfo) {
            if (! $fileInfo->isDot()) {
                $array_result[$fileInfo->getBasename()]
                    = file_get_contents($fileInfo->getPathname());
            }
        }

        return $array_result;
    }
}