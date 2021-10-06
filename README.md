# notif.io
A simple notification service.


## What's up

This service is designed to allow a client to send notification messages.


## Problem

This PR creates a service that accepts the necessary information and sends a notification to customers. It uses 2 different messaging services:
- SMS
- Email
If one of the services goes down, the service can fail-over to a different provider without affecting your customers.

The service can:
- Send a message to multiple channels
- fail-over to a secondary channel in case the primary channel fails
- Be configured via proper configuration files


## Strategy
The system is composed by the following API:
    
    POST /notification

with the following params:

    email_address: <string>
    phone_number: <string>
    title: <string>
    body: <string>
    channels: <string> (list of channels. Current active channels: 'email', 'sms'. Example: 'channels:email,sms')
    fail_over_channels: <string>

If some input field does not pass the validation, the API will respond with a 400 error and a proper error message, with the following json structure:

    {"error":{"errors":["Email address is not valid"]}}

Otherwise, a standard 201 will be returned.


Given we want to be able to scale this service, the service will accept the message and save it to a queue for later processing.
In order to process the queue, a worker should call the following command:

    php bin/console messenger:consume async


## Testing

In order to run the tests, just call:

    bin/phpunit

For smoke testing, you can use the following `cURL` call:
    
    curl -X POST \
    -F 'email_address=test@example.com' \
    -F 'phone_number=+393491234567' \
    -F 'title=Order shipped' \
    -F 'body=Your order #123 has been shipped' \
    -F 'channels=sms' \
    -F 'fail_over_channels=email' \
    http://127.0.0.1:8000/notification -v

This will return a 201 code.


To test an error, you can use the following `cURL` call:

    curl -X POST \
    -F 'email_address=invalid-email-address' \
    -F 'phone_number=+393491234567' \
    -F 'title=Order shipped' \
    -F 'body=Your order #123 has been shipped' \
    -F 'channels=sms' \
    -F 'fail_over_channels=email' \
    http://127.0.0.1:8000/notification -v

This will return a 400 code and an error message


## MVP constraints
1. For this MVP we are supposing that a customer in the system already exists and we have both email address and phone number. Of course this is a product decision and we may change the validation to comply with the system requirement.
2. More validation rules can be applied to the messages (for example a maximum length or similar)
3. No authentication/authorization has been implemented at this stage, but of course we cannot deploy this in production without proper authentication and/or authorization


## To be completed
1. Integration testing is not complete, we should test more cases and also test the responses
2. I was not able to connect to the database, so the full process is not tested yet. Unfortunately that also mean an integration test is failing