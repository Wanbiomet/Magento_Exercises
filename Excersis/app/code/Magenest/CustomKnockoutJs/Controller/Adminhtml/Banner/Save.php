<?php

namespace Magenest\CustomKnockoutJs\Controller\Adminhtml\Banner;

use Magenest\CustomKnockoutJs\Model\BannerFactory;
use Magenest\CustomKnockoutJs\Model\ResourceModel\Banner as BannerResource;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\Result\RedirectFactory;


class Save extends Action
{
    protected $bannerFactory;
    protected $bannerResource;
    protected $resultRedirectFactory;
    public function __construct(
        Action\Context $context,
        BannerFactory $bannerFactory,
        BannerResource $bannerResource,
        RedirectFactory $resultRedirectFactory
    ) {
        parent::__construct($context);
        $this->bannerFactory = $bannerFactory;
        $this->bannerResource = $bannerResource;
        $this->resultRedirectFactory = $resultRedirectFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();
        $banner = $this->bannerFactory->create();
        $bannerID = isset($data['banner_id']) ? $data['banner_id'] : null;;

        if($bannerID) {
            $banner->load($bannerID);
            if (!$banner->getId()) {
                throw new LocalizedException(__('This banner no longer exists.'));
            }

        }

        $banner->setData('name', $data['name']);
        if($data['enabled'] == 'true') {
            $banner->setData('enabled', 1);
        }
        $banner->setData('enabled', 0);
        $banner->setData('title', $data['title']);
        $banner->setData('image', $data['image'][0]['name']);
        $banner->setData('link', $data['link']);
        $banner->setData('text', $data['text']);

        $this->bannerResource->save($banner);
        $resultRedirect->setPath('*/*/index');
        return $resultRedirect;
    }

}
