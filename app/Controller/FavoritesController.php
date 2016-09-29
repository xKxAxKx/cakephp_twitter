<?php

class FavoritesController extends AppController{

  public $uses = ['Favorite', 'Tweet', 'User'];

  public function add(){
    $this->request->allowMethod('post');

    $userId = $this->Auth->user('id');
    $tweetId = $this->request->named['tweet_id'];

    if($this->request->is(['post'])){
      $this->Favorite->create();
    }

    $this->request->data['Favorite']['user_id'] = $userId;
    $this->request->data['Favorite']['tweet_id'] = $tweetId;

    if($this->Favorite->save($this->request->data)){
      $this->redirect($this->referer());
      // return $this->redirect(['controller' => 'tweets', 'action' => 'view', $tweetId]);
    }
  }

  public function delete(){
    $this->request->allowMethod('post', 'delete');

    $userId = $this->Auth->user('id');
    $tweetId = $this->request->named['tweet_id'];

    $params = ['Favorite.user_id' => $userId, 'Favorite.tweet_id' => $tweetId];
    if($this->Favorite->DeleteAll($params)){
      $this->Flash->success('お気に入りを削除しました');
    } else {
      $this->Flash->error('お気に入りを削除できませんでした');
    }
    $this->redirect($this->referer());
  }

  public function view($tweet_id){
    $this->autoLayout = false;
    $Favorite = $this->Favorite->find('all',  ['conditions' => ['tweet_id' => $tweet_id]]);


    $user_ids = Hash::extract($Favorite, '{n}.Favorite.user_id');
    $this->User->recursive = -1;

    $Favflag = '0';
    if($this->Favorite->getData($tweet_id, $this->Auth->user('id'))){
      $Favflag = '1';
    }

    $this->set('Favflag', $Favflag);
    $this->set('tweet_id', $tweet_id);
    $this->set('users', $this->User->find('all', ['conditions' => ['id' => $user_ids]]));



  }

}
