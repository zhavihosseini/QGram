<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wifi extends Model
{
    use HasFactory;
    protected $table='wifi';
    public $timestamps=false;
    const DB_ALL_WIFI=['id'=>'id','status'=>'status','time'=>'time','desc'=>'desc','download'=>'download','userid'=>'userid','ssid'=>'ssid','pwd'=>'pwd','hidden'=>'hidden','enc'=>'enc'];
    public static function SAVE_ALL_WIFI($status,$time,$desc,$download,$userid,$ssid,$pwd,$hidden,$enc){
        self::insertOrIgnore([
            self::DB_ALL_WIFI['status']=>$status,
            self::DB_ALL_WIFI['desc']=>$desc,
            self::DB_ALL_WIFI['time']=>$time,
            self::DB_ALL_WIFI['download']=>$download,
            self::DB_ALL_WIFI['userid']=>$userid,
            self::DB_ALL_WIFI['ssid']=>$ssid,
            self::DB_ALL_WIFI['pwd']=>$pwd,
            self::DB_ALL_WIFI['hidden']=>$hidden,
            self::DB_ALL_WIFI['enc']=>$enc,
        ]);
    }
    public static function get_by_userid($userid){
        return self::where(self::DB_ALL_WIFI['userid'],$userid)->get();
    }
    public static function get_by_Count($userid){
        return self::where(self::DB_ALL_WIFI['userid'],$userid)->get()->count();
    }
    public static function GET_SELECT_USER($userid){
        return self::where(self::DB_ALL_WIFI['userid'],$userid)
            ->select(self::DB_ALL_WIFI['status'],self::DB_ALL_WIFI['ssid'],self::DB_ALL_WIFI['pwd'],self::DB_ALL_WIFI['hidden'],self::DB_ALL_WIFI['enc'])
            ->get()->count();
    }
    public static function delete_by_id($id){
        self::where(self::DB_ALL_WIFI['id'],$id)->delete();
    }
    public static function get_by_id($id){
        return self::where(self::DB_ALL_WIFI['id'],$id)->get();
    }
    public static function updates_item($id,$status,$time,$desc,$download,$userid,$ssid,$pwd,$hidden,$enc){
        self::where(self::DB_ALL_WIFI['id'],$id)->update([
            self::DB_ALL_WIFI['status']=>$status,
            self::DB_ALL_WIFI['desc']=>$desc,
            self::DB_ALL_WIFI['time']=>$time,
            self::DB_ALL_WIFI['download']=>$download,
            self::DB_ALL_WIFI['userid']=>$userid,
            self::DB_ALL_WIFI['ssid']=>$ssid,
            self::DB_ALL_WIFI['pwd']=>$pwd,
            self::DB_ALL_WIFI['hidden']=>$hidden,
            self::DB_ALL_WIFI['enc']=>$enc,
        ]);
    }
}
