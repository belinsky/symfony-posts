// UPDATE ONE-TO-MANY PAIR

// $ent = Doctrine_Core::getTable('Three')->findOneById(9);
// $ent->Two = Doctrine_Core::getTable('Two')->findOneById(7);
// $ent->save();


// UPDATE MANY-TO-MANY PAIR

// $ent->Type[] = Doctrine_Core::getTable('Type')->findOneById(1);
// $ent->save();


// DELETE ONE-TO-MANY RELATION

// $ent = Doctrine_Core::getTable('Three')->findOneById(8);
// $ent->unlink();
// $ent->delete();


// DELETE MANY-TO-MANY RELATION

// Doctrine_Query::create()
// ->delete()
// ->from('TwoType tt')
// ->addWhere('type_id=?', 11)
// ->execute();
// Doctrine_Query::create()
// ->delete()
// ->from('Type t')
// ->addWhere('id=?', 11)
// ->execute();


// CREATING NEW ROW
// $one = new One();
// $one->fromArray([
//   'email' => 'qwe@qwe.qwe',
//   'token' => generateToken()
// ]);
// $one->save();

// CHANGING THA TYPE

// $obj = Doctrine_Core::getTable('Post')->findOneById(2);
// $obj->unlink('Type', [2]);
// $obj->Type[] = Doctrine_Core::getTable('Type')->find(3);
// $obj->save();
// $this->obj = $obj;


<?php foreach(sfOutputEscaperGetterDecorator::unescape($posts) as $post): ?>
  <div class="few-item block">
    <span class="post-title">
      <a class="remove" href="#delete_post" onclick="((function(){var form = document.getElementById('delete_post_form'); form.action = '/remove/post/<?php echo $post['query_token'] ?>/'; form.elements.namedItem('token').value = '<?php echo $post['query_token'] ?>'; document.getElementById('delete_post_title').innerHTML='Delete post <?php  echo $post['query_token'] ?>'; })())">
        <img class='button' src="/images/cancel.svg" alt="edit" />
      </a>
      <a class="edit" href="#edit_post" onclick="((function(){var form = document.getElementById('edit_post_form'); form.action = '/edit/post/<?php echo $post['query_token'] ?>/'; form.elements.namedItem('token').value = '<?php echo$post['query_token'] ?>';document.getElementById('edit_post_title').innerHTML='Edit post <?php  echo $post['query_token'] ?>';})())">
        <img class='button' src="/images/pencil.svg" alt="remove" />
      </a>
      <span class="theme"><a href="<?php echo url_for('/list/posts/html/?query_token='.$post['query_token']) ?>"><?php echo $post['theme'] ?></a></span>
      <span class="raiting">
        <a href="#"><img class='button' src="/images/like.svg" alt="like" /></a>
        <span class="count"><?php echo $post['raiting'] ?></span>
      </span>
      <span class="comments"><a href="<?php echo url_for('/list/posts/html/?query_token='.$post['query_token']) ?>"><?php echo count($post['Comment']) ?> comments</a></span>
    </span>
    <span class="types"><?php foreach($post['Type'] as $type){ echo $type['name'].' '; } ?></span>
    <span class="letter">
      <?php echo substr($post['letter'], 0, 50); ?>
      <a href="<?php echo url_for('/list/posts/html/?query_token='.$post['query_token']) ?>">...</a>
      <div class="dates">
        <span class="date"><?php echo $post['created'] ?> Created.</span>
      </div>
    </span>

  </div>
<?php endforeach; ?>
