<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class email extends Model
{
    use HasFactory;
    protected $table='email';
    public $timestamps=false;
    const DB_all_Email=['id'=>'id','subject'=>'subject','message'=>'message','time'=>'time','email'=>'email','userid'=>'userid'];
    public static function save_all_email($subject,$message,$time,$email,$userid){
        self::insertOrIgnore([
            self::DB_all_Email['subject']=>$subject,
            self::DB_all_Email['email']=>$email,
            self::DB_all_Email['message']=>$message,
            self::DB_all_Email['time']=>$time,
            self::DB_all_Email['userid']=>$userid,
        ]);
    }
    public static function get_by_userid($userid){
        return self::where(self::DB_all_Email['userid'],$userid)->get();
    }
    public static function get_by_Count($userid){
        return self::where(self::DB_all_Email['userid'],$userid)->get()->count();
    }
    public static function get_by_id($id){
        return self::where(self::DB_all_Email['id'],$id)->get();
    }
    public static function deleted_by_id($id){
        self::where(self::DB_all_Email['id'],$id)->delete();
    }
    public static function updates_itemms($id,$email,$subject,$message,$time,$userid){
        self::where(self::DB_all_Email['id'],$id)->where(self::DB_all_Email['userid'],$userid)->update([
            self::DB_all_Email['subject']=>$subject,
            self::DB_all_Email['time']=>$time,
            self::DB_all_Email['message']=>$message,
            self::DB_all_Email['email']=>$email,
        ]);
    }
}
