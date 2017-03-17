<?php

/**
 * Post form.
 *
 * @package    test
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PostForm extends BasePostForm
{
  public function configure(){
    unset(
      $this['created'],
      $this['updated'],
      $this['raiting']
    );
    $this->widgetSchema['query_token'] =new sfWidgetFormInputHidden();
    $this->widgetSchema->setLabels([
      'theme' => 'Title: ',
      'letter' => false,
      'type_list' => false
    ]);
  }
}


class AdminPostForm extends BasePostForm
{
  public function configure(){
    
    $this->widgetSchema['query_token'] =new sfWidgetFormInputHidden();
    $this->widgetSchema->setLabels([
      'theme' => 'Title: ',
      'letter' => false,
      'type_list' => false
    ]);
  }
}
