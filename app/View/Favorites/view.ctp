<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#215;</button>
  <h4 class="modal-title" id="favoriteModal">お気に入り一覧</h4>
</div>
<div class="modal-body">
    <?php foreach($users as $user) :?>
      <p>
        <?= $this->User->photoImage($user['User'], ['style' => 'width:100px']);?>
        <?= $this->Html->link(
          '@'.$user['User']['name'],
          ['controller' => 'users', 'action' => 'profile', $user['User']['id']],
          ['escape' => false]
        );?>
      </p>
    <?php endforeach; ?>
</div>
<div class="modal-footer">
  <?php if($Favflag == '0') :?>
  <?= $this->Form->postlink(
    'お気に入りに追加',
    ['controller' => 'favorites', 'action' => 'add', 'tweet_id' => $tweet_id],
    ['class' => 'btn btn-info'],
    ['escape' => false]
    );?>
  <?php else :?>
    <?= $this->Form->postlink(
    'お気に入りを削除',
    ['controller' => 'favorites', 'action' => 'delete', 'tweet_id' => $tweet_id],
    ['class' => 'btn btn-default'],
    ['escape' => false]
    );?>
  <?php endif;?>
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
