<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Sortable
{
    public function scopeSort($query, $orders)
    {
        foreach ($orders as $column => $direction) {
            $method = 'sort' . Str::studly($column);

            if (method_exists($this, $method)) {
                $this->{$method}($query, $direction);
                continue;
            }

            if (empty($this->sortable) || !is_array($this->sortable)) {
                continue;
            }

            if (in_array($column, $this->sortable)) {
                $query->orderBy($column, $direction);
            }
        }

        return $query;
    }
}