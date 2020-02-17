<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    // モデルからのリレーション用
    public function tasks()
    {
        return $this->hasMany('App\Task');  // 省略しなかった場合は $this->hasMany('App\Task', 'folder_id', 'id');
    }
}
