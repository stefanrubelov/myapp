<?php

declare(strict_types=1);

namespace App\Domains\Expenses\Product\Services;

use App\Domains\Expenses\Product\Models\Product;
use App\Domains\Expenses\Product\Repositories\ProductRepository;

class ProductService
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function saveProduct(array $data): Product
    {
        return $this->repository->create($data);
    }
}
