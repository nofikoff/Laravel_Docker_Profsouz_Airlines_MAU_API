<?php
/**
 * Created by PhpStorm.
 * User: theardent
 * Date: 16.03.18
 * Time: 16:46
 */

namespace App\Providers;

use GuzzleHttp\Client;

class SMSProvider
{

    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string $phone
     * @param string $message
     * @param int $type
     */
    public function send(string $phone, string $message, $type = 0)
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8" ?><package> </package>');

        if (env('SMS_LOGIN', false) && env('SMS_PASSWORD', false)) {
            $xml->addAttribute('login', env('SMS_LOGIN'));
            $xml->addAttribute('password', env('SMS_PASSWORD'));
        } else {
            $xml->addAttribute('key', env('SMS_KEY'));
        }

        $messageXML = $xml->addChild('message');

        $msg = $messageXML->addChild('msg', $message);

        $msg->addAttribute('recipient', $phone);
        $msg->addAttribute('sender', env('SMS_SENDER'));
        $msg->addAttribute('type', $type);

        $response = $this->client->request('POST', 'https://alphasms.ua/api/xml.php', [
            'body' => $xml->asXML(),
        ]);

        return $response;
    }

    /**
     * @param array $messages
     * @param int $type
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function sendMany(array $messages, $type = 0)
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8" ?><package> </package>');

        if (env('SMS_LOGIN', false) && env('SMS_PASSWORD', false)) {
            $xml->addAttribute('login', env('SMS_LOGIN'));
            $xml->addAttribute('password', env('SMS_PASSWORD'));
        } else {
            $xml->addAttribute('key', env('SMS_KEY'));
        }

        $messageXML = $xml->addChild('message');

        foreach ($messages as $phone => $text) {
            $msg = $messageXML->addChild('msg', $text);
            $msg->addAttribute('recipient', $phone);
            $msg->addAttribute('sender', env('SMS_SENDER'));
            $msg->addAttribute('type', $type);
        }

        $response = $this->client->request('POST', 'https://alphasms.ua/api/xml.php', [
            'body' => $xml->asXML(),
        ]);

        return $response;
    }

    /**
     * @return array|bool
     */
    public function balance()
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8" ?><package> </package>');

        if (env('SMS_LOGIN', false) && env('SMS_PASSWORD', false)) {
            $xml->addAttribute('login', env('SMS_LOGIN'));
            $xml->addAttribute('password', env('SMS_PASSWORD'));
        } else {
            $xml->addAttribute('key', env('SMS_KEY'));
        }

        $xml->addChild('balance');

        $response = $this->client->request('POST', 'https://alphasms.ua/api/xml.php', [
            'body' => $xml->asXML(),
        ]);

        $responseXML = new \SimpleXMLElement((string)$response->getBody());

        if (! isset($responseXML->balance)) {
            return false;
        }

        return [
            'amount'   => (double)$responseXML->balance->amount,
            'currency' => (string)$responseXML->balance->currency,
        ];
    }
}