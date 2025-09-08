<?php

namespace Application\UseCase\Category;
use Application\DTOs\CategoryAttributeRequest;
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
        // Buscar categoría y validar existencia
        $category = $this->categoryRepository->findById($categoryRequest->id);
        if (!$category) {
            throw new \Exception("Category with ID {$categoryRequest->id} not found.");
        }
        $category->fillFromArray($categoryRequest->toArray());
        $attributes = $this->attributeRepository->findByCategoryId($categoryRequest->id);
        foreach ($attributes as $attr) {
            $category->addAttribute($attr);
        }

        // Rellenar entidad categoría con datos del request

 

        // Obtener lista mixta de atributos: entidades y DTOs convertidos a entidades
        $existingAttributes = [];
        foreach ($category->getAttributes() as $attr) {
            if ($attr instanceof CategoryAttribute) {
                $existingAttributes[] = $attr;
            } elseif ($attr instanceof CategoryAttributeRequest) {
                $existingAttributes[] = $this->mapDTOToEntity($attr);
            }
        }

        // Mapa para acceso rápido por ID
        $existingAttributesById = [];
        foreach ($existingAttributes as $attr) {
            $existingAttributesById[$attr->getId()] = $attr;
        }

        // Atributos entrantes desde request
        $incomingAttributes = $categoryRequest->attributes ?? [];
        $receivedAttributeIds = [];

        // Actualizar existentes o crear nuevos
        foreach ($incomingAttributes as $attrDTO) {
            if (isset($attrDTO->id) && isset($existingAttributesById[$attrDTO->id])) {
                // Actualizar entidad existente
                $existing = $existingAttributesById[$attrDTO->id];
                $existing->setName($attrDTO->name);
                $existing->setDataType($attrDTO->data_type);
                $existing->setRequired($attrDTO->required);
                $existing->setStatus($attrDTO->status);
                $this->attributeRepository->save($existing);
                $receivedAttributeIds[] = $attrDTO->id;
            } else {
                // Crear nueva entidad desde DTO
                $newAttr = $this->mapDTOToEntity($attrDTO);
                $newAttr->setCategoryId($category->getId());
                $this->attributeRepository->save($newAttr);
                $category->addAttribute($newAttr);
                if ($newAttr->getId()) {
                    $receivedAttributeIds[] = $newAttr->getId();
                }
            }
        }

        // Eliminar atributos que ya no están en el request
        foreach ($existingAttributes as $attr) {
            if (!in_array($attr->getId(), $receivedAttributeIds)) {
                $this->attributeRepository->delete($attr);
                $category->removeAttribute($attr);
            }
        }

        // Guardar categoría
        $this->categoryRepository->save($category);

        return $category;
    }

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
