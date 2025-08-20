<?php
namespace App\Infrastructure\Framework\Controller;

use App\Application\UseCase\CreateProductUseCase;
use App\Application\UseCase\UpdateProductUseCase;
use App\Application\UseCase\DeleteProductUseCase;
use App\Application\UseCase\ListProductsUseCase;
use App\Infrastructure\Persistence\ProductRepository;
use Illuminate\Http\Request;

class ProductController
{
    private CreateProductUseCase $createUseCase;
    private UpdateProductUseCase $updateUseCase;
    private DeleteProductUseCase $deleteUseCase;
    private ListProductsUseCase $listUseCase;

    public function __construct()
    {
        $repo = new ProductRepository();
        $this->createUseCase = new CreateProductUseCase($repo);
        $this->updateUseCase = new UpdateProductUseCase($repo);
        $this->deleteUseCase = new DeleteProductUseCase($repo);
        $this->listUseCase = new ListProductsUseCase($repo);
    }

    public function store(Request $request)
    {
        $product = $this->createUseCase->execute(
            $request->input('name'),
            floatval($request->input('price')),
            intval($request->input('stock'))
        );
        return response()->json($product, 201);
    }

    public function index()
    {
        $products = $this->listUseCase->execute();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = $this->listUseCase->execute();
        $item = collect($product)->firstWhere('id', (int)$id);
        if (!$item) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $product = $this->updateUseCase->execute(
            (int)$id,
            $request->input('name'),
            floatval($request->input('price')),
            intval($request->input('stock'))
        );
        if (!$product) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json($product);
    }

    public function destroy($id)
    {
        $deleted = $this->deleteUseCase->execute((int)$id);
        if (!$deleted) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json(null, 204);
    }
}
