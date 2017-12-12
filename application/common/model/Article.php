<?php
namespace app\common\model;

use think\Model;

class Article extends Model
{
    // 指定表名,不含前缀
    protected $name = 'article';
    public function type(){
    	return $this -> hasOne('articletype','typeid','id');

    }
    
}
