<?php
namespace Yjtec\Upload;
class Upload
{
    private $config;
    public function __construct($config){
        $this->config = $config;
    }
    public function getPath(){
        //{type}/20190101
        $type = \Request::input('type');
        $path = 'default';
        if(isset($this->config['types'][$type]['path'])){
            $path = $this->config['types'][$type]['path'];
        }
        return $path . '/' . date('Y-m-d',time());
    }
}
