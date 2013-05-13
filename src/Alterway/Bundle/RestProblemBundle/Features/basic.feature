Feature: Basic request with errors

  Scenario: Get a 400 without annotation
    When I send a POST request to "/user/edit/1" with:
     | name         |  jeff    |
     | email        |  jeff    |
    Then the response status code should be 400
    Then the response should contain "This value is not a valid email address"


  Scenario: Get a 400 without annotation, only one error
    When I send a POST request to "/user/edit/1" with:
     | name         |  jeff              |
     | email        |  email@email.fr    |
    Then the response status code should be 400
    Then the response should not contain "This value is not a valid email address"


  Scenario: Get a 400 without annotation, with listener
    When I send a POST request to "/user/edit/direct" with:
     | name         |  jeff              |
     | email        |  email             |
    Then the response status code should be 400
    Then the response should contain "This value is not a valid email address"