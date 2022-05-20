<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phone extends Model
{
    use HasFactory;
    protected $table='phone';
    public $timestamps=false;
    const All_Phone=['id'=>'id','phone'=>'phone','time'=>'time','userid'=>'userid'];
    public static function save_all_phone($phone,$time,$userid){
        self::insertOrIgnore([
            self::All_Phone['phone']=>$phone,
            self::All_Phone['userid']=>$userid,
            self::All_Phone['time']=>$time,
        ]);
    }
    public static function get_by_userid($userid){
        return self::where(self::All_Phone['userid'],$userid)->get();
    }
    public static function get_by_Count($userid){
        return self::where(self::All_Phone['userid'],$userid)->get()->count();
    }
    public static function get_by_id($id){
        return self::where(self::All_Phone['id'],$id)->get();
    }
    public static function deleted_by_id($id){
        self::where(self::All_Phone['id'],$id)->delete();
    }
    public static function updates_itemms($id,$time,$userid,$phone){
        self::where(self::All_Phone['id'],$id)->where(self::All_Phone['userid'],$userid)->update([
            self::All_Phone['phone']=>$phone,
            self::All_Phone['time']=>$time,
        ]);
    }
}
