<?php

namespace App\Repositories\Interfaces;

interface AlbumRepositoryInterface
{
    public function getAll();
    public function get($request);
    public function count($request);
    public function create(array $request);
    public function find(int $id);
    public function update(int $id, array $request);
    public function delete(int $id);
    /**photo */
    public function getPhoto($albumId);
    public function createPhoto(array $request);
    public function updatePhoto(int $id, array $request);
    public function findPhoto(int $id);
    public function findPhotoBy($field, $value);
    public function deletePhoto(int $id);
    /**addon */
    public function album($limit);
    public function photo(int $albumId, $limit);
    public function photoAll($limit);
}