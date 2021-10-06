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


## Testing

In order to run the tests, just call:

    bin/phpunit


## Constraint
1. For this MVP we are supposing that a customer in the system already exists and we have both email address and phone number. Of course this is a product decision and we may change the validation to comply with the system requirement.
2. More validation rules can be applied to the messages (for example a maximum length or similar)

3. No authentication/authorization has been implemented at this stage, but of course we cannot deploy this in production without proper authentication and/or authorization
4. Integration testing is not complete, we should test more cases and also test the responses