<?php

namespace App\Repositories\Interfaces;

interface PageRepositoryInterface
{
    public function getAll();
    public function get($request);
    public function count($request);
    public function create(array $request);
    public function createLang(array $request);
    public function find(int $id);
    public function findBy($field, $value);
    public function update(int $id, array $request);
    public function updateLang(int $id, array $request);
    public function delete($field, $value);
    public function deleteLang(int $pageId);
    /**media */
    public function getMedia(int $pageId);
    public function createMedia(array $request);
    public function findMedia(int $id);
    public function findMediaBy($field, $value);
    public function updateMedia(int $id, array $request);
    public function deleteMedia($field, $value);
    /**addon */
    public function read(int $id);
    public function child(int $parent, $limit);
    public function search($request);
    public function media(int $pageId, $limit);
}