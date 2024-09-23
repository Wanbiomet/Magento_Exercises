<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order;

class AutoInvoiceZeroOrder implements ObserverInterface
{
    protected $invoiceService;
    protected $transaction;
    protected $logger;

    public function __construct(
        \Magento\Sales\Model\Service\InvoiceService $invoiceService,
        \Magento\Framework\DB\Transaction $transaction,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->invoiceService = $invoiceService;
        $this->transaction = $transaction;
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getOrder();

        // Kiểm tra nếu đơn hàng có tổng cộng là 0
        if ($order->getGrandTotal() == 0 && $order->getState() == Order::STATE_NEW) {
            try {
                // Chuyển trạng thái sang "Processing"
                $order->setStatus(Order::STATE_PROCESSING);
                $order->save();
                // Tạo invoice
                if (!$order->canInvoice()) {
                    throw new \Magento\Framework\Exception\LocalizedException(
                        __('Cannot create invoice.')
                    );
                }

                $invoice = $this->invoiceService->prepareInvoice($order);
                $invoice->register();
                $invoice->save();

                $transactionSave = $this->transaction
                    ->addObject($invoice)
                    ->addObject($invoice->getOrder());
                $transactionSave->save();
            } catch (\Exception $e) {
                $this->logger->error(__('Error creating invoice: %1', $e->getMessage()));
            }
        }
    }
}
