<?php
namespace Corley\Phing;

class S3GetTask extends Amazon
{
    private $bucket;
    private $object;
    private $source;

    public function getTarget()
    {
        return $this->source;
    }

    public function setTarget($source)
    {
        $this->source = $source;
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

    public function main()
    {
        parent::main();
        $client = $this->getAwsClient()->createS3();
        $client->getObject(array(
            'Bucket'       => $this->getBucket(),
            'Key'          => $this->getObject(),
            'SaveAs'       => is_dir($this->getTarget()) ? $this->getTarget() . $this->getObject() : $this->getTarget()
        ));
    }
}
