<?php

namespace App\Repositories\Logger\Contracts;

use App\Repositories\Logger\LoggerRepository;

interface LoggerRepositoryContract
{
	/**
	 * @return array
	 * @see LoggerRepository::get()
	 */
	function get(): array;

    /**
     * @return array
     * @see LoggerRepository::all()
     */
    public function all() : array;

	/**
	 * @param array $data
	 * @return array|object
	 * @see LoggerRepository::create()
	 */
	function create(array $data = []): array|object;


	/**
	 * @param array $data
	 * @return array|object
	 * @see LoggerRepository::update()
	 */
	function update(array $data = []): array|object;

    /**
     * @param $field
     * @param $value
     * @return bool
     */
    public function exists($field,$value) : bool;


    /**
     * @param int $id
     * @param array $select
     * @return array
     * @see CommentRepository::find()
     */
    function find(int $id,array $select = ['*']): array;
}
