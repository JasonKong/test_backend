<?php

namespace App\GraphQL\Queries;


use App\Models\Category;

use App\Models\SubCategory;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL\Type\Definition\Type;

class SubCategoriesQuery extends Query {

    protected $attributes = [
        'name'  => 'subCategories',
    ];

//    public function authorize(array $args = [])
//    {
//        return true;
//    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('SubCategory')); //retrieve a collection of users
    }

    public function args(): array
    {
        return [
            'category_id' => [
                'name' => 'category_id',
                'type' => Type::listOf(Type::int()),
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
        if (isset($args['category_id'])) {
            return SubCategory::where('category_id',$args['category_id'])->get();
        }

        return SubCategory::all();
    }
}
