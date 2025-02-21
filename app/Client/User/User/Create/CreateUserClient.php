<?php

namespace App\Client\User\User\Create;

use App\Models\User;
use App\Client\Client;
use Illuminate\Support\Facades\Hash;
use App\Client\ClientAutoGeneratorTrait;

/**
 * Class GetClient
 * @package App\Client\User
 */
class CreateUserClient extends Client
{
    use GeneratorTrait,ClientAutoGeneratorTrait;

    /**
     * get capsule for client
     *
     * @var array
     */
    protected array $capsule = [];

    /**
     * get model entity validation
     *
     * @var array|string[]
     */
    protected array $model = [User::class];

    /**
     * get rule for client
     *
     * @var array
     */
    protected array $rule = [
        'name'      => 'required|max:50',
        'email'     => 'required',
        'password'  => 'required',
    ];

    /**
     * it is password in the client data
     *
     * @var string
     */
    protected string $password;

    /**
     * password value sent will be passed through the Hash::make() method.
     *
     * @return string
     */
    protected function password(): string
    {
        return Hash::make($this->password);
    }
}
