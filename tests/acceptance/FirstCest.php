<?php


class FirstCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php');
        $I->see('Онлайн менеджер для истинных любителей хоккея!', 'h1');
    }
}
