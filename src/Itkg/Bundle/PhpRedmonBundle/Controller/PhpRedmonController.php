<?php

namespace Itkg\Bundle\PhpRedmonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Itkg\Bundle\PhpRedmonBundle\Monitoring\RedisMonitoring;
use Itkg\Bundle\PhpRedmonBundle\Redis\Predis\Client;

class PhpRedmonController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        
        $redis = new \Itkg\Bundle\PhpRedmonBundle\Redis\Predis\Client('tcp://192.168.50.4:6379');
        $redis->set('foo', 'bar');
        $value = $redis->get('foo');
        
        $monitoring =  new \Itkg\Bundle\PhpRedmonBundle\Monitoring\RedisMonitoring($redis);
        $infos = $monitoring->GetStat();
        
        echo("<br>");echo("<br>");echo("<br>");echo("<br>");echo("<br>");echo("<br>");echo("<br>");echo("<br>");
        
        
        var_dump($infos['Server']);
        $ret = $monitoring->Showlog();
        $client_list = $monitoring->ClientList();
        echo("<br>");echo("<br>");echo("<br>");echo("<br>");
        var_dump($client_list);
        $monitoring->GetInfoClient();
     
        return array('Server'=>$infos['Server'],'client_list' => $client_list);
    }
}