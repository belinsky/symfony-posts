<div class="vertical-container posts grow-6">
  <div class="block title">
    <h2>Posts:</h2>
  </div>
  <?php include_partial('post/few', ['posts' => $pager->getResults()]) ?>
  <?php include_partial('post/paginator', ['pager'=>$pager, 'urlArgs' => '']) ?>
</div>
<div class="vertical-container navigation block grow-4">
  <div class="block title">
    <h3>Create query:</h3>
    <form class="" action="/new/query" method="post">
      <?php echo $query_form ?>
      <input type="submit" name="name" value="Send">
    </form>
  </div>
</div>
