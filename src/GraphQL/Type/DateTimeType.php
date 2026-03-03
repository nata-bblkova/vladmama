<?php

namespace App\GraphQL\Type;

use DateTime;
use Exception;
use GraphQL\Language\AST\Node;
use Overblog\GraphQLBundle\Annotation as GQL;

/**
 * @GQL\Scalar(name="DateTime")
 */
class DateTimeType
{
    public static function serialize(DateTime $value): string
    {
        return $value->format('Y-m-d H:i:s');
    }

    public static function parseValue(mixed $value): DateTime
    {
        return new DateTime($value);
    }

    public static function parseLiteral(Node $valueNode): DateTime
    {
        return new DateTime($valueNode->value);
    }
}
