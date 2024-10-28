<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\Admin\UserController;
use App\Http\Controllers\WEB\Admin\DashboardController;
use App\Http\Controllers\WEB\Admin\Auth\AdminLoginController;
use App\Http\Controllers\WEB\Admin\Auth\AdminForgotPasswordController;
use App\Http\Controllers\WEB\Admin\AdminProfileController;
use App\Http\Controllers\WEB\Admin\SpecificationKeyController;
use App\Http\Controllers\WEB\Admin\TestimonialController;
use App\Http\Controllers\WEB\Admin\ServiceController;
use App\Http\Controllers\WEB\Admin\AboutUsController;
use App\Http\Controllers\WEB\Admin\ContactPageController;
use App\Http\Controllers\WEB\Admin\CustomPageController;
use App\Http\Controllers\WEB\Admin\TermsAndConditionController;
use App\Http\Controllers\WEB\Admin\PrivacyPolicyController;
use App\Http\Controllers\WEB\Admin\BlogCategoryController;
use App\Http\Controllers\WEB\Admin\BlogController;
use App\Http\Controllers\WEB\Admin\PopularBlogController;
use App\Http\Controllers\WEB\Admin\BlogCommentController;
use App\Http\Controllers\WEB\Admin\SettingController;
use App\Http\Controllers\WEB\Admin\SubscriberController;
use App\Http\Controllers\WEB\Admin\ContactMessageController;
use App\Http\Controllers\WEB\Admin\EmailConfigurationController;
use App\Http\Controllers\WEB\Admin\EmailTemplateController;
use App\Http\Controllers\WEB\Admin\AdminController;
use App\Http\Controllers\WEB\Admin\FaqController;
use App\Http\Controllers\WEB\Admin\ProductReviewController;
use App\Http\Controllers\WEB\Admin\CustomerController;
use App\Http\Controllers\WEB\Admin\ErrorPageController;
use App\Http\Controllers\WEB\Admin\ContentController;
use App\Http\Controllers\WEB\Admin\CountryController;
use App\Http\Controllers\WEB\Admin\CountryStateController;
use App\Http\Controllers\WEB\Admin\CityController;
use App\Http\Controllers\WEB\Admin\HomePageController;
use App\Http\Controllers\WEB\Admin\ProductReportController;
use App\Http\Controllers\WEB\Admin\CouponController;
use App\Http\Controllers\WEB\Admin\FooterController;
use App\Http\Controllers\WEB\Admin\FooterSocialLinkController;
use App\Http\Controllers\WEB\Admin\FooterLinkController;
use App\Http\Controllers\WEB\Admin\LanguageController;
use App\Http\Controllers\WEB\Admin\NotificationController;
use App\Http\Controllers\WEB\Admin\HomeBottomSettingController;

use App\Http\Controllers\WEB\Admin\IPBlockController;

use App\Http\Controllers\WEB\Admin\CollectionBannerController;


//Frontend
use App\Http\Controllers\WEB\Frontend\Auth\AuthController as FrontAuthController;
use App\Http\Controllers\WEB\Frontend\Blog\BlogController as BlogBlogController;
use App\Http\Controllers\WEB\Frontend\HomeController as FrontHomeController;


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return "Application all cached has been cleared!";
});

