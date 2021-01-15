<?php

namespace App\Services;

use App\Repositories\Interfaces\ConfigRepositoryInterface;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\PageRepositoryInterface;
use App\Services\Interfaces\PageServiceInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\PageMedia;

class PageService implements PageServiceInterface
{
    private $pageRepository, $configRepository;

    public function __construct(PageRepositoryInterface $pageRepository, ConfigRepositoryInterface $configRepository)
    {
        $this->pageRepository = $pageRepository;
        $this->configRepository = $configRepository;
    }

    public function getAll()
    {
        return $this->pageRepository->getAll();
    }

    public function get($request)
    {
        return $this->pageRepository->get($request);
    }

    public function count($request)
    {
        return $this->pageRepository->count($request);
    }

    public function create($request)
    {
        $locale = App::getLocale();
        $parent = $request->get('parent');
        $ordering = $this->pageRepository->findBy('parent', (int)$parent)->max('position') + 1;

        $page = $this->pageRepository->create([
            'parent' => $parent,
            'slug' => Str::slug($request->slug, '-'),
            'cover' => ($request->cover_img == '') ? null : [
                'cover_img' => Str::replaceLast(url('/'), '', $request->cover_img),
                'cover_title' => $request->cover_title,
                'cover_alt' => $request->cover_alt,
            ],
            'banner' => ($request->banner_img == '') ? null : [
                'banner_img' => Str::replaceLast(url('/'), '', $request->banner_img),
                'banner_title' => $request->banner_title,
                'banner_alt' => $request->banner_alt,
            ],
            'publish' => (bool)$request->publish,
            'public' => (bool)$request->public,
            'custom_view' => ($request->custom_view == '') ? null : Str::slug($request->custom_view, '-'),
            'meta_title' => ($request->meta_title == '') ? null : $request->meta_title,
            'meta_description' => ($request->meta_description == '') ? null : $request->meta_description,
            'meta_keywords' => ($request->meta_keywords == '') ? null : $request->meta_keywords,
            'position' => $ordering,
            'created_by' => auth()->user()['id'],
        ]);

        if ($request->custom_view != '') {
            $path = resource_path('views/frontend/page/custom/'.Str::slug($request->custom_view, '-').'.blade.php');
            File::put($path, '');
        }

        $langDef = false;
        $langDef = $this->pageRepository->createLang([
            'page_id' => $page->id,
            'title' => Str::title($request->title_def),
            'intro' => ($request->intro_def == '') ? null : $request->intro_def,
            'content' => ($request->content_def == '') ? null : $request->content_def,
            'lang' => $locale,
        ]);

        $multipleLang = false;
        if (config('app.multiple_lang') == true) {
            foreach ($this->configRepository->getLangNot('lang', [$locale]) as $key) {
                $multipleLang = $this->pageRepository->createLang([
                    'page_id' => $page->id,
                    'title' => ($request->input('title_'.$key['lang']) == '') ? Str::title($request->title_def) : Str::title($request->input('title_'.$key['lang'])),
                    'intro' => ($request->input('intro_'.$key['lang']) == '') ? null : $request->input('intro_'.$key['lang']),
                    'content' => ($request->input('content_'.$key['lang']) == '') ? null : $request->input('content_'.$key['lang']),
                    'lang' => $key['lang'],
                ]);
            }
        }

        return $page;
    }
    
    public function find(int $id)
    {
        return $this->pageRepository->find($id);
    }

    public function update($request, int $id)
    {
        
    
        $locale = App::getLocale();
        $find = $this->find($id);

        $page = $this->pageRepository->update($id, [
            'slug' => Str::slug($request->slug, '-'),
            'updated_by' => auth()->user()['id'],
        ]);
        

        $langDef = false;
        
        $langDef = $this->pageRepository->updateLang($request->id_def, [
            'title' => Str::title($request->title_def),
            'content' => ($request->content_def == '') ? null : $request->content_def,
            
        ]);


        return $page;
    }

