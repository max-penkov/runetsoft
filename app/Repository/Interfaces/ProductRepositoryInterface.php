<?php

declare(strict_types=1);

namespace App\Repository\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductRepository
 * @package App\Repository
 */
interface ProductRepositoryInterface
{
    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @param       $id
     *
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id);

    /**
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    /**
     * @param       $field
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findBy($field, $value, $columns = ['*']);

    /**
     * @param array $array
     *
     * @return mixed
     */
    public function firstOrCreate(array $array);
}
