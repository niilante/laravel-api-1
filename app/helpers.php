<?php

use App\Services\Client;
use JetBrains\PhpStorm\Pure;
use App\Exceptions\Exception;
use App\Models\Entities\EntityMap;
use Illuminate\Support\Facades\DB;

if(!function_exists('entity')){

    /**
     * get factory instance
     *
     * @return EntityMap
     */
    #[Pure] function entity(): EntityMap
    {
        return new EntityMap();
    }
}

if(!function_exists('fullTextSearchTable')){

    /**
     * full text search table for migration
     *
     * @param $table
     * @param array $columns
     * @return void
     */
    function fullTextSearchTable($table,array $columns = []): void
    {
        $queryString = 'ALTER TABLE '.$table.' ADD FULLTEXT fulltext_index ('.implode(',',$columns).')';
        DB::statement($queryString);
    }
}

if(!function_exists('generateHash')){

    /**
     * generates hash via crc32 method
     *
     * @return int
     */
    function generateHash(): int
    {
        return crc32(Client::fingerPrint().'_'.time().'_'.rand(1,999999));
    }
}

if(!function_exists('inValidCodeException')){

    /**
     * throws exception for invalid code
     *
     * @param ?string $key
     * @param ?int $value
     * @return object
     */
    function inValidCodeException(?string $key = null,?int $value = null): object
    {
        return Exception::customException(trans('exception.codeException',[
            'key' => $key,
            'value' => $value
        ]));
    }
}
