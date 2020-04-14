<?php

declare(strict_types=1);

namespace App\Repository\Interfaces;

/**
 * Interface AttributeRepositoryInterface
 * @package App\Repository\Interfaces
 */
interface AttributeRepositoryInterface
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
}
