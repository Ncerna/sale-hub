<?php
namespace Infrastructure\ServiceImplementations;

use Application\Service\ProductNotificationService;

class EmailService implements ProductNotificationService
{
    public function notifyNewProduct(string $productId): void
    {
        // Implementar el envío de correo
        // Por ejemplo, usando un paquete de correo como PHPMailer o el sistema del framework
        // mail(subject, message, headers);
    }
}
