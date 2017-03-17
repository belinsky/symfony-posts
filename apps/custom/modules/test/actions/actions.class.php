<?php

/**
 * test actions.
 *
 * @package    test
 * @subpackage test
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class testActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $request->setRequestFormat('json');

    // $message = $this->getMailer()->compose(
    //   ['belinsky.mis@gmail.com' => 'bot'], // from => name
    //   'belinsky.mis@gmail.com', // to
    //   'hehey',
    //   'hi, itsa message'
    // );
    // $this->getMailer()->send($message);

    $this->data = Doctrine_Core::getTable('Post')->find(1)->getTypes();
  }
}
