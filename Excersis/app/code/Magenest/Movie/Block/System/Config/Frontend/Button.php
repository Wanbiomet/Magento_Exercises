<?php
namespace Magenest\Movie\Block\System\Config\Frontend;

use Magento\Framework\Data\Form\Element\AbstractElement;

class Button  extends \Magento\Config\Block\System\Config\Form\Field
{
    protected function _getElementHtml(AbstractElement $element)
    {
        $this->setElement($element);
        // Return the button HTML with JavaScript to reload the page
        $html = '<button type="button" onclick="reloadPage()">Click Me</button>';
        $html .= '<script type="text/javascript">
                    function reloadPage() {
                        location.reload();
                    }
                  </script>';
        return $html;
    }
}
