<?php

class RequestException extends Exception {
    private int $responseCode = 500;
    private string $responseMessage = "Masalah internal server.";

    public function __construct($responseCode, $responseMessage) {
        $this->responseCode = $responseCode;
        $this->responseMessage = $responseMessage;

        parent::__construct();
    }

    public function getResponseCode(): int {
        return $this->responseCode;
    }

    public function getResponseMessage(): string {
        return $this->responseMessage;
    }
}
