<?php

namespace App\Services;

use App\Repositories\Interfaces\AlbumRepositoryInterface;
use App\Repositories\Interfaces\ConfigRepositoryInterface;
use App\Services\Interfaces\AlbumServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AlbumService implements AlbumServiceInterface
{
    private $albumRepository, $configRepository;

    public function __construct(AlbumRepositoryInterface $albumRepository, ConfigRepositoryInterface $configRepository)
    {
        $this->albumRepository = $albumRepository;
        $this->configRepository = $configRepository;
    }

    public function get($request)
    {
        return $this->albumRepository->get($request);
    }

    public function count($request)
    {
        return $this->albumRepository->count($request);
    }

    public function create($request)
    {
        $locale = App::getLocale();
        $ordering = $this->albumRepository->getAll()->max('position') + 1;

        $name[$locale] = $request->name_def;
        $description[$locale] = $request->description_def;
        if (config('app.multiple_lang') == true) {
            foreach ($this->configRepository->getLangNot('lang', [$locale]) as $key) {
                $name[$key['lang']] = ($request->input('name_'.$key['lang']) == '') ? $request->name_def : $request->input('name_'.$key['lang']);
                $description[$key['lang']] = ($request->input('description_'.$key['lang']) == '') ? $request->description_def : $request->input('description_'.$key['lang']);
            }
        }

        $album = $this->albumRepository->create([
            'name' => $name,
            'description' => ($request->description_def == '') ? null : $description,
            'banner' => ($request->banner_img == '') ? null : [
                'banner_img' => Str::replaceLast(url('/'), '', $request->banner_img),
                'banner_title' => $request->banner_title,
                'banner_alt' => $request->banner_alt,
            ],
            'position' => $ordering,
            'created_by' => auth()->user()['id'],
        ]);

        $path = public_path('userfile/album/'.$album->id);
        File::makeDirectory($path, $mode = 0777, true, true);

        return $album;
    }

    public function find(int $id)
    {
        return $this->albumRepository->find($id);
    }

    public function update($request, int $id)
    {
        $locale = App::getLocale();
        
        $name[$locale] = $request->name_def;
        $description[$locale] = $request->description_def;
        if (config('app.multiple_lang') == true) {
            foreach ($this->configRepository->getLangNot('lang', [$locale]) as $key) {
                $name[$key['lang']] = ($request->input('name_'.$key['lang']) == '') ? $request->name_def : $request->input('name_'.$key['lang']);
                $description[$key['lang']] = ($request->input('description_'.$key['lang']) == '') ? $request->description_def : $request->input('description_'.$key['lang']);
            }
        }

        $album = $this->albumRepository->update($id, [
            'name' => $name,
            'description' => ($request->description_def == '') ? null : $description,
            'banner' => ($request->banner_img == '') ? null : [
                'banner_img' => Str::replaceLast(url('/'), '', $request->banner_img),
                'banner_title' => $request->banner_title,
                'banner_alt' => $request->banner_alt,
            ],
            'updated_by' => auth()->user()['id'],
        ]);

        return $album;
    }

    public function sort(int $id, $position)
    {
        return $this->albumRepository->find($id)->update([
            'position' => $position,
        ]);
    }

    public function delete(int $id)
    {
        foreach ($this->albumRepository->findPhotoBy('album_id', $id)->get() as $key) {
            $loc = public_path('userfile/album/'.$id.'/'.$key['file']);
            File::delete($loc);
        }
        File::deleteDirectory(public_path('userfile/album/'.$id));

        $album = $this->albumRepository->delete($id);
        $photo = $this->albumRepository->findPhotoBy('album_id', $id)->delete();

        return $album;
    }

    /**photo */
    public function getPhoto($albumId)
    {
        return $this->albumRepository->getPhoto($albumId);
    }

    public function createPhoto($request, $albumId)
    {
        $ordering = $this->albumRepository->findPhotoBy('album_id', (int)$albumId)->max('position') + 1;

        if ($request->hasFile('file')) {
            $fileName = 'photo-'.$albumId.'-'.Carbon::parse(now())->format('YmdHis').'.'.$request->file('file')->guessExtension();
            $request->file('file')->move(public_path('userfile/album/'.$albumId), $fileName);
        }

        return $this->albumRepository->createPhoto([
            'album_id' => $albumId,
            'file' => $fileName,
            'title' => ($request->title == '') ? null : $request->title,
            'description' => ($request->description == '') ? null : $request->description,
            'alt' => ($request->alt == '') ? null : $request->alt,
            'position' => $ordering,
        ]);
    }

    public function multiUploadPhoto($request, $albumId)
    {
        $ordering = $this->albumRepository->findPhotoBy('album_id', (int)$albumId)->max('position') + 1;

        $fileName = 'photo-'.$albumId.'-'.Str::random(10).'-'.Carbon::parse(now())->format('Ymd').'.'.$request->file('file')->guessExtension();
        $request->file('file')->move(public_path('userfile/album/'.$albumId), $fileName);

        return $this->albumRepository->createPhoto([
            'album_id' => $albumId,
            'file' => $fileName,
            'position' => $ordering,
        ]);
    }

    public function updatePhoto($request, $id)
    {
        return $this->albumRepository->updatePhoto($id, [
            'title' => ($request->title == '') ? null : $request->title,
            'description' => ($request->description == '') ? null : $request->description,
            'alt' => ($request->alt == '') ? null : $request->alt,
        ]);
    }

    public function positionPhoto(int $id, int $position, int $albumId)
    {
        if ($position >= 1) {
                
            $data = $this->albumRepository->findPhotoBy('id', $id)->first();

            if (isset($albumId)) {

                $this->albumRepository->findPhotoBy('position', $position)->where('album_id', $albumId)->update([
                    'position' => $data->position,
                ]);

            } else {

                $this->albumRepository->findPhotoBy('position', $position)->update([
                    'position' => $data->position,
                ]);
                
            }

            $query = $this->albumRepository->updatePhoto($id, [
                'position' => $position,
            ]);

            return $query;
        }
    }

    public function sortPhoto(int $id, $position)
    {
        $data = $this->albumRepository->findPhotoBy('id', $id)->first();

        return $this->albumRepository->findPhotoBy('id', $id)->where('album_id', $data['album_id'])->update([
            'position' => $position,
        ]);
    }

    public function deletePhoto(int $id)
    {
        $find = $this->albumRepository->findPhoto($id);

        $loc = public_path('userfile/album/'.$find['album_id'].'/'.$find['file']);
        File::delete($loc);

        $media = $this->albumRepository->deletePhoto($id);

        return $media;
    }

    /**addon */
    public function album($limit)
    {
        return $this->albumRepository->album($limit);
    }

    public function photo(int $albumId, $limit)
    {
        return $this->albumRepository->photo($albumId, $limit);
    }

    public function photoAll($limit)
    {
        return $this->albumRepository->photoAll($limit);
    }

    public function viewer(int $id)
    {
        $find = $this->find($id);

        return $this->albumRepository->update($id, [
            'viewer' => $find['viewer'] + 1,
        ]);
    }
}