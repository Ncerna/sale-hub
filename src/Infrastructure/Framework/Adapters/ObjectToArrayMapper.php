<?php

namespace Infrastructure\Framework\Adapters;
use ReflectionClass;
class ObjectToArrayMapper {
    public static function map($obj): array
    {
        // Usa reflexión para obtener propiedades
        $reflection = new ReflectionClass($obj);
        $properties = $reflection->getProperties();

        $data = [];
        foreach ($properties as $prop) {
            $prop->setAccessible(true);
            if (!$prop->isInitialized($obj)) continue; 
              
            $value = $prop->getValue($obj);

            if (is_object($value)) {
                $data[$prop->getName()] = self::map($value);
            } elseif (is_array($value)) {
                $data[$prop->getName()] = array_map(
                    fn($item) => is_object($item) ? self::map($item) : $item,
                    $value
                );
            } else {
                $data[$prop->getName()] = $value;
            }
        }
        return $data;
    }
}

// Uso

