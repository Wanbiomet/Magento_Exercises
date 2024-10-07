<?php
namespace Magenest\Movie\Controller\Adminhtml\Customer;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\File\UploaderFactory;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Controller\Result\RedirectFactory;

class Save extends \Magento\Backend\App\Action {
    protected $customerFactory;
    protected $jsonFactory;
    protected $uploaderFactory;
    protected $directoryList;

    protected $_request;

    protected $resultRedirectFactory;

    public function __construct(
        Context $context,
        CustomerFactory $customerFactory,
        JsonFactory $jsonFactory,
        UploaderFactory $uploaderFactory,
        DirectoryList $directoryList,
        RedirectFactory $resultRedirectFactory,
        \Magento\Framework\App\RequestInterface $request,
    ) {
        parent::__construct($context);
        $this->customerFactory = $customerFactory;
        $this->jsonFactory = $jsonFactory;
        $this->uploaderFactory = $uploaderFactory;
        $this->directoryList = $directoryList;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->_request = $request;
    }
    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $params = $this->getRequest()->getParams();

        $customerId = $params['customer_id'];
        $image = $this->getRequest()->getFiles('avatar');

        try {
            $customer = $this->customerFactory->create()->load($customerId);

            $uploader = $this->uploaderFactory->create(['fileId' => 'profile_image']);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'png']);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(false);

            $mediaPath = $this->directoryList->getPath(DirectoryList::MEDIA) . '/customer/';
            $result = $uploader->save($mediaPath);

            $imagePath = 'customer/' . $result['file'];
            $customer->setData('profile_image', $imagePath);
            $customer->save();

            return $resultJson->setData(['success' => true, 'message' => __('Image successfully uploaded and saved.')]);
        } catch (LocalizedException $e) {
            return $resultJson->setData(['success' => false, 'message' => $e->getMessage()]);
        } catch (\Exception $e) {
            return $resultJson->setData(['success' => false, 'message' => __('An error occurred during file upload.')]);
        }
    }

}
