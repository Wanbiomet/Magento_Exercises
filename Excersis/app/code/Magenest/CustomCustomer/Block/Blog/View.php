<?php
namespace Magenest\CustomCustomer\Block\Blog;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magenest\CustomCustomer\Model\BlogFactory;

class View extends Template
{
    protected $blogFactory;
    protected $_request;
    public function __construct(
        Context $context,
        BlogFactory $blogFactory,
        \Magento\Framework\App\RequestInterface $request,
        array $data = []
    ) {
        $this->blogFactory = $blogFactory;
        $this->_request = $request;
        parent::__construct($context, $data);
    }

    public function getBlog()
    {
        // Get blog ID from request
        $blogId = $this->getRequest()->getParam('id');

        // Load blog data
        return $this->blogFactory->create()->load($blogId);
    }
}

