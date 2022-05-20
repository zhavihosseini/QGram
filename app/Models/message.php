<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    use HasFactory;
    protected $table='message';
    public $timestamps=false;
    const All_message=['id'=>'id','time'=>'time','userid'=>'userid','message'=>'message','number'=>'number'];
    public static function Save_all_message($time,$userid,$message,$number){
        self::insertOrIgnore([
            self::All_message['time']=>$time,
            self::All_message['userid']=>$userid,
            self::All_message['message']=>$message,
            self::All_message['number']=>$number,
        ]);
    }
    public static function get_by_userid($userid){
        return self::where(self::All_message['userid'],$userid)->get();
    }
    public static function get_by_Count($userid){
        return self::where(self::All_message['userid'],$userid)->get()->count();
    }
    public static function get_by_id($id){
        return self::where(self::All_message['id'],$id)->get();
}
    public static function delete_by_id($id){
        self::where(self::All_message['id'],$id)->delete();
    }
    public static function updates_itemm($id,$time,$message,$userid,$number){
        self::where(self::All_message['id'],$id)->where(self::All_message['userid'],$userid)->update([
          self::All_message['message']=>$message,
            self::All_message['number']=>$number,
            self::All_message['time']=>$time,
        ]);
    }
}
