<?php

require_once dirname(__FILE__).'/../lib/queryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/queryGeneratorHelper.class.php';

/**
 * query actions.
 *
 * @package    test
 * @subpackage query
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class queryActions extends autoQueryActions {
  public function executeBatchActivate(sfWebRequest $request) {
    foreach(Query::setStatuses($request->getParameter('ids'), true)->execute()->toArray() as $query) {
      $link = $request->getUriPrefix().'/create/post/'.$query['token'].'/';
      print_r($query['email'].'  '.$link);
      $this->sendEmail($query['email'], $link);
    }
    $this->redirect('query');
  }
  public function executeBatchDeactivate(sfWebRequest $request) {
    Query::setStatuses($request->getParameter('ids'), false);
    $this->redirect('query');
  }
  public function executeListRemoveDeactivated(sfWebRequest $request) {
    Doctrine_Query::create()->delete('Query q')->addWhere('q.status=?', false)->execute();
    $this->redirect('query');
  }
  public function sendEmail($to = 'to_somebody', $link = 'http://test.sy'){
    $message = $this->getMailer()->compose(
      ['belinsky.mis@gmail.com' => 'Posts application'], // from => name
      'belinsky.mis@gmail.com', // to
      'Your query is accepted',
      $to.'\'s query is activated, look: '.$link
    );
    $this->getMailer()->send($message);
  }
}
