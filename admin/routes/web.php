<?php

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

use App\Helpers\Constant;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

Route::get('/', 'HomeController@dashboard')->name('dashboard');

Route::get('/profile', 'HomeController@profile')->name('profile');
Route::post('/profile/update', 'HomeController@profile_update')->name('profile_update');

// Super Admin Middleware

Route::group(['middleware' => 'super_admin'], function () {

    // Programs

    Route::get('/programs', 'ProgramController@index')->name('programs');
    Route::get('/programs/create', 'ProgramController@create')->name('programs.create');
    Route::post('/programs/create', 'ProgramController@save');

    Route::get('/programs/{id}/edit', 'ProgramController@edit')->name('programs.edit');
    Route::post('/programs/{id}/edit', 'ProgramController@update');

    // Programs Intakes

    Route::get('/programs/intakes', 'ProgramController@intakes')->name('programs_intakes');
    Route::post('/programs/intakes/{id}/delete', 'ProgramController@intakes')->name('programs_intakes.delete');

    // Reports

    Route::get('/reports', 'ReportController@reports')->name('reports');
    Route::get('/reports/students', 'ReportController@reports_students')->name('reports.students');
    Route::get('/reports/fees', 'ReportController@reports_fees')->name('reports.fees');
    Route::get('/reports/refunds', 'ReportController@reports_refunds')->name('reports.refunds');

    // Settings

    Route::get('/settings', 'CollageController@settings')->name('settings');
    Route::post('/settings/update', 'CollageController@settings_update')->name('settings_update');

    // Staff

    Route::get('/staffs', 'CollageController@staffs')->name('staffs');
    Route::get('/staffs/create', 'CollageController@staff_create')->name('staffs.create');
    Route::post('/staffs/create', 'CollageController@staff_save');

    Route::get('/staffs/{id}/edit', 'CollageController@staff_edit')->name('staffs.edit');
    Route::post('/staffs/{id}/edit', 'CollageController@staff_update');

    Route::post('/staffs/{id}/delete', 'CollageController@staff_delete')->name('staffs.delete');

    // College Campus

    Route::get('/campus', 'CollageController@campus')->name('campus');
    Route::get('/campus/create', 'CollageController@campus_create')->name('campus.create');
    Route::post('/campus/create', 'CollageController@campus_save');

    Route::get('/campus/{id}/edit', 'CollageController@campus_edit')->name('campus.edit');
    Route::post('/campus/{id}/edit', 'CollageController@campus_update');

    Route::post('/campus/{id}/delete', 'CollageController@campus_delete')->name('campus.delete');
});

// Students Applications

Route::get('/applications', 'StudentApplicationController@index')->name('applications');

Route::get('/applications/{id}/view', 'StudentApplicationController@view')->name('applications.view');
//Route::get('/applications/edit', 'StudentApplicationController@edit')->name('applications_edit');
//Route::post('/applications/{id}/update', 'StudentApplicationController@update')->name('applications.update');
Route::post('/applications/{id}/update', 'StudentApplicationController@update');

Route::post('/applications/{id}/generate_conditional_loa', 'StudentApplicationController@generate_conditional_loa');
Route::post('/applications/{id}/verify_conditional_loa', 'StudentApplicationController@verify_conditional_loa');


Route::get('/applications/{id}/download_conditional_loa', 'StudentApplicationController@download_conditional_loa')->name('applications.download_conditional_loa');
Route::get('/applications/{id}/download_signed_conditional_loa', 'StudentApplicationController@download_signed_conditional_loa')->name('applications.download_signed_conditional_loa');

Route::post('/applications/{id}/generate_final_loa', 'StudentApplicationController@generate_final_loa');
Route::get('/applications/{id}/download_final_loa', 'StudentApplicationController@download_final_loa')->name('applications.download_final_loa');

Route::get('/applications/{id}/payments', 'StudentApplicationController@payments')->name('applications.payments');
Route::get('/applications/{id}/refunds', 'StudentApplicationController@refunds')->name('applications.refunds');

Route::post('/applications/payments/{id}/delete', 'StudentApplicationController@payment_delete')->name('applications.payment_delete');
Route::post('/applications/refunds/{id}/delete', 'StudentApplicationController@refund_delete')->name('applications.refund_delete');

Route::get('/applications/{id}/students_application_pdf', 'APIController@students_application_pdf');

// Users

Route::get('/users', 'UserController@index')->name('users');
Route::get('/users/create', 'UserController@create')->name('users.create');
Route::post('/users/create', 'UserController@save');

Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');
Route::post('/users/{id}/edit', 'UserController@update');

//
/*Route::get('/sub-agents', 'UserController@sub_agents_index')->name('sub_agents');
Route::get('/sub-agents/create', 'UserController@sub_agents_create')->name('sub_agents.create');
Route::post('/sub-agents/create', 'UserController@sub_agents_save');

Route::get('/sub-agents/{id}/edit', 'UserController@sub_agents_edit')->name('sub_agents.edit');
Route::post('/sub-agents/{id}/edit', 'UserController@sub_agents_update');*/

/** Ajax Request **/
Route::any('/ajax/{action}', 'HomeController@ajax')->name('ajax');
Route::any('/ajax/status/{action}/{id}/{type}', 'HomeController@ajax_status')->name('ajax_status');

/** Students Application **/
Route::get('/api-request/{action}', 'APIController@request');
Route::post('/api-request/saveApplication', 'APIController@saveApplication');

//Auth::routes();
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
#Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


// user invitation link
Route::get('user/invitation/{token}', 'UserController@setInvitationPassword')->name('user_invitation_link');
Route::post('user/invitation', 'UserController@saveInvitationPassword')->name('save_user_invitation_link');


Route::get('storage/signature/{filename}', function ($filename) {
    //$signed_conditional_loa = storage_path('app' . DIRECTORY_SEPARATOR . Constant::SIGNED_LOA_FOLDER . DIRECTORY_SEPARATOR . $student_admission->signed_loa_filename);
    $path = storage_path('app/' .Constant::SIGNATURE_FOLDER . '/' . $filename);

    //dd($path);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->name('storage_signature');

Route::get('/phpinfo', function () {
    phpinfo();
});


Route::group(['prefix' => 'dev-test'], function () {
    /*Route::get('/create-super-admin', function () {
        $user = User::find(1);
        if (!$user) {
            $user = User::create([
                'first_name'     => 'admin',
                'email'          => 'admin',
                'password'       => bcrypt('123456'),
                'is_super_admin' => 1,
            ]);
        }
        dump($user);
    });*/

    /*Route::get('/create-roles', function () {
        $roles = Role::all();
        if ($roles->count() == 0) {
            Role::create(['name' => 'Super Admin']);
            Role::create(['name' => 'Admin']);
        }
        dump($roles);
    });*/

    Route::get('/test', function () {
        dump(bcrypt('123456'));
    });

    Route::get('/super-admin-password', function () {
        $user = User::find(1);
        dump($user);
        if ($user) {
            $user->password = bcrypt('123456');
            $user->save();
        }
    });

    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        return "All Cache/route/config/view is cleared";
    });

    Route::get('/php-artisan', function () {
        Artisan::call('optimize');
        Artisan::call('dump-autoload');
        //system('composer dump-autoload');

        return "All optimize/dump-autoload";
    });

    Route::get('/database', function () {
        //DB::statement('');
        //DB::statement('');
    });
});
