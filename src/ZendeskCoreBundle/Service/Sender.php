<?php
/**
 * Created by PhpStorm.
 * User: rapidapi
 * Date: 14.04.17
 * Time: 13:56
 */

namespace ZendeskCoreBundle\Service;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\ResponseInterface;

class Sender
{
    public function send($url, $method, $data, $headers, $type)
    {
        try {
            $client = new Client();
            /** @var ResponseInterface $vendorResponse */
            $vendorResponse = $client->$method($url, [
                'headers' => $headers,
                $this->getType($type) => $this->getFormattedData($data, $type)
            ]);
            if (in_array($vendorResponse->getStatusCode(), range(200, 204))) {
                $result['callback'] = 'success';
                $vendorResponseBodyContent = $vendorResponse->getBody()->getContents();
                if (empty(trim($vendorResponseBodyContent))) {
                    $result['contextWrites']['to'] = $vendorResponse->getReasonPhrase();
                } else {
                    $result['contextWrites']['to'] = json_decode($vendorResponseBodyContent, true);
                }
            } else {
                $result['callback'] = 'error';
                $result['contextWrites']['to']['status_code'] = 'API_ERROR';
                $result['contextWrites']['to']['status_msg'] = is_array($vendorResponse) ? $vendorResponse : json_decode($vendorResponse, true);
            }
        } catch (BadResponseException $exception) {
            // todo add params, to find in header needed to response
            $exceptionResponseContent = $exception->getResponse()->getBody()->getContents();
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            if (empty(trim($exceptionResponseContent))) {
                $result['contextWrites']['to']['status_msg'] = $exception->getResponse()->getReasonPhrase();
            } else {
                $answerDecoded = json_decode($exceptionResponseContent, true);
                if (json_last_error()) {
                    $result['contextWrites']['to']['status_msg'] = $exceptionResponseContent;
                } else {
                    $result['contextWrites']['to']['status_msg'] = $answerDecoded;
                }
            }
        }

        return $result;
    }

    private function getFormattedData(array $data, string $type)
    {
        $type = mb_strtolower($type);
        if ($type == 'binary') {
            return $this->getBinaryData($data);
        } elseif ($type == 'multipart') {
            return $this->getMultipartData($data);
        } else {
            return $data;
        }
    }

    private function getMultipartData($data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            $result[] = [
                "name" => $key,
                "contents" => $value
            ];
        }

        return $result;
    }

    private function getBinaryData($data) {
        return array_pop($data);
    }

    private function getType($type) {
        if ($type == 'binary') {
            return 'body';
        }
        return $type;
    }
}