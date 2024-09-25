<?php
namespace Magenest\CustomCustomer\Block\Adminhtml\Form;

use Magento\Search\Controller\RegistryConstants;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * Url Builder
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;


    protected $request;
    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\App\Request\Http $request
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\App\Request\Http $request,
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->request = $request;
    }

    /**
     * Return the synonyms group Id.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->request->getParam('id');
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
