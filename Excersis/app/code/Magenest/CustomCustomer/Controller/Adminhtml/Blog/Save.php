<?php
namespace Magenest\CustomCustomer\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action\Context;
use Magenest\CustomCustomer\Model\ResourceModel\Blog;
use Magenest\CustomCustomer\Model\BlogFactory;
use Magenest\CustomCustomer\Model\ResourceModel\Blog\CollectionFactory;
use Magento\UrlRewrite\Model\UrlRewriteFactory;
use Magento\Framework\Controller\Result\RedirectFactory;

class Save extends \Magento\Backend\App\Action {
    protected $blogResourceModel;
    protected $blogFactory;
    protected $blogCollectionFactory;

    protected $urlRewriteFactory;
    protected $_request;

    protected $resultRedirectFactory;

    protected $eventManager;
    public function __construct(
        Context $context,
        Blog $blogResourceModel,
        BlogFactory $blogFactory,
        CollectionFactory $blogCollectionFactory,
        RedirectFactory $resultRedirectFactory,
        UrlRewriteFactory $urlRewriteFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Event\ManagerInterface $eventManager
    ) {
        parent::__construct($context);
        $this->blogResourceModel = $blogResourceModel;
        $this->blogFactory = $blogFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->blogCollectionFactory = $blogCollectionFactory;
        $this->_request = $request;
        $this->urlRewriteFactory = $urlRewriteFactory;
        $this->eventManager = $eventManager;
    }
    public function execute()
    {
        $post_data = $this->_request->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        $blog = $this->blogFactory->create();


        $blogID = isset($post_data['id']) ? $post_data['id'] : null;

        if($blogID){
            $blog->load($blogID);
            if (!$blog->getId()) {
                throw new LocalizedException(__('This blog no longer exists.'));
            }
            if($blog->getData('url_rewrite') != $post_data['url_rewrite']){
                $collection = $this->blogCollectionFactory->create()
                    ->addFieldToFilter('url_rewrite',$post_data['url_rewrite'])
                    ->getFirstItem();
                if($collection->getId() != $blogID){
                    $this->messageManager->addErrorMessage(__('Url rewrite đã tồn tại!'));
                    return $resultRedirect->setPath('*/*/edit', ['_current' => true, 'id' => $blogID]);
                }
            }
        }else{
            $collection = $this->blogCollectionFactory->create()
                ->addFieldToFilter('url_rewrite',$post_data['url_rewrite'])
                ->getSize();
            if($collection > 0){
                $this->messageManager->addErrorMessage(__('Url rewrite đã tồn tại!'));
                return $resultRedirect->setPath('*/*/create', ['_current' => true]);
            }
        }

        $blog->setData('author_id', $post_data['author_id']);
        $blog->setData('title', $post_data['title']);
        $blog->setData('description', $post_data['description']);
        $blog->setData('content', $post_data['content']);
        $blog->setData('url_rewrite', $post_data['url_rewrite']);

        if($post_data['status'] == 'true'){
            $blog->setData('status', 1);
        }else {
            $blog->setData('status', 0);
        }

        $this->blogResourceModel->save($blog);
        $this->createUrlRewrite($blog);
        $resultRedirect->setPath('*/*/index');
        return $resultRedirect;
    }
    protected function createUrlRewrite($blog)
    {
        // Xóa url_rewrite cũ (nếu có)
        $this->urlRewriteFactory->create()
            ->getCollection()
            ->addFieldToFilter('entity_type', 'custom')
            ->addFieldToFilter('entity_id', $blog->getId())
            ->walk('delete');

        // Tạo url_rewrite mới
        $urlRewriteModel = $this->urlRewriteFactory->create();
        $urlRewriteModel->setEntityType('custom') // Custom type cho blog
        ->setEntityId($blog->getId()) // ID của blog
        ->setRequestPath($blog->getData('url_rewrite') . '.html') // URL rewrite tùy chỉnh
        ->setTargetPath('blog/blog/view/id/' . $blog->getId()) // Đường dẫn gốc
        ->setRedirectType(0) // Không chuyển hướng
        ->setStoreId(1) // ID store
        ->save();
    }

}
