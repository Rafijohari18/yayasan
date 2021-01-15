<?php

namespace App\Services\Interfaces;

interface AlbumServiceInterface
{
    public function get($request);
    public function count($request);
    public function create($request);
    public function find(int $id);
    public function update($request, int $id);
    public function sort(int $id, $position);
    public function delete(int $id);
    /**photo */
    public function getPhoto($albumId);
    public function createPhoto($request, $albumId);
    public function multiUploadPhoto($request, $albumId);
    public function updatePhoto($request, $id);
    public function positionPhoto(int $id, int $position, int $albumId);
    public function sortPhoto(int $id, $position);
    public function deletePhoto(int $id);
    /**addon */
    public function album($limit);
    public function photo(int $albumId, $limit);
    public function photoAll($limit);
    public function viewer(int $id);
}