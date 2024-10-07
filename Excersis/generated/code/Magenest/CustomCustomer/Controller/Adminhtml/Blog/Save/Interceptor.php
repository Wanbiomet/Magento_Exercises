<?php
namespace Magenest\CustomCustomer\Controller\Adminhtml\Blog\Save;

/**
 * Interceptor class for @see \Magenest\CustomCustomer\Controller\Adminhtml\Blog\Save
 */
class Interceptor extends \Magenest\CustomCustomer\Controller\Adminhtml\Blog\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magenest\CustomCustomer\Model\ResourceModel\Blog $blogResourceModel, \Magenest\CustomCustomer\Model\BlogFactory $blogFactory, \Magenest\CustomCustomer\Model\ResourceModel\Blog\CollectionFactory $blogCollectionFactory, \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory, \Magento\UrlRewrite\Model\UrlRewriteFactory $urlRewriteFactory, \Magento\Framework\App\RequestInterface $request, \Magento\Framework\Event\ManagerInterface $eventManager)
    {
        $this->___init();
        parent::__construct($context, $blogResourceModel, $blogFactory, $blogCollectionFactory, $resultRedirectFactory, $urlRewriteFactory, $request, $eventManager);
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
