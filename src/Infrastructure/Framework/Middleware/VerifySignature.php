<?php
namespace Infrastructure\Framework\Middleware;
use Closure;
use Illuminate\Http\Request;
class VerifySignature
{
    private string $secretKey = 'your_shared_secret_key'; // Manténlo seguro en .env
    //php artisan make:middleware VerifySignature

    public function handle(Request $request, Closure $next)
    {
        $signature = $request->header('X-Signature');
        $payload = $request->getContent(); // cuerpo raw JSON de la petición
        

        if (!$signature || !$this->isValidSignature($payload, $signature)) {
            return response()->json(['error' => 'Firma inválida'], 401);
        }

        return $next($request);
    }

    private function isValidSignature(string $payload, string $signature): bool
    {
        $computed = hash_hmac('sha256', $payload, $this->secretKey);
        return hash_equals($computed, $signature);
    }
}
