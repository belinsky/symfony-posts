<?php $action = '/';
$action .= $form->getObject()->isNew() ? 'new' : 'update';
$action .= '/comment/';
$action .= sfOutputEscaperGetterDecorator::unescape($token);
$action .= '/';
$action .= $form->getObject()->isNew() ? '' : '?id='.$form->getObject()->getId();
?>
<form class="comment-form" action="<?php echo url_for($action, true);?>" method="post">
  <?php echo $form;?>
  <input type="submit" value="Send">
  <?php if (!$form->getObject()->isNew()): ?>
  <?php echo link_to('Delete comment.',
  '/remove/comment/'.$sf_request->getUrlParameter('token', 0).'/'.( $form->getObject()->isNew() ? '' : '?id='.$form->getObject()->getId()),
  [
    'confirm' => 'R u sure?',
    'absolute' => true
  ]); ?>
<?php endif; ?>
</form>
