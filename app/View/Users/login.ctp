<h2>ログイン</h2>


<div class="container">
  <?= $this->Flash->render('Auth');?>
  <?= $this->Form->create('User');?>
  <form class="form-horizontal">
    <div class="form-group">
      <?= $this->Form->input('email', ['label' => 'メールアドレス', 'class' => 'form-control']); ?>
    </div>
    <div class="form-group">
      <?= $this->Form->input('encrypted_password', ['label' => 'パスワード', 'type' => 'password', 'class' => 'form-control']); ?>
    </div>
      <?= $this->Form->submit('ログイン', ['class' => 'btn btn-primary']); ?>
  </form>
</div>
