<?php
namespace Application\Contracts;


interface FileManagerInterface {
     /**
     * Sube múltiples archivos y los asocia a una entidad
     * 
     * @param int $entityId  Id de la entidad relacionada (ej. user, producto)
     * @param array $files   Array de archivos de tipo UploadedFile
     * @param string $entityType Tipo de entidad a la que se asocian los archivos
     * @return void
     */
    public function uploadFiles(int $entityId, array $files, string $entityType = 'user'): void;

    /**
     * Elimina archivos asociados a una entidad
     * 
     * @param int $entityId
     * @param array $fileIds
     * @param string $entityType
     * @return void
     */
    public function deleteFiles(int $entityId, array $fileIds, string $entityType = 'user'): void;
   
}