<?php

/**
 * Type form.
 *
 * @package    test
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TypeForm extends BaseTypeForm
{
  public function configure()
  {
    unset(
      $this['post_type_alias_list']
    );
  }
}
