<?php

namespace App\GraphQL\Queries;


use App\Models\Product;

use phpDocumentor\Reflection\Types\Boolean;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL\Type\Definition\Type;

class ProductsQuery extends Query {

    protected $attributes = [
        'name'  => 'products',
    ];

//    public function authorize(array $args = [])
//    {
//        return true;
//    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Product')); //retrieve a collection of users
    }

    public function args(): array
    {
        return [
            'ids'   => [
                'name' => 'ids',
                'type' => Type::listOf(Type::int()),
            ],
            'category_id'    => [
                'name' => 'category_id',
                'type' => Type::int(),
            ],
            'sub_category_id'    => [
                'name' => 'sub_category_id',
                'type' => Type::int(),
            ],
        ];
    }

    public function rules(array $args = []): array
    {
        return [
            'ids' => [
                'array',
            ],
            'ids.*' => [
                'numeric',
            ]
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['ids'])) {
            return Product::find($args['ids']);
        }

        $where = function ($query) use ($args) {
            if (isset($args['category_id'])) {
                $query->where('category_id',$args['category_id']);
            }
            if (isset($args['sub_category_id'])) {
                $query->where('sub_category_id',$args['sub_category_id']);
            }
        };

        $products = Product::query()->where($where)
            ->orderBy('updated_at', 'DESC')->get();

        return $products;
    }
}
