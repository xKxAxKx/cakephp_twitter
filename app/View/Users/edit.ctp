<h2>ユーザ情報修正</h2>

<div class="container" style="margin-bottom: 30px;">
  <?= $this->Form->create('User', ['type' => 'file']); ?>
  <form class="form-horizontal">
    <div class="form-group">
      <?= $this->Form->input('name', ['label' => 'ニックネーム', 'class' => 'form-control'] ); ?>
    </div>
    <div class="form-group">
      <?= $this->Form->input('email', ['label' => 'メールアドレス', 'class' => 'form-control']); ?>
    </div>
    <div>
      <div>現在のアイコン</div>
      <?= $this->User->photoImage($currentUser, ['style' => 'width:100px']) ;?>
    </div>
    <div class="form-group">
      <?= $this->Form->input('image', ['type'=>'file', 'label' => 'アイコン', 'class' => 'form-control']); ?>
      <?= $this->Form->input('image_dir', ['type'=>'hidden']); ?>
    </div>
    <div class="form-group">
      <?= $this->Form->input('encrypted_password', ['label' => '新しいパスワード', 'type' => 'password', 'value' => '', 'class' => 'form-control']); ?>
    </div>
    <div class="form-group">
      <?= $this->Form->input('password_confirm', ['label' => '新しいパスワード（確認）', 'type' => 'password', 'class' => 'form-control']); ?>
    </div>
    <div class="form-group">
      <?= $this->Form->input('profile', ['type'=>'textarea', 'label' => 'プロフィール', 'class' => 'form-control'] ); ?>
    </div>
    <?= $this->Form->hidden('id'); ?>
    <?= $this->Form->submit('保存する', ['class' => 'btn btn-primary']); ?>
  </form>
</div>

<hr>
<h4>ユーザ削除</h4>
<p>一度アカウントを削除すると、二度と元に戻せません。十分ご注意ください。</p>
<div style="margin-bottom: 30px;">
  <?= $this->Form->postLink(
    'ユーザを削除する',
    ['action' => 'delete', $currentUser['id']],
    ['class' => 'btn btn-danger', 'confirm' => '本当に削除してよろしいですか?']
  ); ?>
</div>
