<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bitcoin extends Model
{
    use HasFactory;
    protected $table='bitcoin';
    public $timestamps=false;
    const All_Bitcoin=['id'=>'id','time'=>'time','userid'=>'userid','amount'=>'amount','receiver'=>'receiver','message'=>'message'];
    public static function save_all_bitcoin($time,$userid,$amount,$receiver,$message){
        self::insertOrIgnore([
            self::All_Bitcoin['time']=>$time,
            self::All_Bitcoin['userid']=>$userid,
            self::All_Bitcoin['amount']=>$amount,
            self::All_Bitcoin['receiver']=>$receiver,
            self::All_Bitcoin['message']=>$message,
        ]);
    }
    public static function get_by_userid($userid){
        return self::where(self::All_Bitcoin['userid'],$userid)->get();
    }
    public static function get_by_Count($userid){
        return self::where(self::All_Bitcoin['userid'],$userid)->get()->count();
    }
    public static function delete_by_id($id){
        self::where(self::All_Bitcoin['id'],$id)->delete();
    }
    public static function get_by_id($id){
        return self::where(self::All_Bitcoin['id'],$id)->get();
    }
    public static function updates_item($id,$time,$userid,$amount,$receiver,$message){
        self::where(self::All_Bitcoin['id'],$id)->update([
            self::All_Bitcoin['time']=>$time,
            self::All_Bitcoin['userid']=>$userid,
            self::All_Bitcoin['amount']=>$amount,
            self::All_Bitcoin['receiver']=>$receiver,
            self::All_Bitcoin['message']=>$message,
        ]);
    }
}
