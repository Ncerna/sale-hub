<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductRegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_register_a_product_with_all_fields_and_attributes()
    {
        // Datos completos para registrar un producto con atributos
        $productData = [
            'name' => 'Producto Completo',
            'code' => 'PROD-5678',
            'barcode' => '0123456789012',
            'description' => 'Descripción completa del producto.',
            'unit_price' => 200.99,
            'offer_price' => 180.50,
            'igv_rate' => 18.0,
            'igv_affectation_code' => '10',
            'stock' => 150,
            'minimum_stock' => 20,
            'photo' => 'http://example.com/images/prod_completo.jpg',
            'product_type_id' => 1,
            'provider_id' => 2,
            'units_measure_id' => 3,
            'status' => 1,
            'company_id' => 1,
            'branch_id' => 1,
            'warehouse_id' => 1,
            'attributes' => [
                [
                    'attribute_id' => 101,
                    'value' => 'Valor atributo 1'
                ],
                [
                    'attribute_id' => 102,
                    'value' => 'Valor atributo 2'
                ]
            ],
        ];

        // Enviar request POST para crear producto
        $response = $this->postJson('/api/products', $productData);

        // Validar respuesta exitosa (Creación)
        $response->assertStatus(201);

        // Verificar que el producto exista en la base de datos
        $this->assertDatabaseHas('products', [
            'name' => 'Producto Completo',
            'code' => 'PROD-5678',
            'barcode' => '0123456789012',
            'stock' => 150,
        ]);

        // Verificar que los atributos estén en la tabla product_attributes
        $this->assertDatabaseHas('product_attributes', [
            'attribute_id' => 1,
            'value' => 'Valor atributo 1',
        ]);
        $this->assertDatabaseHas('product_attributes', [
            'attribute_id' => 2,
            'value' => 'Valor atributo 2',
        ]);
    }
}
