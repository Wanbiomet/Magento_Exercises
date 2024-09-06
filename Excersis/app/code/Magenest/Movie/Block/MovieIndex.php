<?php

namespace Magenest\Movie\Block;

use Magento\Framework\View\Element\Template;
use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory as MovieCollectionFactory;
use Magenest\Movie\Model\ResourceModel\Director\CollectionFactory as DirectorCollectionFactory;
use Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory as ActorCollectionFactory;
use Magenest\Movie\Model\ResourceModel\MovieActor\CollectionFactory as MovieActorCollectionFactory;

class MovieIndex extends Template
{
    protected $movieCollectionFactory;
    protected $directorCollectionFactory;
    protected $actorCollectionFactory;
    protected $movieActorCollectionFactory;

    public function __construct(
        Template\Context $context,
        MovieCollectionFactory $movieCollectionFactory,
        DirectorCollectionFactory $directorCollectionFactory,
        ActorCollectionFactory $actorCollectionFactory,
        MovieActorCollectionFactory $movieActorCollectionFactory,
        array $data = []
    ) {
        $this->movieCollectionFactory = $movieCollectionFactory;
        $this->directorCollectionFactory = $directorCollectionFactory;
        $this->actorCollectionFactory = $actorCollectionFactory;
        $this->movieActorCollectionFactory = $movieActorCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getMovies()
    {
        return $this->movieCollectionFactory->create()
            ->addFieldToSelect('*');
    }

    public function getDirectorByMovieId($movieId)
    {
        $movie = $this->movieCollectionFactory->create()
        ->getItemById($movieId);

        return $this->directorCollectionFactory->create()
                    ->addFieldToFilter('director_id', $movie->getData('director_id'))
                    ->getFirstItem();
    }

    public function getActorsByMovieId($movieId)
    {
        $movieActorCollection = $this->movieActorCollectionFactory->create()
                                     ->addFieldToFilter('movie_id', $movieId);
        $actorIds = [];
        foreach ($movieActorCollection as $movieActor) {
            $actorIds[] = (int)$movieActor->getActorId();
        }


        $actorCollection = $this->actorCollectionFactory->create()
            ->addFieldToFilter('actor_id', ['in' => $actorIds]);

        return $actorCollection;
    }
}
