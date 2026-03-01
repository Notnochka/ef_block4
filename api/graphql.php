<?php
require_once __DIR__ . '/vendor/autoload.php';

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Utils\SchemaPrinter;

$schemaString = file_get_contents(__DIR__ . '/graphql/schema.graphql');
$schemaString .= "\n\n# Автогенерированные типы\n";

$users = [
    ['id' => 1, 'name' => 'Иван Иванов'],
    ['id' => 2, 'name' => 'Мария Петрова'],
    ['id' => 3, 'name' => 'Пётр Сидоров'],
];

$userType = new ObjectType([
    'name' => 'User',
    'fields' => [
        'id' => Type::id(),
        'name' => Type::nonNull(Type::string()),
    ]
]);

$queryType = new ObjectType([
    'name' => 'Query',
    'fields' => [
        'users' => [
            'type' => Type::nonNull(Type::listOf(Type::nonNull($userType))),
            'resolve' => fn() => $users
        ],
        'getUser' => [
            'type' => $userType,
            'args' => [
                'id' => Type::nonNull(Type::int())
            ],
            'resolve' => function ($root, $args) use ($users) {
                foreach ($users as $user) {
                    if ((int)$user['id'] === (int)$args['id']) {
                        return $user;
                    }
                }
                return null;
            }
        ],
    ]
]);

$mutationType = new ObjectType([
    'name' => 'Mutation',
    'fields' => [
        'createUser' => [
            'type' => Type::nonNull($userType),
            'args' => [
                'name' => Type::nonNull(Type::string())
            ],
            'resolve' => function ($root, $args) use (&$users) {
                $newId = count($users) + 1;
                $newUser = [
                    'id' => $newId,
                    'name' => $args['name']
                ];
                $users[] = $newUser;
                return $newUser;
            }
        ],
    ]
]);

$schema = new Schema([
    'query' => $queryType,
    'mutation' => $mutationType
]);

$input = json_decode(file_get_contents('php://input'), true);
$query = $input['query'] ?? '';
$variables = $input['variables'] ?? null;
$result = GraphQL::executeQuery($schema, $query, null, null, $variables);

header('Content-Type: application/json');
echo json_encode($result->toArray(JSON_PRETTY_PRINT));
