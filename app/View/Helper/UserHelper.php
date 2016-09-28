<?php

class UserHelper extends AppHelper{

  public $helpers = ['Html'];

  public function photoImage($image, $options =[]){

    $photoDir = Configure::read('image.dir');
    $defaultPhoto = Configure::read('image.default');

    if(empty($image['image'])){
      $path = $defaultPhoto;
    } else {
      $path = $photoDir . $image['image_dir'].'/'.$image['image'];
    }

    return $this->Html->image($path, $options);
  }
}
