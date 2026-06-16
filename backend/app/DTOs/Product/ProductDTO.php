<?php

namespace App\DTOs\Product;

class ProductDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $name,
        public string $sku,
        public float $price,
        public int $stock,
        public bool $isActive,
        public int $userId
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            sku: $data['sku'],
            price: $data['price'],
            stock: $data['stock'],
            isActive: $data['is_active'],
            userId: $data['user_id']
        );
    }
}
