<?php

/**
 * query actions.
 *
 * @package    test
 * @subpackage query
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class queryActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeList(sfWebRequest $request)
  {
    // фича, которую должен мочь юзать не только лишь каждый.
    $request->setRequestFormat('json');
    $this->data = Query::getQueries($request->getGetParameters());
  }

  public function executeNew(sfWebRequest $request){
    if(!$request->isMethod(sfRequest::POST))
      return $this->sendError(400, 'Bad Request');
    $this->saveQuery($request->getPostParameters()['query']) ?
    $this->getUser()->setFlash('notice', 'Query sended successfully'):
    $this->getUser()->setFlash('error', 'Email is not valid. Query was not sended.');
    $this->redirect('/');
  }
  public function saveQuery($data, Query $query = null){
    if (!$query) $query = new Query();
    $data['token'] = Query::generateToken();
    $form = new QueryForm($query);
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
