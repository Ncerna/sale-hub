<?php
namespace Infrastructure\Framework\Controller;


use Application\Contracts\CategoryServiceInterface;
use Illuminate\Http\Request;
use Infrastructure\Framework\Adapters\ApiResponse;
class CategoryController
{
    private CategoryServiceInterface $categoryServiceInterface;

    public function __construct(CategoryServiceInterface $categoryServiceInterface)
    {
        $this->categoryServiceInterface = $categoryServiceInterface;
    }

    public function store(Request $request)
    {
        $category = $this->categoryServiceInterface->registeCategory($request->all());
        return ApiResponse::success($category, 'User registered successfully');

       /* $attributesDTO = [];
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
        }*/
    }
    public function update(Request $request, int $id)
    {
        $category = $this->categoryServiceInterface->updateCategory($request->all(), $id);
        return ApiResponse::success($category, 'User update successfully');
    }
}