<?php

namespace App\Repositories\Interfaces;

interface UsersRepositoryInterface
{
    /**User */
    public function get($request);
    public function count($request);
    public function create(array $value);
    public function find(int $id);
    public function findBy($field, $value);
    public function update(int $id, array $value);
    public function delete(int $id);
    /**Role */
    public function getAllRole();
    public function getRole($request);
    public function getByUser(int $role);
    public function countRole($request);
    public function createRole(array $value);
    public function findRole(int $id);
    public function updateRole(int $id, array $value);
    public function deleteRole(int $id);
    /**Permission */
    public function getAllPermission();
    public function getPermission($request);
    public function countPermission($request);
    public function createPermission(array $value);
    public function findPermission(int $id);
    public function updatePermission(int $id, array $value);
    public function givePermission($request);
    public function deletePermission(int $id);
    
}