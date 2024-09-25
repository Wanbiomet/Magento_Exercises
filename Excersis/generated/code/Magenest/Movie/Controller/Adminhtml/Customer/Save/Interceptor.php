<?php
namespace Magenest\Movie\Controller\Adminhtml\Customer\Save;

/**
 * Interceptor class for @see \Magenest\Movie\Controller\Adminhtml\Customer\Save
 */
class Interceptor extends \Magenest\Movie\Controller\Adminhtml\Customer\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Customer\Model\CustomerFactory $customerFactory, \Magento\Framework\Controller\Result\JsonFactory $jsonFactory, \Magento\Framework\File\UploaderFactory $uploaderFactory, \Magento\Framework\App\Filesystem\DirectoryList $directoryList, \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory, \Magento\Framework\App\RequestInterface $request)
    {
        $this->___init();
        parent::__construct($context, $customerFactory, $jsonFactory, $uploaderFactory, $directoryList, $resultRedirectFactory, $request);
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
