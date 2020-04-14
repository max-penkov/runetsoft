<?php

declare(strict_types=1);

namespace App\Repository;

use App\Product;
use App\Repository\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductRepository
 * @package App\Repository
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var Model
     */
    private $model;

    /**
     * ProductRepository constructor.
     *
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     *
     * @return mixed|void
     */
    public function create(array $data)
    {
        $this->model->create($data);
    }

    /**
     * @param array  $data
     * @param        $id
     * @param string $attribute
     *
     * @return mixed
     */
    public function update(array $data, $id, $attribute = 'id')
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @inheritDoc
     */
    public function find($id, $columns = ['*'])
    {
        // TODO: Implement find() method.
    }

    /**
     * @inheritDoc
     */
    public function findBy($field, $value, $columns = ['*'])
    {
        // TODO: Implement findBy() method.
    }


    /**
     * @inheritDoc
     */
    public function firstOrCreate(array $array)
    {
        return $this->model->firstOrCreate($array);
    }

    /**
     * @param $method
     * @param $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->model, $method], $args);
    }
}
