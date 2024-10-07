<?php
namespace Magenest\CustomKnockoutJs\Block;

use Magento\Framework\View\Element\Template;
use Magenest\CustomKnockoutJs\Model\BannerFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
class Banner extends Template
{
    protected $bannerFactory;
    protected $directoryList;

    public function __construct(
        Template\Context $context,
        BannerFactory $bannerFactory,
        DirectoryList $directoryList,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->bannerFactory = $bannerFactory;
        $this->directoryList = $directoryList;
    }

    public function getBannerById()
    {

        $bannerId =  $this->getData('bannerId');
        $banner =  $this->bannerFactory->create()->load($bannerId);
        if ($banner->getId() && $banner->getImage()) {
            $imagePath = $banner->getImage(); // Lấy tên hình ảnh từ cột 'image'
            $mediaUrl = $this->_urlBuilder->getBaseUrl(['_type' => \Magento\Framework\UrlInterface::URL_TYPE_MEDIA]) . 'banner_images/' . $imagePath; // Tạo URL đầy đủ
            return [
                'url' => $mediaUrl,
                'name' => $imagePath
            ];
        }
        return null;
    }
}
