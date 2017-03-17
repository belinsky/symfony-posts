<?php

/**
 * Post filter form base class.
 *
 * @package    test
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePostFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'query_token' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Query'), 'add_empty' => true)),
      'theme'       => new sfWidgetFormFilterInput(),
      'letter'      => new sfWidgetFormFilterInput(),
      'raiting'     => new sfWidgetFormFilterInput(),
      'created'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'type_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Type')),
    ));

    $this->setValidators(array(
      'query_token' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Query'), 'column' => 'token')),
      'theme'       => new sfValidatorPass(array('required' => false)),
      'letter'      => new sfValidatorPass(array('required' => false)),
      'raiting'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'type_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Type', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('post_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addTypeListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.PostType PostType')
      ->andWhereIn('PostType.type_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Post';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'query_token' => 'ForeignKey',
      'theme'       => 'Text',
      'letter'      => 'Text',
      'raiting'     => 'Number',
      'created'     => 'Date',
      'updated'     => 'Date',
      'type_list'   => 'ManyKey',
    );
  }
}
