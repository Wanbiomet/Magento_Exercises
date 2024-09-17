<?php

namespace Magenest\Movie\Block\Adminhtml;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Module\ModuleListInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as CustomerCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as OrderCollectionFactory;
use Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory as InvoiceCollectionFactory;
use Magento\Sales\Model\ResourceModel\Order\Creditmemo\CollectionFactory as CreditmemoCollectionFactory;

class ModuleInfo extends Template
{
    /**
     * @var ModuleListInterface
     */
    protected $moduleList;
    protected $resourceConnection;
    protected $customerCollectionFactory;
    protected $productCollectionFactory;
    protected $orderCollectionFactory;
    protected $invoiceCollectionFactory;
    protected $creditmemoCollectionFactory;
    /**
     * Constructor.
     *
     * @param Template\Context $context
     * @param ModuleListInterface $moduleList
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        ModuleListInterface $moduleList,
        ResourceConnection $resourceConnection,
        CustomerCollectionFactory $customerCollectionFactory,
        ProductCollectionFactory $productCollectionFactory,
        OrderCollectionFactory $orderCollectionFactory,
        InvoiceCollectionFactory $invoiceCollectionFactory,
        CreditmemoCollectionFactory $creditmemoCollectionFactory,
        array $data = []
    ) {
        $this->moduleList = $moduleList;
        $this->resourceConnection = $resourceConnection;
        $this->customerCollectionFactory = $customerCollectionFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->invoiceCollectionFactory = $invoiceCollectionFactory;
        $this->creditmemoCollectionFactory = $creditmemoCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * Get the count of installed modules
     *
     * @return int
     */
    public function getInstalledModuleCount()
    {
        $allModules = $this->moduleList->getAll();
        return count($allModules);
    }

    /**
     * Get the count of modules in setup_module table
     *
     * @return int
     */
    public function getModuleCountFromTable()
    {
        $connection = $this->resourceConnection->getConnection();
        $select = $connection->select()
            ->from($this->resourceConnection->getTableName('setup_module'), ['module' => 'COUNT(*)']);
        return $connection->fetchOne($select);
    }
    public function getCustomerCount()
    {
        return $this->customerCollectionFactory->create()->count();
    }
    public function getProductCount(){
        return $this->productCollectionFactory->create()->count();
    }
    public function getOrderCount(){
        return $this->orderCollectionFactory->create()->count();
    }
    public function getInvoiceCount(){
        return $this->invoiceCollectionFactory->create()->count();
    }
    public function getCreditmemoCount(){
        return $this->creditmemoCollectionFactory->create()->count();
    }
}
