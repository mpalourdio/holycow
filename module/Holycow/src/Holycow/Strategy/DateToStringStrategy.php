<?php
namespace Holycow\Strategy;

use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

class DateToStringStrategy implements StrategyInterface
{
    public function extract($value)
    {
        if(!is_null($value))
            return $value->format('d.m.Y H:i');
        else
            return '';
    }

    public function hydrate($value)
    {
        return $value;
    }
}