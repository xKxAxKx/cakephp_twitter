<h2>ツイート更新</h2>
<?php if($tweet['User']['id'] == $currentUser['id'] or $currentUser['email'] == 'root@example.com') :?>
<div class="container">
  <div class="row">
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
          </div>
        </div>
      </div>
  </div>
</div>

<div class="container" style = "margin-bottom: 30px;">
  <div class="row">
  <?= $this->Flash->render('Auth');?>
  <?= $this->Form->create('Tweet');?>
  <form class="form-horizontal">
    <div class="form-group">
      <?= $this->Form->input('content', ['label' => '', 'type'=>'textarea', 'value' => $tweet['Tweet']['content'], 'class' => 'form-control']); ?>
    </div>
    <?= $this->Form->hidden('user_id', ['value' => $tweet['Tweet']['user_id']]); ?>
    <?= $this->Form->hidden('id', ['value' => $tweet['Tweet']['id']]); ?>
    <?= $this->Form->submit('編集する', ['class' => 'btn btn-primary']); ?>
  </form>
    <div style="margin-top: 10px;">
      <?= $this->Form->PostLink(
        'ツイートを削除する',
        ['action' => 'delete', $tweet['Tweet']['id']],
        ['class' => 'btn btn-danger', 'confirm' => '本当に削除してよろしいですか?']
      );?>
    </div>
  </div>
</div>
<?php endif;?>
