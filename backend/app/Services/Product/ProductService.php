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

    public function getAllProducts($request)
    {
        return $this->productRepository->getAllProducts($request);
    }

    public function getProductById($request): \App\Models\Product
    {
        $id = $request->id;
        $user = $request->user();
        return $this->productRepository->getProductById($id, $user);
    }

    public function updateProduct(int $ProductId, ProductDTO $dto): \App\Models\Product
    {
        return $this->productRepository->updateProduct(
            $ProductId,
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
