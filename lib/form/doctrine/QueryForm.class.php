<?php

/**
 * Query form.
 *
 * @package    test
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class QueryForm extends BaseQueryForm
{
  public function configure(){
    unset(
      $this['status'],
      $this['created']
    );
    $this->validatorSchema['email'] = new sfValidatorAnd([
      new sfValidatorEmail(['max_length' => 255, 'required' => true])
    ]);
    $this->validatorSchema['token'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
  }
}
