<div class="exp-block vertical-container">
<?php foreach(sfOutputEscaperGetterDecorator::unescape($data) as $post): ?>
<div class="block">
  <div class="post">
    <div class="post-title">
      <a class="remove" href="#delete_post" onclick="((function(){var form = document.getElementById('delete_post_form'); form.action = '/remove/post/<?php echo $post['query_token'] ?>/'; form.elements.namedItem('token').value = '<?php echo $post['query_token'] ?>'; document.getElementById('delete_post_title').innerHTML='Delete post <?php  echo $post['query_token'] ?>'; })())">
        <img src="/images/cancel.svg" class="button" alt="edit" />
      </a>
      <a class="edit" href="#edit_post" onclick="((function(){var form = document.getElementById('edit_post_form'); form.action = '/edit/post/<?php echo $post['query_token'] ?>/'; form.elements.namedItem('token').value = '<?php echo$post['query_token'] ?>';document.getElementById('edit_post_title').innerHTML='Edit post <?php  echo $post['query_token'] ?>';})())">
        <img src="/images/pencil.svg" class="button" alt="remove" />
      </a>
      <h3><?php echo $post['theme']; ?></h3>
      <span class="raiting">
        <a href="<?php echo url_for('/inc/post/'.$post['query_token'], true) ?>"><img src="/images/like.svg" alt="like" class="button"/></a>
        <span class="count"><?php echo $post['raiting'] ?></span>
      </span>
    </div>
    <div class="types"><?php foreach($post['Type'] as $type){echo $type['name'].' ';} ?></div>
    <div class="letter">
      <div class="text">
          <?php echo nl2br($post['letter']) ?>
      </div>
      <div class="dates">
        <div class="date"><?php echo $post['created'] ?> Created.</div>
        <div class="date"><?php echo $post['updated'] ?> Updated.</div>
      </div>
    </div>
  </div>
  <div class="comments block vertical-container">

    <?php if (count($post['Comment'])):?>
      <h4 class="block">
        Comments: <?php echo count($post['Comment']) ?>
      </h4>
    <?php endif; ?>
    <?php include_partial('post/comments', ['comments'=>$pager->getResults()]) ?>
    <?php include_partial('post/paginator', ['pager'=>$pager, 'urlArgs' => 'query_token='.$post['query_token']]) ?>
    <div class="form block">
      <h4>Send comment:</h4>
      <?php include_partial('comment/form', ['form'=>$comment_form, 'token'=>$post['query_token']]); ?>
      <script type="text/javascript">
        (function(){
          document.getElementById('comment_post_id').value = "<?php echo $post['id'] ?>";
        })();
      </script>
    </div>
  </div>
</div>
<?php endforeach; ?>
</div>
