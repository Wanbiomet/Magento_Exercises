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
//    protected function _initSelect()
//    {
//       parent::_initSelect();
//       $this->joinTable();
//
//    }
//    public function joinTable(){
//        $actorTable = $this->getTable('magenest_actor');
//        $actormovieTable = $this->getTable('magenest_movie_actor');
//        $directorTable = $this->getTable('magenest_director');
//        $result = $this
//            ->addFieldToSelect('movie_id')
//            ->addFieldToSelect('name')
//            ->addFieldToSelect('description')
//            ->addFieldToSelect('rating')
//            ->getSelect()
//            ->join(['d' => $directorTable], 'main_table.director_id = d.director_id',['director_id'=>'d.director_id','director' => 'd.name'])
//            ->join(['ma' => $actormovieTable],'main_table.movie_id = ma.movie_id',[])
//            ->join(['a' => $actorTable], 'a.actor_id = ma.actor_id',['actor_name' => 'GROUP_CONCAT(a.name)'])
//            ->group('main_table.movie_id');
//        $sql = $this->getSelect()->__toString();
//        return $this;
//    }
}
