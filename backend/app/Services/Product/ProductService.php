<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepository;
use App\DTOs\Product\ProductDTO;

class ProductService
{
    public function __construct(
        private ProductRepository $productRepository
    ) {
    }

    public function createProduct(ProductDTO $dto): \App\Models\Product
    {
        return $this->productRepository->createProduct(
            [
                "name" => $dto->name,
                "sku" => $dto->sku,
                "price" => $dto->price,
                "stock" => $dto->stock,
                "is_active" => $dto->isActive,
                "user_id" => $dto->userId,
            ]
        );
    }
}
