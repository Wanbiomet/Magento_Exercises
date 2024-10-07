<?php

namespace Magenest\CustomCustomer\Model;

use Magenest\CustomCustomer\Api\Data\BlogInterface;
use Magento\Framework\Model\AbstractModel;

class Blog extends AbstractModel implements BlogInterface
{
    protected function _construct()
    {
        $this->_init('Magenest\CustomCustomer\Model\ResourceModel\Blog');
    }
    public function getId()
    {
        return $this->getData('id');
    }

    public function setId($id)
    {
        return $this->setData('id', $id);
    }

    public function getTitle()
    {
        return $this->getData('title');
    }

    public function setTitle($title)
    {
        return $this->setData('title', $title);
    }

    public function getDescription()
    {
        return $this->getData('description');
    }

    public function setDescription($description)
    {
        return $this->setData('description', $description);
    }

    public function getContent()
    {
        return $this->getData('content');
    }

    public function setContent($content)
    {
        return $this->setData('content', $content);
    }

    public function getUrlRewrite()
    {
        return $this->getData('url_rewrite');
    }

    public function setUrlRewrite($urlRewrite)
    {
        return $this->setData('url_rewrite', $urlRewrite);
    }

    public function getStatus()
    {
        return $this->getData('status');
    }

    public function setStatus($status)
    {
        return $this->setData('status', $status);
    }

    public function getCreateAt()
    {
        return $this->getData('create_at');
    }

    public function setCreateAt($createAt)
    {
        return $this->setData('create_at', $createAt);
    }

    public function getUpdateAt()
    {
        return $this->getData('update_at');
    }

    public function setUpdateAt($updateAt)
    {
        return $this->setData('update_at', $updateAt);
    }
}
