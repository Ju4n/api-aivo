<?php

namespace Aivo\Controller;

use Jgut\Slim\Controller\Base as BaseController;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Aivo\Exception\FacebookServiceException;

/**
 * FacebookController
 *
 * @uses BaseController
 * @author Juan Deladoey
 */
class FacebookController extends BaseController
{
    /**
     * /facebook/profile/{id}
     *
     * Get Facebook Profile Action
     *
     * @param Request $request
     * @param Response $response
     * @param int $id
     * @return Response $response
     */
    public function getProfileAction(Request $request, Response $response, $id)
    {
        try {
            $code = 200;
            $returnData = $this->facebookService->getProfileById($id);
        } catch (FacebookServiceException $e) {
            /*
             * if the service throw an exception
             * build a error response and set the error code
             */
            $code = $e->getCode();
            $returnData = [
                'code'    => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
        return $response->withJson($returnData, $code);
    }
}
