<?php

namespace App\GraphQL\Types;

use App\Models\Product;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;


class ProductType extends GraphQLType {

    protected $attributes = [
        'name'          => 'Product', //defining the GraphQL type name
        'description'   => 'A Product', //providing a description for the GraphQL type name
        'model'         => Product::class, //mapping the GraphQL type to the Laravel model
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type'          => Type::nonNull(Type::int()),
                'description'   => 'ID of the product',
            ],
            'category_id' => [
                'type'          => Type::nonNull(Type::int()),
                'description'   => 'ID of the category which the current product belong to',
            ],
            'name' => [
                //defining the name field as a non-null string
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Name of the product',
            ],
            'description' => [
                //defining the email field as a non-null string
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Description of the product',
            ],
            'category' => [
                // This is saying that friends is a "list" of the type "user"
                'type' => GraphQL::type('Category'),
                'description' => 'Category of product'
            ]
        ];
    }
}
