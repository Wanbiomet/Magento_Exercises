<?php
namespace Magenest\Movie\Model\Product\Attribute\Backend\File;

/**
 * Interceptor class for @see \Magenest\Movie\Model\Product\Attribute\Backend\File
 */
class Interceptor extends \Magenest\Movie\Model\Product\Attribute\Backend\File implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Psr\Log\LoggerInterface $logger, \Magento\Framework\Filesystem $filesystem, \Magento\Framework\Filesystem\Driver\File $file, \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory)
    {
        $this->___init();
        parent::__construct($logger, $filesystem, $file, $fileUploaderFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'validate');
        return $pluginInfo ? $this->___callPlugins('validate', func_get_args(), $pluginInfo) : parent::validate($object);
    }
}
