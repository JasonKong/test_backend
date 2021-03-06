<?php

namespace App\GraphQL\Queries;


use App\Models\Category;

use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL\Type\Definition\Type;

class CategoriesQuery extends Query {

    protected $attributes = [
        'name'  => 'categories',
    ];

//    public function authorize(array $args = [])
//    {
//        return true;
//    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Category')); //retrieve a collection of users
    }

    public function args(): array
    {
        return [
            'id'   => [
                'name' => 'id',
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
        if (isset($args['ids'])) {
            return Category::find($args['ids']);
        }
//    $categories = Category::all();
//        foreach($categories as $category) {
//            dd($category->subCategories);
//        }
        return Category::all();
    }
}
