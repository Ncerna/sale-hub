<?php
namespace Application\UseCase\Category;
use Application\DTOs\CategoryRequest;
use Domain\Entity\Category;
use Domain\Entity\CategoryAttribute;
use Domain\IRepository\ICategoryRepository;
use Domain\IRepository\ICategoryAttributeRepository;

class CreateCategoryUseCase
{
    private ICategoryRepository $categoryRepository;
    private ICategoryAttributeRepository $attributeRepository;

    public function __construct(
        ICategoryRepository $categoryRepository,
        ICategoryAttributeRepository $attributeRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function execute(CategoryRequest $categoryRequest): Category
    {
      
        $attributes = [];
        foreach ($categoryRequest->attributes as $attrDTO) {
            $attributes[] = new CategoryAttribute(
                null,
                0, // category_id se asigna luego
                $attrDTO->name,
                $attrDTO->data_type,
                $attrDTO->required,
                $attrDTO->status
            );
        }
        $category = new Category(
            null,
            $categoryRequest->family_id,
            $categoryRequest->name,
            $categoryRequest->photo,
            $categoryRequest->description,
            $categoryRequest->status,
            $attributes
        );

        $this->categoryRepository->save($category);
        foreach ($category->getAttributes() as $attribute) {
            $attribute->setCategoryId($category->getId());
            $this->attributeRepository->save($attribute);
        }

        return $category;

        /*
        $category = new Category();
$category->fillFromArray($categoryRequest->toArray());  // Mapea todos los campos básicos

$this->categoryRepository->save($category);

// Luego agrega los atributos (que vienen por separado)
foreach ($categoryRequest->attributes ?? [] as $attrDTO) {
    $attr = $this->mapDTOToEntity($attrDTO);
    $attr->setCategoryId($category->getId());
    $this->attributeRepository->save($attr);
    $category->addAttribute($attr);
}
*/
    }
}
