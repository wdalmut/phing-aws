<?php
namespace Corley\Phing;

class CodeDeployTask extends Amazon
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
        $client = $this->getAwsClient()->get("CodeDeploy");

        $client->registerApplicationRevision(array(
            "applicationName" => $this->getApplication(),
            "description" => "Deploy app {$this->getApplication} at version {$this->getVersion()} on date " . date('Ymd H:i:s'),
            "revision" => [
                "revisionType" => "S3",
                "s3Location" => [
                    "bucket" => $this->getBucket(),
                    "bundleType" => pathinfo($this->getObject(), PATHINFO_EXTENSION),
                    "key" => $this->getObject(),
                ],
            ],
        ));
    }
}
