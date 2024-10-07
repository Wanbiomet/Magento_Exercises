<?php

namespace Magenest\CustomCustomer\Controller\Blog;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\UrlRewrite\Model\UrlRewriteFactory;
use Magenest\CustomCustomer\Model\BlogFactory;

class View extends Action
{
    protected $blogFactory;
    protected $pageFactory;
    protected $urlRewriteFactory;

    public function __construct(
        Context $context,
        BlogFactory $blogFactory,
        PageFactory $pageFactory,
        UrlRewriteFactory $urlRewriteFactory,

    ) {
        $this->blogFactory = $blogFactory;
        $this->pageFactory = $pageFactory;
        $this->urlRewriteFactory = $urlRewriteFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        // Lấy id blog từ request
        $blogId = $this->getRequest()->getParam('id');
        $blog = $this->blogFactory->create()->load($blogId);

        if (!$blog->getId()) {
            // Nếu blog không tồn tại, chuyển về trang 404
            return $this->resultRedirectFactory->create()->setPath('noroute');
        }

        // Load trang chi tiết của blog
        $resultPage = $this->pageFactory->create();
        return $resultPage;
    }
}
