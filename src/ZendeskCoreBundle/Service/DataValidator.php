<?php

namespace ZendeskCoreBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DataValidator
{
    /** @var array */
    private $metaDataBlocks = [];

    /** @var array */
    private $requiredErrorField = [];

    /** @var string */
    private $blockName;

    /** @var Request */
    private $request;

    public function __construct()
    {
        $metaDataRaw = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/metadata.json', 'r');
        if ($metaDataRaw) {
            $metaData = json_decode($metaDataRaw, true);
            if ($metaData) {
                foreach ($metaData['blocks'] as $block) {
                    $this->metaDataBlocks[$block['name']] = $block;
                }
            }
            else {
                // todo 404 exception to response!
                throw new NotFoundHttpException('Metadata not found');
            }
        }
    }

    public function setData(Request $request, $blockName)
    {
        $this->request = $request;
        $this->blockName = $blockName;
    }

    public function isValid()
    {
        if (!empty($this->metaDataBlocks[$this->blockName]) && $this->checkRequiredParams()) {
            return true;
        }
        return false;
    }

    public function getValidData()
    {
        $result = [];
        $params = $this->request->request->all();
        foreach ($this->metaDataBlocks[$this->blockName]['args'] as $args) {
            if (isset($params['args'][$args['name']])) {
                $name = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $args['name']));
                if (mb_strtolower($args['type']) == "boolean") {
                    $result[$name] = filter_var($params['args'][$args['name']], FILTER_VALIDATE_BOOLEAN);
                } else if (mb_strtolower($args['type']) == "number") {
                    $result[$name] = (int) $params['args'][$args['name']];
                }
                else if (mb_strtolower($args['type']) == 'array') {
                    if (!is_array($params['args'][$args['name']])) {
                        $result[$name] = explode(',', $params['args'][$args['name']]);
                    }
                }
                else {
                    $result[$name] = $params['args'][$args['name']];
                }
            }
        }

        return $result;
    }

    public function getRequiredErrors()
    {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = "REQUIRED_FIELDS";
        $result['contextWrites']['to']['status_msg'] = "Please, check and fill in required fields.";
        $result['contextWrites']['to']['fields'] = $this->requiredErrorField;

        return $result;
    }

    private function checkRequiredParams()
    {
        $requestParams = $this->request->request->all();
        foreach ($this->metaDataBlocks[$this->blockName]['args'] as $param) {
            if ($param['required'] == true) {
                if (isset($requestParams['args'][$param['name']])) {
                    if (is_array($requestParams['args'][$param['name']])) {
                        if (empty($requestParams['args'][$param['name']])) {
                            $this->requiredErrorField[] = $param['name'];
                        }
                    } else if (strlen(trim($requestParams['args'][$param['name']])) == 0) {
                        $this->requiredErrorField[] = $param['name'];
                    }
                } else {
                    $this->requiredErrorField[] = $param['name'];
                }
            }
        }

        return empty($this->requiredErrorField);
    }
}