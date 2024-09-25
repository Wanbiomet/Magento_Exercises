<?php
namespace Magenest\CustomCustomer\Model;

use Magenest\CustomCustomer\Api\BlogRepositoryInterface;
use Magenest\CustomCustomer\Api\Data\BlogInterface;
use Magenest\CustomCustomer\Model\ResourceModel\Blog as BlogResource;
use Magenest\CustomCustomer\Model\ResourceModel\Blog\CollectionFactory as BlogCollectionFactory;
use Magenest\CustomCustomer\Model\BlogFactory;

class BlogRepository implements BlogRepositoryInterface
{
    protected $blogFactory;
    protected $blogResource;
    protected $blogCollectionFactory;
    public function __construct(BlogFactory $blogFactory, BlogResource $blogResource, BlogCollectionFactory $blogCollectionFactory)
    {
        $this->blogFactory = $blogFactory;
        $this->blogResource = $blogResource;
        $this->blogCollectionFactory = $blogCollectionFactory;
    }

    public function save(BlogInterface $blog)
    {
        $this->blogResource->save($blog);
        return $blog;
    }

    public function getById($id)
    {
        $blog = $this->blogFactory->create();
        $blog->load($id);
        if (!$blog->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(__('Blog with id "%1" does not exist.', $id));
        }
        return $blog;
    }

    public function delete($id)
    {
        $blog = $this->getById($id);
        $this->blogResource->delete($blog);
        return true;
    }

    public function getList()
    {
        $collection = $this->blogCollectionFactory->create();
        return $collection->getItems();
    }
}
