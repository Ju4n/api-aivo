<?php

namespace Aivo\Service;

use Facebook\Facebook;

// Exceptions
use Aivo\Rest\Resource\FacebookProfileResource;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException ;
use Aivo\Exception\FacebookServiceException;
use Monolog\Logger;

/**
 * Facebook Service
 *
 * @author Juan Deladoey
 */
class FacebookService
{
    /**
     * logger
     *
     * @var Monolog\Logger
     */
    private $logger;

    /**
     * appId
     *
     * @var string
     */
    private $appId;

    /**
     * appSecret
     *
     * @var string
     */
    private $appSecret;

    /**
     * graphVersion
     *
     * @var string
     */
    private $graphVersion;

    /**
     * facebook
     *
     * @var Facebook
     */
    private $facebook;

    /**
     * __construct
     *
     * @param string $appId
     * @param string $appSecret
     * @param string $graphVersion
     */
    public function __construct($logger, $appId, $appSecret, $graphVersion)
    {
        $this->logger       = $logger;
        $this->appId        = $appId;
        $this->appSecret    = $appSecret;
        $this->graphVersion = $graphVersion;
    }

    /**
     * Get Profile By Id
     *
     * @param mixed $id
     * @return Facebook\GraphNodes\GraphUser
     */
    public function getProfileById($id)
    {
        try {
            // create instance
            $this->connect();

            // get the graph user
            $data = $this->facebook
                ->get(
                    sprintf(
                        '/%s?fields=id,first_name,last_name',
                        $id
                    )
                )
                ->getGraphUser();
        } catch (FacebookResponseException $e) {
            $this->logger->error($e->getMessage());
            throw new FacebookServiceException('Facebook Profile Not Found', 404);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            $this->logger->error($e->getMessage());
            throw new FacebookServiceException('An error has occurred, try again Later', 500);
        }

        return new FacebookProfileResource($data);
    }

    /**
     * Get Facebook Instance
     *
     * @return Facebook\Facebook
     */
    private function connect()
    {
        $this->facebook =  new Facebook([
            'app_id'                => $this->appId,
            'app_secret'            => $this->appSecret,
            'default_graph_version' => $this->graphVersion,
        ]);

        // set default access token
        $this->setAccessToken();
    }

    /**
     * Set Access Token
     *
     * @return Facebook\Authentication\AccessToken
     */
    private function setAccessToken()
    {
        // if access token is not present in session get again
        if (!isset($_SESSION['access_token'])) {
            $_SESSION['access_token'] = $this->facebook->getApp()->getAccessToken();
        }

        $this->facebook->setDefaultAccessToken($_SESSION['access_token']);
    }
}
