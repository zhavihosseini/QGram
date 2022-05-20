<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\GoogleSocialiteController;
use App\Mail\WelcomeMail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*Route::get('/testtt',[\App\Http\Controllers\HomeController::class,'testtt'])->name('testtt');*/
Route::get('/Privacy-Policy',[\App\Http\Controllers\HomeController::class,'privacy'])->name('privacy');
Route::get('/Terms-Of-Use',[\App\Http\Controllers\HomeController::class,'term'])->name('term');
Route::post('/contact',[\App\Http\Controllers\HomeController::class,'contact'])->name('contact');
Route::group(['middleware' => ['prevent-back-history']],function(){
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'home'])->name('home');
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [\App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware(['auth'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/verified');
    })->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
    Route::get('verified', [App\Http\Controllers\HomeController::class, 'verified'])->name('verified');
    Route::post('/submit-contact', [\App\Http\Controllers\HomeController::class, 'submitContactForm'])->name('contact.submit');
    Route::get('/dashboard/wifi',[\App\Http\Controllers\HomeController::class,'wifi'])->name('wifi');
    Route::post('/dashboard/wifi/wifiQRCODE/', [\App\Http\Controllers\HomeController::class, 'wifiQRCODE'])->name('wifiQRCODE');
    Route::get('/dashboard/wifi/delete/{id}/', [\App\Http\Controllers\HomeController::class, 'delete'])->name('delete');
    Route::get('/dashboard/wifi/edit/{id}/', [\App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
    Route::post('/dashboard/wifi/edit/{id}/', [\App\Http\Controllers\HomeController::class, 'submited'])->name('submited');
    Route::get('/dashboard/bitcoin',[\App\Http\Controllers\HomeController::class,'bitcoin'])->name('bitcoin');
    Route::post('/dashboard/bitcoinn/',[\App\Http\Controllers\HomeController::class,'bitcoinn'])->name('bitcoinn');
    Route::get('/dashboard/bitcoin/delete/{ids}',[\App\Http\Controllers\HomeController::class,'deletee'])->name('deletee');
    Route::get('/dashboard/bitcoin/update/{id}',[\App\Http\Controllers\HomeController::class,'updates'])->name('updates');
    Route::post('/dashboard/bitcoin/update/{id}',[\App\Http\Controllers\HomeController::class,'sub'])->name('sub');
    Route::get('/dashboard/message',[\App\Http\Controllers\HomeController::class,'message'])->name('message');
    Route::post('/dashboard/message/postmessage',[\App\Http\Controllers\HomeController::class,'postmessage'])->name('postmessage');
    Route::get('/dashboard/message/edits/{id}',[\App\Http\Controllers\HomeController::class,'edits'])->name('edits');
    Route::post('/dashboard/message/edits/{id}',[\App\Http\Controllers\HomeController::class,'subs'])->name('subs');
    Route::get('/dashboard/message/delete/{ids}',[\App\Http\Controllers\HomeController::class,'deleteit'])->name('deleteit');
    Route::get('/dashboard/phone',[\App\Http\Controllers\HomeController::class,'phone'])->name('phone');
    Route::post('/dashboard/phone/phonenumber',[\App\Http\Controllers\HomeController::class,'phonenumber'])->name('phonenumber');
    Route::get('/dashboard/phone/editsphone/{id}',[\App\Http\Controllers\HomeController::class,'editsphone'])->name('editsphone');
    Route::post('/dashboard/phone/editsphone/{id}',[\App\Http\Controllers\HomeController::class,'suub'])->name('suub');
    Route::get('/dashboard/phone/deleted/{ids}',[\App\Http\Controllers\HomeController::class,'deleted'])->name('deleted');
    Route::get('/dashboard/geo',[\App\Http\Controllers\HomeController::class,'geo'])->name('geo');
    Route::post('/dashboard/geo/geolocation',[\App\Http\Controllers\HomeController::class,'geolocation'])->name('geolocation');
    Route::get('/dashboard/geo/geoedit/{id}',[\App\Http\Controllers\HomeController::class,'geoedit'])->name('geoedit');
    Route::post('/dashboard/geo/geoedit/{id}',[\App\Http\Controllers\HomeController::class,'subz'])->name('subz');
    Route::get('/dashboard/geo/deleted/{ids}',[\App\Http\Controllers\HomeController::class,'deleteits'])->name('deleteits');
    Route::get('/dashboard/email',[\App\Http\Controllers\HomeController::class,'email'])->name('email');
    Route::post('/dashboard/email/emailsub',[\App\Http\Controllers\HomeController::class,'emailsub'])->name('emailsub');
    Route::get('/dashboard/email/emailedit/{id}',[\App\Http\Controllers\HomeController::class,'emailedit'])->name('emailedit');
    Route::post('/dashboard/email/emailedit/{id}',[\App\Http\Controllers\HomeController::class,'subemail'])->name('subemail');
    Route::get('/dashboard/email/deleteemail/{ids}',[\App\Http\Controllers\HomeController::class,'deleteemail'])->name('deleteemail');
    Route::get('/dashboard/url',[\App\Http\Controllers\HomeController::class,'url'])->name('url');
    Route::post('/dashboard/url/urls',[\App\Http\Controllers\HomeController::class,'urls'])->name('urls');
    Route::get('/dashboard/url/editurl/{id}',[\App\Http\Controllers\HomeController::class,'editurl'])->name('editurl');
    Route::post('/dashboard/url/editurl/{id}',[\App\Http\Controllers\HomeController::class,'subedit'])->name('subedit');
    Route::get('/dashboard/url/deleteurl/{ids}',[\App\Http\Controllers\HomeController::class,'deleteurl'])->name('deleteurl');
    Route::get('auth/google',[GoogleSocialiteController::class,'redirectToGoogle'])->name('redirectToGoogle');
    Route::get('auth/google/callback',[GoogleSocialiteController::class,'handleCallback'])->name('handleCallback');
    Route::get('register/error',[\App\Http\Controllers\HomeController::class,'error'])->name('error');
    Route::get('/dashboard/scanner',[\App\Http\Controllers\HomeController::class,'scanner'])->name('scanner');
    Route::post('/save-token', [App\Http\Controllers\HomeController::class, 'saveToken'])->name('save-token');
    Route::post('/send-notification', [App\Http\Controllers\HomeController::class, 'sendNotification'])->name('send.notification');
    Route::get('welcome',[\App\Http\Controllers\HomeController::class,'wel'])->name('wel');
});
Route::get('/admin/',function (){
    if (\Illuminate\Support\Facades\Auth::user()->utype === 'ADM' && \Illuminate\Support\Facades\Auth::user()->username === 'AdMin') {
        return view('admin.dashboard');
    }else{
        abort(404);
    }
})->middleware(['AuthAdmin']);
Route::get('admin/users',[\App\Http\Controllers\AdminController::class,'usersz'])->middleware(['AuthAdmin'])->name('usersz');
Route::get('admin/users/deletedds/user/{id}',[\App\Http\Controllers\AdminController::class,'deletedss'])->middleware(['AuthAdmin'])->name('deletedss');
Route::get('admin/Session/{id}',[\App\Http\Controllers\AdminController::class,'session'])->middleware(['AuthAdmin'])->name('session');
Route::get('admin/Session/sendemail/{id}',[\App\Http\Controllers\AdminController::class,'sendeemail'])->middleware(['AuthAdmin'])->name('sendeemail');
Route::get('admin/sendemailusers/',[\App\Http\Controllers\AdminController::class,'sendemailusers'])->middleware(['AuthAdmin'])->name('sendemailusers');
Route::get('admin/sendemailtoallusers/',[\App\Http\Controllers\AdminController::class,'allusers'])->middleware('AuthAdmin')->name('allusers');

Route::get('admin/news',[\App\Http\Controllers\AdminController::class,'news'])->middleware(['AuthAdmin'])->name('news');
Route::delete('myproductsnewsz/{id}', [\App\Http\Controllers\AdminController::class,'destroynews'])->middleware(['AuthAdmin']);
Route::delete('myproductDeletenewsz', [\App\Http\Controllers\AdminController::class,'deleteAllnews'])->middleware(['AuthAdmin']);

Route::get('admin/users/delete/selected/from/bitcoin/{id}',[\App\Http\Controllers\AdminController::class,'deletebitz'])->middleware(['AuthAdmin'])->name('deletebitz');
Route::get('admin/users/delete/selected/from/emailz/{id}',[\App\Http\Controllers\AdminController::class,'deleteemailz'])->middleware(['AuthAdmin'])->name('deleteemailz');
Route::get('admin/users/delete/selected/from/geoez/{id}',[\App\Http\Controllers\AdminController::class,'deleteGeo'])->middleware(['AuthAdmin'])->name('deleteGeo');
Route::get('admin/users/delete/selected/from/Messagess/{id}',[\App\Http\Controllers\AdminController::class,'Messagessz'])->middleware(['AuthAdmin'])->name('Messagessz');
Route::get('admin/users/delete/selected/from/phonezz/{idv}',[\App\Http\Controllers\AdminController::class,'phonezzze'])->middleware(['AuthAdmin'])->name('phonezzze');
Route::get('admin/users/delete/selected/from/urlzzc/{idv}',[\App\Http\Controllers\AdminController::class,'urlzzcb'])->middleware(['AuthAdmin'])->name('urlzzcb');
Route::get('admin/users/delete/selected/from/wifiz/{idw}',[\App\Http\Controllers\AdminController::class,'wifisz'])->middleware(['AuthAdmin'])->name('wifisz');

Route::get('admin/multi/deleted/bitcoin/', [\App\Http\Controllers\AdminController::class,'indexxx'])->middleware(['AuthAdmin'])->name('indexxx');
Route::delete('myproducts/{id}', [\App\Http\Controllers\AdminController::class,'destroy'])->middleware(['AuthAdmin']);
Route::delete('myproductsDeleteAll', [\App\Http\Controllers\AdminController::class,'deleteAll'])->middleware(['AuthAdmin']);

Route::get('admin/multi/deleted/emails/', [\App\Http\Controllers\AdminController::class,'indexxxx'])->middleware(['AuthAdmin'])->name('indexxxx');
Route::delete('myproductss/{id}', [\App\Http\Controllers\AdminController::class,'destroys'])->middleware(['AuthAdmin']);
Route::delete('myproductssDeleteAlls', [\App\Http\Controllers\AdminController::class,'deleteAlls'])->middleware(['AuthAdmin']);

Route::get('admin/multi/deleted/geos/',[\App\Http\Controllers\AdminController::class,'indez'])->middleware(['AuthAdmin'])->name('indez');
Route::delete('myproductssz/{id}', [\App\Http\Controllers\AdminController::class,'destroysz'])->middleware(['AuthAdmin']);
Route::delete('myproductsszDeleteAlls', [\App\Http\Controllers\AdminController::class,'deleteAllsz'])->middleware(['AuthAdmin']);

Route::get('admin/multi/deleted/messages/',[\App\Http\Controllers\AdminController::class,'indezz'])->middleware(['AuthAdmin'])->name('indezz');
Route::delete('myproductsszz/{id}', [\App\Http\Controllers\AdminController::class,'destroyszz'])->middleware(['AuthAdmin']);
Route::delete('myproductsszzDeleteAlls', [\App\Http\Controllers\AdminController::class,'deleteAllszz'])->middleware(['AuthAdmin']);

Route::get('admin/multi/deleted/phone/',[\App\Http\Controllers\AdminController::class,'indexphone'])->middleware(['AuthAdmin'])->name('indexphone');
Route::delete('myproductsphone/{id}', [\App\Http\Controllers\AdminController::class,'destroyphone'])->middleware(['AuthAdmin']);
Route::delete('myproductDeletephone', [\App\Http\Controllers\AdminController::class,'deleteAllphone'])->middleware(['AuthAdmin']);

Route::get('admin/multi/deleted/url/',[\App\Http\Controllers\AdminController::class,'indexurl'])->middleware(['AuthAdmin'])->name('indexurl');
Route::delete('myproductsurl/{id}', [\App\Http\Controllers\AdminController::class,'destroyurl'])->middleware(['AuthAdmin']);
Route::delete('myproductDeleteurl', [\App\Http\Controllers\AdminController::class,'deleteAllurl'])->middleware(['AuthAdmin']);

Route::get('admin/multi/wifi/url/',[\App\Http\Controllers\AdminController::class,'indexwifi'])->middleware(['AuthAdmin'])->name('indexwifi');
Route::delete('myproductswifi/{id}', [\App\Http\Controllers\AdminController::class,'destroywifi'])->middleware(['AuthAdmin']);
Route::delete('myproductDeletewifi', [\App\Http\Controllers\AdminController::class,'deleteAllwifi'])->middleware(['AuthAdmin']);

Route::get('admin/contact/us',[\App\Http\Controllers\AdminController::class,'contactadmin'])->middleware(['AuthAdmin'])->name('contactadmin');
Route::delete('myproductscontactus/{id}', [\App\Http\Controllers\AdminController::class,'destroycontactus'])->middleware(['AuthAdmin']);
Route::delete('myproductDeletecontactus', [\App\Http\Controllers\AdminController::class,'deleteAllcontactus'])->middleware(['AuthAdmin']);

Route::get('admin/contact/send/email/to/Users/{id}',[\App\Http\Controllers\AdminController::class,'contactusers'])->middleware(['AuthAdmin'])->name('contactusers');
Route::get('admin/sendeemailcontact/{id}',[\App\Http\Controllers\AdminController::class,'sendeemailcontact'])->name('sendeemailcontact');
