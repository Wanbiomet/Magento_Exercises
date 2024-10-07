<?php
namespace Magenest\CustomKnockoutJs\Controller\Adminhtml\Promotion;

use Magento\Backend\App\Action\Context;
use Magenest\CustomKnockoutJs\Model\ResourceModel\Promotion;
use Magenest\CustomKnockoutJs\Model\PromotionFactory;
use Magento\UrlRewrite\Model\UrlRewriteFactory;
use Magento\Framework\Controller\Result\RedirectFactory;

class Save extends \Magento\Backend\App\Action {
    protected $promotionResourceModel;
    protected $promotionFactory;

    protected $urlRewriteFactory;
    protected $_request;

    protected $resultRedirectFactory;

    protected $eventManager;
    public function __construct(
        Context $context,
        Promotion $promotionResourceModel,
        PromotionFactory $promotionFactory,
        RedirectFactory $resultRedirectFactory,
        UrlRewriteFactory $urlRewriteFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Event\ManagerInterface $eventManager
    ) {
        parent::__construct($context);
        $this->promotionResourceModel = $promotionResourceModel;
        $this->promotionFactory = $promotionFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->_request = $request;
        $this->urlRewriteFactory = $urlRewriteFactory;
        $this->eventManager = $eventManager;
    }
    public function execute()
    {
        $post_data = $this->_request->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        $promotion = $this->promotionFactory->create();


        $promotionID = isset($post_data['id']) ? $post_data['id'] : null;

        if($promotionID){
            $promotion->load($promotionID);
            if (!$promotion->getId()) {
                throw new LocalizedException(__('This blog no longer exists.'));
            }

        }

        $promotion->setData('customer_group_id', $post_data['customer_group_id']);
        $promotion->setData('promotion_text', $post_data['promotion_text']);
        $this->promotionResourceModel->save($promotion);
        $resultRedirect->setPath('*/*/index');
        return $resultRedirect;
    }

}
