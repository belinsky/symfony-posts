<?php

/**
 * PostType form base class.
 *
 * @method PostType getObject() Returns the current form's model object
 *
 * @package    test
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePostTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'post_id' => new sfWidgetFormInputHidden(),
      'type_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'post_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('post_id')), 'empty_value' => $this->getObject()->get('post_id'), 'required' => false)),
      'type_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('type_id')), 'empty_value' => $this->getObject()->get('type_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('post_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostType';
  }

}
