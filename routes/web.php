<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\VerifyEmailController;

// Route::get('/admin/tyumnnfvrd', function() {
//     \DB::table('admins')->insert([
//         'name' => 'admin',
//         'email' => 'email@email.com',
//         'password' => \Hash::make('admin123'),
//         'phone' => '0123123123',
//         'role' => 1
//     ]);
// });

// Route::get('/customer/lkjskjnckjrn', function() {
//     \DB::table('users')->insert([
//         'name' => 'admin',
//         'email' => 'email@email.com',
//         'password' => \Hash::make('admin123'),
//         'phone' => '0123123123',
//         'email_verified' => 'email@email.com',
//         'gender' => 1
//     ]);
// });

/*
| admin routing group
*/
Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['prefix' => '/admin', 'as' => 'ad.', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::group(['middleware' => 'admin.check'],function(){
        Route::resource('config', 'ConfigController')->except('show');
        Route::resource('cms', 'CmsController')->except('show');
        Route::resource('exam', 'ExamController');
        Route::patch('exam/status/{exam}', 'ExamController@updateStatus')->name('exam.status');
        Route::get('result-exam', 'ExamController@resultExam')->name('exam.result');
        Route::get('export-result-exam', 'ExamController@exportResult')->name('exam.export_result');
        Route::get('search-exam', 'ExamController@search')->name('exam.search');
        Route::delete('exam-question/{id}', 'ExamController@delete')->name('exam-question.delete');
        Route::resource('profession', 'ProfessionController');
        Route::resource('question', 'QuestionController');
        Route::patch('question/status/{question}', 'QuestionController@updateStatus')->name('question.status');
        Route::get('search-question', 'QuestionController@search')->name('question.search');
        Route::get('question-export', 'QuestionController@exportQuestion')->name('question.export_question');
        Route::post('question/{question}', 'QuestionController@answer')->name('question.answer');
        Route::resource('answer', 'AnswerController')->only('destroy');
        Route::get('course/bought', 'BoughtCourseController@index')->name('course.bought');
        Route::get('course/bought/search', 'BoughtCourseController@search')->name('course.bought-search');
        Route::resource('courses', 'CoursesController');
        Route::patch('course/status/{course}', 'CoursesController@updateStatus')->name('course.status');
        Route::get('course/feedback/{course}', 'CoursesController@getFeedbackByCourse')->name('course.get_feedback');
        Route::get('search-courses', 'CoursesController@search')->name('courses.search');
        Route::get('confirm-exam', 'ExamConfirmController@index')->name('exam-confirm.index');
        Route::get('confirm-exam/{courseUser}', 'ExamConfirmController@edit')->name('exam-confirm.edit');
        Route::post('confirm-exam/{courseUser}', 'ExamConfirmController@update')->name('exam-confirm.update');
        Route::resource('lesson', 'LessonController');
        Route::get('search-lesson', 'LessonController@search')->name('lesson.search');
        Route::patch('lesson/status/{lesson}', 'LessonController@updateStatus')->name('lesson.status');
        Route::resource('lesson-question', 'LessonQuestionController')->only('edit','update','destroy')->parameters([
        'lesson-question' => 'lesson'
        ]);
        Route::resource('admin', 'AdminController')->except('show');
        Route::resource('user', 'UserController')->only('index','show');
        Route::get('user-export', 'UserController@exportUser')->name('user.export_excel');
        Route::put('count/{id}', 'UserController@count')->name('user.count');
        Route::get('search-user', 'UserController@search')->name('user.search');
        Route::get('recharge','PaymentController@getRecharge')->name('payment.getRecharge');
        Route::resource('expert', 'ExpertController')->only('index','edit','update');
        Route::get('search-expert', 'ExpertController@search')->name('expert.search');
        Route::get('internship', 'InternshipController@index')->name('internship.index');
        Route::get('internship/edit/{customer}', 'InternshipController@edit')->name('internship.edit','update');
        Route::put('internship/update/{customer}', 'InternshipController@update')->name('internship.update');
        Route::get('search-internship', 'InternshipController@search')->name('internship.search');
        Route::get('news-internship', 'InternshipNewsController@index')->name('news-internship.index');
        Route::get('news-internship/show/{internship}', 'InternshipNewsController@show')->name('news-internship.show');
        Route::get('news-internship/{internship}/list-intern', 'InternshipNewsController@listIntern')->name('list-intern');
        Route::get('news-internship/{internship}/list-intern/{userCustomer}', 'InternshipNewsController@showIntern')->name('show-intern');
        Route::patch('status/{internship}', 'InternshipNewsController@status')->name('news-internship.status');
        Route::get('search-news-internship', 'InternshipNewsController@search')->name('news-internship.search');
        Route::resource('contact', 'ContactController')->only('index');
    });
    Route::get('/', 'DashboardController@index')->name('index');
    Route::resource('blog', 'BlogController')->except('show');
    Route::patch('update-status/{blog}', 'BlogController@updateStatus')->name('blog.update_status');
    Route::resource('category', 'CategoryController')->except('show');
    Route::patch('category/status/{category}', 'CategoryController@status')->name('category.status');
    Route::get('search-blog', 'BlogController@search')->name('blog.search');
    Route::resource('slider', 'SliderController')->except('show');
    Route::patch('slider/status/{slider}', 'SliderController@status')->name('slider.status');
    Route::resource('partner', 'PartnerController')->except('show');
    Route::resource('feedback', 'FeedbackController')->except('show');
    Route::patch('feedback/status/{feedback}', 'FeedbackController@status')->name('feedback.status');

    Route::post('/logout', 'LoginController@logout')->name('logout');
});

