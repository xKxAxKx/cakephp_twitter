<h2>新規ユーザ登録</h2>

<div class="container">
  <?= $this->Form->create('User', ['type' => 'file']); ?>
  <form class="form-horizontal">
    <div class="form-group">
      <?= $this->Form->input('name', ['label' => 'ユーザネーム', 'class' => 'form-control']); ?>
    </div>
    <div class="form-group">
      <?= $this->Form->input('email', ['label' => 'メールアドレス', 'type' => 'email', 'class' => 'form-control']); ?>
    </div>
    <div class="form-group">
      <?= $this->Form->input('encrypted_password', ['label' => 'パスワード', 'type' => 'password', 'class' => 'form-control']); ?>
    </div>
    <div class="form-group">
      <?= $this->Form->input('password_confirm', ['label' => 'パスワード(確認)', 'type' => 'password', 'class' => 'form-control']); ?>
    </div>
    <div class="form-group">
      <?= $this->Form->input('image', ['type'=>'file', 'label' => 'プロフィール画像', 'class' => 'form-control']); ?>
    </div>
    <div class="form-group">
      <?= $this->Form->input('profile', ['type'=>'textarea', 'label' => 'プロフィール', 'class' => 'form-control']); ?>
    </div>
    <?= $this->Form->input('image_dir', ['type'=>'hidden']); ?>
    <?= $this->Form->submit('登録する',['class' => 'btn btn-primary']); ?>
  </form>
</div>
