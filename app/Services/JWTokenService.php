<?php
namespace App\Services;

use DomainException;
use LogicException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use UnexpectedValueException;

class JWTokenService {
    private $payload = [];
    private $key = 'sercret123';

    public function __construct()
    {
        $this->payload = [
            'iss' => 'http://example.org',
            'aud' => 'http://example.com',
            'iat' => 1356999524,
            'nbf' => 1357000000
        ];
        $this->key = 'frase segura';
    }
    /**
     * Create JW Token
     * @param array $data Data to include in JWT
     * @return string|false|void
     */
    public function encodeJWT($data = [])
    {
        try {
            if(count($data) > 0) {
                $this->payload['data'] = $data;
            }

            return JWT::encode($this->payload, $this->key, 'HS256');
        } catch (DomainException $th) {
            return false;
        }
        // Si trae información extra se agrega a token
    }
    /**
     * Return decoded token
     * @param string $jwt JW Token
     * @return array|false|void
     */
    public function decodeJWT($jwt = '')
    {
        try {
            return (array)JWT::decode($jwt,  new Key($this->key, 'HS256'));
        } catch (LogicException $e) {
            // errors having to do with environmental setup or malformed JWT Keys
            return false;
        } catch (UnexpectedValueException $e) {
            // errors having to do with JWT signature and claims
            return false;
        }
    }
}
