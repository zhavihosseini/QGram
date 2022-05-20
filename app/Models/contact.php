<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class contact extends Model
{
    use HasFactory;
    protected $table='contact';
    public $timestamps=false;
    const all_Contact=['id'=>'id','name'=>'name','email'=>'email','subject'=>'subject','message'=>'message','time'=>'time'];
    public static function save_all_contact($name,$email,$subject,$message,$time){
        self::insertOrIgnore([
            self::all_Contact['name']=>$name,
            self::all_Contact['email']=>$email,
            self::all_Contact['subject']=>$subject,
            self::all_Contact['message']=>$message,
            self::all_Contact['time']=>$time,
        ]);
    }
    public static function get_email($email){
        return self::where(self::all_Contact['email'],$email)->get()->toArray();
    }
    public static function get_by_id($id){
        return self::where(self::all_Contact['id'],$id)->get()->toArray();
    }
    public static function get_even_email($email){
        return self::where(self::all_Contact['email'],'!=',$email)->get();
    }
}
