<?php

namespace App\GraphQL\Types;

use App\Models\Category;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;


class CategoryType extends GraphQLType {

    protected $attributes = [
        'name'          => 'Category', //defining the GraphQL type name
        'description'   => 'A Category', //providing a description for the GraphQL type name
        'model'         => Category::class, //mapping the GraphQL type to the Laravel model
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type'          => Type::nonNull(Type::int()),
                'description'   => 'ID of the category',
            ],
            'name' => [
                //defining the name field as a non-null string
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Name of the category',
            ],
        ];
    }
}
