<?php

namespace App\GraphQL\Queries;

use App\Models\Product;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class ProductQuery extends Query {

    protected $attributes = [
        'name'  => 'product',
    ];

//    public function authorize(array $args = [])
//    {
//        return true;
//    }

    public function type(): Type
    {
        return GraphQL::type('Product'); //retrieve a single product
    }

    public function rules(array $args = []): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                'min:1',
                'exists:products,id'
            ],
        ];
    }

    public function args(): array
    {
        return [
            'id'    => [
                'name' => 'id',
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $fields = $info->getFieldSelection($depth = 3);

        $product = Product::findOrFail($args['id']);

        foreach ($fields as $field => $keys) {
            if ($field === 'category') {
                $product->with('category');
            }
        }

        return $product;
    }

}
