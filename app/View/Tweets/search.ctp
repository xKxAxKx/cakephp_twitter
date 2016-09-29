<h2>検索結果</h2>

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
          </div>
        </div>
      </div>
    <?php endforeach;?>
  </div>
</div>

<?=	$this->element('modal'); ?>
