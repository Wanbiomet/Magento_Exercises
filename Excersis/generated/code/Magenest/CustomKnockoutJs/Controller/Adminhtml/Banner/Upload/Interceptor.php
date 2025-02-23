<?php
namespace Magenest\CustomKnockoutJs\Controller\Adminhtml\Banner\Upload;

/**
 * Interceptor class for @see \Magenest\CustomKnockoutJs\Controller\Adminhtml\Banner\Upload
 */
class Interceptor extends \Magenest\CustomKnockoutJs\Controller\Adminhtml\Banner\Upload implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\File\UploaderFactory $uploaderFactory, \Magento\Framework\App\Filesystem\DirectoryList $directoryList, \Magento\Framework\Controller\Result\JsonFactory $jsonFactory)
    {
        $this->___init();
        parent::__construct($context, $uploaderFactory, $directoryList, $jsonFactory);
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
