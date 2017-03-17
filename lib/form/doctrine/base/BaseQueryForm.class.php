<?php

/**
 * Query form base class.
 *
 * @method Query getObject() Returns the current form's model object
 *
 * @package    test
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseQueryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'token'   => new sfWidgetFormInputHidden(),
      'email'   => new sfWidgetFormInputText(),
      'status'  => new sfWidgetFormInputCheckbox(),
      'created' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'token'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('token')), 'empty_value' => $this->getObject()->get('token'), 'required' => false)),
      'email'   => new sfValidatorString(array('max_length' => 255)),
      'status'  => new sfValidatorBoolean(array('required' => false)),
      'created' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('query[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Query';
  }

}
