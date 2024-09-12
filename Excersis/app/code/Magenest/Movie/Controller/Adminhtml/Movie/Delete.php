<?php
namespace Magenest\Movie\Controller\Adminhtml\Movie;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magenest\Movie\Model\MovieFactory;
use Magenest\Movie\Model\ResourceModel\Movie;

class Delete extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    protected $movieFactory;
    protected $movieResource;
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        MovieFactory $movieFactory,
        Movie $movieResource
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->movieFactory = $movieFactory;
        $this->movieResource = $movieResource;
    }
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $movie = $this->movieFactory->create();
        $movie->load($id);
        $this->movieResource->delete($movie);

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/index');
        return $resultRedirect;
    }

}
