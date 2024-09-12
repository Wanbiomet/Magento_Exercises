<?php
namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magento\Backend\App\Action\Context;
use Magenest\Movie\Model\ResourceModel\Movie;
use Magenest\Movie\Model\MovieFactory;
use Magento\Framework\Controller\Result\RedirectFactory;

class Save extends \Magento\Backend\App\Action {
    protected $movieResourceModel;
    protected $movieFactory;

    protected $_request;

    protected $resultRedirectFactory;

    public function __construct(
        Context $context,
        Movie $movieResourceModel,
        MovieFactory $movieFactory,
        RedirectFactory $resultRedirectFactory,
        \Magento\Framework\App\RequestInterface $request
    ) {
        parent::__construct($context);
        $this->movieResourceModel = $movieResourceModel;
        $this->movieFactory = $movieFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->_request = $request;
    }
    public function execute()
    {
        $post_data = $this->_request->getPostValue();
        $movie = $this->movieFactory->create();

        $moiveID = isset($post_data['movie_id']) ? $post_data['movie_id'] : null;
        if($moiveID){
            $movie->load($moiveID);
            if (!$movie->getId()) {
                throw new LocalizedException(__('This movie no longer exists.'));
            }
        }
        $movie->setData('name', $post_data['name']);
        $movie->setData('description', $post_data['description']);
        $movie->setData('rating', $post_data['rating']);
        $movie->setData('director_id', $post_data['director_id']);
        $this->movieResourceModel->save($movie);

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/index');
        return $resultRedirect;
    }

}
