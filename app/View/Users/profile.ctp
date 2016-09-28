<div class="container">
  <div class="row">
    <div class="col-xs-3">
      <?= $this->User->photoImage($users['0']['User'], ['style' => 'width:80%', 'class' => "center-block"]) ;?>
    </div>
    <div class="col-xs-9">
      <h2>@<?= $users['0']['User']['name'];?></h2>
      <small>最終ログイン日時:<?= $users['0']['User']['login_date'];?></small>
      <div style="margin-top: 30px;">
        <h4>プロフィール</h4>
        <?= $users['0']['User']['profile'];?>
      </div>
    </div>
  </div>
</div>

<div class="container" style="margin-top: 100px;">
  <div class="row">
    <?php foreach ($users as $user) :?>
      <div class="panel panel-primary">
        <div class="panel-body">
          <div class="col-xs-1">
          <?= $this->User->photoImage($user['User'], ['style' => 'width:100%']);?>
          </div>
          <div class="col-xs-11">
            <?= $this->Html->link(
              '@'.$user['User']['name'],
              ['controller' => 'users', 'action' => 'profile', $user['User']['id']],
              ['escape' => false]
            );?>
            (<?= $user['Tweet']['created']; ?>)
            <br>
            <?= $user['Tweet']['content']; ?>
            <br>
            <?= $this->Html->link(
            '返信する',
            ['controller' => 'tweets', 'action' => 'view', $user['Tweet']['id']],
            ['escape' => false]
            );?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<nav style="text-align:center">
	<ul class="pagination">
		<li><?= $this->Paginator->prev('<< 前へ'); ?></li>
		<li><?= $this->Paginator->numbers(); ?></li>
		<li><?= $this->Paginator->next('次へ >>'); ?></li>
	</ul>
</nav>
