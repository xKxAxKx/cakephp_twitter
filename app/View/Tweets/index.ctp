<div class="container" style = "margin-bottom: 30px;">
  <div class="row">
  <?= $this->Flash->render('Auth');?>
  <?= $this->Form->create('Tweet');?>
  <form class="form-horizontal">
    <div class="form-group">
      <?= $this->Form->input('content', ['label' => '', 'type'=>'textarea', 'placeholder' => '140文字以内で入力して下さい','class' => 'form-control']); ?>
    </div>
    <?= $this->Form->submit('つぶやく', ['class' => 'btn btn-primary']); ?>
  </form>
  </div>
</div>

<div class="container">
  <div class="row">
    <?php foreach ($tweets as $tweet) :?>
      <div class="panel panel-primary">
        <div class="panel-body">
          <div class="col-xs-1">
            <?= $this->User->photoImage($tweet['User'], ['style' => 'width:100%']);?>
          </div>
          <div class="col-xs-10">
            <?= $this->Html->link(
              '@'.$tweet['User']['name'],
              ['controller' => 'users', 'action' => 'profile', $tweet['User']['id']],
              ['escape' => false]
            );?>
            (<?= $tweet['Tweet']['created']; ?>)
            <br>
            <?= $tweet['Tweet']['content']; ?>
            <br>
            <?= $this->Html->link(
              '返信する',
              ['controller' => 'tweets', 'action' => 'view', $tweet['Tweet']['id']],
              ['escape' => false]
            );?>
              <!-- Button trigger modal -->
              <a href="favorites/view/<?=$tweet['Tweet']['id']?>"data-toggle="modal" data-target="#favoriteModal">
                お気に入り(
                  <?php
                      if($tweet['Favorite']){
                        $count = count($tweet['Favorite']);
                        echo $count;
                      } else {
                        echo '0';
                      }
                    ?>
                  )
              </a>
              <!-- Button trigger modal -->
              <?php if($tweet['Tweet']['user_id'] == $currentUser['id']) :?>
                <?= $this->Form->postLink(
                  'ツイートを削除する',
                  ['action' => 'delete', $tweet['Tweet']['id']],
                  ['confirm' => '本当に削除してよろしいですか?']
                );?>
              <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach;?>
  </div>
</div>

<nav style="text-align:center">
	<ul class="pagination">
		<li><?= $this->Paginator->prev('<< 前へ'); ?></li>
		<li><?= $this->Paginator->numbers(); ?></li>
		<li><?= $this->Paginator->next('次へ >>'); ?></li>
	</ul>
</nav>
<?=	$this->element('modal'); ?>
<!-- Modal -->

<!-- Modal -->
