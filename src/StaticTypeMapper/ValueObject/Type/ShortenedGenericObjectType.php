<?php

declare(strict_types=1);

namespace Rector\StaticTypeMapper\ValueObject\Type;

use PHPStan\Type\Generic\GenericObjectType;
use PHPStan\Type\IsSuperTypeOfResult;
use PHPStan\Type\Type;

/**
 * @api
 */
final class ShortenedGenericObjectType extends GenericObjectType
{
    /**
     * @param class-string $fullyQualifiedName
     */
    public function __construct(
        string $shortName,
        array $types,
        private readonly string $fullyQualifiedName
    ) {
        parent::__construct($shortName, $types);
    }

    public function isSuperTypeOf(Type $type): IsSuperTypeOfResult
    {
        $genericObjectType = new GenericObjectType($this->fullyQualifiedName, $this->getTypes());
        return $genericObjectType->isSuperTypeOf($type);
    }

    public function getShortName(): string
    {
        return $this->getClassName();
    }
}
