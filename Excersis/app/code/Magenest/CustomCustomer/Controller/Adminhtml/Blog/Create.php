<?php
namespace Magenest\CustomCustomer\Controller\Adminhtml\Blog;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Create extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Blog Detail'));
        return $resultPage;
    }

}
