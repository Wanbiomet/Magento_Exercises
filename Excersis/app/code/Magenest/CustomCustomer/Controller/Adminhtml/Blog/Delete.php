<?php
namespace Magenest\CustomCustomer\Controller\Adminhtml\Blog;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magenest\CustomCustomer\Model\BlogFactory;
use Magenest\CustomCustomer\Model\ResourceModel\Blog;

class Delete extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    protected $blogFactory;
    protected $blogResource;
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        BlogFactory $blogFactory,
        Blog $blogResource
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->blogFactory = $blogFactory;
        $this->blogResource = $blogResource;
    }
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $movie = $this->blogFactory->create();
        $movie->load($id);
        $this->blogResource->delete($movie);

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/index');
        return $resultRedirect;
    }

}
