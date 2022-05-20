<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class url extends Model
{
    use HasFactory;
    protected $table='url';
    public $timestamps=false;
    const DB_All_url=['id'=>'id','url'=>'url','describe'=>'describe','time'=>'time','userid'=>'userid'];
    public static function save_all_url($url,$time,$describe,$userid){
        self::insertOrIgnore([
            self::DB_All_url['url']=>$url,
            self::DB_All_url['describe']=>$describe,
            self::DB_All_url['time']=>$time,
            self::DB_All_url['userid']=>$userid,
        ]);
    }
    public static function get_by_userid($userid){
        return self::where(self::DB_All_url['userid'],$userid)->get();
    }
    public static function get_by_Count($userid){
        return self::where(self::DB_All_url['userid'],$userid)->get()->count();
    }
    public static function get_by_id($id){
        return self::where(self::DB_All_url['id'],$id)->get();
    }
    public static function deleted_by_id($id){
        self::where(self::DB_All_url['id'],$id)->delete();
    }
    public static function updates_itemms($id,$url,$describe,$userid,$time){
        self::where(self::DB_All_url['id'],$id)->where(self::DB_All_url['userid'],$userid)->update([
            self::DB_All_url['url']=>$url,
            self::DB_All_url['time']=>$time,
            self::DB_All_url['describe']=>$describe,
        ]);
    }
}
