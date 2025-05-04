<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;

class QNBService
{
    private string $paymentApiUrl;
    private string $merchantId;
    private string $username;
    private string $password;
    private array $headers;
    private float $amount;
    private int $pay_id;
    private string $description;

    public function __construct()
    {
        $this->paymentApiUrl = config('services.qnb.host_url');
        $this->merchantId = config('services.qnb.merchant_id');
        $this->username = config('services.qnb.user_name');;
        $this->password = config('services.qnb.password');
        $this->headers = [
            'Content-Type' => 'application/json',
        ];
    }

    public static function make($pay_id,$el_amount): QNBService
    {
        $instance = new self();
        $instance->amount = $el_amount;
        $instance->pay_id = $pay_id;

        return $instance;
    }

    public function setDescription($el_description=null): static
    {
        $this->description = $el_description;
        return $this;
    }

    public function pay()
    {
        abort_if(empty($this->pay_id), 400, 'Pay id is required');
        abort_if(empty($this->amount), 400, 'Pay amount required');

        $expiryDateTime = $this->getExpiryDate();
        $data = $this->getRequestData($expiryDateTime);
        $paymentLink = $this->getPaymentLink();

        $response = $this->sendPaymentRequest($paymentLink, $data);

        return $response->json();
    }

    /**
     * Get the expiry date for the payment link.
     */
    private function getExpiryDate(): string
    {
        return now()->addDays(4)->format('Y-m-d\TH:i:s.v\Z');
    }

    /**
     * Build the request data for the payment link API.
     */
    private function getRequestData(string $expiryDateTime): array
    {
        return [
            "apiOperation" => "INITIATE_CHECKOUT",
            "checkoutMode" => "PAYMENT_LINK",
            "paymentLink" => [
                "expiryDateTime" => $expiryDateTime,
                "numberOfAllowedAttempts" => 20,
            ],
            "interaction" => [
                "displayControl" => [
                    "billingAddress" => "MANDATORY",
                    "customerEmail" => "MANDATORY",
                ],
                "operation" => config('services.qnb.transaction_mode'),
                "merchant" => [
                    "name" => $this->merchantId,
                    "url" => route('landing.home'),
//                    "logo" => asset('images/logo.png'),
                    "logo" => "https://portal.specialtravelservice.com/images/logo.png",
                ],
            ],
            "order" => [
                "currency" => config('services.qnb.merchant_currency'),
                "id" => $this->pay_id,
                "description" => $this->description,
                "reference" => "156b6f58-8a86-4h06-9nec-7489",
                "amount" => $this->amount,
            ],
            "transaction" => [
                "reference" => "QNBAA_TESTING_23658",
            ],
        ];
    }

    /**
     * Get the payment link for the API.
     */
    private function getPaymentLink(): string
    {
        return "{$this->paymentApiUrl}/api/rest/version/67/merchant/{$this->merchantId}/session";
    }

    /**
     * Send the payment request to the API.
     */
    private function sendPaymentRequest(string $paymentLink, array $data)
    {
        return Http::withHeaders($this->headers)
            ->withBasicAuth($this->username, $this->password)
            ->post($paymentLink, $data);
    }

}
