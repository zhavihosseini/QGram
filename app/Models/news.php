<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class news extends Model
{
    use HasFactory;
    protected $table='news';
    public $timestamps=false;
    const all_db_news=['id'=>'id','title'=>'title','description'=>'description','url'=>'url','urltoimage'=>'urltoimage','publishat'=>'publishat','content'=>'content'];
    public static function saved_all_news($title,$description,$url,$imgurl,$publishat,$content)
    {
        self::insertOrIgnore([
            self::all_db_news['title'] => $title,
            self::all_db_news['description'] => $description,
            self::all_db_news['url'] => $url,
            self::all_db_news['urltoimage'] => $imgurl,
            self::all_db_news['publishat'] => $publishat,
            self::all_db_news['content'] => $content,
        ]);
    }
    public static function checkExist($title, $description, $url, $content){
        return self::where(self::all_db_news['title'], $title)
            ->where(self::all_db_news['description'], $description)
            ->where(self::all_db_news['url'], $url)
            ->where(self::all_db_news['content'], $content)
            ->get()->count();
    }
    public static function GETS_Some($number){
        return self::OrderBy(self::all_db_news['id'])->take($number)->get();
    }
    public static function delete_by($id){
        return self::where(self::all_db_news['id'],$id)->delete();
    }
    public static function get_down($number){
        return self::OrderBy(self::all_db_news['id'],'desc')->get()->take($number);
    }
    public static function get_up($number)
    {
        return self::OrderBy(self::all_db_news['id'], 'asc')->get()->take($number);
    }
}
