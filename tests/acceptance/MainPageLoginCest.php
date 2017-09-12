<?php


class MainPageLoginCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/registration');
        $I->submitForm('.registration', ['userName' => 'Sean', 'passWord' => '777', 'confirmPassWord' => '777']);
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function login(AcceptanceTester $I)
    {
        $I->expect('entering');
        $I->amOnPage('/');
        $I->submitForm('.log_in', ['username'=>'Sean', 'password'=>'777']);
        $I->see('Hi, Sean!');
    }

    public function loginWrongPassword(AcceptanceTester $I)
    {
        $I->expect('error');
        $I->amOnPage('/');
        $I->submitForm('.log_in', ['username'=>'Sean', 'password'=>'778']);
        $I->see('Username or password are incorrect');
    }
    public function loginWrongUsername(AcceptanceTester $I)
    {
        $I->expect('error');
        $I->amOnPage('/');
        $I->submitForm('.log_in', ['username'=>'Seany', 'password'=>'888']);
        $I->see('Username or password are incorrect');
    }
}
