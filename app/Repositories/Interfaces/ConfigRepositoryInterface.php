<?php

namespace App\Repositories\Interfaces;

interface ConfigRepositoryInterface
{
    public function getNot(int $gId, string $field, array $value);
    public function getBy(string $field, string $value);
    public function update(string $name, array $value);
   
}