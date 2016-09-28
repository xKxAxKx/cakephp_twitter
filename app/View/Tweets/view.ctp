<div class="container">
  <div class="row">
    <div class="panel panel-primary">

      <div class="panel-body">
        <div class="col-xs-1">
          <?= $this->User->photoImage($tweet['User'], ['style' => 'width:100%']);?>
        </div>
        <div class="col-xs-11">
          <?= $this->Html->link(
            '@'.$tweet['User']['name'],
            ['controller' => 'users', 'action' => 'profile', $tweet['User']['id']],
            ['escape' => false]
          );?>
          (<?= $tweet['Tweet']['created']; ?>)
          <br>
          <?= $tweet['Tweet']['content']; ?>
          <br>
          <!-- Button trigger modal -->
          <a href="http://192.168.33.10/cakephp_twitter/favorites/view/<?=$tweet['Tweet']['id']?>"data-toggle="modal" data-target="#favoriteModal">
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
      
      <?php if($reply):?>
        <div class="panel panel-primary col-xs-10 pull-right">
          <ul class="list-group">
            <?php foreach ($reply as $reply) :?>
              <li class="list-group-item">
                <div class="col-xs-1">
                  <?= $this->User->photoImage($reply['User'], ['style' => 'width:100%']);?>
                </div>
                <div>
                  <?= $this->Html->link(
                    $reply['User']['name'],
                    ['controller' => 'users', 'action' => 'profile', $reply['User']['id']],
                    ['escape' => false]
                  );?>
                  (<?= $reply['Tweet']['created']; ?>)
                  <br>
                  <?= $reply['Tweet']['content']; ?>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>


<div class="container" style = "margin-top: 30px;">
  <div class="row">
  <h4>このツイートへ返信する</h4>
  <?= $this->Flash->render('Auth');?>
  <?= $this->Form->create('Tweet');?>
  <form class="form-horizontal">
    <div class="form-group">
      <?= $this->Form->input('content', ['label' => '','type'=>'textarea','class' => 'form-control']); ?>
    </div>
    <?= $this->Form->hidden('reply_tweet_id', ['value' => $tweet['Tweet']['id']]); ?>
    <?= $this->Form->submit('返信する', ['class' => 'btn btn-primary']); ?>
  </form>
  </div>
</div>

<?=	$this->element('modal'); ?>
