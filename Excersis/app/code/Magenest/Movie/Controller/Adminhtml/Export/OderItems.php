<?php

namespace Magenest\Movie\Controller\Adminhtml\Export;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Filesystem\DirectoryList;

class OderItems extends Action
{
    protected $orderRepository;
    protected $searchCriteriaBuilder;
    protected $fileFactory;
    protected $directoryList;
    public function __construct(
        Action\Context $context,
        OrderRepositoryInterface $orderRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        DirectoryList $directoryList
    ) {
        $this->orderRepository = $orderRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->fileFactory = $fileFactory;
        $this->directoryList = $directoryList;
        parent::__construct($context);
    }

    public function execute()
    {
        // Lấy tất cả các đơn hàng
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $orders = $this->orderRepository->getList($searchCriteria)->getItems();

        // Tạo file CSV
        $fileName = 'order_items_export.csv';
        $content = [];
        $header = ['Order ID', 'Order Date', 'Customer Email', 'Product Name', 'SKU', 'Price', 'Quantity'];
        $content[] = $header;

        // Duyệt qua các đơn hàng và lấy các sản phẩm
        foreach ($orders as $order) {
            foreach ($order->getAllVisibleItems() as $item) {
                $data = [
                    $order->getIncrementId(),
                    $order->getCreatedAt(),
                    $order->getCustomerEmail(),
                    $item->getName(),
                    $item->getSku(),
                    $item->getPrice(),
                    $item->getQtyOrdered()
                ];
                $content[] = $data;
            }
        }

        // Đảm bảo rằng thư mục 'var/export/' tồn tại
        $directory = $this->directoryList->getPath($this->directoryList::VAR_DIR) . '/export/';
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);  // Tạo thư mục nếu chưa tồn tại
        }

        // Tạo file CSV
        $filePath = $directory . $fileName;


        $csvFile = fopen($filePath, 'w');
        foreach ($content as $row) {
            fputcsv($csvFile, $row);
        }
        fclose($csvFile);

        // Trả về file CSV
        return $this->fileFactory->create(
            $fileName,
            [
                'type' => 'filename',
                'value' => $filePath,
                'rm' => true // Xóa file sau khi tải xuống
            ],
            $this->directoryList::VAR_DIR
        );
    }
}
