<?php

namespace App\Repositories;


interface HolidaySetRepositoryInterface
{
    public function getAll($paginate = true);

    public function create(array $data);

    public function update($id, array $attributes);

    public function findOne($id);

    public function delete($id);

    public function search($key, $value);
}
