<?php
namespace Infrastructure\Framework\Controller;

use Application\Service\ProductCoordinatorService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private ProductCoordinatorService $productCoordinator;

    public function __construct(ProductCoordinatorService $productCoordinator)
    {
        $this->productCoordinator = $productCoordinator;
    }

    public function index(Request $request)
    {
        $page = (int) $request->get('page', 1);
        $size = (int) $request->get('size', 10);
        $search = $request->get('search', null);

        $products = $this->productCoordinator->listProducts($page, $size, $search);

        return response()->json($products);
    }

    public function store(Request $request)
    {
        $command = new \Application\Command\CreateProductCommand(
            $request->input('name'),
            $request->input('code'),
            $request->input('basePrice'),
            $request->input('igvRate'),
            $request->input('stock')
        );

        $this->productCoordinator->createProduct($command);

        return response()->json(['message' => 'Producto creado correctamente'], 201);
    }

    public function updateStock(Request $request, string $productId)
    {
        $quantity = (int) $request->input('quantity');
        $this->productCoordinator->updateStock($productId, $quantity);
        return response()->json(['message' => 'Stock actualizado correctamente']);
    }
}
