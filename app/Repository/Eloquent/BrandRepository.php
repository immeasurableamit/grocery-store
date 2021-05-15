<?php

namespace App\Repository\Eloquent;

use App\Models\Brand;
use Illuminate\Support\Collection;
use App\Repository\BrandRepositoryInterface;


class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Brand $model
     */
    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Get category by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->where('id', $id)->get();
    }
}
