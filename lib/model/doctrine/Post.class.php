<?php

/**
 * Post
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    test
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Post extends BasePost
{
  static public function getPostsQuery($param=[]){
    $query = Doctrine_Query::create()
    ->select('q.*, p.*, t.*, c.*')
    ->from('Post p')
    ->leftJoin('p.Query q')
    ->leftJoin('p.Type t')
    ->leftJoin('p.Comment c');
    foreach($param as $key=>$value){
      $query = $query->addWhere('p.'.$key.'=?', $value);
    }
    return $query;
  }
  static public function getPosts($param=[]){
    return self::getPostsQuery($param)->execute()->toArray();
  }
  static public function postExists($token){
    return !!Doctrine_Query::create()
    ->select('p.*')
    ->from('Post p')
    ->addWhere('p.query_token=?', $token)
    ->execute()
    ->toArray();
  }
  static public function unlinkTypes($id = 0){
    return Doctrine_Query::create()
    ->delete('PostType pt')
    ->addWhere('pt.post_id=?', $id)
    ->execute();
  }
  static public function checkQuery($data){
    if (!isset($data['email']) || !isset($data['token'])) return false;
    // check if status is true
    return !!Doctrine_Query::create()->select('q.*')->from('Query q')->addWhere('q.token=?', $data['token'])->addWhere('q.email=?', $data['email'])->execute()->toArray();
  }
  public function getTypes(){
    $types = '';
    $q = Doctrine_Query::create()
    ->select('p.id, t.name')->
    from('Post p')
    ->leftJoin('p.Type t')
    ->addWhere('p.id=?', $this->getId())
    ->execute()
    ->toArray();
    foreach($q[0]['Type'] as $type) {
      $types .= $type['name'].' ';
    }
    return $types;
  }
  static public function removeDeactivated() {
    $q = Doctrine_Query::create()->from('Post p')->leftJoin('p.Query q')->addWhere('q.status=?', false)->execute();
    foreach ($q as $post) {
      $post->unlinkTypes($post->id);
      $post->delete();
    }
    return true;
  }
}