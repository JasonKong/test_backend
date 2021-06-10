<?php

namespace App\GraphQL\Mutations;

use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateProduct'
    ];

//    public function authorize(array $args = [])
//    {
//        return true;
//    }

    public function rules(array $args = []) : array
    {
        return [
            'id' => [
                'required', 'numeric', 'min:1', 'exists:products,id'
            ],
            'category_id' => [
                'exists:categories,id'
            ],
            'name' => [
                'required', 'max:50'
            ],
            'description' => [
                'required', 'max:255',
            ],
        ];
    }

    public function type(): Type
    {
        return GraphQL::type('Product');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' =>  Type::nonNull(Type::int()),
            ],
            'category_id' => [
                'name' => 'category_id',
                'type' =>  Type::nonNull(Type::int()),
            ],
            'sub_category_id' => [
                'name' => 'sub_category_id',
                'type' =>  Type::nonNull(Type::int()),
            ],
            'name' => [
                'name' => 'name',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'description' => [
                'name' => 'description',
                'type' =>  Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $product = Product::findOrFail($args['id']);
        $product->fill($args);
        $product->save();

        return $product;
    }
}
