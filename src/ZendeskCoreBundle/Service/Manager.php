<?php
/**
 * Created by PhpStorm.
 * User: rapidapi
 * Date: 14.04.17
 * Time: 14:28
 */

namespace ZendeskCoreBundle\Service;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use ZendeskCoreBundle\Exception\PackageException;

class Manager
{
    /** @var DataValidator */
    private $dataValidator;

    /** @var Sender */
    private $sender;

    /** @var Metadata */
    private $metadata;

    /** @var Request */
    private $request;

    /** @var array */
    private $currentBlockMetadata = [];

    public function __construct(DataValidator $dataValidator, Sender $sender, Metadata $metadata, RequestStack $requestStack)
    {
        $this->dataValidator = $dataValidator;
        $this->sender = $sender;
        $this->request = $requestStack->getCurrentRequest();
        $this->metadata = $metadata;
    }

    public function setBlockName($blockName)
    {
        $this->currentBlockMetadata = $this->metadata->getBlockData($blockName);
        $this->dataValidator->setData($this->request, $this->currentBlockMetadata);
    }

    public function getValidData()
    {
        return $this->dataValidator->getValidData();
    }

    public function send($url, $data, $headers = []) {
        $blockMetadata = $this->dataValidator->getBlockMetadata();
        if (!isset($blockMetadata['type'])) {
            $type = 'json';
        }
        else {
            $type = $blockMetadata['type'];
        }

        return $this->sender->send($url, $blockMetadata['method'], $data, $headers, $type);
    }


    public function createFullUrl(&$data)
    {
        $url = "https://" . $data['domain'] . ".zendesk.com";
        unset($data['domain']);
        $res = preg_replace_callback(
            '/{(\w+)}/',
            function ($match) use (&$data) {
                if (!isset($data[$match[1]])) {
                    throw new PackageException('Cant find variables to URL parse: ' . $match[1]);
                }
                $result = $data[$match[1]];
                unset($data[$match[1]]);
                if (is_array($result)) {
                    return str_replace(' ', '', implode(',', $result));
                }
                return $result;
            },
            $this->currentBlockMetadata['url']);
        return $url . $res;
    }

    public function createHeaders(&$data)
    {
        $result = [
            'Authorization' => 'Bearer ' . $data['access_token']
        ];
        unset($data['access_token']);

        return $result;
    }
}