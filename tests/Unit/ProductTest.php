<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_get_categories()
    {

        $categories = Category::all();

        $this->postJson('graphql', [
            'query' => <<<GQL
                query {
                    categories {
                        id
                        name
                    }
                }
            GQL,
            'variables' => [
            ]
        ],
            ['ApiKey' => env('API_KEY')])
            ->assertJsonFragment(['id' => $categories[0]->id])
            ->assertJsonFragment(['name' => $categories[0]->name])
            ->assertJsonFragment(['id' => $categories[1]->id])
            ->assertJsonFragment(['name' => $categories[1]->name])
            ->assertJsonFragment(['id' => $categories[2]->id])
            ->assertJsonFragment(['name' => $categories[2]->name]);

    }

    public function test_get_products()
    {

        $products = Product::query()->orderBy('updated_at','DESC')->get();

        $cnt = count($products);

        $this->postJson('graphql', [
            'query' => <<<GQL
                query {
                    products {
                        id
                        category_id
                        name
                        description
                    }
                }
            GQL,
            'variables' => [
            ]
        ],
            ['ApiKey' => env('API_KEY')])
            ->assertJsonFragment(['id' => $products[0]->id])
            ->assertJsonFragment(['category_id' => $products[0]->category_id])
            ->assertJsonFragment(['name' => $products[0]->name])
            ->assertJsonFragment(['description' => $products[0]->description])
            ->assertJsonFragment(['id' => $products[$cnt - 1]->id])
            ->assertJsonFragment(['category_id' => $products[$cnt - 1]->category_id])
            ->assertJsonFragment(['name' => $products[$cnt - 1]->name])
            ->assertJsonFragment(['description' => $products[$cnt - 1]->description]);
    }

    public function test_get_products_by_category()
    {
        $category_id = 1;

        $products = Product::query()->where('category_id', 1)
            ->orderBy('updated_at','DESC')->get();

        $cnt = count($products);

        $this->postJson('graphql', [
            'query' => <<<GQL
                query {
                    products(category_id: $category_id) {
                        id
                        category_id
                        name
                        description
                    }
                }
            GQL,
            'variables' => [
//                'id' => $category_id
            ]
        ],
            ['ApiKey' => env('API_KEY')])
            ->assertJsonFragment(['id' => $products[0]->id])
            ->assertJsonFragment(['category_id' => $products[0]->category_id])
            ->assertJsonFragment(['name' => $products[0]->name])
            ->assertJsonFragment(['description' => $products[0]->description])
            ->assertJsonFragment(['id' => $products[$cnt - 1]->id])
            ->assertJsonFragment(['category_id' => $products[$cnt - 1]->category_id])
            ->assertJsonFragment(['name' => $products[$cnt - 1]->name])
            ->assertJsonFragment(['description' => $products[$cnt - 1]->description]);
    }

    public function test_get_products_by_id()
    {
        $id = 2;

        $product = Product::find($id);

        $this->postJson('graphql', [
            'query' => <<<GQL
                query {
                    product(id: $id) {
                        id
                        category_id
                        name
                        description
                    }
                }
            GQL,
            'variables' => [
            ]
        ],
            ['ApiKey' => env('API_KEY')])
            ->assertJsonFragment(['id' => $product->id])
            ->assertJsonFragment(['category_id' => $product->category_id])
            ->assertJsonFragment(['name' => $product->name])
            ->assertJsonFragment(['description' => $product->description]);
    }

    public function test_create_product()
    {
        $rsp = $this->postJson('graphql', [
            'query' => <<<GQL
                mutation {
                    createProduct(
                        category_id: 1,
                        name: "new test",
                        description: "This is a description"
                    ) {
                        id
                        category_id
                        name
                        description
                    }
                }
            GQL,
            'variables' => [
            ]
        ],
            ['ApiKey' => env('API_KEY')]);

        $product = false;

        if ($rsp && isset($rsp['data']['createProduct']['id'])) {
            $product = Product::find($rsp['data']['createProduct']['id']);
        }

        $rsp->assertJsonFragment(['id' => $product->id])
            ->assertJsonFragment(['category_id' => $product->category_id])
            ->assertJsonFragment(['name' => $product->name])
            ->assertJsonFragment(['description' => $product->description]);


        $rsp2 = $this->postJson('graphql', [
            'query' => <<<GQL
                mutation {
                    deleteProduct(
                        id: $product->id
                    )
                }
            GQL,
            'variables' => [
            ]
        ],
            ['ApiKey' => env('API_KEY')]);
    }

    public function test_update_product()
    {
        $id = 2;
        $rsp = $this->postJson('graphql', [
            'query' => <<<GQL
                mutation {
                    updateProduct(
                        id:$id
                        category_id: 1,
                        name: "new test",
                        description: "This is a description"
                    ) {
                        id
                        category_id
                        name
                        description
                    }
                }
            GQL,
            'variables' => [
            ]
        ],
            ['ApiKey' => env('API_KEY')]);

        $product = Product::find($id);

        $rsp->assertJsonFragment(['id' => $product->id])
            ->assertJsonFragment(['category_id' => $product->category_id])
            ->assertJsonFragment(['name' => $product->name])
            ->assertJsonFragment(['description' => $product->description]);
    }

    public function test_delete_product()
    {
        $rsp = $this->postJson('graphql', [
            'query' => <<<GQL
                mutation {
                    createProduct(
                        category_id: 1,
                        name: "new test",
                        description: "This is a description"
                    ) {
                        id
                        category_id
                        name
                        description
                    }
                }
            GQL,
            'variables' => [
            ]
        ],
            ['ApiKey' => env('API_KEY')]);

        $product = false;

        if ($rsp && isset($rsp['data']['createProduct']['id'])) {
            $product = Product::find($rsp['data']['createProduct']['id']);
        }

        $rsp2 = $this->postJson('graphql', [
            'query' => <<<GQL
                mutation {
                    deleteProduct(
                        id: $product->id
                    )
                }
            GQL,
            'variables' => [
            ]
        ],
            ['ApiKey' => env('API_KEY')]);

        $rsp2->assertJsonFragment(['deleteProduct' => true]);

        $product = Product::find($product->id);

        self::assertNull($product);
    }
}
