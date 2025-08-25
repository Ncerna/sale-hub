<?php
namespace App\Infrastructure\Framework\Controller;

use App\Application\DTO\CategoryDTO;
use App\Application\DTO\CategoryAttributeDTO;
use App\Application\UseCase\CreateCategoryUseCase;
use Illuminate\Http\Request;

class CategoryController
{
    private CreateCategoryUseCase $createCategoryUseCase;

    public function __construct(CreateCategoryUseCase $createCategoryUseCase)
    {
        $this->createCategoryUseCase = $createCategoryUseCase;
    }

    public function store(Request $request)
    {
        $attributesDTO = [];
        foreach ($request->input('attributes', []) as $attr) {
            $attributesDTO[] = new CategoryAttributeDTO(
                null,
                0, // category_id será asignado luego
                $attr['name'],
                $attr['data_type'],
                $attr['required'] ?? false,
                $attr['status'] ?? 1
            );
        }

        $dto = new CategoryDTO(
            null,
            (int)$request->input('family_id'),
            $request->input('name'),
            $request->input('photo'),
            $request->input('description'),
            (int)$request->input('status', 1),
            $attributesDTO
        );

        try {
            $category = $this->createCategoryUseCase->execute($dto);
            return response()->json(['status' => 'success', 'data' => $category]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}