<?php

namespace App\Repositories;

use App\Models\Config;
use App\Models\Language;
use App\Repositories\Interfaces\ConfigRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ConfigRepository implements ConfigRepositoryInterface
{
    private $config;

    public function __construct(Config $config,Language $language)
    {
        $this->config = $config;
        $this->language = $language;
    
    }

    public function getLangNot(string $field, array $value)
    {
        return $this->language->where('status', 1)->whereNotIn($field, $value)->get();
    }

    public function getNot(int $gId, string $field, array $value)
    {
        return $this->config->where('group_id', $gId)->whereNotIn($field, $value)->get();
    }

    public function getBy(string $field, string $value)
    {
        return $this->config->where($field, $value)->first();
    }

    public function update(string $name, array $value)
    {
        return $this->config->where('name', $name)->update($value);
    }

    
}