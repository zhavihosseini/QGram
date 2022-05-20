<?php

namespace App\Http\Controllers;

use App\Events\PostPublished;
use App\Events\StatusLiked;
use App\Models\bitcoin;
use App\Models\contact;
use App\Models\email;
use App\Models\geo;
use App\Models\Post;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use App\Models\message;
use App\Models\news;
use App\Models\phone;
use App\Models\url;
use App\Models\User;
use App\Models\wifi;
use Carbon\Carbon;
use PragmaRX\Tracker\Tracker;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use phpDocumentor\Reflection\Types\This;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Notifications\InvoicePaid;
use function Livewire\str;
use function PHPUnit\Framework\isEmpty;
use Laravel\Socialite\Facades\Socialite;
use Exception;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['home','contact','privacy','term']);
    }
    public function privacy(){
        return view('privacy');
    }
    public function term(){
        return view('term');
    }
    public function verified()
    {
        return view('verifying');
    }
    public function home(Request $request)
    {
        $api = file_get_contents('http://newsapi.org/v2/top-headlines?sources=techcrunch&apiKey=d8c56b72a7cb46df8b09e208a664e021');
        $decoder = json_decode($api);
        $article = $decoder->articles;
        foreach ($article as $item) {
            $title = $item->title;
            $des = $item->description;
            $url = $item->url;
            $imgurl = $item->urlToImage;
            $publish = $item->publishedAt;
            $content = $item->content;
            $checkExist = news::checkExist($title, $des, $url, $content);
            if ($checkExist == 0) {
                news::saved_all_news($title, $des, $url, $imgurl, $publish, $content);
            }
        }
        $year = Carbon::now()->toArray()['year'];
        $all_article = news::GETS_Some(120)->toArray();
        $desc = news::get_down(120)->toArray();
        $desc_rand=Arr::random($desc,'20');
        $asc = news::get_up(150)->toArray();
        $asc_rand=Arr::random($asc,'20');
        $ddd = array_merge($desc_rand,$asc_rand);
        $allss = array_merge($ddd,$all_article);
        $article = Arr::random($allss, '4');
        return view('homepage', compact('article'),['year'=>$year]);
    }
    public function unique($length = 30){
        $data_pool = '0123456789-2437580394720938abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($data_pool, $length)), 0, $length);
        return $this->geo();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function wifi(){
        $qr = new QrCode();
        $id = Auth::id();
        $get = wifi::get_by_userid($id)->toArray();
        $getcount = wifi::get_by_Count($id);
        $validqr = [];
        foreach ($get as $all) {
            if ($id == $all['userid']) {
                $validqr[] = $all;
            }
        }
        foreach ($validqr as $qrs) {
            $id = $qrs['id'];
            $stat = $qrs['status'];
            $user = $qrs['userid'];
            $ss = $qrs['ssid'];
            $pwwd = $qrs['pwd'];
            $time = $qrs['time'];
            $hidden = $qrs['hidden'];
            $enc = $qrs['enc'];
            $description = $qrs['desc'];
            $download = 'download';
            $all_qr= $qr::wifi([
                'encryption' => $enc,
                'ssid' => $ss,
                'password' => $pwwd,
                'hidden' => $hidden
            ]);
            $alls [] = ['id'=>$id,'qr'=>$all_qr,'time'=>$time,'status'=>$stat,'ss'=>$ss,'password'=>$pwwd,'description'=>$description];
        }
        if ($get != []) {
            return view('wifi.wifi', ['count'=>$getcount,'all'=>$alls]);
        }
        if ($get == []) {
            return view('wifi.wifi');
        }
    }
    public function wifiQRCODE(Request $request)
    {
        $req = $request->toArray();
        $user = Auth::user()->toArray();
        $userid = $user['id'];
        $ssid = $req['ssid'];
        $password = $req['pswd'];
        $time = Carbon::now()->toArray();
        $times = $time['formatted'];
        $hidden = $req['hidden'];
        $enc = $req['enc'];
        $description = $req['description'];
        $download = 'download';
        wifi::SAVE_ALL_WIFI('wifi',$times,$description,$download,$userid,$ssid,$password,$hidden,$enc);
        return redirect()->back()->with('success','Successfully Created!!');
    }
    public function dashboard()
    {
       return view('dashboard');
    }
    public function delete($id){
        $ids = Crypt::decrypt($id);
        wifi::delete_by_id($ids);
        return redirect()->back()->with('deletee','Successfully Deleted!!');
    }
    public function edit(Request $request){
        $req = $request['id'];
        $enc = Crypt::decrypt($req);
        $all = wifi::get_by_id($enc)->toArray();
        return view('wifi.edit',['all'=>$all]);
    }
    public function submited(Request $request){
        $req = $request->toArray();
        $user = Auth::user()->toArray();
        $idd = $req['id'];
        $userid = $user['id'];
        $ssid = $req['ssid'];
        $password = $req['pswd'];
        $time = Carbon::now()->toArray();
        $times = $time['formatted'];
        $hidden = $req['hidden'];
        $enc = $req['enc'];
        $description = $req['description'];
        $download = 'download';
        wifi::updates_item($idd,'wifi',$times,$description,$download,$userid,$ssid,$password,$hidden,$enc);
            return redirect()->route('wifi')->with('edited','Successfully Edited!!');
    }
    public function bitcoinn(Request $request){
        $result = $request->toArray();
        $user = Auth::user()->toArray();
        $userid = $user['id'];
        $time = Carbon::now()->toArray();
        $timee = $time['formatted'];
        $amount = $request['amount'];
        $receiver = $request['receiver'];
        $Message = $request['Message'];
        bitcoin::save_all_bitcoin($timee,$userid,$amount,$receiver,$Message);
        return redirect()->back()->with('success','Successfully Created!!');
    }
    public function bitcoin(){
        $unique = $this->unique();
        $hash = Hash::make($unique);
        $hashh = Hash::make($unique);
        $qr = new QrCode();
        $id = Auth::id();
        $get = bitcoin::get_by_userid($id)->toArray();
        $getcount = bitcoin::get_by_Count($id);
        $validqr = [];
        foreach ($get as $all) {
            if ($id == $all['userid']) {
                $validqr[] = $all;
            }
        }
        foreach ($validqr as $qrs) {
            $id = $qrs['id'];
            $user = $qrs['userid'];
            $time = $qrs['time'];
            $amount = $qrs['amount'];
            $receiver = $qrs['receiver'];
            $message = $qrs['message'];
            $all_qrr = $qr::BTC($receiver, $amount, [
                'message' => $message,
                'returnAddress' => $receiver
            ]);
            $alls [] =['hash' => $hash, 'hashh' => $hashh, 'qr' => $all_qrr, 'count' => $getcount, 'time' => $time, 'message' => $message,'id'=>$id];
        }
        if ($get != []) {
            return view('bitcoin.bitcoin', ['count'=>$getcount,'all'=>$alls,'hash' => $hash, 'hashh'=>$hashh]);
        }
        if ($get == []) {
            return view('bitcoin.bitcoin',['hash' => $hash, 'hashh' => $hashh,'count'=>$getcount]);
        }
    }
    public function deletee(Request $request){
       $req = $request['ids'];
       $enc = decrypt($req);
       bitcoin::delete_by_id($enc);
       return redirect()->back()->with('deletee','Successfully Deleted!!');
    }
    public function updates(Request $request){
        $result = $request->toArray();
        $id = $result['id'];
        $dec = decrypt($id);
        $all = bitcoin::get_by_id($dec)->toArray();
        return view('bitcoin.updates',['all'=>$all]);
    }
    public function sub(Request $request){
        $req = $request->toArray();
        $user = Auth::user()->toArray();
        $idd = $req['id'];
        $userid = $user['id'];
            $time = Carbon::now()->toArray();
            $times = $time['formatted'];
            $amount = $req['amount'];
            $message = $req['Message'];
            $receiver = $req['receiver'];
            bitcoin::updates_item($idd,$times,$userid,$amount,$receiver,$message);
        return redirect()->route('bitcoin')->with('edited','Successfully Edited!!');
    }
    public function message(){
        $unique = $this->unique();
        $hash = Hash::make($unique);
        $hashh = Hash::make($unique);
        $qr = new QrCode();
        $id = Auth::id();
        $get = message::get_by_userid($id)->toArray();
        $getcount = message::get_by_Count($id);
        $validqr = [];
        foreach ($get as $all) {
            if ($id == $all['userid']) {
                $validqr[] = $all;
            }
        }
        foreach ($validqr as $qrs) {
            $id = $qrs['id'];
            $user = $qrs['userid'];
            $time = $qrs['time'];
            $message = $qrs['message'];
            $phone = $qrs['number'];
            $all_qrr = $qr::SMS($phone,$message);
            $alls [] =['hash' => $hash, 'hashh' => $hashh, 'qr' => $all_qrr, 'count' => $getcount, 'time' => $time, 'message' => $message,'id'=>$id];
        }
        if ($get != []) {
            return view('message.message', ['count'=>$getcount,'all'=>$alls,'hash' => $hash, 'hashh'=>$hashh]);
        }
        if ($get == []) {
            return view('message.message',['hash' => $hash, 'hashh' => $hashh,'count'=>$getcount]);
        }
    }
    public function postmessage(Request $request){
        $result = $request->toArray();
        $user = Auth::user()->toArray();
        $userid = $user['id'];
        $time = Carbon::now()->toArray();
        $timee = $time['formatted'];
        $message = $result['message'];
        $phone = $result['number'];
        message::Save_all_message($timee,$userid,$message,$phone);
        return redirect()->back()->with('success','Successfully Created!!');
    }
    public function edits(Request $request){
        $result = $request->toArray();
        $id = $result['id'];
        $dec = decrypt($id);
        $all = message::get_by_id($dec)->toArray();
        return view('message.edits',['all'=>$all]);
    }
    public function subs(Request $request){
        $req = $request->toArray();
        $user = Auth::user()->toArray();
        $idd = $req['id'];
        $userid = $user['id'];
        $time = Carbon::now()->toArray();
        $times = $time['formatted'];
        $message = $req['message'];
        $number = $req['number'];
        message::updates_itemm($idd,$times,$message,$userid,$number);
        return redirect()->route('message')->with('edited','Successfully Edited!!');
    }
    public function deleteit(Request $request){
        $req = $request['ids'];
        $enc = decrypt($req);
        message::delete_by_id($enc);
        return redirect()->back()->with('deletee','Successfully Deleted!!');
    }
    public function phone(){
        $unique = $this->unique();
        $hash = Hash::make($unique);
        $hashh = Hash::make($unique);
        $qr = new QrCode();
        $id = Auth::id();
        $get = phone::get_by_userid($id)->toArray();
        $getcount = phone::get_by_Count($id);
        $validqr = [];
        foreach ($get as $all) {
            if ($id == $all['userid']) {
                $validqr[] = $all;
            }
        }
        foreach ($validqr as $qrs) {
            $id = $qrs['id'];
            $user = $qrs['userid'];
            $time = $qrs['time'];
            $phone = $qrs['phone'];
            $all_qrr = $qr::phoneNumber($phone);
            $alls [] =['hash' => $hash, 'hashh' => $hashh, 'qr' => $all_qrr, 'count' => $getcount, 'time' => $time, 'phone' => $phone,'id'=>$id];
        }
        if ($get != []) {
            return view('phonenumber.phone', ['count'=>$getcount,'all'=>$alls,'hash' => $hash, 'hashh'=>$hashh]);
        }
        if ($get == []) {
            return view('phonenumber.phone',['hash' => $hash, 'hashh' => $hashh,'count'=>$getcount]);
        }
    }
    public function phonenumber(Request $request){
        $result = $request->toArray();
        $user = Auth::user()->toArray();
        $userid = $user['id'];
        $time = Carbon::now()->toArray();
        $timee = $time['formatted'];
        $phone = $result['phone'];
        phone::save_all_phone($phone,$timee,$userid);
        return redirect()->back()->with('success','Successfully Created!!');
    }
    public function editsphone(Request $request){
        $result = $request->toArray();
        $id = $result['id'];
        $dec = decrypt($id);
        $all = phone::get_by_id($dec)->toArray();
        return view('phonenumber.edits',['all'=>$all]);
    }
    public function suub(Request $request){
        $req = $request->toArray();
        $user = Auth::user()->toArray();
        $idd = $req['id'];
        $userid = $user['id'];
        $time = Carbon::now()->toArray();
        $times = $time['formatted'];
        $phone = $req['phone'];
        phone::updates_itemms($idd,$times,$userid,$phone);
        return redirect()->route('phone')->with('edited','Successfully Edited!!');
    }
    public function deleted(Request $request){
        $req = $request['ids'];
        $enc = decrypt($req);
        phone::deleted_by_id($enc);
        return redirect()->back()->with('deletee','Successfully Deleted!!');
    }
    public function geo(){
        $unique = $this->unique();
        $hash = Hash::make($unique);
        $hashh = Hash::make($unique);
        $qr = new QrCode();
        $id = Auth::id();
        $get = geo::get_by_userid($id)->toArray();
        $getcount = geo::get_by_Count($id);
        $validqr = [];
        foreach ($get as $all) {
            if ($id == $all['userid']) {
                $validqr[] = $all;
            }
        }
        foreach ($validqr as $qrs) {
            $id = $qrs['id'];
            $user = $qrs['userid'];
            $time = $qrs['time'];
            $latitude = $qrs['latitude'];
            $longitude = $qrs['longitude'];
            $describe = $qrs['describe'];
            $all_qrr = $qr::geo($latitude,$longitude);
            $alls [] =['hash' => $hash, 'hashh' => $hashh, 'qr' => $all_qrr, 'count' => $getcount, 'time' => $time,'describe'=>$describe,'latitude'=>$latitude,'longitude'=>$longitude,'id'=>$id];
        }
        if ($get != []) {
            return view('geo.geo', ['count'=>$getcount,'all'=>$alls,'hash' => $hash, 'hashh'=>$hashh]);
        }
        if ($get == []) {
            return view('geo.geo',['hash' => $hash, 'hashh' => $hashh,'count'=>$getcount]);
        }
    }
    public function geolocation(Request $request){
        $result = $request->toArray();
        $user = Auth::user()->toArray();
        $userid = $user['id'];
        $time = Carbon::now()->toArray();
        $timee = $time['formatted'];
        $latitude = $result['latitude'];
        $longitude = $request['longitude'];
        $describe = $request['describe'];
        geo::SAve_all_geo($timee,$userid,$latitude,$describe,$longitude);
        return redirect()->back()->with('success','Successfully Created!!');
    }
    public function geoedit(Request $request){
        $result = $request->toArray();
        $id = $result['id'];
        $dec = decrypt($id);
        $all = geo::get_by_id($dec)->toArray();
        return view('geo.geoedit',['all'=>$all]);
    }
    public function subz(Request $request){
        $req = $request->toArray();
        $user = Auth::user()->toArray();
        $idd = $req['id'];
        $userid = $user['id'];
        $time = Carbon::now()->toArray();
        $times = $time['formatted'];
        $latitude = $req['latitude'];
        $longitude = $req['longitude'];
        $describe = $req['describe'];
        geo::updates_itemms($idd,$times,$userid,$latitude,$longitude,$describe);
        return redirect()->route('geo')->with('edited','Successfully Edited!!');
    }
    public function deleteits(Request $request){
        $req = $request['ids'];
        $enc = decrypt($req);
        geo::deleted_by_id($enc);
        return redirect()->back()->with('deletee','Successfully Deleted!!');
    }
    public function email(){
        $unique = $this->unique();
        $hash = Hash::make($unique);
        $hashh = Hash::make($unique);
        $qr = new QrCode();
        $id = Auth::id();
        $get = email::get_by_userid($id)->toArray();
        $getcount = email::get_by_Count($id);
        $validqr = [];
        foreach ($get as $all) {
            if ($id == $all['userid']) {
                $validqr[] = $all;
            }
        }
        foreach ($validqr as $qrs) {
            $id = $qrs['id'];
            $user = $qrs['userid'];
            $time = $qrs['time'];
            $subject = $qrs['subject'];
            $email = $qrs['email'];
            $message = $qrs['message'];
            $all_qrr = $qr::email($email,$subject,$message);
            $alls [] =['hash' => $hash, 'hashh' => $hashh, 'qr' => $all_qrr, 'count' => $getcount, 'time' => $time,'subject'=>$subject,'id'=>$id];
        }
        if ($get != []) {
            return view('email.email', ['count'=>$getcount,'all'=>$alls,'hash' => $hash, 'hashh'=>$hashh]);
        }
        if ($get == []) {
            return view('email.email',['hash' => $hash, 'hashh' => $hashh,'count'=>$getcount]);
        }
        return view('email.email');
    }
    public function emailsub(Request $request){
        $result = $request->toArray();
        $user = Auth::user()->toArray();
        $userid = $user['id'];
        $time = Carbon::now()->toArray();
        $timee = $time['formatted'];
        $subject = $result['subject'];
        $email = $result['email'];
        $message = $result['message'];
        email::save_all_email($subject,$message,$timee,$email,$userid);
        return redirect()->back()->with('success','Successfully Created!!');
    }
    public function emailedit(Request $request){
        $result = $request->toArray();
        $id = $result['id'];
        $dec = decrypt($id);
        $all = email::get_by_id($dec)->toArray();
        return view('email.emailedit',['all'=>$all]);
    }
    public function subemail(Request $request){
        $req = $request->toArray();
        $user = Auth::user()->toArray();
        $idd = $req['id'];
        $userid = $user['id'];
        $time = Carbon::now()->toArray();
        $times = $time['formatted'];
        $subject = $req['subject'];
        $email = $req['email'];
        $message = $req['message'];
        email::updates_itemms($idd,$email,$subject,$message,$times,$userid);
        return redirect()->route('email')->with('edited','Successfully Edited!!');
    }
    public function deleteemail(Request $request){
        $req = $request['ids'];
        $enc = decrypt($req);
        email::deleted_by_id($enc);
        return redirect()->back()->with('deletee','Successfully Deleted!!');
    }
    public function url(){
        $unique = $this->unique();
        $hash = Hash::make($unique);
        $hashh = Hash::make($unique);
        $qr = new QrCode();
        $id = Auth::id();
        $get = url::get_by_userid($id)->toArray();
        $getcount = url::get_by_Count($id);
        $validqr = [];
        foreach ($get as $all) {
            if ($id == $all['userid']) {
                $validqr[] = $all;
            }
        }
        foreach ($validqr as $qrs) {
            $id = $qrs['id'];
            $user = $qrs['userid'];
            $time = $qrs['time'];
            $url = $qrs['url'];
            $describe = $qrs['describe'];
            $all_qrr = $qr::generate($url);
            $alls [] =['hash' => $hash, 'hashh' => $hashh, 'qr' => $all_qrr, 'count' => $getcount, 'time' => $time,'describe'=>$describe,'id'=>$id];
        }
        if ($get != []) {
            return view('url.url', ['count'=>$getcount,'all'=>$alls,'hash' => $hash, 'hashh'=>$hashh]);
        }
        if ($get == []) {
            return view('url.url',['hash' => $hash, 'hashh' => $hashh,'count'=>$getcount]);
        }
    }
    public function urls(Request $request){
        $result = $request->toArray();
        $user = Auth::user()->toArray();
        $userid = $user['id'];
        $time = Carbon::now()->toArray();
        $timee = $time['formatted'];
        $url = $result['url'];
        $describe = $result['describe'];
        url::save_all_url($url,$timee,$describe,$userid);
        return redirect()->back()->with('success','Successfully Created!!');
    }
    public function editurl(Request $request){
        $result = $request->toArray();
        $id = $result['id'];
        $dec = decrypt($id);
        $all = url::get_by_id($dec)->toArray();
        return view('url.editurl',['all'=>$all]);
    }
    public function subedit(Request $request){
        $req = $request->toArray();
        $user = Auth::user()->toArray();
        $idd = $req['id'];
        $userid = $user['id'];
        $time = Carbon::now()->toArray();
        $times = $time['formatted'];
        $url = $req['url'];
        $describe = $req['describe'];
        url::updates_itemms($idd,$url,$describe,$userid,$times);
        return redirect()->route('url')->with('edited','Successfully Edited!!');
    }
    public function deleteurl(Request $request){
        $req = $request['ids'];
        $enc = decrypt($req);
        url::deleted_by_id($enc);
        return redirect()->back()->with('deletee','Successfully Deleted!!');
    }
    public function contact(Request $request)
    {
        $result = $request->toArray();
        $name = $result['name'];
        $email = $result['email'];
        $subject = $result['subject'];
        $message = $result['message'];
        $time = Carbon::now()->toArray()['formatted'];
        $contactt = contact::get_email($email);
        if (!$contactt) {
            contact::save_all_contact($name, $email, $subject, $message, $time);
            return redirect()->back()->with('success1', 'Successfully Send !!');
        }else{
            return redirect()->back()->with('success2', 'Not sent, your email has been registered!!');
        }
    }
    public function scanner(){
        return view('scanner.scanner');
    }
    public function wel(){
        return view('welcome');
    }
    /*public function testtt(){
        event(new StatusLiked('Message'));
        return "Event has been sent!";
    }*/
    /*public function fa(){
       App::setLocale('fa');
       return redirect()->back();
    }
    public function en(){
        App::setLocale('en');
        return redirect()->back();
    }*/
}
