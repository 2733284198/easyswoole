<?php


namespace EasySwoole\EasySwoole\Test;


use EasySwoole\EasySwoole\Config;
use EasySwoole\EasySwoole\Logger;
use EasySwoole\Log\Logger as DefaultLogger;
use EasySwoole\Utility\File;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    protected $logPath;
    function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $logPath = getcwd().'/temp';
        $result = File::createDirectory($logPath);
        $this->assertTrue(!!$result);
        $this->logPath=$logPath;
    }

    function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
        $result = File::deleteDirectory($this->logPath);
        $this->assertTrue(!!$result);
    }


    function testLog()
    {
        $logger = new DefaultLogger($this->logPath);
        $msg='test';
        $logLevel=Logger::LOG_LEVEL_INFO;
        $category='category';
        $loggerHandel = new Logger($logger);
        $loggerHandel->onLog()->set('onLog',function ($msg2,$logLevel2,$category2)use($msg,$logLevel,$category){
            $this->assertEquals($msg,$msg2);
            $this->assertEquals($logLevel,$logLevel2);
            $this->assertEquals($category,$category2);
        });
        $loggerHandel->log($msg,$logLevel,$category);
    }


}