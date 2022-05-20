<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class geo extends Model
{
    use HasFactory;
    protected $table='geo';
    public $timestamps=false;
    const DB_All_geo=['id'=>'id','time'=>'time','describe'=>'describe','userid'=>'userid','latitude'=>'latitude','longitude'=>'longitude'];
    public static function SAve_all_geo($time,$userid,$latitude,$describe,$longitude){
        self::insertOrIgnore([
            self::DB_All_geo['time']=>$time,
            self::DB_All_geo['userid']=>$userid,
            self::DB_All_geo['latitude']=>$latitude,
            self::DB_All_geo['describe']=>$describe,
            self::DB_All_geo['longitude']=>$longitude,
        ]);
    }
    public static function get_by_userid($userid){
        return self::where(self::DB_All_geo['userid'],$userid)->get();
    }
    public static function get_by_Count($userid){
        return self::where(self::DB_All_geo['userid'],$userid)->get()->count();
    }
    public static function get_by_id($id){
        return self::where(self::DB_All_geo['id'],$id)->get();
    }
    public static function deleted_by_id($id){
        self::where(self::DB_All_geo['id'],$id)->delete();
    }
    public static function updates_itemms($id,$time,$userid,$latitude,$longitude,$describe){
        self::where(self::DB_All_geo['id'],$id)->where(self::DB_All_geo['userid'],$userid)->update([
            self::DB_All_geo['time']=>$time,
            self::DB_All_geo['latitude']=>$latitude,
            self::DB_All_geo['longitude']=>$longitude,
            self::DB_All_geo['describe']=>$describe,
        ]);
    }
}
