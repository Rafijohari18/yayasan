<?php

namespace App\Repositories;

use App\Album;
use App\Photo;
use App\Repositories\Interfaces\AlbumRepositoryInterface;

class AlbumRepository implements AlbumRepositoryInterface
{
    private $album, $photo;

    public function __construct(Album $album, Photo $photo)
    {
        $this->album = $album;
        $this->photo = $photo;
    }

    public function getAll()
    {
        return $this->album->all();
    }

    public function get($request)
    {
        $query = $this->album->orderBy('position', 'ASC')
        ->when($request->q, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->q}%");
        })->paginate(20);
        $query->appends($request->only('q'));

        return $query;
    }

    public function count($request)
    {
        $query = $this->album->orderBy('position', 'ASC')
        ->when($request->q, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->q}%");
        })->count();

        return $query;
    }

    public function create(array $request)
    {
        return $this->album->create($request);
    }
    
    public function find(int $id)
    {
        return $this->album->findOrFail($id);
    }

    public function update(int $id, array $request)
    {
        return $this->album->where('id', $id)->update($request);
    }

    public function delete(int $id)
    {
        return $this->album->where('id', $id)->delete();
    }

    public function getPhoto($albumId)
    {
        return $this->photo->where('album_id', $albumId)->orderBy('position', 'ASC')->paginate(9);
    }

    public function createPhoto(array $request)
    {
        return $this->photo->create($request);
    }

    public function findPhoto(int $id)
    {
        return $this->photo->findOrFail($id);
    }

    public function findPhotoBy($field, $value)
    {
        return $this->photo->with('album')->where($field, $value);
    }

    public function updatePhoto(int $id, array $request)
    {
        return $this->photo->where('id', $id)->update($request);
    }

    public function deletePhoto(int $id)
    {
        return $this->photo->where('id', $id)->delete();
    }

    /**addon */
    public function album($limit)
    {
        return $this->album->orderBy('created_at', 'DESC')->paginate($limit);
    }

    public function photo(int $albumId, $limit)
    {
        return $this->photo->where('album_id', $albumId)->orderBy('position', 'ASC')->paginate($limit);
    }

    public function photoAll($limit)
    {
        return $this->photo->orderBy('position', 'ASC')->paginate($limit);
    }
}