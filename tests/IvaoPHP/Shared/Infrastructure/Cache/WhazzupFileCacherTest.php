<?php


namespace IvaoPHP\Tests\Shared\Infrastructure\Cache;

use IvaoPHP\Shared\Infrastructure\Cache\WhazzupFileCacher;
use IvaoPHP\Tests\Whazzup\Http\HttpFileDownloaderMock;
use PHPUnit\Framework\TestCase;
use IvaoPHP\Whazzup\Dto\Whazzup;

class WhazzupFileCacherTest extends TestCase
{
    public ?Whazzup $whazzupMock = null;
    public ?array $testData = null;

    private function getTestData(): array
    {
        if ($this->testData !== null)
        {
            return $this->testData;
        }

        $fileDownloaderMock = new HttpFileDownloaderMock();
        $fileStr = $fileDownloaderMock->download();
        $this->testData = json_decode($fileStr, true);

        return $this->testData;
    }

    private function getWhazzupMock(): Whazzup
    {
        if ($this->whazzupMock !== null) {
            return $this->whazzupMock;
        }

        $this->whazzupMock = new Whazzup($this->getTestData());

        return $this->whazzupMock;
    }

    /**
     * @covers \IvaoPHP\Shared\Infrastructure\Cache\WhazzupFileCacher::getWhazzupFromCache()
     */
    public function testGetWhazzupFromCache()
    {
        // Create a mock of the Whazzup class
        $mockWhazzup = $this->getWhazzupMock();

        // Create an instance of the WhazzupFileCacher class
        $cacher = new WhazzupFileCacher();
        // Set the mock Whazzup object in the cache
        $cacher->setWhazzupCache($mockWhazzup);
        // Retrieve the object from the cache
        $result = $cacher->getWhazzupFromCache();

        // Assert that the returned object is an instance of the Whazzup class
        $this->assertInstanceOf(Whazzup::class, $result);
        // Assert that the returned object has the expected data
        $this->assertEquals($this->getTestData(), $result->getResponseData());
    }

    /**
     * @covers \IvaoPHP\Shared\Infrastructure\Cache\WhazzupFileCacher::setWhazzupCache()
     */
    public function testSetWhazzupCache()
    {
        // Create a mock of the Whazzup class
        $mockWhazzup = $this->getWhazzupMock();

        // Create an instance of the WhazzupFileCacher class
        $cacher = new WhazzupFileCacher();
        // Set the mock Whazzup object in the cache
        $result = $cacher->setWhazzupCache($mockWhazzup);

        // Assert that the method returned true
        $this->assertTrue($result);
    }

    /**
     * @covers \IvaoPHP\Shared\Infrastructure\Cache\WhazzupFileCacher::clearCache()
     */
    public function testClearCache()
    {
        // Create an instance of the WhazzupFileCacher class
        $cacher = new WhazzupFileCacher();
        // Set a value in the cache
        $cacher->setWhazzupCache($this->getWhazzupMock());
        // Clear the cache
        $result = $cacher->clearCache();

        // Assert that the method returned true
        $this->assertTrue($result);
        // Assert that the cache is now empty
        $this->assertNull($cacher->getWhazzupFromCache());
    }
}
