<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Dosen;

class DosenService 
{
    private $dosen;

    public function __construct(Dosen $dosen)
    {
        $this->dosen = $dosen;
    }

    public function getAll()
    {
        return $this->dosen->get();
    }


    public function count($request)
    {
        return $this->dosen->count($request);
    }

    public function create($request)
    {
        $locale = App::getLocale();
        $parent = $request->get('parent');
        $ordering = $this->dosen->findBy('parent', (int)$parent)->max('position') + 1;

        $page = $this->dosen->create([
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
        $langDef = $this->dosen->createLang([
            'page_id' => $page->id,
            'title' => Str::title($request->title_def),
            'intro' => ($request->intro_def == '') ? null : $request->intro_def,
            'content' => ($request->content_def == '') ? null : $request->content_def,
            'lang' => $locale,
        ]);

        $multipleLang = false;
       

        return $page;
    }
    
    public function find(int $id)
    {
        return $this->dosen->find($id);
    }

    public function update($request, int $id)
    {
        
    
        $locale = App::getLocale();
        $find = $this->find($id);

        $page = $this->dosen->update($id, [
            'slug' => Str::slug($request->slug, '-'),
            'updated_by' => auth()->user()['id'],
        ]);
        

        $langDef = false;
        
        $langDef = $this->dosen->updateLang($request->id_def, [
            'title' => Str::title($request->title_def),
            'content' => ($request->content_def == '') ? null : $request->content_def,
            
        ]);


        return $page;
    }

    public function status(int $id)
    {
        $page = $this->find($id);

        return $this->dosen->update($id, [
            'publish' => !$page['publish'],
        ]);
    }

    public function position(int $id, int $position, int $parent)
    {
        if ($position >= 1) {
                
            $data = $this->find($id);

            if (isset($parent)) {

                $this->dosen->findBy('position', $position)->where('parent', $parent)->update([
                    'position' => $data->position,
                ]);

            } else {

                $this->dosen->findBy('position', $position)->update([
                    'position' => $data->position,
                ]);
                
            }

            $query = $this->dosen->update($id, [
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

        $page = $this->dosen->delete('id', $id);
        $child = $this->dosen->delete('parent', $id);
        $lang = $this->dosen->deleteLang($id);
        $media = $this->dosen->deleteMedia('page_id', $id);

        return $page;
    }

    /**media */
    public function getMedia(int $pageId)
    {
        return $this->dosen->getMedia($pageId);
    }

    public function createMedia($request, int $pageId)
    {
        $ordering = $this->dosen->findMediaBy('page_id', (int)$pageId)->max('position') + 1;


        if ($request->file != NULL) {
            $tes = $request->file;
            $name = 'file/'.Str::slug($request->input('file')).''.time().'-'.$tes->getClientOriginalName();
            $tes->move(public_path().'/file/', $name);  
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
        return $this->dosen->updateMedia($id, [
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
                
            $data = $this->dosen->findMediaBy('id', $id)->first();

            if (isset($pageId)) {

                $this->dosen->findMediaBy('position', $position)->where('page_id', $pageId)->update([
                    'position' => $data->position,
                ]);

            } else {

                $this->dosen->findMediaBy('position', $position)->update([
                    'position' => $data->position,
                ]);
                
            }

            $query = $this->dosen->updateMedia($id, [
                'position' => $position,
            ]);

            return $query;
        }
    }

    public function sortMedia(int $id, $position)
    {
        $data = $this->dosen->findMediaBy('id', $id)->first();

        return $this->dosen->findMediaBy('id', $id)->where('page_id', $data['page_id'])->update([
            'position' => $position
        ]);
    }

    public function deleteMedia(int $id)
    {
        $media = $this->dosen->deleteMedia('id', $id);

        return $media;
    }

    /**addon */
    public function read(int $id)
    {
        return $this->dosen->read($id);
    }

    public function child(int $parent, $limit)
    {
        return $this->dosen->child($parent, $limit);
    }

    public function search($request)
    {
        return $this->dosen->search($request);
    }

    public function media(int $pageId, $limit)
    {
        return $this->dosen->media($pageId, $limit);
    }

    public function viewer(int $id)
    {
        $find = $this->find($id);

        return $this->dosen->update($id, [
            'viewer' => $find['viewer'] + 1,
        ]);
    }
}