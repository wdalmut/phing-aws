<?php
namespace Corley\Phing;

class S3PutTask extends Amazon
{
    private $bucket;
    private $object;
    private $source;

    public function getSource()
    {
        return $this->source;
    }

    public function setSource($source)
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
        $client = $this->getAwsClient()->get('s3');
        $client->putObject(array(
            'Bucket'       => $this->getBucket(),
            'Key'          => $this->getObject(),
            'SourceFile'   => $this->getSource(),
            'ContentType'  => 'application/zip',
        ));
    }
}
