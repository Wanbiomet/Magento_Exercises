<?php

namespace Magenest\CustomKnockoutJs\Block;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

class ColorPickerArray extends AbstractFieldArray
{
    private $colorRenderer;

    protected function _prepareToRender()
    {
        $this->addColumn('color', ['label' => __('Color'), 'class' => 'required-entry']);
        $this->addColumn('value', ['label' => __('Value'), 'class' => 'required-entry', 'renderer' => $this->getColorRenderer()]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }
    private function getColorRenderer()
    {
        if (!$this->colorRenderer) {
            $this->colorRenderer = $this->getLayout()->createBlock(
                \Magenest\CustomKnockoutJs\Block\ColorPicker::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->colorRenderer;
    }
}
