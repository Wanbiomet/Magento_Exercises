<?php
namespace Magenest\Movie\Controller\Adminhtml\Export\OderItems;

/**
 * Interceptor class for @see \Magenest\Movie\Controller\Adminhtml\Export\OderItems
 */
class Interceptor extends \Magenest\Movie\Controller\Adminhtml\Export\OderItems implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Sales\Api\OrderRepositoryInterface $orderRepository, \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Framework\App\Filesystem\DirectoryList $directoryList)
    {
        $this->___init();
        parent::__construct($context, $orderRepository, $searchCriteriaBuilder, $fileFactory, $directoryList);
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
