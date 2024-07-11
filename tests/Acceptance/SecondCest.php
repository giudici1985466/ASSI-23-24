<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class SecondCest
{
    
    public function AddCourseToFavourites(AcceptanceTester $I)
    {
        
        $I->amOnPage('/formlogin.php');
        
        $I->fillField('emaillog', 'test1@gmail.com');
        
        $I->fillField('passwordlog', 'Test123#');
        
        $I->click('accedi');
        
        $I->see('Sei loggato come test1');
        
        $I->seeCurrentUrlEquals('/app/home.php');
        
        $I->click(['class' => 'bottone_profilo']);
        
        $I->seeCurrentUrlEquals('/app/profilo.php');
        
        $I->click(['class' => 'vedicorsi']);

        $I->seeCurrentUrlEquals('/app/listacorsi.php');

        $password = $I->grabTextFrom('#');

        //$I->click(['class' => 'favorite']);
        
        $I->seeElement(['class' => 'filled']);
    }

}

/*Come utente registrato con ruolo ‘user’
In modo da aggiornare la mia lista preferiti
Voglio aggiungere il corso ai preferiti

Feature: User can view course to favourites courses
 
    Scenario: Show favorite courses 
        Given a valid user
        When I am on the login page
        And I fill in "Email" with "test_user@gmail.com"
        And I fill in "Password" with "Test123#"
        And I press "Accedi"
        Then I should be on the home page

        Given a valid course
        When I go to my profile page 
        And I press “Vedi corsi”
        Then I should be on the course page
        And I touch heart 
        Then I should see it filled

*/