    public function status(int $id)
    {
        $page = $this->find($id);

        return $this->pageRepository->update($id, [
            'publish' => !$page['publish'],
        ]);
    }

    public function position(int $id, int $position, int $parent)
    {
        if ($position >= 1) {
                
            $data = $this->find($id);

            if (isset($parent)) {

                $this->pageRepository->findBy('position', $position)->where('parent', $parent)->update([
                    'position' => $data->position,
                ]);

            } else {

                $this->pageRepository->findBy('position', $position)->update([
                    'position' => $data->position,
                ]);
                
            }

            $query = $this->pageRepository->update($id, [
                'position' => $position,
            ]);

            return $query;
        }
    }

    public function delete(int $id)
    {
        $find = $this->find($id);

        $loc = resource_path('views/frontend/page/custom/'.$find['custom_view'].'.blade.php');
        File::delete($loc);

        $page = $this->pageRepository->delete('id', $id);
        $child = $this->pageRepository->delete('parent', $id);
        $lang = $this->pageRepository->deleteLang($id);
        $media = $this->pageRepository->deleteMedia('page_id', $id);

        return $page;
    }

    /**media */
    public function getMedia(int $pageId)
    {
        return $this->pageRepository->getMedia($pageId);
    }

    public function createMedia($request, int $pageId)
    {
        $ordering = $this->pageRepository->findMediaBy('page_id', (int)$pageId)->max('position') + 1;


        if ($request->file != NULL) {
            $tes = $request->file;
            $name = 'file/'.Str::slug($request->input('file')).''.time().'-'.$tes->getClientOriginalName();
            $tes->move('file/', $name);  
            $fileMove = $name;  
        } else {
            $fileMove = NULL;
        
        }
        
        PageMedia::create([
            'page_id' => $pageId,
            'file'   => $fileMove,
            'title'   => $request->title,
            'position' => $ordering,
        ]);
    }

    public function updateMedia($request, int $id)
    {
        return $this->pageRepository->updateMedia($id, [
            'meta_file' => [
                'file' => Str::replaceLast(url('/'), '', $request->file),
                'title' => ($request->title == '') ? null : $request->title,
                'alt' => ($request->alt == '') ? null : $request->alt,
            ],
        ]);
    }

    public function positionMedia(int $id, int $position, int $pageId)
    {
        if ($position >= 1) {
                
            $data = $this->pageRepository->findMediaBy('id', $id)->first();

            if (isset($pageId)) {

                $this->pageRepository->findMediaBy('position', $position)->where('page_id', $pageId)->update([
                    'position' => $data->position,
                ]);

            } else {

                $this->pageRepository->findMediaBy('position', $position)->update([
                    'position' => $data->position,
                ]);
                
            }

            $query = $this->pageRepository->updateMedia($id, [
                'position' => $position,
            ]);

            return $query;
        }
    }

    public function sortMedia(int $id, $position)
    {
        $data = $this->pageRepository->findMediaBy('id', $id)->first();

        return $this->pageRepository->findMediaBy('id', $id)->where('page_id', $data['page_id'])->update([
            'position' => $position
        ]);
    }

    public function deleteMedia(int $id)
    {
        $media = $this->pageRepository->deleteMedia('id', $id);

        return $media;
    }

    /**addon */
    public function read(int $id)
    {
        return $this->pageRepository->read($id);
    }

    public function child(int $parent, $limit)
    {
        return $this->pageRepository->child($parent, $limit);
    }

    public function search($request)
    {
        return $this->pageRepository->search($request);
    }

    public function media(int $pageId, $limit)
    {
        return $this->pageRepository->media($pageId, $limit);
    }

    public function viewer(int $id)
    {
        $find = $this->find($id);

        return $this->pageRepository->update($id, [
            'viewer' => $find['viewer'] + 1,
        ]);
    }
}