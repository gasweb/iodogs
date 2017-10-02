<?php
namespace IodogsFiles\Service;

class S3Service
{

    private $s3Client;

    public function __construct($s3Client)
    {
        $this->s3Client = $s3Client;
    }

    public function putObject($amazonFilePath, $filePath)
    {
        if(!empty($filePath))
        {
            $this->s3Client->putObject([
                    'Bucket' => 'iodogs',
                    'Key' => $amazonFilePath,
                    'Body' => fopen($filePath, 'r'),
                    //'Body' => file_get_contents($filePath),
                    'ACL' => 'public-read'
                ]
            );
            //echo "im done $amazonFilePath - $filePath";
            //die;
        }

    }

    public function getPublicBucketLink()
    {
        return "https://s3.eu-central-1.amazonaws.com/iodogs/";
    }

}