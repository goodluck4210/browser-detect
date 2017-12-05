<?php

namespace hisorange\BrowserDetect\Test\Stages;

use hisorange\BrowserDetect\Result;
use hisorange\BrowserDetect\Stages\CrawlerDetect;
use hisorange\BrowserDetect\Test\TestCase;

/**
 * Test the CrawlerDetect stage.
 *
 * @package            hisorange\BrowserDetect\Test\Stages
 * @coversDefaultClass hisorange\BrowserDetect\Stages\CrawlerDetect
 */
class CrawlerDetectTest extends TestCase
{
    /**
     * @dataProvider provideAgents
     *
     * @covers ::__invoke()
     *
     * @param string $agent
     * @param bool   $expected
     */
    public function testInvoke($agent, $expected)
    {
        $stage  = new CrawlerDetect;
        $result = new Result($agent);

        $stage($result);

        $this->assertSame($expected, $result->offsetGet('isBot'), sprintf('User agent "%s" failing the crawler test.', $agent));
    }

    /**
     * Simple agents to test the crawler stage.
     *
     * @return array
     */
    public function provideAgents()
    {
        return [
            ['NotGoingToMatch', false],
            ['GoogleBot', true],
            ['Yahoo Crawler', true],
        ];
    }
}
