<?php


namespace ZendeskCoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use ZendeskCoreBundle\Exception\PackageException;
use ZendeskCoreBundle\Exception\RequiredFieldException;

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
            $metadata = $this->get('metadata');
            $result = $metadata->getClearMetadata();
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
        try {
            $manager = $this->get('manager');
            $manager->setBlockName(__FUNCTION__);

            $validData = $manager->getValidData();
            $validData['grant_type'] = 'authorization_code';

            $url = $manager->createFullUrl($validData);
            $result = $manager->send($url, $validData);
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
        try {
            $manager = $this->get('manager');
            $manager->setBlockName($blockName);

            $validData = $manager->getValidData();
            $url = $manager->createFullUrl($validData);
            $headers = $manager->createHeaders($validData);

            $data['identity'] = [
                "type" => $validData["type"],
                "value" => $validData["value"]
            ];

            $result = $manager->send($url, $data, $headers);
        } catch (PackageException $exception) {
            $result = $this->createPackageExceptionResponse($exception);
        } catch (RequiredFieldException $exception) {
            $result = $this->createRequiredFieldExceptionResponse($exception);
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
        try {
            $manager = $this->get('manager');
            $manager->setBlockName($blockName);

            $validData = $manager->getValidData();
            $url = $manager->createFullUrl($validData);
            $headers = $manager->createHeaders($validData);

            $result = $manager->send($url, $validData, $headers);
        } catch (PackageException $exception) {
            $result = $this->createPackageExceptionResponse($exception);
        } catch (RequiredFieldException $exception) {
            $result = $this->createRequiredFieldExceptionResponse($exception);
        }

        return new JsonResponse($result);
    }

    private function createPackageExceptionResponse(PackageException $exception)
    {
        // todo add params, to find in header needed to response
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
}
