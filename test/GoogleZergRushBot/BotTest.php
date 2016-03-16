<?php

class BotTest extends PHPUnit_Framework_TestCase
{
    public function testBot()
    {
        $driver = RemoteWebDriver::create(
            'http://localhost:4444/wd/hub',
            array(
                WebDriverCapabilityType::BROWSER_NAME => 'firefox'
            )
        );

        $driver->get('http://www.google.de');
        $searchField = $driver->findElement(WebDriverBy::name('q'));
        $searchField->sendKeys('zerg rush');
        $searchField->sendKeys(WebDriverKeys::ENTER);

        while (true) {
            $zerlings = $driver->findElements(WebDriverBy::className('zr_zergling_container'));

            foreach ($zerlings as $zerling) {
                try {
                    $zerling->click();
                } catch (Exception $e) {
                    continue;
                }
            }

            sleep(0.2);
        }
    }
}
