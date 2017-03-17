<?php

/**
 * type actions.
 *
 * @package    test
 * @subpackage type
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class typeActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeList(sfWebRequest $request){
    $this->data = Type::getTypes($request->getGetParameters());
  }

  public function executeCreate(sfWebRequest $request){
    $this->form = new TypeForm();
  }

  public function executeEdit(sfWebRequest $request){
    $this->forward404Unless($type = Doctrine_Core::getTable('Type')->find($request->getUrlParameter('id', 0)));
    $this->form = new TypeForm($type);
  }

  public function executeNew(sfWebRequest $request){
    $this->forward404Unless($request->isMethod(sfRequest::POST) && $this->saveType($request->getPostParameters()['type']));
    $this->redirect('/');
  }

  public function executeUpdate(sfWebRequest $request){
    $this->forward404Unless($request->isMethod(sfRequest::POST) && $type = Doctrine_Core::getTable('Type')->find($request->getUrlParameter('id', 0)));
    $this->saveType($request->getPostParameters()['type'], $type);
    die();
    $this->redirect('/');
  }

  public function executeRemove(sfWebRequest $request){
    $this->forward404Unless(Doctrine_Core::getTable('Type')->find($request->getUrlParameter('id', 0))->delete());
    $this->redirect('/');
  }

  public function saveType($data, Type $type = null){
    if (!$type) $type = new Type();
    $form = new TypeForm($type);
    $form->bind($data, []);
    return $form->isValid() ? !!$form->save() : false;
  }
}