Route::group(['middleware' => ['demo', 'XSS']], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'as' => 'admin.'], function () {

        // employee
        Route::get('index-user', [UserController::class, 'index'])->name('user.index');
        Route::get('create-user', [UserController::class, 'create'])->name('user.create');
        Route::post('store-user', [UserController::class, 'store'])->name('user.store');
        Route::get('stuff', [UserController::class, 'stuffPage'])->name('user.stuff');
        Route::post('stuff-login', [UserController::class, 'storeStuffLogin'])->name('user.stuff.login');
        Route::get('edit-user/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::get('delete-user/{id}', [UserController::class, 'delete_user'])->name('user.delete');
        Route::post('update-user/{id}', [UserController::class, 'update'])->name('user.update');

        Route::put('employee-status/{id}', [UserController::class, 'changeStatus'])->name('user.status');

        // employee
        // permission
        Route::get('index-permission', [UserController::class, 'permission_index'])->name('user.permission.index');
        Route::get('create-permission', [UserController::class, 'permission_create'])->name('user.permission.create');

        Route::post('store-permission', [UserController::class, 'permission_store'])->name('user.permission.store');
        Route::get('edit-permission/{id}', [UserController::class, 'permission_edit'])->name('user.permission.edit');
        Route::post('update-permission/{id}', [UserController::class, 'permission_update'])->name('user.permission.update');
        Route::get('delete-permission/{id}', [UserController::class, 'permission_delete'])->name('user.permission.delete');
        // permission
        Route::get('index-role', [UserController::class, 'role_index'])->name('user.role.index');
        Route::get('create-role', [UserController::class, 'role_create'])->name('user.role.create');
        Route::post('store-role', [UserController::class, 'role_store'])->name('user.role.store');
        Route::get('edit-role/{id}', [UserController::class, 'role_edit'])->name('user.role.edit');
        Route::post('update-role/{id}', [UserController::class, 'role_update'])->name('user.role.update');
        Route::get('delete-role/{id}', [UserController::class, 'role_delete'])->name('user.role.delete');
        // permission
        // Route::get('login', [AdminLoginController::class, 'adminLoginPage'])->name('login');
        // Route::post('login', [AdminLoginController::class, 'storeLogin'])->name('login');
        Route::post('logout', [AdminLoginController::class, 'adminLogout'])->name('logout');
        // Route::get('forget-password', [AdminForgotPasswordController::class, 'forgetPassword'])->name('forget-password');
        // Route::post('send-forget-password', [AdminForgotPasswordController::class, 'sendForgetEmail'])->name('send.forget.password');
        // Route::get('reset-password/{token}', [AdminForgotPasswordController::class, 'resetPassword'])->name('reset.password');
        // Route::post('password-store/{token}', [AdminForgotPasswordController::class, 'storeResetData'])->name('store.reset.password');
        // end auth route

        //IP Block
        Route::get('/Ip-block', [IPBlockController::class, 'index'])->name('ipblock');
        Route::get('/Ip-block/delete/{id}', [IPBlockController::class, 'delete'])->name('ipblock.delete');
        Route::get('/Ip-block/edit/{id}', [IPBlockController::class, 'edit'])->name('ipblock.edit');
        Route::put('/Ip-block/update/{id}', [IPBlockController::class, 'update'])->name('ipblock.update');
        Route::post('/Ip-block-submit', [IPBlockController::class, 'IPBlockSubmit'])->name('ipblock.submit');
        //ip block end


        Route::get('/', [DashboardController::class, 'dashobard'])->name('dashboard');
        Route::get('dashboard', [DashboardController::class, 'dashobard'])->name('dashboard');
        Route::get('profile', [AdminProfileController::class, 'index'])->name('profile');
        Route::put('profile-update', [AdminProfileController::class, 'update'])->name('profile.update');



        Route::resource('specification-key', SpecificationKeyController::class);
        Route::put('specification-key-status/{id}', [SpecificationKeyController::class, 'changeStatus'])->name('specification-key.status');

        Route::resource('testimonial', TestimonialController::class);
        Route::put('testimonial-status/{id}', [TestimonialController::class, 'changeStatus'])->name('testimonial.status');





        Route::resource('service', ServiceController::class);
        Route::put('service-status/{id}', [ServiceController::class, 'changeStatus'])->name('service.status');

        Route::resource('about-us', AboutUsController::class);
        Route::resource('collection-banner', CollectionBannerController::class);

        // Home Bottom Setting

        Route::resource('home-bottom', HomeBottomSettingController::class);
        Route::post('update-home-bottom/{id}', [HomeBottomSettingController::class, 'update_home_bottom'])->name('update-home-bottom');

        Route::resource('contact-us', ContactPageController::class);

        Route::resource('custom-page', CustomPageController::class);

        Route::put('custom-page-status/{id}', [CustomPageController::class, 'changeStatus'])->name('custom-page.status');

        Route::resource('terms-and-condition', TermsAndConditionController::class);

        Route::resource('privacy-policy', PrivacyPolicyController::class);
        // Blog Routes Start
        Route::resource('blog-category', BlogCategoryController::class); // Add
        Route::put('blog-category-status/{id}', [BlogCategoryController::class, 'changeStatus'])->name('blog.category.status');

        Route::resource('blog', BlogController::class); // Add
        Route::put('blog-status/{id}', [BlogController::class, 'changeStatus'])->name('blog.status');

        Route::resource('/recommended-blog', PopularBlogController::class)->names('popular-blog'); // Add
        Route::put('popular-blog-status/{id}', [PopularBlogController::class, 'changeStatus'])->name('popular-blog.status');

        Route::resource('blog-comment', BlogCommentController::class); // Add
        Route::put('blog-comment-status/{id}', [BlogCommentController::class, 'changeStatus'])->name('blog-comment.status');
        // Blog Routes End

        Route::get('clear-database', [SettingController::class, 'showClearDatabasePage'])->name('clear-database');
        Route::delete('clear-database', [SettingController::class, 'clearDatabase'])->name('clear-database');

        Route::put('update-database', [SettingController::class, 'update_database'])->name('update-database');



        Route::get('subscriber', [SubscriberController::class, 'index'])->name('subscriber');
        Route::delete('delete-subscriber/{id}', [SubscriberController::class, 'destroy'])->name('delete-subscriber');
        Route::post('specification-subscriber-email/{id}', [SubscriberController::class, 'specificationSubscriberEmail'])->name('specification-subscriber-email');
        Route::post('each-subscriber-email', [SubscriberController::class, 'eachSubscriberEmail'])->name('each-subscriber-email');

        Route::get('contact-message', [ContactMessageController::class, 'index'])->name('contact-message');
        Route::get('show-contact-message/{id}', [ContactMessageController::class, 'show'])->name('show-contact-message');
        Route::delete('delete-contact-message/{id}', [ContactMessageController::class, 'destroy'])->name('delete-contact-message');
        Route::put('enable-save-contact-message', [ContactMessageController::class, 'handleSaveContactMessage'])->name('enable-save-contact-message');

        Route::get('email-configuration', [EmailConfigurationController::class, 'index'])->name('email-configuration');
        Route::put('update-email-configuraion', [EmailConfigurationController::class, 'update'])->name('update-email-configuraion');

        Route::get('email-template', [EmailTemplateController::class, 'index'])->name('email-template');
        Route::get('edit-email-template/{id}', [EmailTemplateController::class, 'edit'])->name('edit-email-template');
        Route::put('update-email-template/{id}', [EmailTemplateController::class, 'update'])->name('update-email-template');

        Route::get('general-setting', [SettingController::class, 'index'])->name('general-setting');
        Route::put('update-general-setting', [SettingController::class, 'updateGeneralSetting'])->name('update-general-setting');

        /* Courier Related Route */
        Route::get('courier-setting', [SettingController::class, 'courier_index'])->name('courier-setting');
        Route::put('update-courier-setting', [SettingController::class, 'updateCourierSetting'])->name('update-courier-setting');
        Route::put('update-courier-setting', [SettingController::class, 'updateCourierSetting'])->name('update-courier-setting');
        Route::get('create-access-token', [SettingController::class, 'viewAccessToken'])->name('create-access-token');
        // Route::post('generate-access-token',[SettingController::class, 'generateAccessToken'])->name('generate-access-token');

        Route::put('update-theme-color', [SettingController::class, 'updateThemeColor'])->name('update-theme-color');
        Route::put('update-logo-favicon', [SettingController::class, 'updateLogoFavicon'])->name('update-logo-favicon');
        Route::put('update-cookie-consent', [SettingController::class, 'updateCookieConset'])->name('update-cookie-consent');
        Route::put('update-google-recaptcha', [SettingController::class, 'updateGoogleRecaptcha'])->name('update-google-recaptcha');
        Route::put('update-facebook-comment', [SettingController::class, 'updateFacebookComment'])->name('update-facebook-comment');
        Route::put('update-tawk-chat', [SettingController::class, 'updateTawkChat'])->name('update-tawk-chat');

        Route::put('update-custom-pagination', [SettingController::class, 'updateCustomPagination'])->name('update-custom-pagination');
        Route::put('update-social-login', [SettingController::class, 'updateSocialLogin'])->name('update-social-login');

        Route::put('update-pusher', [SettingController::class, 'updatePusher'])->name('update-pusher');

        Route::resource('admin', AdminController::class);
        Route::put('admin-status/{id}', [AdminController::class, 'changeStatus'])->name('admin-status');

        Route::resource('faq', FaqController::class);
        Route::put('faq-status/{id}', [FaqController::class, 'changeStatus'])->name('faq-status');

        Route::get('product-review', [ProductReviewController::class, 'index'])->name('product-review');
        Route::put('product-review-status/{id}', [ProductReviewController::class, 'changeStatus'])->name('product-review-status');
        Route::get('show-product-review/{id}', [ProductReviewController::class, 'show'])->name('show-product-review');
        Route::delete('delete-product-review/{id}', [ProductReviewController::class, 'destroy'])->name('delete-product-review');

        Route::get('product-report', [ProductReportController::class, 'index'])->name('product-report');
        Route::get('show-product-report/{id}', [ProductReportController::class, 'show'])->name('show-product-report');
        Route::delete('delete-product-report/{id}', [ProductReportController::class, 'destroy'])->name('delete-product-report');
        Route::put('de-active-product/{id}', [ProductReportController::class, 'deactiveProduct'])->name('de-active-product');

        Route::get('customer-list', [CustomerController::class, 'index'])->name('customer-list');
        Route::get('customer-show/{id}', [CustomerController::class, 'show'])->name('customer-show');
        Route::put('customer-status/{id}', [CustomerController::class, 'changeStatus'])->name('customer-status');
        Route::delete('customer-delete/{id}', [CustomerController::class, 'destroy'])->name('customer-delete');
        Route::get('pending-customer-list', [CustomerController::class, 'pendingCustomerList'])->name('pending-customer-list');
        Route::get('send-email-to-all-customer', [CustomerController::class, 'sendEmailToAllUser'])->name('send-email-to-all-customer');
        Route::post('send-mail-to-all-user', [CustomerController::class, 'sendMailToAllUser'])->name('send-mail-to-all-user');
        Route::post('send-mail-to-single-user/{id}', [CustomerController::class, 'sendMailToSingleUser'])->name('send-mail-to-single-user');


        Route::resource('error-page', ErrorPageController::class);

        Route::get('maintainance-mode', [ContentController::class, 'maintainanceMode'])->name('maintainance-mode');
        Route::put('maintainance-mode-update', [ContentController::class, 'maintainanceModeUpdate'])->name('maintainance-mode-update');
        Route::get('announcement', [ContentController::class, 'announcementModal'])->name('announcement');
        Route::post('announcement-update', [ContentController::class, 'announcementModalUpdate'])->name('announcement-update');

        Route::get('topbar-contact', [ContentController::class, 'headerPhoneNumber'])->name('topbar-contact');
        Route::put('update-topbar-contact', [ContentController::class, 'updateHeaderPhoneNumber'])->name('update-topbar-contact');

        Route::get('product-quantity-progressbar', [ContentController::class, 'productProgressbar'])->name('product-quantity-progressbar');
        Route::put('update-product-quantity-progressbar', [ContentController::class, 'updateProductProgressbar'])->name('update-product-quantity-progressbar');

        Route::get('default-avatar', [ContentController::class, 'defaultAvatar'])->name('default-avatar');
        Route::post('update-default-avatar', [ContentController::class, 'updateDefaultAvatar'])->name('update-default-avatar');

        Route::get('seller-conditions', [ContentController::class, 'sellerCondition'])->name('seller-conditions');
        Route::put('update-seller-conditions', [ContentController::class, 'updatesellerCondition'])->name('update-seller-conditions');

        Route::get('subscription-banner', [ContentController::class, 'subscriptionBanner'])->name('subscription-banner');
        Route::post('update-subscription-banner', [ContentController::class, 'updatesubscriptionBanner'])->name('update-subscription-banner');


        Route::get('login-page', [ContentController::class, 'loginPage'])->name('login-page');
        Route::post('update-login-page', [ContentController::class, 'updateloginPage'])->name('update-login-page');
        Route::get('image-content', [ContentController::class, 'image_content'])->name('image-content');
        Route::post('update-image-content', [ContentController::class, 'updateImageContent'])->name('update-image-content');
        Route::get('shop-page', [ContentController::Class, 'shopPage'])->name('shop-page');
        Route::put('update-filter-price', [ContentController::Class, 'updateFilterPrice'])->name('update-filter-price');

        Route::get('seo-setup', [ContentController::Class, 'seoSetup'])->name('seo-setup');
        Route::put('update-seo-setup/{id}', [ContentController::Class, 'updateSeoSetup'])->name('update-seo-setup');
        Route::get('get-seo-setup/{id}', [ContentController::Class, 'getSeoSetup'])->name('get-seo-setup');

        Route::resource('country', CountryController::class);
        Route::put('country-status/{id}', [CountryController::class, 'changeStatus'])->name('country-status');

        Route::resource('state', CountryStateController::class);
        Route::put('state-status/{id}', [CountryStateController::class, 'changeStatus'])->name('state-status');

        Route::resource('city', CityController::class);
        Route::put('city-status/{id}', [CityController::class, 'changeStatus'])->name('city-status');



        Route::get('pc_builders', [HomePageController::class, 'pcBuilders'])->name('pc-builder');
        Route::get('popular-category', [HomePageController::class, 'popularCategory'])->name('popular-category');
        Route::post('store-popular-category', [HomePageController::class, 'storePopularCategory'])->name('store-popular-category');
        Route::post('store-pc-build', [HomePageController::class, 'storePcBuild'])->name('store-build-pc');
        Route::delete('destroy-popular-category/{id}', [HomePageController::class, 'destroyPopularCategory'])->name('destroy-popular-category');
        Route::delete('destroy-pc-build/{id}', [HomePageController::class, 'destroyPcBuilder'])->name('destroy-pc-builder');

        Route::delete('destroy-color/{id}', [HomePageController::class, 'destroyColor'])->name('destroy-color');
        Route::delete('destroy-size/{id}', [HomePageController::class, 'destroySize'])->name('destroy-size');



        Route::put('popular-category-banner', [HomePageController::class, 'bannerPopularCategory'])->name('popular-category-banner');
        Route::put('featured-category-banner', [HomePageController::class, 'bannerFeaturedCategory'])->name('featured-category-banner');

        Route::get('featured-category', [HomePageController::class, 'featuredCategory'])->name('featured-category');
        Route::post('store-featured-category', [HomePageController::class, 'storeFeaturedCategory'])->name('store-featured-category');
        Route::delete('destroy-featured-category/{id}', [HomePageController::class, 'destroyFeaturedCategory'])->name('destroy-featured-category');

        Route::get('homepage-section-title', [HomePageController::class, 'homepage_section_content'])->name('homepage-section-title');
        Route::post('update-homepage-section-title', [HomePageController::class, 'update_homepage_section_content'])->name('update-homepage-section-title');




        Route::resource('coupon', CouponController::class);

        Route::put('coupon-status/{id}', [CouponController::class, 'changeStatus'])->name('coupon-status');


        Route::resource('footer', FooterController::class);

        Route::resource('social-link', FooterSocialLinkController::class);

        Route::resource('footer-link', FooterLinkController::class);
        Route::get('second-col-footer-link', [FooterLinkController::class, 'secondColFooterLink'])->name('second-col-footer-link');
        Route::get('third-col-footer-link', [FooterLinkController::class, 'thirdColFooterLink'])->name('third-col-footer-link');
        Route::put('update-col-title/{id}', [FooterLinkController::class, 'updateColTitle'])->name('update-col-title');

        Route::get('admin-language', [LanguageController::class, 'adminLnagugae'])->name('admin-language');
        Route::post('update-admin-language', [LanguageController::class, 'updateAdminLanguage'])->name('update-admin-language');

        Route::get('admin-validation-language', [LanguageController::class, 'adminValidationLnagugae'])->name('admin-validation-language');
        Route::post('update-admin-validation-language', [LanguageController::class, 'updateAdminValidationLnagugae'])->name('update-admin-validation-language');

        Route::get('website-language', [LanguageController::class, 'websiteLanguage'])->name('website-language');
        Route::post('update-language', [LanguageController::class, 'updateLanguage'])->name('update-language');

        Route::get('website-validation-language', [LanguageController::class, 'websiteValidationLanguage'])->name('website-validation-language');
        Route::post('update-validation-language', [LanguageController::class, 'updateValidationLanguage'])->name('update-validation-language');



        Route::get('sms-notification', [NotificationController::class, 'twilio_sms'])->name('sms-notification');
        Route::put('update-twilio-configuration', [NotificationController::class, 'update_twilio_sms'])->name('update-twilio-configuration');
        Route::put('update-biztech-configuration', [NotificationController::class, 'update_biztech_sms'])->name('update-biztech-configuration');

        Route::get('sms-template', [NotificationController::class, 'sms_template'])->name('sms-template');
        Route::get('edit-sms-template/{id}', [NotificationController::class, 'edit_sms_template'])->name('edit-sms-template');
        Route::put('update-sms-template/{id}', [NotificationController::class, 'update_sms_template'])->name('update-sms-template');
    });
});






// Blog

Route::group(['as' => 'front.'], function () {
    Route::controller(FrontHomeController::class)->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/page/{slug}', 'customPages')->name('customPages');
        Route::get('/contact', 'contact')->name("contact");
        Route::get('/search', 'search')->name('search');

    });
    Route::get("/blogs/{slug}", [BlogBlogController::class, "categoryWiseBlogs"] )->name("blog.categoryWiseBlogs");
    Route::get("/{category}/{id}", [BlogBlogController::class, "blogDetails"] )->name("blog.details");
    Route::post("/comment", [BlogBlogController::class, "commentStore"])->name("blog.comment");





    Route::controller(FrontAuthController::class)->group(function () {
        // Route::get('register-user', 'regpage')->name('user-reg');
        Route::get('/login', 'logpage')->name('user-log');
        Route::post('/login', 'login')->name('login');
        // Route::get('logout', 'logout')->name('logout');
        // Route::post('register', 'register')->name('register');
        // Route::post('optverify', 'optverify')->name('optverify');
        // Route::post('change-password', 'changePassword')->name('pasword.change');
        // Route::post('profile-update', 'updateProfile')->name('profile.update');
    });
});
