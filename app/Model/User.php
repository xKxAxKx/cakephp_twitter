<?php

App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel{
  public $hasMany =[
    'Tweet' => ['className' => 'Tweet', 'foreignKey' => 'user_id', 'dependent' => true,],
    'Favorite' => ['className' => 'Favorite', 'foreignKey' => 'tweet_id', 'dependent' => true,]
  ];

  public $actsAs = [
    'Upload.Upload' => [
      'image' => [
        'fields' => ['dir' => 'image_dir'],
        'deleteOnUpdate' => 'true',
      ]
    ]
  ];

  public $validate =[
    //サインアップのバリデーション
    'name' => [
      'required' => [
        'rule' => 'notBlank',
        'message' => 'ユーザネームを入力して下さい'
      ]
    ],

    'email' => [
      'required' => [
        'rule' => 'notBlank',
        'message' => 'メールアドレスを入力してください'
      ],
      'validEmail' => [
        'rule' => 'email',
        'message' => '正しいメールアドレスを入力してください'
      ],
      'emailExists' => [
        'rule' => ['isUnique', 'email'],
        'message' => '入力されたメールアドレスは既に登録されています'
      ],
    ],
    'encrypted_password' => [
      'required' => [
        'rule' => 'notBlank',
        'message' => 'パスワードを入力してください'
      ],
      'match' => [
        'rule' => 'passwordConfirm',
        'message' => 'パスワードが一致していません'
      ],
    ],
    'password_confirm' => [
      'required' => [
        'rule' => 'notBlank',
        'message' => 'パスワード(確認)を入力してください'
      ],
    ],
    'profile' => [
      'required' => [
        'rule' => 'notBlank',
        'message' => 'プロフィールを入力して下さい'
      ]
    ],

    //ログイン時のバリデーション
    'password_current' =>[
      'required' => [
        'rule' => 'notBlank',
        'message' => 'パスワードが入力されていません'
      ],
      'match' => [
        'rule' => 'checkCurrentPassword',
        'message' => 'パスワードが一致していません'
      ]
    ],

    //画像関係のバリデーション
    'image' =>[
      'UnderPhpSizeLimit' => [
        'allowEmpty' => true,
        'rule' => 'isUnderPhpSizeLimit',
        'message' => 'アップロード可能なファイルサイズを超えています'
      ],
      'BelowMaxSize' => [
        'rule' => ['isBelowMaxSize', 5242880],
        'message' => 'アップロード可能なファイルサイズを超えています'
      ],
      'CompletedUpload' => [
        'rule' => 'isCompletedUpload',
        'message' => 'ファイルが正常にアップロードされませんでした'
      ],
      'ValidMimeType' => [
        'rule' => ['isValidMimeType', ['image/jpeg', 'image/png'], false],
        'message' => 'ファイルが JPEG でも PNG でもありません'
      ],
      'ValidExtension' => [
        'rule' => ['isValidExtension', ['jpeg', 'jpg', 'png'], false],
        'message' => 'ファイルの拡張子が JPEG でも PNG でもありません'
      ]
    ]

  ];

  public function passwordConfirm($check) {
    if ($check['encrypted_password'] === $this->data['User']['password_confirm']) {
      return true;
    }
    return false;
  }

  public function beforeSave($options = [ ]){
    if(isset($this->data['User']['encrypted_password'])){
      $passwordHasher = new BlowfishPasswordHasher();
      $this->data['User']['encrypted_password'] = $passwordHasher->hash($this->data['User']['encrypted_password']);
    }
    return true;
  }

  public function checkCurrentPassword($check){
    $password = array_values($check)[0];

    $user = $this->findById($this->data['User']['id']);

    $passwordHasher = new BlowfishPasswordHasher();

    if($passwordHasher->check($password, $user['User']['encrypted_password'])){
      return true;
    }
    return false;
  }

  public function sendmail($mail){
    $email = new CakeEmail('default');

    $email->from(['thanks@example.com' => 'Twitter']);
    $email->to($mail);
    $email->template('text_mail');
    $email->subject('登録ありがとうございます！');
    $email->send();
  }

}
