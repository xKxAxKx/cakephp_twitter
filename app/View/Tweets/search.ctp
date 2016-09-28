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
            <?= $this->Html->link(
              'お気に入り',
              ['controller' => 'favorites', 'action' => 'view', $tweet['Tweet']['id']],
              ['escape' => false]
              );
            ?>
            (
              <?php
                  if($tweet['Favorite']){
                    $count = count($tweet['Favorite']);
                    echo $count;
                  } else {
                    echo '0';
                  }
                ?>
              )
              <!-- Button trigger modal -->
              <a data-toggle="modal" data-target="#myModal">
                modaltest
              </a>

              <!-- Modal -->
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">お気に入り一覧</h4>
                    </div>
                    <div class="modal-body">
                      ...
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">お気に入りに追加する</button>
                    </div>
                  </div>
                </div>
              </div>

          </div>
        </div>
      </div>
    <?php endforeach;?>
  </div>
</div>
