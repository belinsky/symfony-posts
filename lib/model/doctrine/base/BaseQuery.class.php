<?php

/**
 * BaseQuery
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $token
 * @property string $email
 * @property boolean $status
 * @property Post $Post
 * 
 * @method string  getToken()  Returns the current record's "token" value
 * @method string  getEmail()  Returns the current record's "email" value
 * @method boolean getStatus() Returns the current record's "status" value
 * @method Post    getPost()   Returns the current record's "Post" value
 * @method Query   setToken()  Sets the current record's "token" value
 * @method Query   setEmail()  Sets the current record's "email" value
 * @method Query   setStatus() Sets the current record's "status" value
 * @method Query   setPost()   Sets the current record's "Post" value
 * 
 * @package    test
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseQuery extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('query');
        $this->hasColumn('token', 'string', 255, array(
             'type' => 'string',
             'primary' => true,
             'length' => 255,
             ));
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => false,
             'length' => 255,
             ));
        $this->hasColumn('status', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Post', array(
             'local' => 'token',
             'foreign' => 'query_token'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             'created' => 
             array(
              'name' => 'created',
             ),
             'updated' => 
             array(
              'disabled' => true,
             ),
             ));
        $this->actAs($timestampable0);
    }
}