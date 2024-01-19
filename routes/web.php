<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DeptCategoryController;
use App\Http\Controllers\Admin\DeptMembRegController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DeviceTokenController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\EventCategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventRegController;
use App\Http\Controllers\Admin\FoodBankCategoryController;
use App\Http\Controllers\Admin\FoodBankController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LiveCountDownController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PodcastCategoryController;
use App\Http\Controllers\Admin\PodcastController;
use App\Http\Controllers\Admin\PrayerController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ResourceCategoryController;
use App\Http\Controllers\Admin\SermonCategoryController;
use App\Http\Controllers\Admin\SermonController;
use App\Http\Controllers\Admin\VolCategoryController;
use App\Http\Controllers\Admin\VolFormController;
use App\Http\Controllers\Admin\VolunteerController;
use App\Models\FoodBank;

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

//Route::prefix('/admin')->group(function(){
    Route::match(['get','post'],'/admin/login',[AdminController::class, 'login']);

    Route::group(['middleware'=>['admin']], function() {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
        Route::match(['get','post'],'/admin/update-password', [AdminController::class,'updatePassword']);
        Route::post('/admin/check-current-password', [AdminController::class,'checkCurrentPassword']);
        Route::match(['get','post'],'/admin/update-admin-details', [AdminController::class,'updateAdminDetails']);
        Route::get('/admin/logout', [AdminController::class,'logout']);

        // Display CMS Pages ( CRUD - READ)
        /*Route::get('/admin/cms-pages', [CmsController::class,'index']);
        Route::post('/admin/update-cms-page-status', [CmsController::class,'updatePageStatus']);
        Route::match(['get','post'],'/admin/add-edit-cms-page/{id?}', [CmsController::class,'edit']);
        Route::match(['get'],'/admin/delete-cms-page/{id?}', [CmsController::class,'destroy']);*/

        // Banner
        Route::get('/admin/banner', [BannerController::class,'index']);
        Route::get('/admin/banner-add', [BannerController::class,'create']);
        Route::post('/admin/banner-add', [BannerController::class,'store']);
        Route::get('/admin/banner-edit/{id?}', [BannerController::class,'edit']);
        Route::post('/admin/banner-edit/{id?}', [BannerController::class,'update']);
        Route::post('/admin/banner-file-edit/{id?}', [BannerController::class,'updateBannerFile']);
        Route::get('/admin/delete-banner/{id?}', [BannerController::class,'destroy']);

        // Event Categories
        Route::get('/admin/eventcategory', [EventCategoryController::class,'index']);
        Route::get('/admin/eventcategory-add', [EventCategoryController::class,'create']);
        Route::post('/admin/eventcategory-add', [EventCategoryController::class,'store']);
        Route::get('/admin/eventcategory-edit/{id?}', [EventCategoryController::class,'edit']);
        Route::post('/admin/eventcategory-edit/{id?}', [EventCategoryController::class,'update']);
        Route::get('/admin/delete-eventcategory/{id?}', [EventCategoryController::class,'destroy']);

        // Sermon Categories
        Route::get('/admin/sermoncategory', [SermonCategoryController::class,'index']);
        Route::get('/admin/sermoncategory-add', [SermonCategoryController::class,'create']);
        Route::post('/admin/sermoncategory-add', [SermonCategoryController::class,'store']);
        Route::get('/admin/sermoncategory-edit/{id?}', [SermonCategoryController::class,'edit']);
        Route::post('/admin/sermoncategory-edit/{id?}', [SermonCategoryController::class,'update']);
        Route::get('/admin/delete-sermoncategory/{id?}', [SermonCategoryController::class,'destroy']);


        // Podscast Categories
        Route::get('/admin/podcastcategory', [PodcastCategoryController::class,'index']);
        Route::get('/admin/podcastcategory-add', [PodcastCategoryController::class,'create']);
        Route::post('/admin/podcastcategory-add', [PodcastCategoryController::class,'store']);
        Route::get('/admin/podcastcategory-edit/{id?}', [PodcastCategoryController::class,'edit']);
        Route::post('/admin/podcastcategory-edit/{id?}', [PodcastCategoryController::class,'update']);
        Route::get('/admin/delete-podcastcategory/{id?}', [PodcastCategoryController::class,'destroy']);

        // News Categories
        Route::get('/admin/newscategory', [NewsCategoryController::class,'index']);
        Route::get('/admin/newscategory-add', [NewsCategoryController::class,'create']);
        Route::post('/admin/newscategory-add', [NewsCategoryController::class,'store']);
        Route::get('/admin/newscategory-edit/{id?}', [NewsCategoryController::class,'edit']);
        Route::post('/admin/newscategory-edit/{id?}', [NewsCategoryController::class,'update']);
        Route::get('/admin/delete-newscategory/{id?}', [NewsCategoryController::class,'destroy']);

        // Volunteer Form Categories
        Route::get('/admin/volcategory', [VolCategoryController::class,'index']);
        Route::get('/admin/volcategory-add', [VolCategoryController::class,'create']);
        Route::post('/admin/volcategory-add', [VolCategoryController::class,'store']);
        Route::get('/admin/volcategory-edit/{id?}', [VolCategoryController::class,'edit']);
        Route::post('/admin/volcategory-edit/{id?}', [VolCategoryController::class,'update']);
        Route::get('/admin/delete-volcategory/{id?}', [VolCategoryController::class,'destroy']);



        // FoodBank Categories
        Route::get('/admin/foodbankcategory', [FoodBankCategoryController::class,'index']);
        Route::get('/admin/foodbankcategory-add', [FoodBankCategoryController::class,'create']);
        Route::post('/admin/foodbankcategory-add', [FoodBankCategoryController::class,'store']);
        Route::get('/admin/foodbankcategory-edit/{id?}', [FoodBankCategoryController::class,'edit']);
        Route::post('/admin/foodbankcategory-edit/{id?}', [FoodBankCategoryController::class,'update']);
        Route::get('/admin/delete-foodbankcategory/{id?}', [FoodBankCategoryController::class,'destroy']);


        // Department Categories
        Route::get('/admin/deptcategory', [DeptCategoryController::class,'index']);
        Route::get('/admin/deptcategory-add', [DeptCategoryController::class,'create']);
        Route::post('/admin/deptcategory-add', [DeptCategoryController::class,'store']);
        Route::get('/admin/deptcategory-edit/{id?}', [DeptCategoryController::class,'edit']);
        Route::post('/admin/deptcategory-edit/{id?}', [DeptCategoryController::class,'update']);
        Route::get('/admin/delete-deptcategory/{id?}', [DeptCategoryController::class,'destroy']);

        // Resources Categories
        Route::get('/admin/resourecategory', [ResourceCategoryController::class,'index']);
        Route::get('/admin/resourcecategory-add', [ResourceCategoryController::class,'create']);
        Route::post('/admin/resourcecategory-add', [ResourceCategoryController::class,'store']);
        Route::get('/admin/resourcecategory-edit/{id?}', [ResourceCategoryController::class,'edit']);
        Route::post('/admin/resourcecategory-edit/{id?}', [ResourceCategoryController::class,'update']);
        Route::get('/admin/delete-resourcecategory/{id?}', [ResourceCategoryController::class,'destroy']);

        // Product Categories
        Route::get('/admin/productcategory', [ProductCategoryController::class,'index']);
        Route::get('/admin/productcategory-add', [ProductCategoryController::class,'create']);
        Route::post('/admin/productcategory-add', [ProductCategoryController::class,'store']);
        Route::get('/admin/productcategory-edit/{id?}', [ProductCategoryController::class,'edit']);
        Route::post('/admin/productcategory-edit/{id?}', [ProductCategoryController::class,'update']);
        Route::get('/admin/delete-productcategory/{id?}', [ProductCategoryController::class,'destroy']);

        // Events
        Route::get('/admin/event', [EventController::class,'index']);
        Route::get('/admin/event-add', [EventController::class,'create']);
        Route::post('/admin/event-add', [EventController::class,'store']);
        Route::get('/admin/event-edit/{id?}', [EventController::class,'edit']);
        Route::post('/admin/event-edit/{id?}', [EventController::class,'update']);
        Route::post('/admin/event-file-edit/{id?}', [EventController::class,'updateEventFile']);
        Route::get('/admin/delete-event/{id?}', [EventController::class,'destroy']);


        // Sermons
        Route::get('/admin/sermon', [SermonController::class,'index']);
        Route::get('/admin/sermon-add', [SermonController::class,'create']);
        Route::post('/admin/sermon-add', [SermonController::class,'store']);
        Route::get('/admin/sermon-edit/{id?}', [SermonController::class,'edit']);
        Route::post('/admin/sermon-edit/{id?}', [SermonController::class,'update']);
        Route::post('/admin/sermon-file-edit/{id?}', [SermonController::class,'updateSermonFile']);
        Route::get('/admin/delete-sermon/{id?}', [SermonController::class,'destroy']);


        // Podcasts
        Route::get('/admin/podcast', [PodcastController::class,'index']);
        Route::get('/admin/podcast-add', [PodcastController::class,'create']);
        Route::post('/admin/podcast-add', [PodcastController::class,'store']);
        Route::get('/admin/podcast-edit/{id?}', [PodcastController::class,'edit']);
        Route::post('/admin/podcast-edit/{id?}', [PodcastController::class,'update']);
        Route::post('/admin/podcast-file-edit/{id?}', [PodcastController::class,'updatePodcastFile']);
        Route::get('/admin/delete-podcast/{id?}', [PodcastController::class,'destroy']);



        // Department
        Route::get('/admin/dept', [DepartmentController::class,'index']);
        Route::get('/admin/dept-add', [DepartmentController::class,'create']);
        Route::post('/admin/dept-add', [DepartmentController::class,'store']);
        Route::get('/admin/dept-edit/{id?}', [DepartmentController::class,'edit']);
        Route::post('/admin/dept-edit/{id?}', [DepartmentController::class,'update']);
        Route::post('/admin/dept-file-edit/{id?}', [DepartmentController::class,'updateDeptFile']);
        Route::get('/admin/delete-dept/{id?}', [DepartmentController::class,'destroy']);  


        // Department Member Registration
        Route::get('/admin/deptmemb', [DeptMembRegController::class,'index']);
        Route::get('/admin/deptmemb-add', [DeptMembRegController::class,'create']);
        Route::post('/admin/deptmemb-add', [DeptMembRegController::class,'store']);
        Route::get('/admin/deptmemb-edit/{id?}', [DeptMembRegController::class,'edit']);
        Route::post('/admin/deptmemb-edit/{id?}', [DeptMembRegController::class,'update']);
        Route::post('/admin/deptmemb-file-edit/{id?}', [DeptMembRegController::class,'updateDeptMembFile']);
        Route::get('/admin/delete-deptmemb/{id?}', [DeptMembRegController::class,'destroy']);


        // Device Token Registration
        Route::get('/admin/devicetoken', [DeviceTokenController::class,'index']);
        Route::get('/admin/devicetoken-add', [DeviceTokenController::class,'create']);
        Route::post('/admin/devicetoken-add', [DeviceTokenController::class,'store']);
        Route::get('/admin/devicetoken-edit/{id?}', [DeviceTokenController::class,'edit']);
        Route::post('/admin/devicetoken-edit/{id?}', [DeviceTokenController::class,'update']);
        Route::get('/admin/delete-devicetoken/{id?}', [DeviceTokenController::class,'destroy']);


        // Donation
        Route::get('/admin/donation', [DonationController::class,'index']);
        Route::get('/admin/donation-add', [DonationController::class,'create']);
        Route::post('/admin/donation-add', [DonationController::class,'store']);
        Route::get('/admin/donation-edit/{id?}', [DonationController::class,'edit']);
        Route::post('/admin/donation-edit/{id?}', [DonationController::class,'update']);
        Route::get('/admin/delete-donation/{id?}', [DonationController::class,'destroy']);



        // Event Member Reg
        Route::get('/admin/eventreg', [EventRegController::class,'index']);
        Route::get('/admin/eventreg-add', [EventRegController::class,'create']);
        Route::post('/admin/eventreg-add', [EventRegController::class,'store']);
        Route::get('/admin/eventreg-edit/{id?}', [EventRegController::class,'edit']);
        Route::post('/admin/eventreg-edit/{id?}', [EventRegController::class,'update']);
        Route::get('/admin/delete-eventreg/{id?}', [EventRegController::class,'destroy']);


        // Food Bank
        Route::get('/admin/foodbank', [FoodBankController::class,'index']);
        Route::get('/admin/foodbank-add', [FoodBankController::class,'create']);
        Route::post('/admin/foodbank-add', [FoodBankController::class,'store']);
        Route::get('/admin/foodbank-edit/{id?}', [FoodBankController::class,'edit']);
        Route::post('/admin/foodbank-edit/{id?}', [FoodBankController::class,'update']);
        Route::get('/admin/delete-foodbank/{id?}', [FoodBankController::class,'destroy']);


        // Galleries
        Route::get('/admin/gallery', [GalleryController::class,'index']);
        Route::get('/admin/gallery-add', [GalleryController::class,'create']);
        Route::post('/admin/gallery-add', [GalleryController::class,'store']);
        Route::get('/admin/gallery-edit/{id?}', [GalleryController::class,'edit']);
        Route::post('/admin/gallery-edit/{id?}', [GalleryController::class,'update']);
        Route::post('/admin/gallery-file-edit/{id?}', [GalleryController::class,'updateGalleryFile']);
        Route::get('/admin/delete-gallery/{id?}', [GalleryController::class,'destroy']);



        // Live CountDown
        Route::get('/admin/countdown', [LiveCountDownController::class,'index']);
        Route::get('/admin/countdown-add', [LiveCountDownController::class,'create']);
        Route::post('/admin/countdown-add', [LiveCountDownController::class,'store']);
        Route::get('/admin/countdown-edit/{id?}', [LiveCountDownController::class,'edit']);
        Route::post('/admin/countdown-edit/{id?}', [LiveCountDownController::class,'update']);
        Route::get('/admin/delete-countdown/{id?}', [LiveCountDownController::class,'destroy']);


        // News
        Route::get('/admin/news', [NewsController::class,'index']);
        Route::get('/admin/news-add', [NewsController::class,'create']);
        Route::post('/admin/news-add', [NewsController::class,'store']);
        Route::get('/admin/news-edit/{id?}', [NewsController::class,'edit']);
        Route::post('/admin/news-edit/{id?}', [NewsController::class,'update']);
        Route::post('/admin/news-file-edit/{id?}', [NewsController::class,'updateNewsFile']);
        Route::get('/admin/delete-news/{id?}', [NewsController::class,'destroy']);


        // Prayer
        Route::get('/admin/prayer', [PrayerController::class,'index']);
        Route::get('/admin/prayer-add', [PrayerController::class,'create']);
        Route::post('/admin/prayer-add', [PrayerController::class,'store']);
        Route::get('/admin/prayer-edit/{id?}', [PrayerController::class,'edit']);
        Route::post('/admin/prayer-edit/{id?}', [PrayerController::class,'update']);
        Route::get('/admin/delete-prayer/{id?}', [PrayerController::class,'destroy']);


        // Volunteer Forms
        Route::get('/admin/volform', [VolFormController::class,'index']);
        Route::get('/admin/volform-add', [VolFormController::class,'create']);
        Route::post('/admin/volform-add', [VolFormController::class,'store']);
        Route::get('/admin/volform-edit/{id?}', [VolFormController::class,'edit']);
        Route::post('/admin/volform-edit/{id?}', [VolFormController::class,'update']);
        Route::get('/admin/delete-volform/{id?}', [VolFormController::class,'destroy']);



        // Volunteers
        Route::get('/admin/vol', [VolunteerController::class,'index']);
        Route::get('/admin/vol-add', [VolunteerController::class,'create']);
        Route::post('/admin/vol-add', [VolunteerController::class,'store']);
        Route::get('/admin/vol-edit/{id?}', [VolunteerController::class,'edit']);
        Route::post('/admin/vol-edit/{id?}', [VolunteerController::class,'update']);
        Route::get('/admin/delete-vol/{id?}', [VolunteerController::class,'destroy']);


     
    });
//});
