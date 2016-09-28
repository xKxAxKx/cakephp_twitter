<?php

class TweetsController extends AppController{

  public $helpers = ['Tweet', 'User'];

  public $uses = ['Tweet','User','Favorite'];

  public $components = [
    'Search.Prg' => ['commonProcess'],
    'Paginator' => ['limit' => 10, 'order' => ['id' =>'desc']]
  ];
  public $presetVars = true;

  public function index(){
    $userId = $this->Auth->user('id');

    if($this->request->is(['post', 'put'])){
      $this->Tweet->create();
      $this->request->data['Tweet']['user_id'] = $userId;
      if($this->Tweet->save($this->request->data)){
        return $this->redirect(['action' => 'index']);
      }
    }

    $this->set('tweets', $this->Paginator->paginate());
  }

  public function view($id = null){
    if(!$this->Tweet->exists($id)){
      throw new NotFoundException('存在しないツイートです');
    }
    $userId = $this->Auth->user('id');

    if($this->request->is(['post', 'put'])){
      $this->Tweet->create();
      $this->request->data['Tweet']['user_id'] = $userId;
      if($this->Tweet->save($this->request->data)){
        $this->redirect($this->referer());
      }
    }

    $this->set('tweet', $this->Tweet->findById($id));
    $this->set('reply', $this->Tweet->find('all', ['conditions' => ['reply_tweet_id' => $id]]));

  }

  public function delete($id = null){
    $this->request->allowMethod('post', 'delete');

    if($this->Tweet->Delete($id, $cascade = true)){
      $this->Flash->success('ツイートを削除しました');
    } else {
      $this->Flash->error('ツイートを削除できませんでした');
    }

    return $this->redirect($this->Auth->redirectUrl());

  }

  public function search(){
    $this->Prg->commonProcess();

    if($this->request->data){
      $passedArgs = $this->passedArgs;
      $tweets = $this->Tweet->find('all', ['conditions' => $this->Tweet->parseCriteria($this->passedArgs)]);
      $this->set('tweets', $tweets);
    } else {
      $passedArgs = null;
    }

  }//serachここまで


}
