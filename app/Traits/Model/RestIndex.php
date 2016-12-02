<?php

namespace EasyShop\Traits\Model;

trait RestIndex
{
    public function scopeIndex(
        $query,
        $columnName = 'name',
        $ascOrDesc = 'asc',
        $paginate = 10
    ) {
        return $query->orderBy($columnName, $ascOrDesc)
                    ->paginate($paginate);
    }
}
