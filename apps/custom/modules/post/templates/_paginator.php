<?php if(!isset($urlArgs)) $urlArgs=null;?>
<div class="block align-center">
  <?php if ($pager->haveToPaginate()): ?>
    <div class="paginator">
      <?php if(1 != $pager->getPreviousPage() && 1 != $pager->getPage()): ?>
        <a class='first' href="?<?php echo $urlArgs ? $urlArgs.'&': '' ?>page=1"><img class='button' src="/images/double-arrow.svg" alt="first page" /></a>
      <?php endif; ?>
      <?php if($pager->getPreviousPage() != $pager->getPage()): ?>
        <a class='prev' href="?<?php echo $urlArgs ? $urlArgs.'&': '' ?>page=<?php echo $pager->getPreviousPage() ?>"><img class='button' src="/images/arrow.svg" alt="prev page" /></a>
      <?php endif; ?>
      <?php foreach ($pager->getLinks() as $page): ?>
        <?php if ($page < intval($pager->getPage()) - 3 || $page > intval($pager->getPage()) + 3)
                continue;
              if ($page == intval($pager->getPage()) - 3 || $page == intval($pager->getPage()) + 3) {
                echo '...';
                continue;
              }
        ?>
        <?php if ($page == $pager->getPage()): ?>
          <?php echo $page ?>
        <?php else: ?>
          <a href="?<?php echo $urlArgs ? $urlArgs.'&': '' ?>page=<?php echo $page ?>"><?php echo $page ?></a>
        <?php endif; ?>
      <?php endforeach; ?>
      <?php if($pager->getNextPage() != $pager->getPage()): ?>
        <a class='next' href="?<?php echo $urlArgs ? $urlArgs.'&': '' ?>page=<?php echo $pager->getNextPage() ?>"><img class='button' src="/images/arrow.svg" alt="next page" /></a>
      <?php endif; ?>
      <?php if($pager->getLastPage() != $pager->getNextPage() && $pager->getLastPage() != $pager->getPage()): ?>
        <a class='last' href="?<?php echo $urlArgs ? $urlArgs.'&': '' ?>page=<?php echo $pager->getLastPage() ?>"><img class='button' src="/images/double-arrow.svg" alt="last page" /></a>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <?php if ($pager->haveToPaginate()): ?>
    <div class="dates">
      <span class="date"> - page <?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></span>
    </div>
  <?php endif; ?>
</div>
