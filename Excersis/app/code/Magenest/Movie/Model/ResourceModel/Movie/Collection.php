<?php
namespace Magenest\Movie\Model\ResourceModel\Movie;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
/**
 * create Collection
 */
class Collection extends AbstractCollection {
    protected $_idFieldName = 'movie_id';
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct() {
        $this->_init('Magenest\Movie\Model\Movie',
            'Magenest\Movie\Model\ResourceModel\Movie');
    }
    protected function _initSelect()
    {
        parent::_initSelect();

       $this->joinTable();

    }
    public function joinTable(){
        $actorTable = $this->getTable('magenest_actor');
        $actormovieTable = $this->getTable('magenest_movie_actor');
        $directorTable = $this->getTable('magenest_director');
        $result = $this
            ->addFieldToSelect('movie_id')
            ->addFieldToSelect('name','movie')
            ->addFieldToSelect('description')
            ->addFieldToSelect('rating')
            ->getSelect()
            ->joinLeft($directorTable, 'main_table.director_id ='.$directorTable.'.director_id',['director' => $directorTable.'.name'])
            ->joinLeft($actormovieTable,'main_table.movie_id ='.$actormovieTable.'.movie_id',null)
            ->joinLeft($actorTable,$actorTable.'.actor_id ='.$actormovieTable.'.actor_id',['actor_name' => 'GROUP_CONCAT('.$actorTable.'.name)'])
            ->group('main_table.movie_id');
        return $this;
    }
}
