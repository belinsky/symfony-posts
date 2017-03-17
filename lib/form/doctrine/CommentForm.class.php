<?php

/**
 * Comment form.
 *
 * @package    test
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CommentForm extends BaseCommentForm
{
  public function configure(){
    unset(
      $this['created'],
      $this['updated']
    );
    $this->widgetSchema['post_id'] =new sfWidgetFormInputHidden();
    $this->widgetSchema->setLabels([
      'author_email' => 'From: ',
      'dest_email' => 'To: ',
      'comment' => ' '
    ]);
  }
}
