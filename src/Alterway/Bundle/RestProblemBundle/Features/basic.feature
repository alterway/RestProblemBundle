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

  Scenario: Catch http exception with wrong routing
    When I send a GET request to "/dcxw"
    Then the response status code should be 404
    Then the response should contain "/exception"
    Then the response should contain "No route found"

  Scenario: Catch logic exception with throw exception
    When I send a GET request to "/exception"
    Then the response status code should be 500
    Then the response should contain "/exception"
    Then the response should contain "Something went wrong!"