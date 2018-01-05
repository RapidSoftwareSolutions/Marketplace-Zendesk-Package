<?php


namespace ZendeskCoreBundle\Controller;

use GuzzleHttp\Exception\ConnectException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use RapidAPI\Exception\PackageException;
use RapidAPI\Exception\RequiredFieldException;

class PackageController extends Controller
{
    /**
     * @Route("/api/ZendeskCore", name="getMetadata")
     * @Method("GET")
     *
     * @return JsonResponse
     */
    public function getMetadataAction()
    {
        try {
            $file = realpath(__DIR__.'/..').DIRECTORY_SEPARATOR.'metadata.json';
            $metadataService = $this->get('metadata');
            $metadataService->set($file);
            $result = $metadataService->getClearMetadata();
        } catch (PackageException $exception) {
            $result = $this->createPackageExceptionResponse($exception);
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/api/ZendeskCore/getAccessToken")
     * @Method("POST")
     *
     * @return JsonResponse
     */
    public function getAccessToken()
    {
        $file = realpath(__DIR__.'/..').DIRECTORY_SEPARATOR.'metadata.json';
        try {
            $manager = $this->get('manager');
            $sender = $this->get('sender');
            $requestParser = $this->get('request_parser');

            $data = $requestParser->getParams();

            $manager->setMetadata($file);
            $manager->setDataFromRequest($data);
            $manager->setBlockName(__FUNCTION__);
            $manager->start();

            $urlParams = $manager->getUrlParams();
            $bodyParams = $manager->getBodyParams();
            $bodyParams['grant_type'] = 'authorization_code';

            $url = $manager->createFullUrl($bodyParams);
            $guzzleData = $manager->createGuzzleData($url, [], $urlParams, $bodyParams);

            $result = $sender->send($guzzleData);
        } catch (PackageException $exception) {
            $result = $this->createPackageExceptionResponse($exception);
        } catch (RequiredFieldException $exception) {
            $result = $this->createRequiredFieldExceptionResponse($exception);
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/api/ZendeskCore/{blockName}", requirements={"blockName": "createIdentity|createSelfIdentity"})
     * @Method("POST")
     *
     * @param $blockName
     *
     * @return JsonResponse
     */
    public function createIdentity(string $blockName)
    {
        $file = realpath(__DIR__.'/..').DIRECTORY_SEPARATOR.'metadata.json';
        try {
            $manager = $this->get('manager');
            $sender = $this->get('sender');
            $requestParser = $this->get('request_parser');

            $data = $requestParser->getParams();

            $manager->setMetadata($file);
            $manager->setDataFromRequest($data);
            $manager->setBlockName($blockName);
            $manager->start();

            $urlParams = $manager->getUrlParams();
            $bodyParams = $manager->getBodyParams();

            $vendorBody = [];
            foreach ($bodyParams as $key=>$value) {
                $param = $this->fromCamelCase($key);
                $vendorBody[$param] = $value;
            }

            $url = $manager->createFullUrl($vendorBody);

            $queryArr = [];
            if(count(explode("?", $url)) > 1) {
                $params = explode("?", $url)[1];
                $url = explode("?", $url)[0];
                $queryArr = $this->createQueryArr($params);
            }

            $guzzleData = $manager->createGuzzleData($url, [], $urlParams, $vendorBody);
            $auth = $this->createAuth($bodyParams);
            $guzzleData["auth"] = $auth;
            $guzzleData["query"] = $queryArr;

            $result = $sender->send($guzzleData);
        } catch (PackageException $exception) {
            $result = $this->createPackageExceptionResponse($exception);
        } catch (RequiredFieldException $exception) {
            $result = $this->createRequiredFieldExceptionResponse($exception);
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/api/ZendeskCore/getUsers")
     * @Method("POST")
     *
     * @return JsonResponse
     */
    public function getUsers()
        {
        $file = realpath(__DIR__.'/..').DIRECTORY_SEPARATOR.'metadata.json';
        try {
            $manager = $this->get('manager');
            $sender = $this->get('sender');
            $requestParser = $this->get('request_parser');

            $data = $requestParser->getParams();

            $manager->setMetadata($file);
            $manager->setDataFromRequest($data);
            $manager->setBlockName(__FUNCTION__);
            $manager->start();

            $urlParams = $manager->getUrlParams();
            $bodyParams = $manager->getBodyParams();


            $vendorBody = [];
            foreach ($bodyParams as $key=>$value) {
                $param = $this->fromCamelCase($key);
                $vendorBody[$param] = $value;
            }

            $url = $manager->createFullUrl($vendorBody);

            if (!empty($bodyParams['role'])) {
                $roleArray = [];
                foreach (explode(',', $bodyParams['role']) as $role) {
                    $roleArray[] = "role[]=".$role;
                }
                unset($bodyParams['role']);
                $url .= "?".implode('&', $roleArray);
            }

            $queryArr = [];
            if(count(explode("?", $url)) > 1) {
                $params = explode("?", $url)[1];
                $url = explode("?", $url)[0];
                $queryArr = $this->createQueryArr($params);
            }

            $guzzleData = $manager->createGuzzleData($url, [], $urlParams, $vendorBody);
            $auth = $this->createAuth($bodyParams);
            $guzzleData["auth"] = $auth;
            $guzzleData["query"] = $queryArr;

            $result = $sender->send($guzzleData);
        } catch (PackageException $exception) {
            $result = $this->createPackageExceptionResponse($exception);
        } catch (RequiredFieldException $exception) {
            $result = $this->createRequiredFieldExceptionResponse($exception);
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/api/ZendeskCore/uploadFiles")
     * @Method("POST")
     *
     * @return JsonResponse
     */
    public function uploadFiles()
    {
        $file = realpath(__DIR__.'/..').DIRECTORY_SEPARATOR.'metadata.json';
        try {
            $manager = $this->get('manager');
            $sender = $this->get('sender');
            $requestParser = $this->get('request_parser');

            $data = $requestParser->getParams();

            $manager->setMetadata($file);
            $manager->setDataFromRequest($data);
            $manager->setBlockName(__FUNCTION__);
            $manager->start();

            $urlParams = $manager->getUrlParams();
            $bodyParams = $manager->getBodyParams();


            $vendorBody = [];
            foreach ($bodyParams as $key=>$value) {
                $param = $this->fromCamelCase($key);
                $vendorBody[$param] = $value;
            }

            $url = $manager->createFullUrl($vendorBody);


            if (!empty($bodyParams['uploadToken'])) {
                $url .= "&token=".$bodyParams['uploadToken'];
                unset($bodyParams['uploadToken']);
            }

            $queryArr = [];
            if(count(explode("?", $url)) > 1) {
                $params = explode("?", $url)[1];
                $url = explode("?", $url)[0];
                $queryArr = $this->createQueryArr($params);
            }

            $guzzleData = $manager->createGuzzleData($url, [], $urlParams, $vendorBody);
            $auth = $this->createAuth($bodyParams);
            $guzzleData["auth"] = $auth;
            $guzzleData["query"] = $queryArr;


            $result = $sender->send($guzzleData);
        } catch (PackageException $exception) {
            $result = $this->createPackageExceptionResponse($exception);
        } catch (RequiredFieldException $exception) {
            $result = $this->createRequiredFieldExceptionResponse($exception);
        } catch (ConnectException $exception) {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = "INTERNAL_PACKAGE_ERROR";
            $result['contextWrites']['to']['status_msg'] = $exception->getMessage();
        } catch (\Exception $exception) {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = "INTERNAL_PACKAGE_ERROR2";
            $result['contextWrites']['to']['status_msg'] = $exception->getMessage();
        } catch (\Throwable $exception) {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = "INTERNAL_PACKAGE_ERROR3";
            $result['contextWrites']['to']['status_msg'] = $exception->getMessage();
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/api/ZendeskCore/{blockName}", requirements={"blockName" = "\w+"})
     * @Method("POST")
     *
     * @param null $blockName
     *
     * @return JsonResponse
     */
    public function test($blockName = null)
    {
        $file = realpath(__DIR__.'/..').DIRECTORY_SEPARATOR.'metadata.json';
        try {
            $manager = $this->get('manager');
            $sender = $this->get('sender');
            $requestParser = $this->get('request_parser');

            $data = $requestParser->getParams();

            $manager->setMetadata($file);
            $manager->setDataFromRequest($data);
            $manager->setBlockName($blockName);
            $manager->start();

            $urlParams = $manager->getUrlParams();
            $bodyParams = $manager->getBodyParams();
            $vendorBody = [];

            foreach ($bodyParams as $key=>$value) {
                $param = $this->fromCamelCase($key);
                $vendorBody[$param] = $value;
            }
            $url = $manager->createFullUrl($vendorBody);
            $queryArr = [];
            if(count(explode("?", $url)) > 1) {
                $params = explode("?", $url)[1];
                $url = explode("?", $url)[0];
                $queryArr = $this->createQueryArr($params);
            }

            $guzzleData = $manager->createGuzzleData($url, [], $urlParams, $vendorBody);
            $auth = $this->createAuth($bodyParams);
            $guzzleData["auth"] = $auth;
            $guzzleData["query"] = $queryArr;

            $result = $sender->send($guzzleData);
        } catch (PackageException $exception) {
            $result = $this->createPackageExceptionResponse($exception);
        } catch (RequiredFieldException $exception) {
            $result = $this->createRequiredFieldExceptionResponse($exception);
        } catch (ConnectException $exception) {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = "INTERNAL_PACKAGE_ERROR";
            $result['contextWrites']['to']['status_msg'] = $exception->getMessage();
        } catch (\Exception $exception) {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = "INTERNAL_PACKAGE_ERROR2";
            $result['contextWrites']['to']['status_msg'] = $exception->getMessage();
        } catch (\Throwable $exception) {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = "INTERNAL_PACKAGE_ERROR3";
            $result['contextWrites']['to']['status_msg'] = $exception->getMessage();
        }

        return new JsonResponse($result);
    }

    private function createHeaders(&$data)
    {
        $result = [
            'Authorization' => 'Bearer '.$data['accessToken'],
        ];
        unset($data['accessToken']);

        return $result;
    }

    private function createAuth(&$data)
    {
        $auth = [
            $data["email"] . "/token",
            $data["apiToken"]
        ];

        return $auth;
    }

    private function createPackageExceptionResponse(PackageException $exception)
    {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'INTERNAL_PACKAGE_ERROR';
        $result['contextWrites']['to']['status_msg'] = $exception->getMessage();

        return $result;
    }

    private function createRequiredFieldExceptionResponse(RequiredFieldException $exception)
    {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = "REQUIRED_FIELDS";
        $result['contextWrites']['to']['status_msg'] = "Please, check and fill in required fields.";
        $result['contextWrites']['to']['fields'] = explode(',', $exception->getMessage());

        return $result;
    }

    private function fromCamelCase($input) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    private function createQueryArr($params) {
        $queryArr = [];
        $fields = explode("&", $params);
        foreach ($fields as $field) {
            $key = explode("=", $field)[0];
            $val = explode("=", $field)[1];
            $queryArr[$key] = $val;
        }

        return $queryArr;
    }
}
