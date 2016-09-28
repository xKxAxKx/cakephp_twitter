<?php

class Favorite extends AppModel{
  public $belongsTo = [
    'Tweet' => ['className' => 'Tweet'],
    'User' => ['className' => 'User']
  ];

  public function getData($tweetId, $userId){
  $options = [
    'conditions' => [
      'Favorite.tweet_id' => $tweetId,
      'Favorite.user_id' => $userId
    ]
  ];

  return $this->find('first', $options);
  }
}
