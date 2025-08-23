<?php
namespace Infrastructure\Framework\Controllers;

use Application\Contracts\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductController
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $this->productService->registerProduct($data);
        return response()->json(['message' => 'Producto creado']);
    }
}
