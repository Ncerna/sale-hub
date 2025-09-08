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
        return ApiResponse::success($category, 'Category registered successfully');
    }

    public function update(Request $request, int $id)
    {
        $category = $this->categoryServiceInterface->updateCategory($request->all(), $id);
        return ApiResponse::success($category, 'User update successfully');
    }
     public function show($id)
    {
        $category = $this->categoryServiceInterface->getCategory($id);
        if (!$category) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        return response()->json($category);
    }
}