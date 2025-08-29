<?php

namespace Domain\ValueObject;
class ModelMapper
{
    public static function model_map(array $data, string $class): object
    {
        $object = new $class();
        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($object, $setter)) {
                $object->$setter($value);
            }
        }
        return $object;
    }
}
/*
$userDtoData = ['name' => 'Juan', 'age' => 30];
$user = ModelMapper::model_map($userDtoData, User::class);*/