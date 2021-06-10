<?php

namespace App\GraphQL\Types;

use App\Models\SubCategory;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;


class SubCategoryType extends GraphQLType {

    protected $attributes = [
        'name'          => 'sub Category', //defining the GraphQL type name
        'description'   => 'A sub Category', //providing a description for the GraphQL type name
        'model'         => SubCategory::class, //mapping the GraphQL type to the Laravel model
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type'          => Type::int(),
                'description'   => 'ID of the category',
            ],
            'category_id' => [
                'type'          => Type::int(),
                'description'   => 'ID of the category which the current product belong to',
            ],
            'name' => [
                //defining the name field as a non-null string
                'type'          => Type::string(),
                'description'   => 'Name of the category',
            ],
        ];
    }
}
