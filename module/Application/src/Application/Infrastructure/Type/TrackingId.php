<?php
/*
 * This file is part of the codeliner/php-ddd-cargo-sample package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Application\Infrastrucure\Type;

use Doctrine\DBAL\Types\TextType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Application\Domain\Model\Cargo\TrackingId as DomainTrackingId;
/**
 * Custom Doctrine Type UID
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class TrackingId extends TextType
{
    /**
     * {@inheritDoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new DomainTrackingId($value);
    }
    
    /**
     * {@inheritDoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!$value instanceof DomainTrackingId) {            
            throw ConversionException::conversionFailed($value, $this->getName());        
        }
        
        return $value->toString();
    }
}
