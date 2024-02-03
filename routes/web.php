<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\ContentController;
use App\Http\Controllers\admin\UserController as AdminUserController;
use App\Http\Controllers\admin\PhaseController;
use App\Http\Controllers\admin\PartController;
use App\Http\Controllers\admin\LessonController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\QuizController;
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

        Route::get('/user',[AdminUserController::class,'user'])->name('admin.user');
        Route::get('/user_delete/{id}',[AdminUserController::class,'user_delete'])->name('admin.user_delete');
        Route::get('/add_user',[AdminUserController::class,'add_user'])->name('admin.add_user');
        Route::post('/add_user',[AdminUserController::class,'save_user'])->name('admin.save_user');
        Route::get('/edit_user/{id}',[AdminUserController::class,'edit_user'])->name('admin.edit_user');
        Route::post('/user_membership',[AdminUserController::class,'user_membership'])->name('admin.user_membership');
                   
        // COURSE  //

        Route::get('/course/{id}/',[CourseController::class,'course'])->name('admin.course');
        Route::post('/course',[CourseController::class,'add_course'])->name('admin.course');
        Route::get('/course',[CourseController::class,'course'])->name('admin.course');
        Route::get('/course_delete/{id}',[CourseController::class,'course_delete'])->name('admin.course_delete');
        Route::patch('/edit_course/{id}',[CourseController::class,'edit_course'])->name('admin.edit_course');
        Route::get('/course-detail/{id}/{slug?}',[CourseController::class,'course_detail'])->name('admin.course_detail');
        Route::post('/course_import',[CourseController::class,'import_course'])->name('admin.import_course');
        Route::get('/course_export',[CourseController::class,'export_course'])->name('admin.export_course');
                   
        // CONTENT  //

        Route::get('/content-list',[ContentController::class,'content_list'])->name('admin.content_list');
        Route::get('/content',[ContentController::class,'add_content'])->name('admin.add_content');
        Route::post('/content',[ContentController::class,'save_content'])->name('admin.save_content');
        Route::get('/content/{id}/',[ContentController::class,'edit_content'])->name('admin.edit_content');
        Route::post('/content/{id}/',[ContentController::class,'update_content'])->name('admin.update_content');
        Route::get('/delete_content/{id}',[ContentController::class,'delete_content'])->name('admin.delete_content');
                   
        // PHASE  //

        Route::get('/phase/{id}/',[PhaseController::class,'phase'])->name('admin.phase');
        Route::post('/phase',[PhaseController::class,'add_phase'])->name('admin.phase');
        Route::get('/phase',[PhaseController::class,'phase'])->name('admin.phase');
        Route::get('/phase_delete/{id}',[PhaseController::class,'phase_delete'])->name('admin.phase_delete');
        Route::patch('/edit_phase/{id}',[PhaseController::class,'edit_phase'])->name('admin.edit_phase');
        Route::post('/phase_import',[PhaseController::class,'import_phase'])->name('admin.import_phase');
        Route::get('/phase_export',[PhaseController::class,'export_phase'])->name('admin.export_phase');

        // ------- END PHASE-------- //

        // PART  //
        
        Route::get('/part/{id}/',[PartController::class,'part'])->name('admin.part');
        Route::get('/part',[PartController::class,'part'])->name('admin.part');
        Route::post('/part',[PartController::class,'add_part'])->name('admin.part');
        Route::patch('/edit_part/{id}',[PartController::class,'edit_part'])->name('admin.edit_part');
        Route::get('/part_delete/{id}',[PartController::class,'part_delete'])->name('admin.part_delete');
        Route::post('/part_import',[PartController::class,'import_part'])->name('admin.import_part');
        Route::get('/part_export',[PartController::class,'export_part'])->name('admin.export_part');

        // ----- END PART---//

        // QUIZ //

        Route::get('/quiz/{id}/',[QuizController::class,'quiz'])->name('admin.quiz');
        Route::get('/quiz',[QuizController::class,'quiz'])->name('admin.quiz');
        Route::post('/quiz',[QuizController::class,'add_quiz'])->name('admin.quiz');
        Route::patch('/edit_quiz/{id}',[QuizController::class,'edit_quiz'])->name('admin.edit_quiz');
        Route::get('/quiz_delete/{id}',[QuizController::class,'quiz_delete'])->name('admin.quiz_delete');
        Route::post('/quiz_import',[QuizController::class,'import_quiz'])->name('admin.import_quiz');
        Route::get('/quiz_export',[QuizController::class,'export_quiz'])->name('admin.export_quiz');

        // Question //
        
        Route::get('/question/{quiz_id}/{id}',[QuizController::class,'question'])->name('admin.question');
        Route::get('/question',[QuizController::class,'question'])->name('admin.question');
        Route::post('/question',[QuizController::class,'add_question'])->name('admin.question');
        Route::patch('/question_edit/{id}/{quiz_id}',[QuizController::class,'edit_question'])->name('admin.question_edit');
        Route::get('/question_delete/{id}/{quiz_id}',[QuizController::class,'question_delete'])->name('admin.question_delete');
        Route::post('/question_import',[QuizController::class,'import_question'])->name('admin.import_question');
        Route::get('/question_export',[QuizController::class,'export_question'])->name('admin.export_question');

        // ----- END QUIZ---//

        // ----- QUIZ SUBMISSION ----- //
    
        Route::get('/quiz-submission',[QuizController::class,'quiz_submission'])->name('admin.quiz_submission');
        Route::get('/quiz-submission/data',[QuizController::class,'quiz_submission_data'])->name('admin.quiz_submission.data');
        Route::get('/quiz-submission-detail/{parent_id}',[QuizController::class,'quiz_submission_detail'])->name('admin.quiz_submission.detail');

        //   MEMBERSHIP //

        Route::get('/membership/{id}',[HomeController::class,'Membership'])->name('admin.membership');
        Route::get('/membership',[HomeController::class,'Membership'])->name('admin.membership');
        Route::Post('/membership',[HomeController::class,'Add_Membership'])->name('admin.membership');
        Route::patch('/edit_membership/{id}',[HomeController::class,'edit_membership'])->name('admin.edit_membership');
        Route::get('/membership_delete/{id}',[HomeController::class,'Membership_delete'])->name('admin.membership_delete');

        // ----- END MEMBERSHIP---//

        // LESSON //
        
        Route::get('/lesson',[LessonController::class,'Lesson'])->name('admin.lesson');
        Route::get('/lesson/{id}',[LessonController::class,'Lesson'])->name('admin.lesson');
        Route::post('/lesson',[LessonController::class,'Add_Lesson'])->name('admin.lesson');
        Route::patch('/edit_lesson/{id}',[LessonController::class,'edit_lesson'])->name('admin.edit_lesson');
        Route::get('/lesson_delete/{id}',[LessonController::class,'lesson_delete'])->name('admin.lesson_delete');
        Route::post('/lesson_import',[LessonController::class,'import_lesson'])->name('admin.import_lesson');
        Route::get('/lesson_export',[LessonController::class,'export_lesson'])->name('admin.export_lesson');

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

    