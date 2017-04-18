<?php

namespace ZendeskCoreBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use ZendeskCoreBundle\Exception\PackageException;
use ZendeskCoreBundle\Exception\RequiredFieldException;

class DataValidator
{
    /** @var array */
    private $blockMetadata = [];

    /** @var array */
    private $requiredFieldError = [];

    /** @var array */
    private $parsedFieldError = [];

    /** @var Request */
    private $request;

    /** @var array */
    private $dataFromRequest = [];

    /** @var array */
    private $parsedValidData = [];

    /**
     * @param Request $request
     * @param array   $blockMetadata
     */
    public function setData(Request $request, $blockMetadata)
    {
        $this->request = $request;
        $this->blockMetadata = $blockMetadata;
        $this->setDataFromRequest();
        $this->parseDataFromRequest();
        $this->checkBlockMetadata();
    }

    /**
     * @return array
     */
    public function getValidData(): array
    {
        return $this->parsedValidData;
    }

    public function getBlockMetadata()
    {
        return $this->blockMetadata;
    }

    private function parseDataFromRequest()
    {
        foreach ($this->blockMetadata['args'] as $paramData) {
            if ($paramData['required'] == true) {
                $this->parseRequiredDataFromRequest($paramData);
            } else {
                $this->parseSingleDataFromRequest($paramData);
            }
        }
        $this->checkErrors();
    }

    private function checkErrors()
    {
        if (!empty($this->requiredFieldError)) {
            throw new RequiredFieldException(implode(',', $this->requiredFieldError));
        }
        if (!empty($this->parsedFieldError)) {
            throw new PackageException("Parse error in: " . implode(',', $this->parsedFieldError));
        }
    }

    private function parseRequiredDataFromRequest($paramData)
    {
        if ($this->checkNotEmptyParam($paramData)) {
            $this->parseSingleDataFromRequest($paramData);
        } else {
            $this->requiredFieldError[] = $paramData['name'];
        }
    }

    private function checkNotEmptyParam($paramData)
    {
        $name = $paramData['name'];
        $type = mb_strtolower($paramData['type']);
        $value = $this->dataFromRequest['args'][$name];
        if ($type == 'array') {
            if (!empty($value)) {
                return true;
            }
        } else {
            if (strlen(trim($value)) > 0) {
                return true;
            }
        }
        return false;
    }

    private function parseSingleDataFromRequest($paramData)
    {
        $name = $paramData['name'];
        $vendorName = $this->getParamVendorName($paramData);
        $type = mb_strtolower($paramData['type']);
        $value = $this->dataFromRequest['args'][$name];
        switch ($type) {
            case 'json':
                $normalizeJson = $this->normalizeJson($value);
                $data = json_decode($normalizeJson, true);
                if (json_last_error()) {
                    $this->parsedFieldError[] = $name;
                } else {
//                    $this->parsedValidData[$vendorName] = $data;
                    $this->setSingleValidData($paramData, $data, $vendorName);
                }
                break;
            case 'array':
                if (mb_strtolower($this->blockMetadata['method']) == 'get') {
//                    $this->parsedValidData[$vendorName] = is_array($value) ? implode(',', $value) : $value;
                    $data = is_array($value) ? implode(',', $value) : $value;
                    $this->setSingleValidData($paramData, $data, $vendorName);
                } else {
//                    $this->parsedValidData[$vendorName] = is_array($value) ? $value : explode(',', $value);
                    $data = is_array($value) ? $value : explode(',', $value);
                    $this->setSingleValidData($paramData, $data, $vendorName);
                }
                break;
            case 'boolean':
//                $this->parsedValidData[$vendorName] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                $data = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                $this->setSingleValidData($paramData, $data, $vendorName);
                break;
            case 'number':
//                $this->parsedValidData[$vendorName] = (int) $value;
                $this->setSingleValidData($paramData, (int) $value, $vendorName);
                break;
            case 'file':
                // todo check
//                $this->parsedValidData[$vendorName] = fopen($value, 'r');
                $data = fopen($value, 'r');
                $this->setSingleValidData($paramData, $data, $vendorName);
                break;
            default:
//                $this->parsedValidData[$vendorName] = $value;
                $this->setSingleValidData($paramData, $value, $vendorName);
                break;
        }
    }

