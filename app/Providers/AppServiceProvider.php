<?php

namespace App\Providers;

use App\Models\Config;
use App\Models\Language;
use App\Repositories\BannerRepository;
use App\Repositories\CatalogRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ConfigRepository;
use App\Repositories\AlbumRepository;
use App\Repositories\InquiryRepository;
use App\Repositories\Interfaces\AlbumRepositoryInterface;
use App\Repositories\Interfaces\BannerRepositoryInterface;
use App\Repositories\Interfaces\CatalogRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ConfigRepositoryInterface;
use App\Repositories\Interfaces\InquiryRepositoryInterface;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use App\Repositories\Interfaces\PageRepositoryInterface;
use App\Repositories\Interfaces\PlaylistRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\SectionRepositoryInterface;
use App\Repositories\Interfaces\UsersRepositoryInterface;
use App\Repositories\LinkRepository;
use App\Repositories\PageRepository;
use App\Repositories\PlaylistRepository;
use App\Repositories\PostRepository;
use App\Repositories\SectionRepository;
use App\Repositories\UsersRepository;
use App\Services\BannerService;
use App\Services\CatalogService;
use App\Services\CategoryService;
use App\Services\ConfigService;
use App\Services\AlbumService;
use App\Services\InquiryService;
use App\Services\Interfaces\AlbumServiceInterface;
use App\Services\Interfaces\BannerServiceInterface;
use App\Services\Interfaces\CatalogServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\ConfigServiceInterface;
use App\Services\Interfaces\InquiryServiceInterface;
use App\Services\Interfaces\LinkServiceInterface;
use App\Services\Interfaces\PageServiceInterface;
use App\Services\Interfaces\PlaylistServiceInterface;
use App\Services\Interfaces\PostServiceInterface;
use App\Services\Interfaces\SectionServiceInterface;
use App\Services\Interfaces\UsersServiceInterface;
use App\Services\LinkService;
use App\Services\PageService;
use App\Services\PlaylistService;
use App\Services\PostService;
use App\Services\SectionService;
use App\Services\UsersService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use Carbon\Carbon;
use App\Models\PageLang;
use App\Models\CategoryContent;
use App\Models\Page;
use App\Models\PageMedia;
use App\Models\Slider;
use App\Models\Content;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
          /**Module Pages */
          $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
          $this->app->bind(PageServiceInterface::class, PageService::class);
          /**Module Content */
          $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
          $this->app->bind(SectionServiceInterface::class, SectionService::class);
          $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
          $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
          $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
          $this->app->bind(PostServiceInterface::class, PostService::class);
          /**Module banner */
          $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);
          $this->app->bind(BannerServiceInterface::class, BannerService::class);
          /**Module catalog */
          $this->app->bind(CatalogRepositoryInterface::class, CatalogRepository::class);
          $this->app->bind(CatalogServiceInterface::class, CatalogService::class);
          /**Module Gallery */
          $this->app->bind(AlbumRepositoryInterface::class, AlbumRepository::class);
          $this->app->bind(AlbumServiceInterface::class, AlbumService::class);
          $this->app->bind(PlaylistRepositoryInterface::class, PlaylistRepository::class);
          $this->app->bind(PlaylistServiceInterface::class, PlaylistService::class);
          /**Module Link */
          $this->app->bind(LinkRepositoryInterface::class, LinkRepository::class);
          $this->app->bind(LinkServiceInterface::class, LinkService::class);
          /**Module inquiry */
          $this->app->bind(InquiryRepositoryInterface::class, InquiryRepository::class);
          $this->app->bind(InquiryServiceInterface::class, InquiryService::class);
          /**Module Users */
          $this->app->bind(UsersRepositoryInterface::class, UsersRepository::class);
          $this->app->bind(UsersServiceInterface::class, UsersService::class);
          /**Module Config */
          $this->app->bind(ConfigRepositoryInterface::class, ConfigRepository::class);
          $this->app->bind(ConfigServiceInterface::class, ConfigService::class);

        View::share([
        
            'list_profil'       => Page::where('parent',2)->orderBy('id','DESC')->get(),
            'sambutan'          => PageLang::where('id',1)->first(),
            'sejarah'           => PageLang::where('id',6)->first(),
            'visimisi'          => Page::where('id',3)->first(),    
            
            //pagemedia
            'foto_ketua'        => PageMedia::where('page_id',1)->get(),
            //slider
            'slider'            => Slider::all(),
            
            //content
            'sekolah_yayasan'   => Content::where('category_content_id',6)->orderBy('id','DESC')->get(),
            'berita_terbaru'    => Content::where('category_content_id',7)->orderBy('id','DESC')->take(8)->get(),

            'berita_terbaru_2'  => Content::where('category_content_id',7)->orderBy('id','DESC')->take(2)->get(),

            
            'logo'              => Config::where('id',9)->first(),
            'background'        => Config::where('id',8)->first(),
            'alamat'            => Config::where('id',1)->first(),
            'app_name'          => Config::where('id',2)->first(),
            'no_hp'             => Config::where('id',4)->first(),
            'email'             => Config::where('id',3)->first(),
            'fb'                => Config::where('id',5)->first(),
            'ig'                => Config::where('id' ,6)->first(),
            'tw'                => Config::where('id',7)->first(),
            'yt'                => Config::where('id',8)->first(),
            'bg_web'            => Config::where('id',9)->first(),
        ]);

    

    }
}
