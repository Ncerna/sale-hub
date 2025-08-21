<?php
namespace Infrastructure\Framework\Controller;

use Application\UseCase\CreateProductUseCase;
use Application\UseCase\UpdateProductUseCase;
use Application\Command\CreateProductCommand1;
use Application\Command\UpdateProductCommand1;
use Illuminate\Http\Request;

class ProductController1
{
    private CreateProductUseCase $createProductUseCase;
    private UpdateProductUseCase $updateProductUseCase;

    public function __construct(
        CreateProductUseCase $createProductUseCase,
        UpdateProductUseCase $updateProductUseCase
    ) {
        $this->createProductUseCase = $createProductUseCase;
        $this->updateProductUseCase = $updateProductUseCase;
    }

    public function store(Request $request)
    {
        $command = new CreateProductCommand1($request->all());
        $productDTO = $this->createProductUseCase->execute($command);

        return response()->json($productDTO, 201);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $data['id'] = $id;
        $command = new UpdateProductCommand1($data);
        $productDTO = $this->updateProductUseCase->execute($command);

        return response()->json($productDTO);
    }
}
