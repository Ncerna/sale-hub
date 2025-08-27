<?php
namespace Infrastructure\Framework\Controller;
use Illuminate\Support\Facades\Log;
use Application\Contracts\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductController
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function list()
    {
        $page = request()->query('page', 1);
        $size = request()->query('size', 10);
        $search = request()->query('search', null);

        $products = $this->productService->listAll($page, $size, $search);
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $data = $request->all();
         Log::info('Entrando al controlador store() con datos:', $request->all());
        $product = $this->productService->registerProduct($data);
        return response()->json(['product' => $product],201);
      
    }

    public function show($id)
    {
        $product = $this->productService->getProduct($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $product = $this->productService->updateProduct($id, $data);
        return response()->json(['product' => $product]);
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return response()->json(['message' => 'Producto eliminado']);
    }
}
