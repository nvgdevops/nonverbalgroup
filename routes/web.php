<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\ContentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('clear-cache', function() {
    $output = [];
    \Artisan::call('cache:clear', $output);
	\Artisan::call('config:clear', $output);
    \Artisan::call('config:cache', $output);	
    \Artisan::call('view:clear', $output);
    \Artisan::call('route:clear', $output);
    \Artisan::call('config:cache', $output);
    \Artisan::call('storage:link', $output);
    dd($output);
});


Route::group(['prefix' => 'admin'],function(){

    Route::group(['middleware' => 'admin.guest'],function(){
        
       Route::get('/login',[AdminLoginController::class,'index'])->name('admin.login');
       Route::post('/authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');
       
    });

    Route::group(['middleware' => 'admin.auth'],function(){

        Route::get('/dashboard',[HomeController::class,'index'])->name('admin.dashboard');
        Route::get('/logout',[HomeController::class,'logout'])->name('admin.logout');

       Route::get('/user_delete/{id}',[HomeController::class,'User_delete'])->name('admin.user_delete');
       Route::get('/edit_user/{id}',[HomeController::class,'edit_user'])->name('admin.edit_user');
       Route::post('/user_membership',[HomeController::class,'User_membership'])->name('admin.user_membership');
                   
        // COURSE  //

        Route::get('/course/{id}/',[HomeController::class,'course'])->name('admin.course');
        Route::post('/course',[HomeController::class,'add_course'])->name('admin.course');
        Route::get('/course',[HomeController::class,'course'])->name('admin.course');
        Route::get('/course_delete/{id}',[HomeController::class,'course_delete'])->name('admin.course_delete');
        Route::patch('/edit_course/{id}',[HomeController::class,'edit_course'])->name('admin.edit_course');
        Route::get('/course-detail/{id}/{slug?}',[HomeController::class,'course_detail'])->name('admin.course_detail');
                   
        // CONTENT  //

        Route::get('/content-list',[ContentController::class,'content_list'])->name('admin.content_list');
        Route::get('/content',[ContentController::class,'add_content'])->name('admin.add_content');
        Route::post('/content',[ContentController::class,'save_content'])->name('admin.save_content');
        Route::get('/content/{id}/',[ContentController::class,'edit_content'])->name('admin.edit_content');
        Route::post('/content/{id}/',[ContentController::class,'update_content'])->name('admin.update_content');
        Route::get('/delete_content/{id}',[ContentController::class,'delete_content'])->name('admin.delete_content');
                   
        // PHASE  //

        Route::get('/phase/{id}/',[HomeController::class,'Phase'])->name('admin.phase');
        Route::post('/phase',[HomeController::class,'add_phase'])->name('admin.phase');
        Route::get('/phase',[HomeController::class,'Phase'])->name('admin.phase');
        Route::get('/phase_delete/{id}',[HomeController::class,'Phase_delete'])->name('admin.phase_delete');
        Route::patch('/edit_phase/{id}',[HomeController::class,'edit_phase'])->name('admin.edit_phase');

        // ------- END PHASE-------- //

        // PART  //
        
        Route::get('/part/{id}/',[HomeController::class,'Part'])->name('admin.part');
        Route::get('/part',[HomeController::class,'Part'])->name('admin.part');
        Route::post('/part',[HomeController::class,'Add_Part'])->name('admin.part');
        
        Route::patch('/edit_part/{id}',[HomeController::class,'edit_part'])->name('admin.edit_part');
        Route::get('/part_delete/{id}',[HomeController::class,'Part_delete'])->name('admin.part_delete');

        // ----- END PART---//

        // QUIZ //

        Route::get('/quiz/{id}/',[HomeController::class,'Quiz'])->name('admin.quiz');
        Route::get('/quiz',[HomeController::class,'Quiz'])->name('admin.quiz');
        Route::post('/quiz',[HomeController::class,'Add_Quiz'])->name('admin.quiz');
        Route::patch('/edit_quiz/{id}',[HomeController::class,'edit_quiz'])->name('admin.edit_quiz');
        Route::get('/quiz_delete/{id}',[HomeController::class,'Quiz_delete'])->name('admin.quiz_delete');


        // Question //
        
        Route::get('/question/{quiz_id}/{id}',[HomeController::class,'Question'])->name('admin.question');
        Route::get('/question',[HomeController::class,'Question'])->name('admin.question');
        Route::post('/question',[HomeController::class,'Add_Question'])->name('admin.question');
        Route::patch('/question_edit/{id}/{quiz_id}',[HomeController::class,'edit_Question'])->name('admin.question_edit');
        Route::get('/question_delete/{id}/{quiz_id}',[HomeController::class,'question_delete'])->name('admin.question_delete');

        // ----- END QUIZ---//

        // ----- QUIZ SUBMISSION ----- //
    
        Route::get('/quiz-submission',[HomeController::class,'quiz_submission'])->name('admin.quiz_submission');
        Route::get('/quiz-submission/data',[HomeController::class,'quiz_submission_data'])->name('admin.quiz_submission.data');
        Route::get('/quiz-submission-detail/{parent_id}',[HomeController::class,'quiz_submission_detail'])->name('admin.quiz_submission.detail');

        //   MEMBERSHIP //

        Route::get('/membership/{id}',[HomeController::class,'Membership'])->name('admin.membership');
        Route::get('/membership',[HomeController::class,'Membership'])->name('admin.membership');
        Route::Post('/membership',[HomeController::class,'Add_Membership'])->name('admin.membership');
        Route::patch('/edit_membership/{id}',[HomeController::class,'edit_membership'])->name('admin.edit_membership');
        Route::get('/membership_delete/{id}',[HomeController::class,'Membership_delete'])->name('admin.membership_delete');

        // ----- END MEMBERSHIP---//

        // LESSON //
       
        Route::get('/lesson',[HomeController::class,'Lesson'])->name('admin.lesson');
        Route::get('/lesson/{id}',[HomeController::class,'Lesson'])->name('admin.lesson');
        Route::post('/lesson',[HomeController::class,'Add_Lesson'])->name('admin.lesson');
        Route::patch('/edit_lesson/{id}',[HomeController::class,'edit_lesson'])->name('admin.edit_lesson');
        Route::get('/lesson_delete/{id}',[HomeController::class,'lesson_delete'])->name('admin.lesson_delete');
        Route::get('/user',[HomeController::class,'User'])->name('admin.user');

        // ----- END LESSON---//
        
    });
});

