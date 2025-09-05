<?php
namespace Application\UseCase\Product;

use Domain\Entity\Product;
use Domain\IRepository\IProductRepository;
use Domain\IService\IProductValidationService;
use Domain\ValueObject\ModelMapper;
use Domain\ValueObject\IGVRate;
use Domain\ValueObject\Price;
use Domain\ValueObject\IGVAffectationCode;
use Application\DTOs\ProductRequest;


class CreateProductUseCase
{
    private IProductRepository $productRepository;
    private IProductValidationService $validationService;

    public function __construct(IProductRepository $productRepository, IProductValidationService $validationService)
    {
        $this->productRepository = $productRepository;
        $this->validationService = $validationService;
    }

    public function execute(ProductRequest $productRequestdto): Product
    {

       $product = ModelMapper::model_map($productRequestdto->toArray(), Product::class);
      
       $preci_unit = new Price($productRequestdto->unit_price,new IGVRate($productRequestdto->igv_rate));
       $product->setUnitPrice($preci_unit);
       
       $product->setOfferPrice($productRequestdto->offer_price !== null ?
        new Price($productRequestdto->offer_price,new IGVRate($productRequestdto->igv_rate)) : null);
       $product->setIgvRate(new IGVRate($productRequestdto->igv_rate));
       $product->setIgvAffectationCode(new IGVAffectationCode($productRequestdto->igv_affectation_code));
        
        if (!$this->validationService->validate($product)) {
            throw new \Exception("Product validation failed");
        }
        
        return $this->productRepository->save($product);
    }
}
