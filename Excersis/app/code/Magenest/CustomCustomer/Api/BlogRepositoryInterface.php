<?php
namespace Magenest\CustomCustomer\Api;

use Magenest\CustomCustomer\Api\Data\BlogInterface;

interface BlogRepositoryInterface
{
    public function save(BlogInterface $blog);

    public function getById($id);

    public function delete($id);

    public function getList();
}