//  Route::group(['middleware' => 'guest'], function(){
//     Route::get('/login',[UserController::class,'login'])->name('login');
//     Route::post('/authanticate',[UserController::class,'authanticate'])->name('authanticate');
  

// });
// Route::group(['middleware' => 'auth'], function(){
//     Route::get('/home',[UserController::class,'home'])->name('home');
//     Route::get('/logout',[UserController::class,'logout'])->name('logout');
    
// });


Route::get('', [AuthController::class, 'index'])->name('login');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('view', [AuthController::class, 'view'])->name('view');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('post-login'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('post-registration'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
  

Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware(['auth', 'is_verify_email'])->name('dashboard'); 
Route::get('account/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify');
// Route::get('emailverify', [AuthController::class, 'checkemail'])->name('emailverify');
Route::get('check-your-inbox', [AuthController::class, 'checkemail'])->name('check-your-inbox');
Route::get('phase/{slug?}', [AuthController::class, 'Phase_Detail'])->name('phase');
Route::get('quizes/{slug}', [AuthController::class, 'Deatil_quizes'])->name('quizes');
Route::get('detail-nested-conten/{slug}', [AuthController::class, 'Deatil_nested_conten'])->name('detail-nested-conten');
Route::post('post-answer', [AuthController::class, 'Post_Answer'])->name('post-answer'); 
Route::post('submit-quiz', [AuthController::class, 'submit_quiz'])->name('submit-quiz'); 
Route::post('update-video-time', [AuthController::class, 'update_video_time'])->name('update-video-time'); 

    