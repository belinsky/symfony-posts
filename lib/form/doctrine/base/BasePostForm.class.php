<?php

/**
 * Post form base class.
 *
 * @method Post getObject() Returns the current form's model object
 *
 * @package    test
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePostForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'query_token' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Query'), 'add_empty' => false)),
      'theme'       => new sfWidgetFormInputText(),
      'letter'      => new sfWidgetFormTextarea(),
      'raiting'     => new sfWidgetFormInputText(),
      'created'     => new sfWidgetFormDateTime(),
      'updated'     => new sfWidgetFormDateTime(),
      'type_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Type')),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'query_token' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Query'))),
      'theme'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'letter'      => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'raiting'     => new sfValidatorInteger(array('required' => false)),
      'created'     => new sfValidatorDateTime(),
      'updated'     => new sfValidatorDateTime(),
      'type_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Type', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Post', 'column' => array('query_token')))
    );

    $this->widgetSchema->setNameFormat('post[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Post';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['type_list']))
    {
      $this->setDefault('type_list', $this->object->Type->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveTypeList($con);

    parent::doSave($con);
  }

  public function saveTypeList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['type_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Type->getPrimaryKeys();
    $values = $this->getValue('type_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Type', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Type', array_values($link));
    }
  }

}
