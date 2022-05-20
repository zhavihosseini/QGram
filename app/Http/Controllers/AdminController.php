<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Mail\NewsMail;
use App\Models\bitcoin;
use App\Models\contact;
use App\Models\email;
use App\Models\geo;
use App\Models\message;
use App\Models\news;
use App\Models\phone;
use Google\Auth\HttpHandler\HttpClientCache;
use Hashids\Hashids;
use App\Models\url;
use App\Models\User;
use App\Models\wifi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notification;
use libphonenumber\CountryCodeSource;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
use Illuminate\Support\Facades\Mail;
use MongoDB\Driver\Session;
use PragmaRX\Support\IpAddress;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('AuthAdmin');
    }
    public function usersz()
    {
        $user = User::all();
        $all = Auth::user()->all()->toArray();
        $allz = User::all()->count();
        $bit = bitcoin::all()->count();
        $email = email::all()->count();
        $geo = geo::all()->count();
        $message = message::all()->count();
        $phone = phone::all()->count();
        $url = url::all()->count();
        $wifi = wifi::all()->count();
        $all_qr = $bit+$email+$geo+$message+$phone+$url+$wifi;
        $all_bit = bitcoin::all()->toArray();
        $emails = email::all()->toArray();
        $geos = geo::all()->toArray();
        $messagess = message::all()->toArray();
        $phones = phone::all()->toArray();
        $urls = url::all()->toArray();
        $wifis = wifi::all()->toArray();
        $contactus = contact::all()->count();
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
                return view('admin.forms', compact('all', ['all_qr', 'all_bit', 'emails', 'geos', 'messagess', 'phones', 'urls', 'wifis']), ['use' => $user, 'count' => $allz, 'mesg' => $message, 'bitz' => $bit, 'geoz' => $geo, 'emailzz' => $email, 'phonezz' => $phone, 'urlz' => $url, 'wifiz' => $wifi,'contact'=>$contactus]);
        }else{
            abort(404);
        }
    }
    public function deletedss(Request $request)
    {
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $hashids = new Hashids();
            $res = $request['id'];
            $decript = Crypt::decrypt($res);
            $all = $hashids->decode($decript);
            foreach ($all as $alls) {
                $id = $alls;
            }
            User::delete_this($id);
            return redirect()->back()->with('success','deleted');
        }else{
            abort(404);
        }
    }
    public function session(Request $request){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $hashids = new Hashids();
            $res = $request['id'];
            $decript = Crypt::decrypt($res);
            $all = $hashids->decode($decript);
            $allusers = User::all()->toArray();
            foreach ($all as $alls) {
                $id = $alls;
            }
            $give_user = User::give_buy($id);
            return view('admin.sessions',['users'=>$give_user,'all_users'=>$allusers]);
        }else{
            abort(404);
        }
    }
    public function sendeemail(Request $request)
    {
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
           $message =  $request->toArray();
            $hashids = new Hashids();
            $res = $request['id'];
            $decript = Crypt::decrypt($res);
            $all = $hashids->decode($decript);
            foreach ($all as $alls) {
                $id = $alls;
            }
            $give_user = User::give_buy($id);
            foreach ($give_user as $item) {
               $users = $item;
            }
            $email = $users['email'];
            Mail::to($email)->send(new NewsMail($users,$message));
            return redirect()->back()->with('success','Email was sent');
        }else{
            abort(404);
    }
 }
 public function sendemailusers(){
     if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
         $all = User::all()->count();
         $contact_count = contact::all()->count();
         $ppo = $all + $contact_count;
         return view('admin.sendemail', ['all' => $ppo]);
     }else{
         abort(404);
     }
 }
 public function allusers(Request $request){
     if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
         $res = $request->toArray();
         $all_users = User::all()->toArray();
         $contact_mail = contact::all()->toArray();
         foreach ($all_users as $all_user) {
             $email = $all_user['email'];
             $users = $all_user;
             Mail::to($email)->send(new NewsMail($users,$res));
         }
         foreach ($contact_mail as $mail) {
             $email = $mail['email'];
             $users = $all_user;
             $give = contact::get_even_email($email)->toArray();
             Mail::to($give)->send(new NewsMail($users,$res));
         }
         return redirect()->back()->with('success','Emailss was sent');
     }else{
         abort(404);
     }

 }
 public function news(){
     if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
         $news = DB::table("news")->get();
         $countt = $news->count();
         $paginate = news::paginate(20);
         return view('admin.news', compact('news'), ['paginate' => $paginate, 'countss' => $countt]);
     }else{
         abort(404);
     }
 }
 public function destroynews($id){
     if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
         DB::table("news")->delete($id);
         return response()->json(['success' => "Product Deleted successfully.", 'tr' => 'tr_' . $id]);
     }else{
         abort(404);
     }
 }
 public function deleteAllnews(Request $request){
     if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
         $ids = $request->ids;
         DB::table("news")->whereIn('id', explode(",", $ids))->delete();
         return response()->json(['success' => "Products Deleted successfully."]);
     }else{
         abort(404);
     }
 }
