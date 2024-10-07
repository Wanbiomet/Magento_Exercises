<?php
namespace Magenest\CustomCustomer\Controller\Blog\View;

/**
 * Interceptor class for @see \Magenest\CustomCustomer\Controller\Blog\View
 */
class Interceptor extends \Magenest\CustomCustomer\Controller\Blog\View implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magenest\CustomCustomer\Model\BlogFactory $blogFactory, \Magento\Framework\View\Result\PageFactory $pageFactory, \Magento\UrlRewrite\Model\UrlRewriteFactory $urlRewriteFactory)
    {
        $this->___init();
        parent::__construct($context, $blogFactory, $pageFactory, $urlRewriteFactory);
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