Route::get('/login', 'Admin\LoginController@index')->name('ad.login.index');
Route::post('/login', 'Admin\LoginController@login')->name('ad.login');

/*
| customer routing group
*/
Route::prefix('/customer')->namespace('Customer')->as('us.')->group(function () {
    Route::get('/',function(){
        return redirect()->route('us.login.index');
    });
    Route::get('/dang-ky', 'RegisterController@create')->name('register.create');
    Route::post('/dang-ky', 'RegisterController@store')->name('register.store');
    Route::get('/dang-nhap', 'LoginController@index')->name('login.index')->middleware('customer.check');
    Route::post('/dang-nhap', 'LoginController@check')->name('login.check');

    Route::middleware('customer.login')->group(function () {
        Route::get('/chuyen-gia', 'ExpertController@index')->name('expert.index')->middleware('customer.expert.check');
        Route::put('/chuyen-gia/{customer}', 'ExpertController@update')->name('expert.update')->middleware('customer.expert.check');
        Route::get('/thuc-tap', 'InternshipController@index')->name('internship.index')->middleware('customer.internship.check');
        Route::put('/thuc-tap/{customer}', 'InternshipController@update')->name('internship.update')->middleware('customer.internship.check');
        Route::get('/tuyen-dung', 'InternshipController@recruitment')->name('internship.recruitment')->middleware('customer.internship.check');
        Route::post('/tuyen-dung', 'InternshipController@createRecruitment')->name('internship.create-recruitment')->middleware('customer.internship.check');
        Route::get('/sua-tin-tuyen-dung/{internship}', 'InternshipController@editRecruitment')->name('internship.edit-recruitment')->middleware('customer.internship.check');
        Route::post('/sua-tin-tuyen-dung/{internship}', 'InternshipController@updateRecruitment')->name('internship.update-recruitment')->middleware('customer.internship.check');
        Route::get('/danh-gia-hoc-vien/{internship}/{userCustomer}', 'InternshipController@evaluate')->name('internship.evaluate')->middleware('customer.internship.check');
        Route::post('/danh-gia-hoc-vien/{internship}/{userCustomer}', 'InternshipController@evaluatePost')->name('internship.evaluate-post')->middleware('customer.internship.check');
        Route::patch('status/{internship}', 'InternshipController@status')->name('internship.status')->middleware('customer.internship.check');
        Route::get('/tuyen-dung/tim-kiem', 'InternshipController@search')->name('internship.search')->middleware('customer.internship.check');
        Route::patch('confirm/{userCustomer}', 'InternshipController@statusRecruitment')->name('internship.status-recruitment')->middleware('customer.internship.check');
        Route::get('/dang-xuat', 'LoginController@logout')->name('login.logout');
    });

});

