<?php
namespace Magenest\CustomKnockoutJs\Controller\Adminhtml\Banner\Save;

/**
 * Interceptor class for @see \Magenest\CustomKnockoutJs\Controller\Adminhtml\Banner\Save
 */
class Interceptor extends \Magenest\CustomKnockoutJs\Controller\Adminhtml\Banner\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magenest\CustomKnockoutJs\Model\BannerFactory $bannerFactory, \Magenest\CustomKnockoutJs\Model\ResourceModel\Banner $bannerResource, \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory, \Magento\Framework\App\RequestInterface $request)
    {
        $this->___init();
        parent::__construct($context, $bannerFactory, $bannerResource, $resultRedirectFactory, $request);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }
}
