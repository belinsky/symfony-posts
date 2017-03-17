<form class="" action="<?php echo url_for('/'.($form->getObject()->isNew() ? 'new' : 'update').'\/type\/'.($form->getObject()->isNew() ? '' : $form->getObject()->getId()), true)?>" method="post">
  <?php echo $form;?>
  <input type="submit" value="Send">
  <?php if (!$form->getObject()->isNew()): ?>
    <?php echo link_to(
    'Remove type',
    '/remove/type/'.$form->getObject()->getId().'/',
    [
      'confirm' => 'R u sure?',
      'absolute' => true
    ]); ?>
  <?php endif; ?>
</form>
