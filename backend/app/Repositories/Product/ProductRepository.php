<?php

namespace App\Repositories\Product;

use App\Models\Product;

class ProductRepository
{

    public function createProduct(array $data): Product
    {
        return Product::create($data);
    }
}
