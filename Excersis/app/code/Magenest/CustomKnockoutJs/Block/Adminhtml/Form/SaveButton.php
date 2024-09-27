<?php
namespace Magenest\CustomKnockoutJs\Block\Adminhtml\Form;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
class SaveButton implements ButtonProviderInterface {
    public function getButtonData() {
        return [
            'label' => __('Save Promotion'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90 ];
    }
//    public function getSaveUrl() {
//        return $this->getUrl('*/*/save', []) ;
//    }
}
