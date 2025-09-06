<?php

namespace Application\UseCase\Category;
use Domain\Entity\CategoryAttribute;
use Domain\Entity\Category;
use Domain\IRepository\ICategoryRepository;
use Domain\IRepository\ICategoryAttributeRepository;
use Application\DTOs\CategoryRequest;
class UpdateCategoryUseCase
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

    public function execute(CategoryRequest $categoryRequest): array|Category
    {
        $category = $this->categoryRepository->findById($categoryRequest->id);

        if (!$category) {
            throw new \Exception("Category with ID {$categoryRequest->id} not found.");
        }

        // Actualizar propiedades de la categoría
        $category->setFamilyId($categoryRequest->family_id);
        $category->setName($categoryRequest->name);
        $category->setPhoto($categoryRequest->photo);
        $category->setDescription($categoryRequest->description);
        $category->setStatus($categoryRequest->status);

        // Obtener la lista actual de atributos persistidos
        $existingAttributes = $category->getAttributes();

        // Mapear atributos del request por id para fácil búsqueda (si id existe)
        $requestAttributesById = [];
        $newAttributes = [];

        foreach ($categoryRequest->attributes as $attrDTO) {
            if (isset($attrDTO->id)) {
                $requestAttributesById[$attrDTO->id] = $attrDTO;
            } else {
                // Atributos nuevos sin ID asignado
                $newAttributes[] = new CategoryAttribute(
                    null,
                    $category->getId(),
                    $attrDTO->name,
                    $attrDTO->dataType,
                    $attrDTO->required,
                    $attrDTO->status
                );
            }
        }

        // Actualizar atributos existentes y eliminar los que faltan
        foreach ($existingAttributes as $existingAttr) {
            $attrId = $existingAttr->getId();

            if (isset($requestAttributesById[$attrId])) {
                // Actualizar el atributo existente con datos del request
                $attrDTO = $requestAttributesById[$attrId];
                $existingAttr->setName($attrDTO->name);
                $existingAttr->setDataType($attrDTO->dataType);
                $existingAttr->setRequired($attrDTO->required);
                $existingAttr->setStatus($attrDTO->status);

                // Guardar el atributo actualizado
                $this->attributeRepository->save($existingAttr);

                // Marcar como procesado eliminándolo del arreglo para identificar removidos
                unset($requestAttributesById[$attrId]);
            } else {
                // Este atributo no está en el request, eliminarlo
                $this->attributeRepository->delete($existingAttr);
            }
        }

        // Guardar todos los atributos nuevos
        foreach ($newAttributes as $attribute) {
            $this->attributeRepository->save($attribute);
            // También añadirlos a la categoría en memoria si aplica
            $category->addAttribute($attribute);
        }

        // Finalmente guardar la categoría con sus cambios
        $this->categoryRepository->save($category);

        return $category;
    }
}
