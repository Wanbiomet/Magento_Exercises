<?php
namespace Magenest\CustomCustomer\Api;

use Magenest\CustomCustomer\Api\Data\BlogInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface BlogRepositoryInterface
 *
 * @package Magenest\CustomCustomer\Api
 */
interface BlogRepositoryInterface
{
    /**
     * Save blog data
     *
     * @param \Magenest\CustomCustomer\Api\Data\BlogInterface $blog
     * @return \Magenest\CustomCustomer\Api\Data\BlogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(BlogInterface $blog);

    /**
     * Retrieve blog by ID
     *
     * @param int $id
     * @return \Magenest\CustomCustomer\Api\Data\BlogInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Delete blog by ID
     *
     * @param int $id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete($id);

    /**
     * Retrieve list of blogs
     *
     * @return \Magenest\CustomCustomer\Api\Data\BlogSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList();
}
