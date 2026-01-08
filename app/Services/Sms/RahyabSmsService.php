<?php

namespace App\Services\Sms;

class RahyabSmsService
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.rahpayam.api_key');
    }

    // ارسال OTP
    public function sendOtp(string $mobile): array
    {
        $params = [
            "mobile" => $this->formatMobile($mobile),
            "method" => "sms",
            "templateID" => 19026,
            "accept-language" => "fa",
            "countryCode" => 98
        ];

        return $this->request($params, 'send');
    }

    // وریفای OTP
    public function verifyOtp(string $mobile, string $otp): array
    {
        $params = [
        "mobile" => $this->formatMobile($mobile),
        "OTP" => $otp,
        "accept-language" => "fa",
        "countryCode" => 98
        ];

        try {
            $response = $this->request($params, 'otp/verify');
            
            // بررسی پاسخ سرویس
            if (isset($response['status']) && $response['status'] === 'success') {
                return ['status' => 'success', 'message' => 'کد تأیید صحیح است'];
            }
            
            // اگر سرویس خطا داده
            return [
                'status' => 'error',
                'message' => $response['message'] ?? 'کد تأیید نامعتبر است'
            ];
            
        } catch (\Exception $e) {
            // خطای شبکه یا سرور
            return [
                'status' => 'error',
                'message' => 'خطا در ارتباط با سرویس پیامک'
            ];
        }
    }

    private function request(array $params, string $endpoint): array
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.msgway.com/' . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'apiKey: ' . $this->apiKey
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true) ?? ['status' => 'error', 'message' => 'خطای نامشخص در API'];
    }

    private function formatMobile(string $mobile): string
    {
        // تبدیل شماره 09... به +989...
        if (substr($mobile, 0, 1) === '0') {
            return '+98' . substr($mobile, 1);
        }
        return $mobile;
    }
}
