<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Config;

class PegawaiResource extends JsonResource
{
    public $status;
    public $msg;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function __construct($status, $msg, $resource)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->msg = $msg;
    }
	
	private function encryptData($data)
	{
		$key = config('app.encryption_key'); // 32 karakter
		$iv = random_bytes(16);
		$json_data = json_encode($data, JSON_UNESCAPED_UNICODE); // Pastikan UTF-8 valid

		// Tambahkan padding agar panjangnya kelipatan 16
		$padding = 16 - (strlen($json_data) % 16);
		$padded_data = $json_data . str_repeat(chr($padding), $padding);

		$encrypted = openssl_encrypt($padded_data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

		return base64_encode($iv . $encrypted);
	}
	

    public function toArray($request)
    {
        return [
            'success'   => $this->status,
            'message'   => $this->msg,
            'data'      => $this->encryptData($this->resource)
        ];
    }
}
