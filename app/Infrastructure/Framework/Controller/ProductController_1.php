<?php
namespace Infrastructure\Framework\Controller;

use Application\Service\ProductApplicationService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    private ProductApplicationService $productService;

    public function __construct(ProductApplicationService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 10);
        $search = $request->input('search');

        $products = $this->productService->listProducts($page, $size, $search);
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $product = $this->productService->registerProduct($data);
            return response()->json($product, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show(int $id)
    {
        $product = $this->productService->getProduct($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        try {
            $product = $this->productService->updateProduct($id, $data);
            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->productService->deleteProduct($id);
            return response()->json(['message' => 'Product deleted']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
