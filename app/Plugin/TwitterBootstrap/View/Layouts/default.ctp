<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php echo __('CakePHP: the rapid development php framework:'); ?>
		<?php echo $title_for_layout; ?>
	</title>

    <!-- Bootstrap -->
	<?php echo $this->Html->css('bootstrap.min'); ?>
	<?php echo $this->Html->css('bootstrap-responsive.min'); ?>
  <?php echo $this->Html->css('bootstrap-custom'); ?>



	<style>


	</style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><?= $this->Html->link('Twitter', '/'); ?></li>
            <?php if($currentUser) :?>
              <li>
                  <?= $this->Form->create('Tweet', ['type' => 'data', 'controller' => 'tweets', 'url' => 'search']); ?>
                  <form class="form-horizontal">
                  <div class="form-group form-group-sm" style="margin-bottom: 0;">
                    <?= $this->Form->input('keyword', ['label' => '', 'class' => 'form-control input-sm', 'placeholder' => 'ツイート検索']); ?>
                  </div>
                    <!-- <?= $this->Form->submit('検索する',['class' => 'btn', 'style'=>'display: inline;']); ?> -->
                </form>
              </li>
            <?php endif; ?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
            <?php if($currentUser) :?>
              <li>
                <?= $this->Html->link('設定変更', ['controller' => 'users', 'action' => 'edit']); ?>
              </li>
              <li>
                <?= $this->Html->link('ログアウト', ['controller' => 'users', 'action' => 'logout']); ?>
              </li>
            <?php else :?>
  						<li>
  							<?= $this->Html->link('ログイン', ['controller' => 'users', 'action' => 'login']); ?>
  						</li>
  						<li>
  							<?= $this->Html->link('新規会員登録', ['controller' => 'users', 'action' => 'signup']); ?>
  						</li>
            <?php endif; ?>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
    <?php echo $this->Session->flash(); ?>

    <?php echo $this->fetch('content'); ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php echo $this->Html->script('bootstrap.min'); ?>
    <?php echo $this->Html->script('bootstrap_custom'); ?>
    <?php echo $this->fetch('script'); ?>
  </body>
</html>