/* public function deletednews(Request $request)
 {
     if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
         $id = $request['id'];
         $hashids = new Hashids();
         $dcrypt = Crypt::decrypt($id);
         $dehash = $hashids->decode($dcrypt);
         foreach ($dehash as $item) {
             $ids = $item;
         }
         news::delete_by($ids);
         return redirect()->back()->with('success','News Was Deleted with Id : '.$ids);
     }else{
         abort(404);
     }
 }*/
 public function deletebitz(Request $request){
     if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
         $id = $request['id'];
         $hashids = new Hashids();
         $dcrypt = Crypt::decrypt($id);
         $dehash = $hashids->decode($dcrypt);
         foreach ($dehash as $item) {
             $ids = $item;
         }
         bitcoin::delete_by_id($ids);
         return redirect()->back()->with('success','Bitcoin Was Deleted with Id : '.$ids);
     }else{
         abort(404);
     }
 }
 public function deleteemailz(Request $request){
     if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
         $id = $request['id'];
         $hashids = new Hashids();
         $dcrypt = Crypt::decrypt($id);
         $dehash = $hashids->decode($dcrypt);
         foreach ($dehash as $item) {
             $ids = $item;
         }
         email::deleted_by_id($ids);
         return redirect()->back()->with('success','Email Was Deleted with Id : '.$ids);
     }else{
         abort(404);
     }
 }
 public function deleteGeo(Request $request){
     if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
         $id = $request['id'];
         $hashids = new Hashids();
         $dcrypt = Crypt::decrypt($id);
         $dehash = $hashids->decode($dcrypt);
         foreach ($dehash as $item) {
             $ids = $item;
         }
        geo::deleted_by_id($ids);
         return redirect()->back()->with('success','Geo Was Deleted with Id : '.$ids);
     }else{
         abort(404);
     }
 }
 public function Messagessz(Request $request){
     if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
         $id = $request['id'];
         $hashids = new Hashids();
         $dcrypt = Crypt::decrypt($id);
         $dehash = $hashids->decode($dcrypt);
         foreach ($dehash as $item) {
             $ids = $item;
         }
         message::delete_by_id($ids);
         return redirect()->back()->with('success','message Was Deleted with Id : '.$ids);
     }else{
         abort(404);
     }
 }
 public function phonezzze(Request $request){
     if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
         $id = $request['idv'];
         $hashids = new Hashids();
         $dcrypt = Crypt::decrypt($id);
         $dehash = $hashids->decode($dcrypt);
         foreach ($dehash as $item) {
             $ids = $item;
         }
         phone::deleted_by_id($ids);
         return redirect()->back()->with('success','phone Was Deleted with Id : '.$ids);
     }else{
         abort(404);
     }
 }
 public function urlzzcb(Request $request){
     if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
         $id = $request['idv'];
         $hashids = new Hashids();
         $dcrypt = Crypt::decrypt($id);
         $dehash = $hashids->decode($dcrypt);
         foreach ($dehash as $item) {
             $ids = $item;
         }
         url::deleted_by_id($ids);
         return redirect()->back()->with('success','url Was Deleted with Id : '.$ids);
     }else{
         abort(404);
     }
 }
 public function wifisz(Request $request){
     if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
         $id = $request['idw'];
         $hashids = new Hashids();
         $dcrypt = Crypt::decrypt($id);
         $dehash = $hashids->decode($dcrypt);
         foreach ($dehash as $item) {
             $ids = $item;
         }
         wifi::delete_by_id($ids);
         return redirect()->back()->with('success','wifi Was Deleted with Id : '.$ids);
     }else{
         abort(404);
     }
 }
 public function indexxx(){
     if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
         $bitcoin = DB::table("bitcoin")->get();
         $countt = $bitcoin->count();
         $paginate = bitcoin::paginate(20);
         return view('admin.product', compact('bitcoin'), ['paginate' => $paginate, 'count' => $countt]);
     }else{
         abort(404);
     }
 }
 public function destroy($id){
     if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
         DB::table("bitcoin")->delete($id);
         return response()->json(['success' => "Product Deleted successfully.", 'tr' => 'tr_' . $id]);
     }else{
         abort(404);
     }
 }
    public function deleteAll(Request $request)
    {
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $ids = $request->ids;
            DB::table("bitcoin")->whereIn('id', explode(",", $ids))->delete();
            return response()->json(['success' => "Products Deleted successfully."]);
        }else{
            abort(404);
        }
    }
    public function indexxxx(){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $email = DB::table("email")->get();
            $countt = $email->count();
            $paginate = email::paginate(20);
            return view('admin.multiemail', compact('email'), ['paginate' => $paginate, 'countt' => $countt]);
        }else{
            abort(404);
        }
    }
    public function destroys($id){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            DB::table("email")->delete($id);
            return response()->json(['success' => "Product Deleted successfully.", 'tr' => 'tr_' . $id]);
        }else{
            abort(404);
        }
    }
    public function deleteAlls(Request $request)
    {
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $ids = $request->ids;
            DB::table("email")->whereIn('id', explode(",", $ids))->delete();
            return response()->json(['success' => "Products Deleted successfully."]);
        }else{
            abort(404);
        }
    }
    public function indez(){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $geos = DB::table("geo")->get();
            $countt = $geos->count();
            $paginate = geo::paginate(20);
            return view('admin.geos', compact('geos'), ['paginate' => $paginate, 'countss' => $countt]);
        }else{
            abort(404);
        }
    }
    public function destroysz($id){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            DB::table("geo")->delete($id);
            return response()->json(['success' => "Product Deleted successfully.", 'tr' => 'tr_' . $id]);
        }else{
            abort(404);
        }
    }
    public function deleteAllsz(Request $request)
    {
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $ids = $request->ids;
            DB::table("geo")->whereIn('id', explode(",", $ids))->delete();
            return response()->json(['success' => "Products Deleted successfully."]);
        }else{
            abort(404);
        }
    }
    public function indezz(){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $message = DB::table("message")->get();
            $countt = $message->count();
            $paginate = message::paginate(20);
            return view('admin.multimessage', compact('message'), ['paginate' => $paginate, 'countss' => $countt]);
        }else{
            abort(404);
        }
    }
    public function destroyszz($id){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            DB::table("message")->delete($id);
            return response()->json(['success' => "Product Deleted successfully.", 'tr' => 'tr_' . $id]);
        }else{
            abort(404);
        }
    }
    public function deleteAllszz(Request $request)
    {
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $ids = $request->ids;
            DB::table("message")->whereIn('id', explode(",", $ids))->delete();
            return response()->json(['success' => "Products Deleted successfully."]);
        }else{
            abort(404);
        }
    }
    public function indexphone(){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $phone = DB::table("phone")->get();
            $countt = $phone->count();
            $paginate = phone::paginate(20);
            return view('admin.multiphone', compact('phone'), ['paginate' => $paginate, 'countss' => $countt]);
        }else{
            abort(404);
        }
    }
    public function destroyphone($id){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            DB::table("phone")->delete($id);
            return response()->json(['success' => "Product Deleted successfully.", 'tr' => 'tr_' . $id]);
        }else{
            abort(404);
        }
    }
    public function deleteAllphone(Request $request)
    {
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $ids = $request->ids;
            DB::table("phone")->whereIn('id', explode(",", $ids))->delete();
            return response()->json(['success' => "Products Deleted successfully."]);
        }else{
            abort(404);
        }
    }
    public function indexurl(){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $url = DB::table("url")->get();
            $countt = $url->count();
            $paginate = url::paginate(20);
            return view('admin.editurl', compact('url'), ['paginate' => $paginate, 'countss' => $countt]);
        }else{
            abort(404);
        }

    }
    public function destroyurl($id){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            DB::table("url")->delete($id);
            return response()->json(['success' => "Product Deleted successfully.", 'tr' => 'tr_' . $id]);
        }else{
            abort(404);
        }
    }
    public function deleteAllurl(Request $request)
    {
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $ids = $request->ids;
            DB::table("url")->whereIn('id', explode(",", $ids))->delete();
            return response()->json(['success' => "Products Deleted successfully."]);
        }else{
            abort(404);
        }
    }
    public function indexwifi(){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $wifi = DB::table("wifi")->get();
            $countt = $wifi->count();
            $paginate = wifi::paginate(20);
            return view('admin.multiwifi', compact('wifi'), ['paginate' => $paginate, 'countss' => $countt]);
        }else{
            abort(404);
        }
    }
    public function destroywifi($id){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            DB::table("wifi")->delete($id);
            return response()->json(['success' => "Product Deleted successfully.", 'tr' => 'tr_' . $id]);
        }else{
            abort(404);
        }
    }
    public function deleteAllwifi(Request $request)
    {
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $ids = $request->ids;
            DB::table("wifi")->whereIn('id', explode(",", $ids))->delete();
            return response()->json(['success' => "Products Deleted successfully."]);
        }else{
            abort(404);
        }
    }
    public function contactadmin(){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $contact = DB::table("contact")->get();
            $countt = $contact->count();
            $paginate = contact::paginate(20);
            return view('admin.contact', compact('contact'), ['paginate' => $paginate, 'countss' => $countt]);
        }else{
            abort(404);
        }
    }
    public function destroycontactus($id){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            DB::table("contact")->delete($id);
            return response()->json(['success' => "Product Deleted successfully.", 'tr' => 'tr_' . $id]);
        }else{
            abort(404);
        }
    }
    public function deleteAllcontactus(Request $request){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $ids = $request->ids;
            DB::table("contact")->whereIn('id', explode(",", $ids))->delete();
            return response()->json(['success' => "Products Deleted successfully."]);
        }else{
            abort(404);
        }
    }
    public function contactusers(Request $request){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $id = $request['id'];
            $encode = Crypt::decrypt($id);
            $hash = new Hashids();
            $dehash = $hash->decode($encode);
            foreach ($dehash as $item) {
                $idd = $item;
            }
            $con = contact::get_by_id($idd);
            return view('admin.contacttouser',['users'=>$con]);
        }else{
            abort(404);
        }
    }
    public function sendeemailcontact(Request $request){
        if (Auth::user()->utype === 'ADM' && Auth::user()->username === 'AdMin' && Auth::user()->id === 1) {
            $id = $request['id'];
            $mesg = $request->toArray();
            $encode = Crypt::decrypt($id);
            $hash = new Hashids();
            $dehash = $hash->decode($encode);
            foreach ($dehash as $item) {
                $idd = $item;
            }
            $con = contact::get_by_id($idd);
            foreach ($con as $contact){
                $iremm = $contact;
            }
            $email = $iremm['email'];
            Mail::to($email)->send(new ContactMail($iremm,$mesg));
            return redirect()->back()->with('success','Email was sent');
        }else{
            abort(404);
        }
    }
}
