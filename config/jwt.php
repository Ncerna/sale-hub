<?php
return [
    'ttl' => env('JWT_TTL', 60),          // tiempo de vida del token en minutos (60 = 1 hora)
    'refresh_ttl' => env('JWT_REFRESH_TTL', 20160),  // tiempo para poder refrescar token expirado (2 semanas)
];
