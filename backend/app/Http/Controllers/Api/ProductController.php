<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Services\Product\ProductService;
use App\DTOs\Product\ProductDTO;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService
    ) {
    }

    public function createProduct(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $data["user_id"] = auth()->id();
        $productDto = ProductDTO::fromArray($data);
        $product = $this->productService->createProduct($productDto);

        return response()->json([
            "success" => true,
            "message" => "Product has been successfully created!",
            "data" => $product->toArray()
        ], 201);
    }
}
