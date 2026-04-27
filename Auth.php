<?php

interface IOAuthProvider {
    public function getAuthorizationUrl(): string;
    public function authenticate(string $code): array;
    public function getUserProfile(string $accessToken): array;
}


class GoogleOAuthProvider implements IOAuthProvider{

    private Google\Client $client;

    public function __construct(string $clientId, string $clientSecret, string $redirectUri){
        $this->client = new \Google\Client();
        $this->client->setClientId($clientId);
        $this->client->setClientSecret($clientSecret);
        $this->client->setRedirectUri($redirectUri);
        $this->client->addScope("email");
        $this->client->addScope("profile");
    }

    public function getAuthorizationUrl(): string {
        return $this->client->createAuthUrl();
    }

    public function authenticate(string $code): array {
        // Menukar kode dengan token
        $token = $this->client->fetchAccessTokenWithAuthCode($code);
        
        if (isset($token['error'])) {
            throw new \Exception("Gagal mendapatkan token: " . $token['error']);
        }
        
        return $token; // Mengembalikan array berisi access_token, dll.
    }

    public function getUserProfile(string $accessToken): array {
        $this->client->setAccessToken($accessToken);
        
        // Memanggil layanan Oauth2 Google untuk get data user
        $oauth2 = new \Google\Service\Oauth2($this->client);
        $userInfo = $oauth2->userinfo->get();

        // Standarisasi output array agar konsisten dengan provider lain nantinya
        return [
            'id' => $userInfo->id,
            'email' => $userInfo->email,
            'name' => $userInfo->name
        ];
    }
}






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
            
            // Di sini kamu bisa tambahkan logika untuk cek user di database,
            // set $_SESSION, buat JWT, dll.
            
            return [
                'profile' => $userProfile,
                'tokens' => $sessionTokens
            ];
        } catch (\Exception $e) {
            // Handle error (misal log error, redirect dengan pesan gagal)
            throw new \Exception("Autentikasi gagal: " . $e->getMessage());
        }
    }
}
?>