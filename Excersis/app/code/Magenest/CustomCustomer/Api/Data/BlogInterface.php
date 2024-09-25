<?php
namespace Magenest\CustomCustomer\Api\Data;

interface BlogInterface
{
    public function getId();

    public function setId($id);

    public function getTitle();

    public function setTitle($title);

    public function getDescription();

    public function setDescription($description);

    public function getContent();

    public function setContent($content);

    public function getUrlRewrite();

    public function setUrlRewrite($urlRewrite);

    public function getStatus();

    public function setStatus($status);

    public function getCreateAt();

    public function setCreateAt($createAt);

    public function getUpdateAt();

    public function setUpdateAt($updateAt);
}
