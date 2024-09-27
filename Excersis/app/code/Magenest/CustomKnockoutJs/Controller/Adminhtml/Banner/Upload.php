<?php

namespace Magenest\CustomKnockoutJs\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\File\UploaderFactory;

class Upload extends Action
{
    protected $uploaderFactory;
    protected $mediaDirectory;
    protected $jsonFactory;

    public function __construct(
        Action\Context $context,
        UploaderFactory $uploaderFactory,
        DirectoryList $directoryList,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->uploaderFactory = $uploaderFactory;
        $this->mediaDirectory = $directoryList->getPath(DirectoryList::MEDIA);
        $this->jsonFactory = $jsonFactory;
    }

    public function execute()
    {
        try {
            $uploader = $this->uploaderFactory->create(['fileId' => 'image']);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(false);

            // Save image to media/banner_images
            $result = $uploader->save($this->mediaDirectory . '/banner_images');
            $imagePath = 'banner_images/' . $result['file'];

            // Return data in correct format
            $response = [
                'url' => $this->_url->getBaseUrl(['_type' => \Magento\Framework\UrlInterface::URL_TYPE_MEDIA]) . $imagePath,
                'name' => $result['file'],  // The name of the uploaded file
                'full_path' => $result['file'],  // Full path for the file
                'type' => $result['type'],  // Mime type of the file
                'tmp_name' => $result['file'],  // Temporary file name
                'error' => 0,  // No error during upload
                'size' => $result['size'],  // File size
                'file' => $result['file'],  // File path without the base URL

            ];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }

        return $this->jsonFactory->create()->setData($response);
    }
}
