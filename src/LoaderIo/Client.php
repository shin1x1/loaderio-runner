<?php
namespace Shin1x1\LoaderIo;

use GuzzleHttp\ClientInterface;
use stdClass;

/**
 * Class Client
 * @package Shin1x1\LoaderIo
 */
class Client
{
    /**
     * API BASE URL
     */
    const API_BASE_URL = 'https://api.loader.io/v2';

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @param string $token
     * @param Client|ClientInterface $client
     * @throws \Exception
     */
    public function __construct($token, ClientInterface $client = null)
    {
        if (is_null($client)) {
            $client = new \GuzzleHttp\Client();
        }
        $this->client = $client;
        $this->client->setDefaultOption('headers', [
            'loaderio-auth' => $token,
        ]);
    }

    /**
     * @return array
     */
    public function tests()
    {
        $response = $this->client->get(static::API_BASE_URL . '/tests');
        return $response->json(['object' => true]);
    }

    /**
     * @param string $testId
     * @return int result_id
     */
    public function run($testId)
    {
        $url = sprintf(static::API_BASE_URL . '/tests/%s/run', $testId);
        $response = $this->client->put($url);
        if (empty($response->getBody())) {
            return null;
        }

        return $response->json(['object' => true])->result_id;
    }

    /**
     * @param string $testId
     * @param int $resultId
     * @return stdClass
     */
    public function result($testId, $resultId)
    {
        $url = sprintf(static::API_BASE_URL . '/tests/%s/results/%s', $testId, $resultId);
        $response = $this->client->get($url);
        return $response->json(['object' => true]);
    }
}