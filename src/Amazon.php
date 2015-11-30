<?php
namespace Corley\Phing;

use Task;

abstract class Amazon extends Task
{
    private $key;
    private $secret;
    private $awsClient;
    private $region;

    public function getRegion()
    {
        return $this->region;
    }

    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;
        return $this;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    public function getAwsClient()
    {
        return $this->awsClient;
    }

    public function setAwsClient($awsClient)
    {
        $this->awsClient = $awsClient;
        return $this;
    }

    public function main()
    {
        $options = [
            'credentials' => [
                'key' => $this->getKey(),
                'secret' => $this->getSecret()
            ],
            'version' => 'latest'
        ];

        if ($this->getRegion()) {
            $options['region'] = $this->getRegion();
        }

        $this->setAwsClient(new \Aws\Sdk($options));
    }
}

