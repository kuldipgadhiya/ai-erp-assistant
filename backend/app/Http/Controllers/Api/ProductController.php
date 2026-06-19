<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\PropductUpdateRequest;
use App\Services\Product\ProductService;
use App\DTOs\Product\ProductDTO;
use Illuminate\Http\Request;

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

    public function index(Request $request)
    {
        $products = $this->productService->getAllProducts($request);
        return response()->json([
            "success" => true,
            "message" => "Products has been successfully retrieved!",
            "data" => $products->toArray()
        ], 200);
    }

    public function getProductById(Request $request)
    {
        $product = $this->productService->getProductById($request);
        if ($product) {
            return response()->json([
                "success" => true,
                "message" => "Product has been successfully retrieved!",
                "data" => $product->toArray()
            ], 200);
        }

        return response()->json([
            "success" => false,
            "message" => "Product not found!",
        ], 404);
    }

    public function updateProduct(int $id, PropductUpdateRequest $request)
    {
        $data = $request->validated();
        $data["user_id"] = auth()->id();
        $productDto = ProductDTO::fromArray($data);
        $product = $this->productService->updateProduct($id, $productDto);

        if ($product) {
            return response()->json([
                "success" => true,
                "message" => "Product has been successfully updated!",
                "data" => $product->toArray()
            ], 200);
        }

        return response()->json([
            "success" => false,
            "message" => "Product not found!",
        ], 404);
    }

    public function deleteProduct(int $id, Request $request)
    {
        $product = $this->productService->getProductById($request);
        if ($product) {
            $deleted = $this->productService->deleteProduct($request);
            if ($deleted) {
                return response()->json([
                    "success" => true,
                    "message" => "Product has been successfully deleted!",
                ], 200);
            }
            return response()->json([
                "success" => false,
                "message" => "Product not found!",
            ], 404);
        }

        return response()->json([
            "success" => false,
            "message" => "Product not found!",
        ], 404);
    }
}
