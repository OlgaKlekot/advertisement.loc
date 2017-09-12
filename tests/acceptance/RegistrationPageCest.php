<?php

class RegistrationPageCest {

    public function _before(AcceptanceTester $I) {
        $I->amOnPage('/registration');
    }
    public function _after(AcceptanceTester $I) {
    }

    // tests
    public function registration(AcceptanceTester $I) {
        $I->wantTo('Register');
        $I->submitForm('.registration', ['userName' => 'James', 'passWord' => '888', 'confirmPassWord' => '888']);
        $I->see('You are successfully registered, please log in!');
    }
    public function registrationExistingUser(AcceptanceTester $I) {
        $I->wantTo('Register existing user');
        $I->submitForm('.registration', ['userName' => 'James', 'passWord' => '888', 'confirmPassWord' => '888']);
        $I->see('Please enter another login, or check whether the password and its confirmation are equal!');
    }
    public function registrationWrongPasswordConfirmation(AcceptanceTester $I) {
        $I->wantTo('Register with wrong password confirmation');
        $I->submitForm('.registration', ['userName' => 'someone', 'passWord' => '123', 'confirmPassWord' => '122']);
        $I->see('Please enter another login, or check whether the password and its confirmation are equal!');
    }
}