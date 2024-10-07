<?php
namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Config\ReinitableConfigInterface;
class ChangeValueTextField implements ObserverInterface
{
    /**
     * Execute the observer
     *
     * @param Observer $observer
     * @return void
     */
    private $request;
    protected $configWriter;
    protected $config;
    public function __construct(RequestInterface $request, WriterInterface $configWriter, ReinitableConfigInterface $config)
    {
        $this->request = $request;
        $this->configWriter = $configWriter;
        $this->config = $config;
    }
    public function execute(Observer $observer)
    {
        $data = $this->request->getParam('groups');
        $name = $data['magenest_movie']['fields']['movie_field']['value'];
        if($name === "Ping") {
            $this->configWriter->save( 'movie/magenest_movie/movie_field','Pong');

            $this->config->reinit();
        }
    }
}
