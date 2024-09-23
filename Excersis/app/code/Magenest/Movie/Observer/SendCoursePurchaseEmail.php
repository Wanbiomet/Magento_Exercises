<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magenest\Movie\Model\CourseFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Translate\Inline\StateInterface;
class SendCoursePurchaseEmail extends AbstractHelper implements ObserverInterface
{
    protected $transportBuilder;
    protected $orderRepository;
    protected $courseFactory;
    protected $storeManager;
    protected $inlineTranslation;
    public function __construct(
        TransportBuilder $transportBuilder,
        OrderRepositoryInterface $orderRepository,
        CourseFactory $courseFactory,
        StoreManagerInterface $storeManager,
        StateInterface $inlineTranslation,
    ) {
        $this->transportBuilder = $transportBuilder;
        $this->orderRepository = $orderRepository;
        $this->courseFactory = $courseFactory;
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $inlineTranslation;
    }

    public function execute(Observer $observer)
    {
        $orderIds = $observer->getEvent()->getOrderIds();
        if (!empty($orderIds)) {
            $order = $this->orderRepository->get(reset($orderIds));

            // Iterate over each product in the order
            foreach ($order->getAllVisibleItems() as $item) {
                $productId = $item->getProductId();

                // Load the course information from the custom table
                $course = $this->courseFactory->create()->load($productId, 'product_id');
                if ($course->getId()) {
                    // Prepare email data
                    $emailData = [
                        'customer_name' => $order->getCustomerFirstname() . ' ' . $order->getCustomerLastname(),
                        'product_name' => $item->getName(),
                        'course_link' => $course->getLink(),
                        'course_document' => $course->getDocument()
                    ];

                    // Send the email
                    $this->sendEmail($order->getCustomerEmail(), $emailData);
                }
            }
        }
    }

    protected function sendEmail($recipientEmail, $emailData)
    {
        // Disable inline translation while sending email
        $this->inlineTranslation->suspend();
        $storeId = $this->storeManager->getStore()->getId();
        $from = array('email' => "test@webkul.com", 'name' => 'Name of Sender');
        $transport = $this->transportBuilder
            ->setTemplateIdentifier('course_purchase_email') // Template ID from admin
            ->setTemplateOptions(
                [
                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store' => $storeId
                ]
            )
            ->setTemplateVars($emailData)
            ->setFrom($from) // Sender email identity
            ->addTo($recipientEmail)
            ->getTransport();

        $transport->sendMessage();
        $this->inlineTranslation->resume();
        echo "Email sent successfully!";
    }
}
