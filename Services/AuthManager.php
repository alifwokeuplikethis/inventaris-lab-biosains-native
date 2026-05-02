<?php
namespace Services;
use Models\Database;
use Services\GoogleOAuthProvider;

class AuthManager {
    private IOAuthProvider $provider;

    public function __construct(IOAuthProvider $provider) {
        $this->provider = $provider;
    }

    // Kalau di tengah jalan mau ganti provider
    public function setProvider(IOAuthProvider $provider): void {
        $this->provider = $provider;
    }

    public function getLoginUrl(): string {
        return $this->provider->getAuthorizationUrl();
    }

    public function handleCallback(string $code): array {
        try {
            $sessionTokens = $this->provider->authenticate($code);
            $userProfile = $this->provider->getUserProfile($sessionTokens['access_token']);
            
            return [
                'profile' => $userProfile,
                'tokens' => $sessionTokens
            ];
        } catch (\Exception $e) {

            throw new \Exception("Autentikasi gagal: " . $e->getMessage());
        }
    }
}