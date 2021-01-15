<?php

namespace App\Repositories;

use App\Models\Page;
use App\Models\PageLang;
use App\Models\PageMedia;
use App\Repositories\Interfaces\PageRepositoryInterface;

class PageRepository implements PageRepositoryInterface
{
    private $page, $pagelang, $media;

    public function __construct(Page $page, PageLang $pagelang, PageMedia $media)
    {
        $this->page = $page;
        $this->pagelang = $pagelang;
        $this->media = $media;
    }

    public function getAll()
    {
        return $this->page->with('pageLang')->all();
    }

    public function get($request)
    {
        $query = $this->page->with('pageLang');

        if ($request->get('q') != '') {
            $query->when($request->q, function ($query) use ($request) {
                return $query->whereHas('pageLang', function ($query) use ($request) {
                    $query->where('title', 'like', "%{$request->q}%");
                });
            });
        }

        if ($request->get('s') != '') {
            $query->where('publish', $request->get('s'));
        }

        return $query->where('parent', 0)->orderBy('position', 'ASC')->paginate(10);
    }

    public function count($request)
    {
        $query = $this->page->with('pageLang');
        
        if ($request->get('q') != '') {
            $query->when($request->q, function ($query) use ($request) {
                return $query->whereHas('pageLang', function ($query) use ($request) {
                    $query->where('title', 'like', "%{$request->q}%");
                });
            });
        }

        if ($request->get('s') != '') {
            $query->where('publish', $request->get('s'));
        }

        return $query->orderBy('position', 'ASC')->count();
    }

    public function create(array $request)
    {
        return $this->page->create($request);
    }

    public function createLang(array $request)
    {
        return $this->pagelang->create($request);
    }

    public function find(int $id)
    {
        return $this->page->with('pageLang')->findOrFail($id);
    }

    public function findBy($field, $value)
    {
        return $this->page->with('pageLang')->where($field, $value);
    }

    public function update(int $id, array $request)
    {
        return $this->page->where('id', $id)->update($request);
    }

    public function updateLang(int $id, array $request)
    {
        
        return $this->pagelang->where('id', $id)->update($request);
    }

    public function delete($field, $value)
    {
        return $this->page->where($field, $value)->delete();
    }

    public function deleteLang(int $pageId)
    {
        return $this->pagelang->where('page_id', $pageId)->delete();
    }

    
    /**media */
    public function getMedia(int $pageId)
    {
        $query = $this->media->where('page_id', $pageId)->orderBy('position', 'ASC')->paginate(50);

        return $query;
    }

    public function createMedia(array $request)
    {
        return $this->media->create($request);
    }

    public function findMedia(int $id)
    {
        return $this->media->findOrFail($id);
    }

    public function findMediaBy($field, $value)
    {
        return $this->media->where($field, $value);
    }

    public function updateMedia(int $id, array $request)
    {
        return $this->media->where('id', $id)->update($request);
    }

    public function deleteMedia($field, $value)
    {
        return $this->media->where($field, $value)->delete();
    }

    /**addon */
    public function read(int $id)
    {
        return $this->page->with('pageLang')->where('id', $id)->where('publish', 1)->first();
    }

    public function child(int $parent, $limit)
    {
        return $this->page->with('pageLang')->where('parent', $parent)->where('publish', 1)->orderBy('position', 'ASC')->paginate($limit);
    }

    public function search($request)
    {
        $query = $this->page->with('pageLang');

        if ($request->get('q') != '') {
            $query->when($request->q, function ($query) use ($request) {
                return $query->whereHas('pageLang', function ($query) use ($request) {
                    $query->where('title', 'like', "%{$request->q}%")
                    ->orWhere('intro', 'like', "%{$request->q}%")
                    ->orWhere('content', 'like', "%{$request->q}%");
                });
            });
        }

        return $query->where('publish', 1)->orderBy('position', 'ASC')->get();
    }

    public function media(int $pageId, $limit)
    {
        return $this->media->where('page_id', $pageId)->orderBy('position', 'ASC')->paginate($limit);
    }
}