<?php

/**
 * comment actions.
 *
 * @package    test
 * @subpackage comment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commentActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeNew(sfWebRequest $request){
    if(!Doctrine_Core::getTable('Post')->findOneByQueryToken($request->getUrlParameter('token', 0)))
      return $this->sendError(404, 'Not Found');
    if(!$request->isMethod(sfRequest::POST))
      return $this->sendError(400, 'Bad Request');
    if ($this->saveComment($request->getPostParameters()['comment'])) {
      $from = $request->getPostParameters()['comment']['author_email'];
      $to = $request->getPostParameters()['comment']['dest_email'];
      $link = $request->getUriPrefix().'/list/posts/html/?query_token='.$request->getUrlParameter('token', 0);
      if ($to) $this->sendEmail($from, $to, $link);
      $this->getUser()->setFlash('notice', 'Comment sended.');

      $this->redirect('/list/post/html/?query_token='.$request->getUrlParameter('token', 0));
    }
    $this->getUser()->setFlash('error', 'Comment was not send.');
  }
  public function executeUpdate(sfWebRequest $request){
    if(!$request->isMethod(sfRequest::POST))
      return $this->sendError(400, 'Bad request');
    if(!($comment = Doctrine_Core::getTable('Comment')->findOneById($request->getGetParameter('id', 0))))
      return $this->sendError(404, 'Not Found');
    $this->saveComment($request->getPostParameters()['comment'], $comment)?
    $this->getUser()->setFlash('notice', 'Comment saved.'):
    $this->getUser()->setFlash('error', 'Comment was not saved.');
    $this->redirect('/list/post/html/?query_token='.$request->getUrlParameter('token', 0));
  }
  public function executeRemove(sfWebRequest $request){
    if (!($comment = Doctrine_Core::getTable('Comment')->findOneById($request->getGetParameter('id', 0))))
      return $this->sendError(404, 'Not Found');
    $comment->delete()?
    $this->getUser()->setFlash('notice', 'Comment removed.'):
    $this->getUser()->setFlash('error', 'Comment was not removed.');
    $this->redirect('/list/post/html/?query_token='.$request->getUrlParameter('token', 0));
  }
  public function saveComment($data, Comment $comment = null){
    if (!$comment) $comment = new Comment();
    $form = new CommentForm($comment);
    $form->bind($data, []);
    return $form->isValid() ? !!$form->save() : 0;
  }
  public function sendEmail($from = 'from_somebody', $to = 'to_somebody', $link = 'http://test.sy'){
    $message = $this->getMailer()->compose(
      ['belinsky.mis@gmail.com' => $from], // from => name
      'belinsky.mis@gmail.com', // to
      'You answered in posts app',
      $from.' answered to '.$to.', look: '.$link
    );
    $this->getMailer()->send($message);
  }
  public function sendError($status = 500 , $message = 'Server error'){
    $this->getResponse()->setStatusCode($status);
    $this->status = $status;
    $this->message = $message;
    $this->setTemplate('tmp');
    return sfView::ERROR;
  }
}
