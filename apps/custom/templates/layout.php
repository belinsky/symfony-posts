<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <?php if($sf_user->getFlash('notice', false)): ?>
      <div class="flash notice">
        Notice: <?php echo $sf_user->getFlash('notice', false) ?>
      </div>
    <?php endif; ?>
    <?php if($sf_user->getFlash('error', false)): ?>
      <div class="flash error">
        Error: <?php echo $sf_user->getFlash('error', false) ?>
      </div>
    <?php endif; ?>
    <div  id="write_post" class="prompt">
      <a href="#"><img src="/images/cancel.svg" alt="hide" /></a>
      <form class="" action="" method="post">
        <span class="title"><h3>Write post</h3></span>
        <label for="token">Enter Token:</label>
        <input id="token" type="text" name="token" placeholder="Token...">
        <input type="button" value="Write" onClick="(window.location = '/create/post/' + document.getElementById('token').value)">
      </form>
    </div>
    <div  id="delete_post" class="prompt">
      <a href="#"><img src="/images/cancel.svg" alt="hide" /></a>
      <form class="" id="delete_post_form" action="" method="post">
        <span class="title"><h3 id="delete_post_title">Delete post</h3></span>
        <input type="hidden" name="token">
        <label for="email">Enter Email:</label>
        <input id="email" type="email" name="email" placeholder="Email...">
        <input type="submit" value="Delete">
      </form>
    </div>
    <div  id="edit_post" class="prompt">
      <a href="#"><img src="/images/cancel.svg" alt="hide" /></a>
      <form id="edit_post_form" class="" action="" method="post">
        <span class="title"><h3 id="edit_post_title">Edit post</h3></span>
        <input type="hidden" name="token">
        <label for="email">Enter Email:</label>
        <input id="email" type="email" name="email" placeholder="Email...">
        <input type="submit" value="Edit">
      </form>
    </div>
    <div class="bar">
      <ul class="menu">
        <li class="logo">
          <a href="/"><img src="/images/news.svg" alt="Homepage"/></a>
        </li>
        <li class="create_post">
          <a href="#write_post">Write post</a>
        </li>
      </ul>
    </div>
    <div class="content container">
      <?php echo $sf_content ?>
    </div>
  </body>
</html>
