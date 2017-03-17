<form class="post-form" action="<?php echo url_for('/'.($form->getObject()->isNew() ? 'new' : 'update').'/post/'.$sf_request->getUrlParameter('token', 0).'/', true)?>" method="post">
  <?php echo $form;?>
  <input type="submit" value="Save">
  <?php if (!$form->getObject()->isNew()): ?>
    <?php echo link_to(
    'Remove',
    '/remove/post/'.$sf_request->getUrlParameter('token', 0).'/',
    [
      'class' => 'button',
      'confirm' => 'R u sure?',
      'absolute' => true
    ]); ?>
  <?php endif; ?>
</form>
