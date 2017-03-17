<?php

/**
 * Comment form base class.
 *
 * @method Comment getObject() Returns the current form's model object
 *
 * @package    test
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCommentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'post_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Post'), 'add_empty' => true)),
      'author_email' => new sfWidgetFormInputText(),
      'dest_email'   => new sfWidgetFormInputText(),
      'comment'      => new sfWidgetFormTextarea(),
      'created'      => new sfWidgetFormDateTime(),
      'updated'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'post_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Post'), 'required' => false)),
      'author_email' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dest_email'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'comment'      => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'created'      => new sfValidatorDateTime(),
      'updated'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comment';
  }

}
