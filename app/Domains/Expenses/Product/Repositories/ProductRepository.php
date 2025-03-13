<?php

declare(strict_types=1);

namespace App\Domains\Expenses\Product\Repositories;

use App\Domains\Expenses\Product\Models\Product;

class ProductRepository
{
    public function __construct(
        private $model = new Product
    ) {}

    public function create(array $data): Product
    {
        return $this->model->create($data);
    }
}