    private function setSingleValidData($paramData, $value, $vendorName) {
        if (!empty($paramData['wrapName'])) {
//            if (!isset($this->parsedValidData[$paramData['wrapName']])) {
//                $this->parsedValidData[$paramData['wrapName']] = [];
//            }
            $wrapNameList = explode('.', $paramData['wrapName']);
            $this->addDepthOfNesting($this->parsedValidData, $wrapNameList, $value, $vendorName);
        }
        else {
            $this->parsedValidData[$vendorName] = $value;
        }
    }

    private function addDepthOfNesting(array &$array, &$depthNameList, $value, $vendorName) {
        $result = [];
        while (!empty($depthNameList)) {
            $deepName = array_shift($depthNameList);
            if (!isset($array[$deepName]) && !empty($depthNameList)) {
                $array[$deepName] = [];
            }
            if (empty($depthNameList)) {
                $array[$deepName][$vendorName] = $value;
            }
            $result = $this->addDepthOfNesting($array[$deepName], $depthNameList, $value, $vendorName);
        }

        return $result;
    }


    /**
     * Return param Vendor name or change CamelCase to snake_case
     * @param array $paramData
     * @return string
     */
    private function getParamVendorName(array $paramData):string {
        if (!empty($paramData['vendorName'])) {
            return $paramData['vendorName'];
        }
        else {
            return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $paramData['name']));
        }
    }

//    /**
//     * @param $argsData
//     * @return array|int|string|bool
//     */
//    private function getSingleValidDataByType($argsData)
//    {
//        $type = mb_strtolower($argsData['type']);
//        $paramFromRequest = $this->dataFromRequest['args'][$argsData['name']];
//        if ($type == 'boolean') {
//            $result = filter_var($paramFromRequest, FILTER_VALIDATE_BOOLEAN);
//        } elseif ($type == 'number') {
//            $result = (int) $paramFromRequest;
//        } elseif ($type == 'array') {
//            if (mb_strtoupper($this->blockMetadata['method']) == 'GET') {
//                $result = is_array($paramFromRequest) ? str_replace(" ", "", implode(',', $paramFromRequest)) : $paramFromRequest;
//            } else {
//                $result = is_array($paramFromRequest) ? $paramFromRequest : explode(',', $paramFromRequest);
//            }
//        } else {
//            $result = $paramFromRequest;
//        }
//        return $result;
//    }

    /**
     * @throws PackageException
     */
    private function setDataFromRequest()
    {
        $jsonContent = $this->request->getContent();
        if (empty($jsonContent)) {
            $this->dataFromRequest = $this->request->request->all();
        } else {
            $this->dataFromRequest = json_decode($jsonContent, true);
            if (json_last_error() != 0) {
                throw new PackageException(json_last_error_msg() . '. Incorrect input JSON. Please, check fields with JSON input.');
            }
        }
    }


//    private function checkRequiredParam($param)
//    {
//        // todo fix if array (strlen of array - false!!!
//        if ($param['required'] == true && (!isset($this->dataFromRequest['args'][$param['name']]) || strlen(trim($this->dataFromRequest['args'][$param['name']])) == 0)) {
//            $this->requiredFieldError[] = $param['name'];
//        } else {
//            $name = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $param['name']));
//            $this->parsedValidData[$name] = $this->getSingleValidDataByType($param);
//        }
//    }

//    private function checkRequiredParamByType($type, $param)
//    {
//        $type = mb_strtolower($type);
//        if ($type == 'string' && strlen(trim($param)) > 0) {
//            return true;
//        } elseif ($type == 'array') {
//            if (is_array($param) && !empty($param)) {
//                return true;
//            } elseif (str_replace(" ", "", strlen($param)) > 0) {
//                return true;
//            }
//        }
//    }

    private function checkBlockMetadata()
    {
        if (!isset($this->blockMetadata['url'])) {
            throw new PackageException("Cant find part of vendor's endpoint");
        }
        if (!isset($this->blockMetadata['method'])) {
            throw new PackageException("Cant find method of vendor's endpoint");
        }
    }

    private function normalizeJson($jsonString)
    {
        $data = preg_replace_callback('~"([\[{].*?[}\]])"~s', function ($match) {
            return preg_replace('~\s*"\s*~', "\"", $match[1]);
        }, $jsonString);

        return str_replace('\"', '"', $data);
    }
}