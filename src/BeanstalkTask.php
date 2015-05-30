<?php
namespace Corley\Phing;

class BeanstalkTask extends Amazon
{
    private $version;
    private $bucket;
    private $object;
    private $application;

    public function getApplication()
    {
        return $this->application;
    }

    public function setApplication($application)
    {
        $this->application = $application;
        return $this;
    }

    public function getObject()
    {
        return $this->object;
    }

    public function setObject($object)
    {
        $this->object = $object;
        return $this;
    }

    public function getBucket()
    {
        return $this->bucket;
    }

    public function setBucket($bucket)
    {
        $this->bucket = $bucket;
        return $this;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    public function main() {
        parent::main();
        $client = $this->getAwsClient()->get("ElasticBeanstalk");

        $client->createApplicationVersion(array(
            "ApplicationName" => $this->getApplication(),
            "VersionLabel" => $this->getVersion(),
            "Description" => "Deploy app {$this->getApplication} at version {$this->getVersion()} on date " . date('Ymd H:i:s'),
            "SourceBundle" => array(
                "S3Bucket" => $this->getBucket(),
                "S3Key" => $this->getObject(),
            ),
            "AutoCreateApplication" => false,
        ));
    }
}
