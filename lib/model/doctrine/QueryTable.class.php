<?php

/**
 * QueryTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class QueryTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object QueryTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Query');
    }
}