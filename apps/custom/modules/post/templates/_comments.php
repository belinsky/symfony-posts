<?php foreach($comments as $comment): ?>
  <div class="comment block">
    <div class="from">
      <?php if($comment->getAuthorEmail()): ?>
      <a href="mailto:<?php echo $comment->getAuthorEmail() ?>">
        <?php echo $comment->getAuthorEmail().': ' ?>
      </a>
    <?php else: ?>
      <a href="#">Anonymus: </a>
    <?php endif; ?>
    </div>
    <span class="message">
      <span class="to"><?php echo $comment->getDestEmail() ? $comment->getDestEmail().', ' : '' ?></span>
      <?php echo $comment->getComment() ?>
    </span>
    <div class="dates">
      <span class="date"><?php echo $comment->getCreated() ?> Created.</span>
    </div>
  </div>
<?php endforeach; ?>
