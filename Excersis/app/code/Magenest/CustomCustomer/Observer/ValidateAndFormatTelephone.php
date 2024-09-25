<?php

namespace Magenest\CustomCustomer\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class ValidateAndFormatTelephone implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        if ($observer->getEvent()->hasCustomer()) {
            // Lấy đối tượng khách hàng từ sự kiện customer_save_before
            $customer = $observer->getEvent()->getCustomer();
        } elseif ($observer->getEvent()->getOrder()) {
            // Lấy đối tượng khách hàng từ order trong sales_order_save_before
            $order = $observer->getEvent()->getOrder();
            $customer = $order->getCustomer();
        }

        if ($customer) {
            $telephone = $customer->getTelephone();

            // Chuyển đổi nếu bắt đầu bằng +84 thành 0
            if (strpos($telephone, '+84') === 0) {
                $telephone = '0' . substr($telephone, 3);
            }

            // Kiểm tra độ dài số điện thoại
            if (strlen($telephone) != 10 || !preg_match('/^0[0-9]{9}$/', $telephone)) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('The telephone number must be exactly 10 digits and start with 0.')
                );
            }

            // Cập nhật lại số điện thoại sau khi chỉnh sửa
            $customer->setTelephone($telephone);
        }
    }
}
