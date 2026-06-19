<?php

namespace App\Repositories\Product;

use App\Models\Product;

class ProductRepository
{

    public function createProduct(array $data): Product
    {
        return Product::create($data);
    }

    public function getAllProducts($request)
    {
        $user = $request->user();
        $limit = $request->limit ?? 10;
        $products = Product::where("user_id", $user->id);
        if ($request->filled('search')) {
            $search = $request->search;
            $products = $products->where("name", "like", "%" . $search . "%")->orWhere("sku", $search);
        }
        if ($request->filled("sort") && in_array($request->sort, ["asc", "desc"])) {
            $sort = $request->sort;
            $products = $products->orderBy("id", $sort);
        }
        return $products->paginate($limit, ["*"]);
    }

    public function getProductById(int $id, $user)
    {
        return Product::where("user_id", $user->id)->find($id);
    }

    public function updateProduct(int $ProductId, array $data)
    {
        $product = $this->getProductById($ProductId, auth()->user());
        if (!$product) {
            return null;
        }
        $product->update($data);
        return $product;
    }

    public function deleteProduct(int $id, $user)
    {
        $product = $this->getProductById($id, $user);
        if (!$product) {
            return null;
        }
        $product->delete();
        return true;
    }
}