/*
| user routing group
*/
Route::group(['as' => 'w.', 'namespace' => 'Web'], function () {
    Route::get('auto-email',[\App\Http\Controllers\AutoEmailController::class,'sendWhenOverTime']);
    Route::get('email/xac-thuc-email', 'VerifyEmailController@web')->name('verify_email');
    Route::get('email/lay-ma-xac-thuc-email', 'VerifyEmailController@sendVerifyCode')->name('verify_email.get');
    Route::put('xac-thuc-email/{user}', 'VerifyEmailController@checkVerifyCode')->name('verify_email.check');
    Route::get('/dang-ky', 'LoginController@getRegister')->name('get_register');
    Route::post('/dang-ky', 'LoginController@register')->name('register');
    Route::get('/dang-nhap', 'LoginController@getLogin')->name('get_login');
    Route::post('/dang-nhap', 'LoginController@login')->name('login');
    Route::get('/dang-xuat', 'LoginController@logout')->name('logout')->middleware('userLogin');
    /* tính năng quên mật khẩu */
    Route::get('/quen-mat-khau', 'ForgetPasswordController@forgetPassword')->name('forget_password');
    Route::put('/quen-mat-khau', 'ForgetPasswordController@postEmail')->name('post.forget_password');
    Route::get('/doi-mat-khau-moi/{user}/{token}', 'ForgetPasswordController@getPass')->name('get_pass');
    Route::put('/doi-mat-khau-moi/{user}', 'ForgetPasswordController@changePass')->name('post.verify_password');

    Route::group(['middleware'=>'verify.email'],function(){
        Route::get('/', [HomeController::class, 'index'])->name('home');

        //account of customer
        Route::get('tai-khoan', 'AccountController@index')->name('tai-khoan.index');
        Route::put('tai-khoan/update/{user}','AccountController@update')->name('account.update');
        Route::get('mat-khau', 'AccountController@updatePassword')->name('account.password');
        Route::put('mat-khau/{user}','AccountController@changePassword')->name('account.change_password');

        //courses
        Route::get('khoa-hoc', 'CourseController@index')->name('course.index');
        Route::get('khoa-hoc/mien-phi', 'CourseController@courseFree')->name('course.free');
        Route::get('khoa-hoc/nganh-nghe/{profession_slug}', 'CourseController@getCourseByProfession')->name('course.get_courses');
        Route::post('khoa-hoc/sap-xep', 'CourseController@arrange')->name('course.arrange');
        Route::get('khoa-hoc/tim-kiem', 'CourseController@search')->name('course.search');
        Route::get('khoa-hoc/{course_slug}', 'CourseController@show')->name('course.show');
        Route::get('khoa-hoc/{course_slug}/lua-chon-chuyen-gia', 'CourseController@selectExpert')->name('course.select_expert');
        Route::post('khoa-hoc/{course}/{expert}', 'CourseController@saveSelectedExpert')->name('course.save_selected_expert');

        // Route::get('khoa-hoc-da-mua', 'CourseController@mycourse')->name('course.mycourse');
        //thi ngay
        Route::get('khoa-hoc/{course_slug}/thong-tin-xac-nhan', 'CertificateExamNowController@index')->name('certificate.index');
        Route::put('khoa-hoc/{course}/thong-tin-xac-nhan', 'CertificateExamNowController@store')->name('certificate.store');

        //checkout
        Route::get('thanh-toan', 'CheckoutController@index')->name('checkout.index');

        //introduce
        Route::get('gioi-thieu', 'HomeController@introduce')->name('introduce');

        //contact
        Route::get('lien-he', 'ContactController@index')->name('contact.index');
        Route::post('lien-he', 'ContactController@store')->name('contact.store');

        // middleware check user logined
        Route::group(['middleware'=>'userLogin'], function () {

            //learn
            Route::get('hoc/{course_slug}', 'LearnController@index')->name('learn.index')->middleware('course.check.expert');
            Route::get('hoc/{course_slug}/truoc/{lesson_slug}', 'LearnController@preShow')->name('learn.show.previous')->middleware('course.check.expert');
            Route::get('hoc/{course_slug}/tiep-theo/{lesson_slug}', 'LearnController@nextShow')->name('learn.show.next')->middleware('course.check.expert');
            Route::post('{lesson}/cham-diem', 'LearnController@reviewGrade')->name('learn.review');

            /* exam */
            Route::get('thi/{course_slug}', 'ExamController@exam')->name('exam.exam');
            Route::get('thi-thu/{course_slug}', 'ExamController@test')->name('exam.test');
            Route::get('cau-hoi/{question_id}', 'ExamController@question')->name('exam.question');
            Route::post('thi/ket-qua/{course}/{exam_id}', 'ExamController@mark')->name('exam.mark');
            Route::post('thi-thu/ket-qua/{course}/{exam_id}', 'ExamController@auditions')->name('exam.auditions');
            Route::get('lich-su-thi', 'ExamController@history')->name('exam.history');
            Route::get('lich-su-thi/dap-an-sai/{history}', 'ExamController@result')->name('exam.result');


            //courses
            Route::get('khoa-hoc/dang-ky/{course}', 'CourseController@register')->name('course.register');
            Route::put('khoa-hoc/danh-gia/{course}', 'CourseController@feedback')->name('course.feedback');
            Route::get('khoa-hoc-da-mua', 'CourseController@bought')->name('course.bought');

            // payment managmentine'); // Thanh toán debit card
            //        Route::get('phuong-thuc-nap-tien/{method_bank}','PaymentController@method_bank')->name('payment.method_bank'); // Giao diện momo
            //        Route::get('nap-tien/ma-qr','PaymentController@getQrbank')->name('payment.getQrbank'); // Giao diện quét mã QR
            //        Route::get('nap-tien/chuyen-khoan','PaymentController@getOnline')->name('payment.getOnline'); // Giao diện Chuyển khoản ATM

            //        Route::get('nap-tien/thanh-cong','PaymentController@success')->name('payment.success'); // xử lý thanh toán để hiển thị popup
            //        Route::get('nap-tien/ket-qua','PaymentController@result')->name('payment.result'); //callback vnpay

            Route::get('nap-tien','PaymentController@payRecharge')->name('payment.recharge'); //
            Route::get('nap-tien/lich-su','AccountController@payHistory')->name('account.history'); //

            Route::post('thuc-tap/ung-tuyen/{internship}', 'InternshipController@recruitment')->name('internship.recruitment');
            Route::put('thuc-tap/ung-tuyen/huy-ung-tuyen/{internship}', 'InternshipController@deleteRecruitment')->name('internship.delete-recruitment');
            Route::get('thong-tin-thuc-tap', 'AccountController@intership')->name('account.intership');
            Route::get('thong-tin-thuc-tap/{userCustomer}', 'AccountController@evaluate')->name('account.evaluate');


        });

        Route::get('payment/success','PaymentController@success')->name('payment.success');
        Route::get('payment/notify','PaymentController@notify')->name('payment.notify');

        //internship
        Route::get('thuc-tap/', 'InternshipController@index')->name('internship.index');
        Route::get('thuc-tap/nganh-nghe/{slug}', 'InternshipController@searchByProfession')->name('internship.search_by_profession');
        Route::get('thuc-tap/{internship_slug}', 'InternshipController@show')->name('internship.show');

        //expert
        Route::get('chuyen-gia/', 'ExpertController@index')->name('expert.index');
        Route::get('chuyen-gia/nganh-nghe/{slug}', 'ExpertController@searchByProfession')->name('expert.search_by_profession');
        Route::get('chuyen-gia/{customer_slug}', 'ExpertController@show')->name('expert.show');

        //blog
        Route::get('danh-sach-bai-viet', 'BlogController@index')->name('blog.index');
        Route::get('danh-sach-bai-viet/{category_slug}', 'BlogController@getByCategorySlug')->name('blog.getBySlug');
        Route::get('danh-sach-bai-viet/{category_slug}/{blog_slug}', 'BlogController@show')->name('blog.show');
        Route::get('{blog_slug}', 'BlogController@showTerm')->name('blog.show.term');
    });


});
