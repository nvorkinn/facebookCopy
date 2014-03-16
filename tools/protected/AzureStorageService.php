<?php

    require_once ("../vendor/autoload.php");
     
    use WindowsAzure\Common\ServicesBuilder;
    use WindowsAzure\Blob\Models\CreateContainerOptions;
    use WindowsAzure\Blob\Models\CreateBlobOptions;
    use WindowsAzure\Blob\Models\PublicAccessType;
    use WindowsAzure\Common\ServiceException;

    //Each user has their own "container" in the azuew storate. There are infinite containers and user_hash acts as the unique container identifier

    class AzureStorageService
    {
            var $blobRestProxy;
            function __construct() 
            {
                $connection_string = "DefaultEndpointsProtocol=http;AccountName=fbcopymedia;AccountKey=ovHi3B1PiOZUsK6Hclo5yld68dOVpzl5CKPIvK0Gp7u7TX05A/XxdP5Hqli0Igb2dsF2M206cdvAL46CTzYH2w==";
                // Create blob REST proxy.
                $this->blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connection_string);
            }
        
            function create_user_container($user_hash) 
            {
                // OPTIONAL: Set public access policy and metadata.
                // Create container options object.
                $createContainerOptions = new CreateContainerOptions(); 

                // Set public access policy. Possible values are 
                // PublicAccessType::CONTAINER_AND_BLOBS and PublicAccessType::BLOBS_ONLY.
                // CONTAINER_AND_BLOBS:     
                // Specifies full public read access for container and blob data.
                // proxys can enumerate blobs within the container via anonymous 
                // request, but cannot enumerate containers within the storage account.
                //
                // BLOBS_ONLY:
                // Specifies public read access for blobs. Blob data within this 
                // container can be read via anonymous request, but container data is not 
                // available. proxys cannot enumerate blobs within the container via 
                // anonymous request.
                // If this value is not specified in the request, container data is 
                // private to the account owner.
                $createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);

                try {
                    // Create container.
                    $this->blobRestProxy->createContainer($user_hash, $createContainerOptions);
                }
                catch(ServiceException $e){
                    // Handle exception based on error codes and messages.
                    // Error codes and messages are here: 
                    // http://msdn.microsoft.com/en-us/library/windowsazure/dd179439.aspx
                    $code = $e->getCode();
                    $error_message = $e->getMessage();
                    echo $code.": ".$error_message."<br />";
                }
            }
            
            function upload_blob($user_hash,$blob_name,$blob_location,$blob_metadata=null) 
            {
                $content = file_get_contents($blob_location);
                try {
                    //Upload blob
                    $options = new CreateBlobOptions();
                    $options->setMetadata($blob_metadata);
                    $this->blobRestProxy->createBlockBlob($user_hash, $blob_name, $content,$options); 
                }
                catch(ServiceException $e){
                    // Handle exception based on error codes and messages.
                    // Error codes and messages are here: 
                    // http://msdn.microsoft.com/en-us/library/windowsazure/dd179439.aspx
                    $code = $e->getCode();
                    $error_message = $e->getMessage();
                    echo $code.": ".$error_message."<br />";
                }
            }
            
            function get_all_blobs($user_hash){
                try {
                    $blob_list = $this->blobRestProxy->listBlobs($user_hash);
                    $blobs = $blob_list->getBlobs();
                    return $blobs;
                }
                catch(ServiceException $e){
                    // Handle exception based on error codes and messages.
                    // Error codes and messages are here: 
                    // http://msdn.microsoft.com/en-us/library/windowsazure/dd179439.aspx
                    $code = $e->getCode();
                    $error_message = $e->getMessage();
                    echo $code.": ".$error_message."<br />";
                }
            }
            
            function delete_container($user_hash){
                try {
                    // Delete container.
                    $this->blobRestProxy->deleteContainer($user_hash);
                }
                catch(ServiceException $e){
                    // Handle exception based on error codes and messages.
                    // Error codes and messages are here: 
                    // http://msdn.microsoft.com/en-us/library/windowsazure/dd179439.aspx
                    $code = $e->getCode();
                    $error_message = $e->getMessage();
                    echo $code.": ".$error_message."<br />";
                }
            }
            
            function delete_blob($user_hash,$blob_name){
                try {
                    // Delete blob.
                    $this->blobRestProxy->deleteBlob($user_hash,$blob_name);
                }
                catch(ServiceException $e){
                    // Handle exception based on error codes and messages.
                    // Error codes and messages are here: 
                    // http://msdn.microsoft.com/en-us/library/windowsazure/dd179439.aspx
                    $code = $e->getCode();
                    $error_message = $e->getMessage();
                    echo $code.": ".$error_message."<br />";
                }
            }
    }

?>