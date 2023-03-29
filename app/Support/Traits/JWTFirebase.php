<?

namespace Support\Traits;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

trait FirebaseJWT
{
    /** Create a JWT token with given payload */
    public static function create_token($payload): string
    {
        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

    /** Decode a JWT token and return his payload data as object */
    public static function decode_token($jwt): stdClass
    {
        return JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
    }
}
