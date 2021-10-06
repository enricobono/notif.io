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
