<?php

class Tweet extends AppModel{
  public $actsAs =[
    'Search.Searchable',//serachプラグインの実装
  ];

  public $filterArgs = [
      'keyword' => ['type' => 'like', 'field' => ['Tweet.content']]
  ];

  public $belongsTo = ['User' => ['className' => 'User']];
  public $hasMany = ['Favorite' => ['className' => 'Favorite','foreignKey' => 'tweet_id', 'dependent' => true,]];

  public $validate =[
    'content' => [
      'required' => [
        'rule' => 'notBlank',
        'message' => '1文字以上を入力して下さい'
      ],
      'BelowMaxLength' => [
        'rule' => ['maxLength', 140],
        'message' => '140字以内で入力して下さい'
      ]
    ]
  ];

}
