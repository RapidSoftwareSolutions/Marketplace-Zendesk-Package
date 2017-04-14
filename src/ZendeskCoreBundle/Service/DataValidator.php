<?php

namespace ZendeskCoreBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use ZendeskCoreBundle\Exception\PackageException;
use ZendeskCoreBundle\Exception\RequiredFieldException;

class DataValidator
{
    /** @var array */
    private $metaDataBlocks = [];

    /** @var array */
    private $requiredFieldError = [];

    /** @var string */
    private $blockName;

    /** @var Request */
    private $request;

    /** @var array */
    private $dataFromRequest = [];

    /** @var array  */
    private $metaData = [];

    /**
     * DataValidator constructor.
     * @throws PackageException
     */
    public function __construct()
    {
        $metaDataRaw = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/metadata.json', 'r');
        if ($metaDataRaw) {
            $metaData = json_decode($metaDataRaw, true);
            if (!json_last_error()) {
                $this->metaData = $metaData;
                foreach ($metaData['blocks'] as $block) {
                    $this->metaDataBlocks[$block['name']] = $block;
                }
            }
            else {
                throw new PackageException(json_last_error_msg() . '. Incorrect Metadata JSON.');
            }
        }
        else {
            throw new PackageException('Metadata not found');
        }
    }

    /**
     * @return array|mixed
     */
    public function getMetaData():array {
        return $this->metaData;
    }

    /**
     * @param Request $request
     * @param         $blockName
     * @throws RequiredFieldException
     */
    public function setData(Request $request, $blockName)
    {
        $this->request = $request;
        $this->blockName = $blockName;
        $this->getDataFromRequest();
        if (!$this->isValidRequiredParams()) {
            throw new RequiredFieldException(implode(',', $this->requiredFieldError));
        }
    }

    /**
     * @return array
     */
    public function getValidData():array 
    {
        $result = [];
        foreach ($this->metaDataBlocks[$this->blockName]['args'] as $args) {
            if (isset($this->dataFromRequest['args'][$args['name']])) {
                $name = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $args['name']));
                $result[$name] = $this->getSingleValidDataByType($args);
            }
        }

        return $result;
    }

    /**
     * @return bool
     */
    private function isValidRequiredParams():bool
    {
        foreach ($this->metaDataBlocks[$this->blockName]['args'] as $param) {
            if ($param['required'] == true) {
                if (isset($this->dataFromRequest['args'][$param['name']])) {
                    if (is_array($this->dataFromRequest['args'][$param['name']])) {
                        if (empty($this->dataFromRequest['args'][$param['name']])) {
                            $this->requiredFieldError[] = $param['name'];
                        }
                    } else if (strlen(trim($this->dataFromRequest['args'][$param['name']])) == 0) {
                        $this->requiredFieldError[] = $param['name'];
                    }
                } else {
                    $this->requiredFieldError[] = $param['name'];
                }
            }
        }

        return empty($this->requiredFieldError);
    }

    /**
     * @param $argsData
     * @return array|int|string|bool
     */
    private function getSingleValidDataByType($argsData) {
        $type = mb_strtolower($argsData['type']);
        $paramFromRequest = $this->dataFromRequest['args'][$argsData['name']];
        if ($type == 'boolean') {
            $result = filter_var($paramFromRequest, FILTER_VALIDATE_BOOLEAN);
        }
        elseif ($type == 'number') {
            $result = (int) $paramFromRequest;
        }
        elseif ($type == 'array') {
            $result = is_array($paramFromRequest) ? $paramFromRequest : explode(',', $paramFromRequest);
        }
        else {
            $result = $paramFromRequest;
        }
        return $result;
    }

    /**
     * @throws PackageException
     */
    private function getDataFromRequest() {
        $jsonContent = $this->request->getContent();
        if (empty($jsonContent)) {
            $result = $this->request->request->all();
        }
        else {
            $result = json_decode($jsonContent, true);
            if (json_last_error() != 0) {
                throw new PackageException(json_last_error_msg() . '. Incorrect input JSON. Please, check fields with JSON input.');
            }
        }
        $this->dataFromRequest = $result;
    }
}