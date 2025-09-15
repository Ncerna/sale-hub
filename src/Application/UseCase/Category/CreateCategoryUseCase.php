<?php
namespace Application\UseCase\Category;
use Application\DTOs\CategoryRequest;
use Domain\Entity\Category;
use Application\DTOs\CategoryAttributeRequest;
use Domain\ValueObject\ModelMapper;
use Domain\Entity\CategoryAttribute;
use Domain\IRepository\ICategoryRepository;
use Domain\IRepository\ICategoryAttributeRepository;
use Domain\IService\ICategoryValidationService;

class CreateCategoryUseCase
{
    private ICategoryRepository $categoryRepository;
    private ICategoryAttributeRepository $attributeRepository;
    private ICategoryValidationService $validationService;

    public function __construct(
        ICategoryRepository $categoryRepository,
        ICategoryAttributeRepository $attributeRepository,
        ICategoryValidationService $validationService
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->attributeRepository = $attributeRepository;
        $this->validationService = $validationService;
    }

    public function execute(CategoryRequest $categoryRequest): Category
{
    // 1. Crear la categoría (sin atributos aún)
    $category = ModelMapper::model_map($categoryRequest->toArray(), Category::class);
    $this->validationService->validate($category);
    $this->categoryRepository->save($category); // ahora ya tiene un ID

    $attributes = [];

    // 2. Crear los atributos y asignar el ID de categoría ya generado
    foreach ($categoryRequest->attributes as $attrDTO) {
        $attrDTO->setId(null); // ID nuevo para el atributo
        $attrDTO->setCategoryId($category->getId()); 
        $attributes[] = $this->mapDTOToEntity($attrDTO);
    }

    // 3. Asignar los atributos a la categoría
    $category->setAttributes($attributes);

    // 4. Guardar cada atributo en el repositorio
    foreach ($category->getAttributes() as $attribute) {
        $this->attributeRepository->save($attribute);
    }

    return $category;
}



   /* public function execute_2(CategoryRequest $categoryRequest): Category
    {

        /* $attributes = [];
         foreach ($categoryRequest->attributes as $attrDTO) {
             $attrDTO->setId();
             $attributes[] = $this->mapDTOToEntity($attrDTO);

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

  */
       // return null;
   // }*/
    private function mapDTOToEntity(CategoryAttributeRequest $dto): CategoryAttribute
    {
        return new CategoryAttribute(
            $dto->id ?? null,
            $dto->category_id ?? null,
            $dto->name,
            $dto->data_type,
            $dto->required,
            $dto->status
        );
    }
}
