<?php


namespace ZendeskCoreBundle\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\ResponseInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Debug\Exception\ContextErrorException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ZendeskCoreBundle\Service\DataValidator;

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
        $metaData = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/metadata.json', 'r');
        return new JsonResponse(json_decode($metaData));
    }

    /**
     * @Route("/api/ZendeskCore/getAccessToken")
     * @Method("POST")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getAccessToken(Request $request)
    {
        // может быть сделать через __call все функции, кроме тех, которые пользуются особой логикой ?
        // таким образом можно сократить число блоков до минимума. В сервисе проверять согласно метадате валидность и отправлять

        /** @var DataValidator $dataValidator */
        $dataValidator = $this->get("dataValidator");
        $dataValidator->setData($request, __FUNCTION__);
        if ($dataValidator->isValid()) {
            $validData = $dataValidator->getValidData();
            $url = "https://" . $validData['domain'] . ".zendesk.com/oauth/tokens";
            unset($validData['domain']);
            $validData['grant_type'] = 'authorization_code';
            $result = $this->getVendorResult($url, 'post', $validData);
        } else {
            $result = $dataValidator->getRequiredErrors();
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/api/ZendeskCore/createSingleTicket")
     * @Method("POST")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createSingleTicket(Request $request)
    {
        // todo переделать. присылают и файлы и параметры
        $blockParamList = $this->getBlockParamList();
        if (empty($blockParamList['createSingleTicket'])) {
            throw new NotFoundHttpException();
        }

        $method = $blockParamList['createSingleTicket']['method'];

        /** @var DataValidator $dataValidator */
        $dataValidator = $this->get("dataValidator");
        $dataValidator->setData($request, 'createSingleTicket');
        if ($dataValidator->isValid()) {
            $validData = $dataValidator->getValidData();
            $url = $this->createUrl($blockParamList['createSingleTicket']['url'], $validData);
            $headers['Authorization'] = 'Bearer ' . $validData['access_token'];
            unset($validData['access_token']);
            $result = $this->getVendorResult($url, $method, ['ticket' => $validData], $headers);
        } else {
            $result = $dataValidator->getRequiredErrors();
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/api/ZendeskCore/createTickets")
     * @Method("POST")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createTickets(Request $request)
    {
        // todo переделать. Присылают файл
        $result = [];
        $blockParamList = $this->getBlockParamList();
        if (empty($blockParamList[__FUNCTION__])) {
            throw new NotFoundHttpException();
        }

        $method = $blockParamList[__FUNCTION__]['method'];

        /** @var DataValidator $dataValidator */
        $dataValidator = $this->get("dataValidator");
        $dataValidator->setData($request, __FUNCTION__);
        if ($dataValidator->isValid()) {
            $validData = $dataValidator->getValidData();
            $url = $this->createUrl($blockParamList[__FUNCTION__]['url'], $validData);
            $headers['Authorization'] = 'Bearer ' . $validData['access_token'];
            unset($validData['access_token']);
            $file = file_get_contents($validData['tickets']);
            if ($file) {
                $validJson = preg_replace_callback('~"([\[{].*?[}\]])"~s', function ($match) {
                    return preg_replace('~\s*"\s*~', "\"", $match[1]);
                }, $file);
                $json = json_decode(str_replace('\"', '"', $validJson), true);
                $result = $this->getVendorResult($url, $method, ['tickets' => $json], $headers);
            }
        } else {
            $result = $dataValidator->getRequiredErrors();
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/api/ZendeskCore/uploadFiles")
     * @Method("POST")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function uploadFiles(Request $request)
    {
        $blockParamList = $this->getBlockParamList();
        if (empty($blockParamList[__FUNCTION__])) {
            throw new NotFoundHttpException();
        }

        $method = $blockParamList[__FUNCTION__]['method'];

        /** @var DataValidator $dataValidator */
        $dataValidator = $this->get("dataValidator");
        $dataValidator->setData($request, __FUNCTION__);
        if ($dataValidator->isValid()) {
            $validData = $dataValidator->getValidData();
            $url = $this->createUrl($blockParamList[__FUNCTION__]['url'], $validData);
            $headers['Authorization'] = 'Bearer ' . $validData['access_token'];
            unset($validData['access_token']);
            $headers['Content-Type'] = 'application/binary';
            try {
                $fileContentStream = fopen($validData['file'], 'r');
                if (!empty($validData['upload_token'])) {
                    $url .= '&token=' . $validData['upload_token'];
                }
                $data[] = [
                    "name" => "file",
                    "contents" => $fileContentStream
                ];
                $result = $this->getVendorResult($url, $method, $data, $headers, 'multipart');
            }
            catch (ContextErrorException $exception) {
                $result = $this->createApiError('Cant read file');
            }
        } else {
            $result = $dataValidator->getRequiredErrors();
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/api/ZendeskCore/{blockName}", requirements={"blockName" = "\w+"})
     * @Method("POST")
     *
     * @param Request $request
     * @param null    $blockName
     *
     * @return JsonResponse
     */
    public function test(Request $request, $blockName = null)
    {
        $blockParamList = $this->getBlockParamList();
        if (empty($blockParamList[$blockName])) {
            throw new NotFoundHttpException();
        }

        $method = $blockParamList[$blockName]['method'];

        /** @var DataValidator $dataValidator */
        $dataValidator = $this->get("dataValidator");
        $dataValidator->setData($request, $blockName);
        if ($dataValidator->isValid()) {
            $validData = $dataValidator->getValidData();
            $url = $this->createUrl($blockParamList[$blockName]['url'], $validData);
            $headers['Authorization'] = 'Bearer ' . $validData['access_token'];
            unset($validData['access_token']);
            $result = $this->getVendorResult($url, $method, $validData, $headers);
        } else {
            $result = $dataValidator->getRequiredErrors();
        }

        return new JsonResponse($result);
    }

    private function createUrl($part, &$data)
    {
        $url = "https://" . $data['domain'] . ".zendesk.com";
        unset($data['domain']);
        $res = preg_replace_callback(
            '/{(\w+)}/',
            function ($match) use (&$data) {
                // todo create exception
                $result = $data[$match[1]];
                unset($data[$match[1]]);
                if (is_array($result)) {
                    return str_replace(' ', '', implode(',', $result));
                }
                return $result;
            },
            $part);
        return $url . $res;
    }

    private function getBlockParamList()
    {
        return [
            'getAccessToken' => [
                'method' => 'post',
                'url' => '/oauth/tokens'
            ],
            'getIncrementalTickets' => [
                'method' => 'get',
                'url' => '/api/v2/incremental/tickets.json'
            ],
            'getIncrementalTicketsEvents' => [
                'method' => 'get',
                'url' => '/api/v2/incremental/ticket_events.json'
            ],
            'getIncrementalOrganizations' => [
                'method' => 'get',
                'url' => '/api/v2/incremental/organizations.json'
            ],
            'getIncrementalUsers' => [
                'method' => 'get',
                'url' => '/api/v2/incremental/users.json'
            ],
            'getJobStatuses' => [
                'method' => 'get',
                'url' => '/api/v2/job_statuses.json'
            ],
            'getSingleJobStatus' => [
                'method' => 'get',
                'url' => "/api/v2/job_statuses/{job_id}.json"
            ],
            'getJobStatusesByIds' => [
                'method' => 'get',
                'url' => '/api/v2/job_statuses/show_many.json?ids={job_ids}'
            ],
            'getTickets' => [
                'method' => 'get',
                'url' => '/api/v2/tickets.json'
            ],
            'getSingleTicket' => [
                'method' => 'get',
                'url' => '/api/v2/tickets/{ticket_id}.json'
            ],
            'getTicketsByIds' => [
                'method' => 'get',
                'url' => '/api/v2/tickets/show_many.json?ids={ticket_ids}'
            ],
            'createSingleTicket' => [
                'method' => 'post',
                'url' => '/api/v2/tickets.json'
            ],
            'createTickets' => [
                'method' => 'post',
                'url' => '/api/v2/tickets/create_many.json'
            ],
            'updateSingleTicket' => [
                'method' => 'put',
                'url' => '/api/v2/tickets/{ticket_id}.json'
            ],
            'markSingleTicketAsSpam' => [
                'method' => 'put',
                'url' => '/api/v2/tickets/{ticket_id}/mark_as_spam.json'
            ],
            'markTicketsAsSpam' => [
                'method' => 'put',
                'url' => '/api/v2/tickets/mark_many_as_spam.json?ids={ticket_ids}'
            ],
            'mergeTickets' => [
                'method' => 'post',
                'url' => '/api/v2/tickets/{ticket_id}/merge.json'
            ],
            'getTicketRelatedInfo' => [
                'method' => 'get',
                'url' => '/api/v2/tickets/{ticket_id}/related.json'
            ],
            'deleteSingleTicket' => [
                'method' => 'delete',
                'url' => '/api/v2/tickets/{ticket_id}.json'
            ],
            'deleteTickets' => [
                'method' => 'delete',
                'url' => '/api/v2/tickets/destroy_many.json?ids={ticket_ids}'
            ],
            'getTicketCollaborators' => [
                'method' => 'get',
                'url' => '/api/v2/tickets/{ticket_id}/collaborators.json'
            ],
            'getTicketIncidents' => [
                'method' => 'get',
                'url' => '/api/v2/tickets/{ticket_Zenid}/incidents.json'
            ],
            'getTicketsProblems' => [
                'method' => 'get',
                'url' => '/api/v2/problems.json',
            ],
            'autocompleteTicketsProblems' => [
                'method' => 'post',
                'url' => '/api/v2/problems/autocomplete.json?text={text}'
            ],
            'getAttachment' => [
                'method' => 'get',
                'url' => '/api/v2/attachments/{attachment_id}.json'
            ],
            'getComments' => [
                'method' => 'get',
                'url' => '/api/v2/tickets/{ticket_id}/comments.json'
            ],
            'removeCommentAttachment' => [
                'method' => 'put',
                'url' => '/api/v2/tickets/{ticket_id}/comments/{comment_id}/attachments/{attachment_id}/redact.json'
            ],
            'deleteAttachment' => [
                'method' => 'delete',
                'url' => '/api/v2/attachments/{attachment_id}.json'
            ],
            'uploadFiles' => [
                'method' => 'post',
                'url' => '/api/v2/uploads.json?filename={file_name}'
            ],
            'deleteUpload' => [
                'method' => 'delete',
                'url' => '/api/v2/uploads/{upload_token}.json'
            ],
            'getSatisfactionRatings' => [
                'method' => 'get',
                'url' => '/api/v2/satisfaction_ratings.json'
            ],
            'createSatisfactionRating' => [
                'method' => 'post',
                'url' => '/api/v2/tickets/{ticket_id}/satisfaction_rating.json'
            ],
            'getSuspendedTickets' => [
                'method' => 'get',
                'url' => '/api/v2/suspended_tickets.json'
            ],
            'getTicketAudits' => [
                'method' => 'get',
                'url' => '/api/v2/tickets/{ticket_id}/audits.json'
            ],
            'getTicketSingleAudits' => [
                'method' => 'get',
                'url' => '/api/v2/tickets/{ticket_id}/audits/{audit_id}.json'
            ],
            'makeAuditPrivate' => [
                'method' => 'put',
                'url' => '/api/v2/tickets/{ticket_id}/audits/{audit_id}/make_private.json'
            ],
            'removeWordFromTicketComment' => [
                'method' => 'put',
                'url' => '/api/v2/tickets/{ticket_id}/comments/{comment_id}/redact.json'
            ],
            'makeCommentPrivate' => [
                'method' => 'put',
                'url' => '/api/v2/tickets/{ticket_id}/comments/{comment_id}/make_private.json'
            ],
            'getSkippedTickets' => [
                'method' => 'get',
                'url' => '/api/v2/skips.json'
            ]
        ];

    }

    private function getVendorResult($url, $method, $data = [], $headers = [], $type = 'json')
    {
        try {
            $client = new Client();
            /** @var ResponseInterface $vendorResponse */
            $vendorResponse = $client->$method($url, [
                'headers' => $headers,
                $type => $data
            ]);
//            $test = $vendorResponse->getHeaders();
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
//            $test = $exception->getResponse()->getHeaders();
//            $resonse = $exception->getResponse();
//            $body = $exception->getResponse()->getBody()->getContents();
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            if (empty($exception->getResponse()->getBody()->getContents())) {
                $result['contextWrites']['to']['status_msg'] = $exception->getResponse()->getReasonPhrase();
            } else {
                $result['contextWrites']['to']['status_msg'] = json_decode($exception->getResponse()->getBody());
            }
        }

        return $result;
    }

    private function createApiError($message) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $message;
        return $result;
    }
}
