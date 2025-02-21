<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\User\Contracts\UserRepositoryContract;
use App\Repositories\Countries\Contracts\CountriesRepositoryContract;
use App\Repositories\Logger\Contracts\LoggerRepositoryContract;

/**
 * Class Repository
 * @package App\Repositories
 */
class Repository
{
    /**
     * get country repository instance
     *
     * @return CountriesRepositoryContract
     */
    public static function country() : CountriesRepositoryContract
    {
        return app()->get(CountriesRepositoryContract::class);
    }

    /**
     * get user repository instance
     *
     * @return UserRepositoryContract
     */
    public static function user() : UserRepositoryContract
    {
        return app()->get(UserRepositoryContract::class);
    }

    /**
     * get logger repository instance
     *
     * @return LoggerRepositoryContract
     */
    public static function logger() : LoggerRepositoryContract
    {
        return app()->get(LoggerRepositoryContract::class);
    }
}
