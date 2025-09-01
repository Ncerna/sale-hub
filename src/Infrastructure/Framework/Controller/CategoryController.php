<?php
namespace Infrastructure\Framework\Controller;

use Application\DTOs\CategoryDTO;
use Application\DTOs\CategoryAttributeDTO;
use Application\UseCase\CreateCategoryUseCase;
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

        $DTOs = new CategoryDTO(
            null,
            (int)$request->input('family_id'),
            $request->input('name'),
            $request->input('photo'),
            $request->input('description'),
            (int)$request->input('status', 1),
            $attributesDTO
        );

        try {
            $category = $this->createCategoryUseCase->execute($DTOs);
            return response()->json(['status' => 'success', 'data' => $category]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}