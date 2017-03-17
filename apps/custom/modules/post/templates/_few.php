<?php foreach($posts as $post): ?>
  <div class="few-item block">
    <span class="post-title">
      <a class="remove" href="#delete_post" onclick="((function(){var form = document.getElementById('delete_post_form'); form.action = '/remove/post/<?php echo $post->getQueryToken() ?>/'; form.elements.namedItem('token').value = '<?php echo $post->getQueryToken() ?>'; document.getElementById('delete_post_title').innerHTML='Delete post <?php  echo $post->getQueryToken() ?>'; })())">
        <img class='button' src="/images/cancel.svg" alt="edit" />
      </a>
      <a class="edit" href="#edit_post" onclick="((function(){var form = document.getElementById('edit_post_form'); form.action = '/edit/post/<?php echo $post->getQueryToken() ?>/'; form.elements.namedItem('token').value = '<?php echo $post->getQueryToken() ?>';document.getElementById('edit_post_title').innerHTML='Edit post <?php  echo $post->getQueryToken() ?>';})())">
        <img class='button' src="/images/pencil.svg" alt="remove" />
      </a>
      <span class="theme"><a href="<?php echo url_for('/list/post/html/?query_token='.$post->getQueryToken()) ?>"><?php echo $post->getTheme() ?></a></span>
      <span class="raiting">
        <a href="#"><img class='button' src="/images/like.svg" alt="like" /></a>
        <span class="count"><?php echo $post->getRaiting() ?></span>
      </span>
      <span class="comments"><a href="<?php echo url_for('/list/post/html/?query_token='.$post->getQueryToken()) ?>"><?php echo count($post->getComment()) ?> comments</a></span>
    </span>
    <span class="types"><?php foreach($post->getType() as $type){ echo $type['name'].' '; } ?></span>
    <span class="letter">
      <?php echo substr($post->getLetter(), 0, 50); ?>
      <a href="<?php echo url_for('/list/post/html/?query_token='.$post->getQueryToken()) ?>">...</a>
      <div class="dates">
        <span class="date"><?php echo $post->getCreated() ?> Created.</span>
      </div>
    </span>
  </div>
<?php endforeach; ?>
