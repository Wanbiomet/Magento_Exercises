<?php
namespace Magenest\Movie\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magenest\Movie\Model\CourseFactory;
use Magenest\Movie\Model\ResourceModel\Course;


class SaveCourseData implements ObserverInterface
{
    protected $courseFactory;

    protected $courseResource;

    public function __construct(
        CourseFactory $courseFactory,
        Course $courseResource
    ) {
        $this->courseFactory = $courseFactory;
        $this->courseResource = $courseResource;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getProduct();
        $courseLink = $product->getData('course_link');
        $courseDocument = $product->getData('course_document');

        $course = $this->courseFactory->create();
        if($product->getId() != $course->getData('product_id')){
            $course->setdata('product_id',$product->getId());
            $course->setData('link',$courseLink);
            $course->setData('document',$courseDocument);
            $this->courseResource->save($course);
        }

    }
}
