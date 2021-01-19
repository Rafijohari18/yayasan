<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\Frontend\IndexController@index')->name('frontend.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('backend.index');
})->name('dashboard');

    Route::post('/login/user','App\Http\Controllers\HomeController@login')->name('login.user');


    Route::group(['prefix' => 'content', 'as' => 'content.'], function () {
        Route::get('/page/{id}/{slug}', 'App\Http\Controllers\Frontend\ContentController@page')->name('page');
        Route::get('/section/{id}/{slug}', 'App\Http\Controllers\Frontend\ContentController@section')->name('section');
        Route::get('/category/{id}/{slug}', 'App\Http\Controllers\Frontend\ContentController@category')->name('category');
        Route::get('/post/{id}/{slug}', 'App\Http\Controllers\Frontend\ContentController@post')->name('post');
    });

    Route::group(['prefix' => 'informasi', 'as' => 'informasi.'], function () {
        Route::get('/{slug}', 'App\Http\Controllers\Frontend\InformasiController@index')->name('index');
        Route::get('preview/{slug}', 'App\Http\Controllers\Frontend\InformasiController@preview')->name('preview');
    });


    Route::get('profil/{slug}', 'App\Http\Controllers\Frontend\ProfilController@visimisi')->name('visi.index');

    Route::get('/kontak', 'App\Http\Controllers\Frontend\InformasiController@kontak')->name('kontak');
    Route::get('/preview/slider/{id}', 'App\Http\Controllers\Frontend\InformasiController@prevslider')->name('preview.slider');
    
    Route::get('/visi-misi', 'App\Http\Controllers\Frontend\InformasiController@tentang')->name('tentang.index');
    Route::get('/pengurus', 'App\Http\Controllers\Frontend\InformasiController@pengurus')->name('pengurus.index');
    Route::get('/program-kerja', 'App\Http\Controllers\Frontend\InformasiController@programKerja')->name('program.kerja.index');
    Route::get('/profil-alumni', 'App\Http\Controllers\Frontend\InformasiController@profilAlumni')->name('profil-alumni.index');
    Route::get('/gallery', 'App\Http\Controllers\Frontend\InformasiController@gallery')->name('gallery.index');

     Route::get('/panduan-ppdb', 'App\Http\Controllers\Frontend\InformasiController@panduanPPDB')->name('panduan.ppdb.index');
     
      Route::get('/pengumuman-ppdb', 'App\Http\Controllers\Frontend\InformasiController@pengumumanPPDB')->name('pengumuman.ppdb.index');


    Route::get('news', 'App\Http\Controllers\Frontend\NewsController@index')->name('news.index');
    Route::get('pengumuman', 'App\Http\Controllers\Frontend\NewsController@pengumuman')->name('pengumuman.index');
    Route::get('news/{slug}', 'App\Http\Controllers\Frontend\NewsController@detail')->name('berita.detail');

    
    
    


Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'admin'], function () {

    Route::get('/home','App\Http\Controllers\HomeController@home')->name('home');
    

    // user
     Route::get('/user', 'App\Http\Controllers\Admin\UsersController@index')->name('users.index');
     Route::get('/user/create', 'App\Http\Controllers\Admin\UsersController@create')->name('users.create');
     Route::post('/user/store', 'App\Http\Controllers\Admin\UsersController@store')->name('users.store');
     Route::get('/user/edit/{id}', 'App\Http\Controllers\Admin\UsersController@edit')->name('users.edit');
     Route::put('user/update/{id}', 'App\Http\Controllers\Admin\UsersController@update')->name('users.update');
     Route::put('user/status/{id}', 'App\Http\Controllers\Admin\UsersController@status')->name('users.status');
     Route::get('user/delete/{id}', 'App\Http\Controllers\Admin\UsersController@destroy')->name('users.destroy');
     Route::get('user/profile', 'App\Http\Controllers\Admin\UsersController@profile')->name('users.profile');
     Route::post('user/update-profile/{id}', 'App\Http\Controllers\Admin\UsersController@updateProfile')->name('users.update-profile');
     Route::put('user/change-photo/{id}', 'App\Http\Controllers\Admin\UsersController@changePhoto')->name('users.change-photo');
     Route::put('user/remove-photo/{id}', 'App\Http\Controllers\Admin\UsersController@removePhoto')->name('users.remove-photo');
        
    
     //pages
     Route::get('/pages', 'App\Http\Controllers\Admin\PagesController@index')->name('pages.index');
     Route::get('/pages/create', 'App\Http\Controllers\Admin\PagesController@create')->name('pages.create');
     Route::post('/pages/store', 'App\Http\Controllers\Admin\PagesController@store')->name('pages.store');
     Route::get('/pages/{id}/edit', 'App\Http\Controllers\Admin\PagesController@edit')->name('pages.edit');
     Route::put('/pages/{id}/update', 'App\Http\Controllers\Admin\PagesController@update')->name('pages.update');
     Route::put('/pages/status/{id}', 'App\Http\Controllers\Admin\PagesController@status')->name('pages.status');
     Route::put('/pages/position/{id}/{position}/{parent}', 'App\Http\Controllers\Admin\PagesController@position')->name('pages.position');
     Route::get('/pages/{id}/delete', 'App\Http\Controllers\Admin\PagesController@destroy')->name('pages.destroy');
    
     //pages media
     Route::get('/media/{pageId}', 'App\Http\Controllers\Admin\PagesController@media')->name('pages.media');
     Route::post('/media/{pageId}', 'App\Http\Controllers\Admin\PagesController@storeMedia')->name('pages.media.store');
     Route::put('/media/{id}', 'App\Http\Controllers\Admin\PagesController@updateMedia')->name('pages.media.update');
     Route::put('/media/{id}/{position}/{pageId}', 'App\Http\Controllers\Admin\PagesController@positionMedia')->name('pages.media.position');
     Route::post('/media/sort/image', 'App\Http\Controllers\Admin\PagesController@sortMedia')->name('pages.media.sort');
     Route::get('/media/destroy/{id}', 'App\Http\Controllers\Admin\PagesController@destroyMedia')->name('pages.media.destroy');

        

    //slider
    Route::get('/slider', 'App\Http\Controllers\Admin\SliderController@index')->name('slider.index');
    Route::get('/slider/create', 'App\Http\Controllers\Admin\SliderController@create')->name('slider.create');
    Route::post('/slider/store', 'App\Http\Controllers\Admin\SliderController@store')->name('slider.store');
    Route::get('/slider/{id}/edit', 'App\Http\Controllers\Admin\SliderController@edit')->name('slider.edit');
    Route::put('/slider/{id}/update', 'App\Http\Controllers\Admin\SliderController@update')->name('slider.update');
    Route::get('/slider/{id}/delete', 'App\Http\Controllers\Admin\SliderController@destroy')->name('slider.destroy');

       
    Route::get('category/product', 'App\Http\Controllers\Admin\CategoryProductController@index')->name('category.product.index');
    Route::get('category/product/create', 'App\Http\Controllers\Admin\CategoryProductController@create')->name('category.product.create');
    Route::post('category/product/store', 'App\Http\Controllers\Admin\CategoryProductController@store')->name('category.product.store');
    Route::get('category/product/{id}/edit', 'App\Http\Controllers\Admin\CategoryProductController@edit')->name('category.product.edit');
    Route::get('category/product/{id}/preview', 'App\Http\Controllers\Admin\CategoryProductController@preview')->name('category.product.preview');
    Route::put('category/product/{id}/update', 'App\Http\Controllers\Admin\CategoryProductController@update')->name('category.product.update');
    Route::get('category/product/{id}/delete', 'App\Http\Controllers\Admin\CategoryProductController@destroy')->name('category.product.destroy');
        
    Route::get('/product/', 'App\Http\Controllers\Admin\ProductController@index')->name('product.index');
     Route::get('/product/create/{category_content_id}', 'App\Http\Controllers\Admin\ProductController@create')->name('product.create');
     Route::post('/product/store', 'App\Http\Controllers\Admin\ProductController@store')->name('product.store');
     Route::get('/product/{category_content_id}/{id}/edit', 'App\Http\Controllers\Admin\ProductController@edit')->name('product.edit');
     Route::get('/product/{id}/preview', 'App\Http\Controllers\Admin\ProductController@preview')->name('product.preview');
     Route::put('/product/{id}/update', 'App\Http\Controllers\Admin\ProductController@update')->name('product.update');
     Route::get('/product/{id}/delete', 'App\Http\Controllers\Admin\ProductController@destroy')->name('product.destroy');



     Route::get('category/content', 'App\Http\Controllers\Admin\CategoryKontenController@index')->name('category.content.index');
     Route::get('category/content/create', 'App\Http\Controllers\Admin\CategoryKontenController@create')->name('category.content.create');
     Route::post('category/content/store', 'App\Http\Controllers\Admin\CategoryKontenController@store')->name('category.content.store');
     Route::get('category/content/{id}/edit', 'App\Http\Controllers\Admin\CategoryKontenController@edit')->name('category.content.edit');
     Route::get('category/content/{id}/preview', 'App\Http\Controllers\Admin\CategoryKontenController@preview')->name('category.content.preview');
     Route::put('category/content/{id}/update', 'App\Http\Controllers\Admin\CategoryKontenController@update')->name('category.content.update');
     Route::get('category/content/{id}/delete', 'App\Http\Controllers\Admin\CategoryKontenController@destroy')->name('category.content.destroy');
    
     Route::get('/content/{id}', 'App\Http\Controllers\Admin\KontenController@index')->name('content.index');
     Route::get('/content/create/{category_content_id}', 'App\Http\Controllers\Admin\KontenController@create')->name('content.create');
     Route::post('/content/store', 'App\Http\Controllers\Admin\KontenController@store')->name('content.store');
     Route::get('/content/{category_content_id}/{id}/edit', 'App\Http\Controllers\Admin\KontenController@edit')->name('content.edit');
     Route::get('/content/{id}/preview', 'App\Http\Controllers\Admin\KontenController@preview')->name('content.preview');
     Route::put('/content/{id}/update', 'App\Http\Controllers\Admin\KontenController@update')->name('content.update');
     Route::get('/content/{id}/delete', 'App\Http\Controllers\Admin\KontenController@destroy')->name('content.destroy');
    
    //config
    Route::get('web-config', 'App\Http\Controllers\Admin\ConfigController@config')->name('web-config');
    Route::put('update/config', 'App\Http\Controllers\Admin\ConfigController@updateConfig')->name('update.config');
    Route::put('update/config/background', 'App\Http\Controllers\Admin\ConfigController@updateConfigBackground')->name('update.config.background');
    Route::put('update/config/logo', 'App\Http\Controllers\Admin\ConfigController@updateConfigLogo')->name('update.config.logo');
    Route::post('store/config/', 'App\Http\Controllers\Admin\ConfigController@storeTingkat')->name('store.tingkat');
    Route::delete('config/{id}/delete', 'App\Http\Controllers\Admin\ConfigController@destroy')->name('config.penyakit.destroy');
   
    
    //dosen
    Route::get('/dosen', 'App\Http\Controllers\Admin\DosenController@index')->name('dosen.index');
    Route::get('/dosen/create', 'App\Http\Controllers\Admin\DosenController@create')->name('dosen.create');
    Route::post('/dosen/store', 'App\Http\Controllers\Admin\DosenController@store')->name('dosen.store');
    Route::get('/dosen/{id}/edit', 'App\Http\Controllers\Admin\DosenController@edit')->name('dosen.edit');
    Route::put('/dosen/{id}/update', 'App\Http\Controllers\Admin\DosenController@update')->name('dosen.update');
    Route::put('/dosen/position/{id}/{position}', 'App\Http\Controllers\Admin\DosenController@position')->name('dosen.position');
    Route::get('/dosen/{id}/delete', 'App\Http\Controllers\Admin\DosenController@destroy')->name('dosen.destroy');
    
    //siswa
    Route::get('/siswa', 'App\Http\Controllers\Admin\SiswaController@index')->name('siswa.index');
    Route::get('/siswa/create', 'App\Http\Controllers\Admin\SiswaController@create')->name('siswa.create');
    Route::post('/siswa/store', 'App\Http\Controllers\Admin\SiswaController@store')->name('siswa.store');
    Route::get('/siswa/{id}/edit', 'App\Http\Controllers\Admin\SiswaController@edit')->name('siswa.edit');
    Route::put('/siswa/{id}/update', 'App\Http\Controllers\Admin\SiswaController@update')->name('siswa.update');
    Route::get('/siswa/{id}/delete', 'App\Http\Controllers\Admin\SiswaController@destroy')->name('siswa.destroy');
    Route::post('siswa/import','App\Http\Controllers\Admin\SiswaController@import')->name('siswa.import');
    Route::get('/siswa/download', 'App\Http\Controllers\Admin\SiswaController@download')->name('siswa.download');


    //guru
    Route::get('/guru', 'App\Http\Controllers\Admin\GuruController@index')->name('guru.index');
    Route::get('/guru/create', 'App\Http\Controllers\Admin\GuruController@create')->name('guru.create');
    Route::post('/guru/store', 'App\Http\Controllers\Admin\GuruController@store')->name('guru.store');
    Route::get('/guru/{id}/edit', 'App\Http\Controllers\Admin\GuruController@edit')->name('guru.edit');
    Route::put('/guru/{id}/update', 'App\Http\Controllers\Admin\GuruController@update')->name('guru.update');
    Route::get('/guru/{id}/delete', 'App\Http\Controllers\Admin\GuruController@destroy')->name('guru.destroy');
    Route::post('guru/import','App\Http\Controllers\Admin\GuruController@import')->name('guru.import');
    Route::get('/guru/download', 'App\Http\Controllers\Admin\GuruController@download')->name('guru.download');


    //alumni
    Route::get('/alumni', 'App\Http\Controllers\Admin\AlumniController@index')->name('alumni.index');
    Route::get('/alumni/create', 'App\Http\Controllers\Admin\AlumniController@create')->name('alumni.create');
    Route::post('/alumni/store', 'App\Http\Controllers\Admin\AlumniController@store')->name('alumni.store');
    Route::get('/alumni/{id}/edit', 'App\Http\Controllers\Admin\AlumniController@edit')->name('alumni.edit');
    Route::put('/alumni/{id}/update', 'App\Http\Controllers\Admin\AlumniController@update')->name('alumni.update');
    Route::get('/alumni/{id}/delete', 'App\Http\Controllers\Admin\AlumniController@destroy')->name('alumni.destroy');
    Route::post('alumni/import','App\Http\Controllers\Admin\AlumniController@import')->name('alumni.import');
    Route::get('/alumni/download', 'App\Http\Controllers\Admin\AlumniController@download')->name('alumni.download');
    

    //profil alumni
    Route::get('profil/alumni', 'App\Http\Controllers\Admin\ProfilAlumniController@index')->name('profil.alumni.index');
    Route::get('profil/alumni/create', 'App\Http\Controllers\Admin\ProfilAlumniController@create')->name('profil.alumni.create');
    Route::post('profil/alumni/store', 'App\Http\Controllers\Admin\ProfilAlumniController@store')->name('profil.alumni.store');
    Route::get('profil/alumni/{id}/edit', 'App\Http\Controllers\Admin\ProfilAlumniController@edit')->name('profil.alumni.edit');
    Route::put('profil/alumni/{id}/update', 'App\Http\Controllers\Admin\ProfilAlumniController@update')->name('profil.alumni.update');
    Route::get('profil/alumni/{id}/delete', 'App\Http\Controllers\Admin\ProfilAlumniController@destroy')->name('profil.alumni.destroy');
    Route::post('profil/alumni/import','App\Http\Controllers\Admin\ProfilAlumniController@import')->name('profil.alumni.import');
    Route::get('/profil/alumni/download', 'App\Http\Controllers\Admin\ProfilAlumniController@download')->name('profil.alumni.download');

    

     #--gallery
     Route::group(['prefix' => 'gallery', 'as' => 'gallery.'], function () {
        /**Album */
        Route::get('/album', 'App\Http\Controllers\Admin\AlbumController@index')->name('album.index');
        Route::get('/album/create', 'App\Http\Controllers\Admin\AlbumController@create')->name('album.create');
        Route::post('/album', 'App\Http\Controllers\Admin\AlbumController@store')->name('album.store');
        Route::get('/album/{id}/edit', 'App\Http\Controllers\Admin\AlbumController@edit')->name('album.edit');
        Route::put('/album/{id}', 'App\Http\Controllers\Admin\AlbumController@update')->name('album.update');
        Route::get('/album/{id}', 'App\Http\Controllers\Admin\AlbumController@destroy')->name('album.destroy');
        
        Route::get('/album/photo/{albumId}', 'App\Http\Controllers\Admin\AlbumController@photo')->name('album.photo');
        Route::post('/album/photo/{albumId}', 'App\Http\Controllers\Admin\AlbumController@storePhoto')->name('album.store.photo');
        Route::post('/album/photo/multi/{albumId}', 'App\Http\Controllers\Admin\AlbumController@multiUpload')->name('album.store.photo.multi');
        Route::put('/album/photo/{id}', 'App\Http\Controllers\Admin\AlbumController@updatePhoto')->name('album.update.photo');
        Route::put('/album/photo/position/{id}/{position}/{albumId}', 'App\Http\Controllers\Admin\AlbumController@positionPhoto')->name('album.position.photo');
        Route::post('/album/sort/photo', 'App\Http\Controllers\Admin\AlbumController@sortPhoto')->name('album.photo.sort');
        Route::delete('/album/photo/{id}', 'App\Http\Controllers\Admin\AlbumController@destroyPhoto')->name('album.destroy.photo');


        /**Playlist */
        Route::get('/playlist', 'App\Http\Controllers\Admin\PlaylistController@index')->name('playlist.index');
        Route::get('/playlist/create', 'App\Http\Controllers\Admin\PlaylistController@create')->name('playlist.create');
        Route::post('/playlist', 'App\Http\Controllers\Admin\PlaylistController@store')->name('playlist.store');
        Route::get('/playlist/{id}/edit', 'App\Http\Controllers\Admin\PlaylistController@edit')->name('playlist.edit');
        Route::put('/playlist/{id}', 'App\Http\Controllers\Admin\PlaylistController@update')->name('playlist.update');
        Route::get('/playlist/{id}', 'App\Http\Controllers\Admin\PlaylistController@destroy')->name('playlist.destroy');

        Route::get('/playlist/video/{playlistId}', 'App\Http\Controllers\Admin\PlaylistController@video')->name('playlist.video');
        Route::post('/playlist/video/{playlistId}', 'App\Http\Controllers\Admin\PlaylistController@storeVideo')->name('playlist.store.video');
        Route::put('/playlist/video/{id}', 'App\Http\Controllers\Admin\PlaylistController@updateVideo')->name('playlist.update.video');
        Route::delete('/playlist/video/{id}', 'App\Http\Controllers\Admin\PlaylistController@destroyVideo')->name('playlist.destroy.video');

    });

        
   
    });
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'Cache Cleared';
});