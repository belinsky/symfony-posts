<?php

/**
 * post actions.
 *
 * @package    test
 * @subpackage post
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class postActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request){
    $this->query_form = new QueryForm();
    $this->data = [];
    $params = $request->getGetParameters();
    unset($params['page']);
    $this->data['posts'] = Post::getPosts($params);
    $this->pager = new sfDoctrinePager(
      'Post',
      sfConfig::get('app_posts_list_length')
    );
    $this->pager->setQuery(Post::getPostsQuery());
    $this->pager->setPage($request->getGetParameter('page', 1));
    $this->pager->init();
  }

  public function executeList(sfWebRequest $request){
    $this->comment_form = new CommentForm();

    if($request->getRequestFormat() == 'html' && !isset($request->getGetParameters()['query_token']))
      $this->sendError(400, 'Bad request');

    $params = $request->getGetParameters();
    unset($params['page']);

    if (!($this->data = Post::getPosts($params)))
      $this->sendError(404, 'Not Found');

    if ($request->getRequestFormat() == 'html') {
      $this->pager = new sfDoctrinePager(
        'Comment',
        sfConfig::get('app_comments_list_length')
      );
      $this->pager->setQuery(Comment::getCommentsQuery($this->data[0]['id']));
      $this->pager->setPage($request->getGetParameter('page', $this->pager->getLastPage()));
      $this->pager->init();

    }
  }

  public function executeCreate(sfWebRequest $request){
    if (Doctrine_Core::getTable('Post')->findOneByQueryToken($request->getUrlParameter('token', 0)))
      return $this->sendError(409, 'Conflict');
    if (!($query = Doctrine_Core::getTable('Query')->findOneByToken($request->getUrlParameter('token', 0))))
      return $this->sendError(404, 'Not Found');
    if (!$query->getStatus())
      return $this->sendError(404, 'Not Found');

    $this->form = new PostForm();
    $this->form->setDefault('query_token', $request->getUrlParameter('token', 0));
  }

  public function executeNew(sfWebRequest $request){
    if(!($query = Doctrine_Core::getTable('Query')->findOneByToken($request->getUrlParameter('token', 0))))
      return $this->sendError(404, 'Not Found');
    if (!$query->getStatus())
      return $this->sendError(404, 'Not Found');
    if (!$request->isMethod(sfRequest::POST))
      return $this->sendError(400, 'Bad request');
    $this->savePost($request->getPostParameters()['post']) ?
    $this->getUser()->setFlash('notice', 'Posted successfully'):
    $this->getUser()->setFlash('error', 'Not posted.');
    $this->redirect('/list/post/html/?query_token='.$request->getUrlParameter('token', 0));
  }

  public function executeInc(sfWebRequest $request){
    if (!($post = Doctrine_Core::getTable('Post')->findOneByQueryToken($request->getUrlParameter('token', 0))))
      return $this->sendError(404, 'Not Found');
    $post->raiting += 1;
    $post->save();
    $this->getUser()->setFlash('notice', 'You like it.');
    $this->redirect('/list/post/html/?query_token='.$request->getUrlParameter('token', 0));
  }

  public function executeEdit(sfWebRequest $request){

    if (!($post = Doctrine_Core::getTable('Post')->findOneByQueryToken($request->getUrlParameter('token', 0))))
      return $this->sendError(404, 'Not Found');
    if (!Post::checkQuery($request->getPostParameters()))
      return $this->sendError(403, 'Forbidden');
    $this->form = new PostForm($post);
  }

  public function executeUpdate(sfWebRequest $request){
    if (!$request->isMethod(sfRequest::POST))
      return $this->sendError(400, 'Bad Request');
    if(!($post = Doctrine_Core::getTable('Post')->findOneByQueryToken($request->getUrlParameter('token', 0))))
      return $this->sendError(404, 'Not Found');
    $this->savePost($request->getPostParameters()['post'], $post) ?
    $this->getUser()->setFlash('notice', 'Post successefully updated.'):
    $this->getUser()->setFlash('error', 'Post was not updated.');
    $this->redirect('/list/post/html/?query_token='.$request->getUrlParameter('token', 0));
  }

  public function executeRemove(sfWebRequest $request){
    if(!($post = Doctrine_Core::getTable('Post')->findOneByQueryToken($request->getUrlParameter('token', 0))))
      return $this->sendError(404, 'Not Found');
    if (!Post::checkQuery($request->getPostParameters()))
    return $this->sendError(403, 'Forbidden');

    Post::unlinkTypes($post->getId());
    $post->delete()?
    $this->getUser()->setFlash('notice', 'Post removed successfully.'):
    $this->getUser()->setFlash('error', 'Something went wrong. Post was not removed');
    $this->redirect('/');
  }

  public function savePost($data, Post $post = null){
    if (!$post) $post = new Post();
    $data['updated'] = new DateTime();
    $form = new PostForm($post);
    $form->bind($data, []);
    return $form->isValid() ? !!$form->save() : 0;
  }
  public function sendError($status = 500 , $message = 'Server error'){
    $this->getResponse()->setStatusCode($status);
    $this->status = $status;
    $this->message = $message;
    $this->setTemplate('tmp');
    return sfView::ERROR;
  }
}
