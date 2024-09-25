<?php
namespace Magenest\Movie\Controller\Adminhtml\Movie\Save;

/**
 * Interceptor class for @see \Magenest\Movie\Controller\Adminhtml\Movie\Save
 */
class Interceptor extends \Magenest\Movie\Controller\Adminhtml\Movie\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magenest\Movie\Model\ResourceModel\Movie $movieResourceModel, \Magenest\Movie\Model\MovieFactory $movieFactory, \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory, \Magento\Framework\App\RequestInterface $request, \Magento\Framework\Event\ManagerInterface $eventManager)
    {
        $this->___init();
        parent::__construct($context, $movieResourceModel, $movieFactory, $resultRedirectFactory, $request, $eventManager);
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
