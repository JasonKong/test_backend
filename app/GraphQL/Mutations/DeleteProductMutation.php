<?php

namespace App\GraphQL\Mutations;

use App\Models\Product;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class DeleteProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteProduct'
    ];

//    public function authorize(array $args = []): Boolean
//    {
//        return true;
//    }

//    public function rules(array $args = []): array
//    {
//        return [
//        ];
//    }

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' =>  Type::nonNull(Type::int()),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $product = Product::findOrFail($args['id']);
        return $product->delete() ? true : false;
    }
}
