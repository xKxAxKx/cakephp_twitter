<?php
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController{

  public $helpers = ['User'];

  public $uses = ['User','Tweet'];

  public $components = [
    'Paginator' => [
      'limit' => 10,
      'order' => ['Tweet.id' =>'desc'],
      'conditions' => []
    ]
  ];

  public function beforeFilter(){
    parent::beforeFilter();

    $this->Auth->allow('signup','view');
  }

  public function login(){
    if($this->Auth->user()){
      return $this->redirect($this->Auth->redirectUrl());
    }

    if($this->request->is('post')){
      if($this->Auth->login()){
        $this->User->id = $this->Auth->user('id');
        $this->User->saveField('login_date', date('Y-m-d H:i:s'));
        $this->redirect($this->Auth->redirectUrl());
      }
      $this->Flash->error('メールアドレスかパスワードが違います');
    }
  }

  public function signup(){
    if($this->Auth->user()){
      return $this->redirect($this->Auth->redirectUrl());
    }

    if($this->request->is('post')){
      $this->User->create();
      if($this->User->save($this->request->data)){
        $mail = $this->request->data['User']['email'];

        $email = new CakeEmail('default');

        $email->from(['thanks@example.com' => 'Twitter']);
        $email->to($mail);
        $email->template('thanks_mail');
        $email->subject('登録ありがとうございます！');
        $email->send();

        $this->Flash->success('ユーザーを登録しました');
        return $this->redirect(['action' => 'login']);
      }
    }

  }

  public function logout(){
    $this->redirect($this->Auth->logout());
  }

  public function profile($id = null){
    if(!$this->User->exists($id)){
      throw new NotFoundException('登録されていないユーザです');
    }
    $this->User->recursive = -1;

    // $hoge = $this->Paginator->paginate('user', ['id' => $id]);
    // var_dump($hoge);
    // exit;

    // $this->set('user', $this->User->findById($id));
    $this->set('users', $this->Paginator->paginate('{n}.Tweet',['User.id' => $id]));
  }

  public function edit(){

    if($this->request->is(['post', 'put'])){
      if($this->User->save($this->request->data)) {
        $this->Flash->success('会員情報を変更しました');

        $user = $this->User->find('first',
          ['fields' => ['id', 'email', 'name', 'image', 'image_dir', 'profile', 'encrypted_password'],
          'conditions' => ['id' => $this->Auth->user('id')]]);

        $this->Auth->login($user['User']);

        return $this->redirect($this->Auth->redirectUrl());
      }
    } else {
    $this->request->data = $this->User->findById($this->Auth->user('id'));
    }

  }

  public function delete($id = null) {
    $this->request->allowMethod('post', 'delete');

    if($this->User->Delete($id, $cascade = true)){
      $this->Flash->success('ユーザを削除しました');
      $this->Auth->logout($user['User']);
    } else {
      $this->Flash->error('ユーザを削除できませんでした');
    }

    return $this->redirect($this->Auth->redirectUrl());
  }

}
