<?php

return [
    /*
     * The webhook URLs that we'll use to send a message to Slack.
     */
    'webhook_urls' => [
        'default' => 'https://hooks.slack.com/services/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',
    ],

    /*
     * This job will send the message to Slack. You can extend this
     * job to set timeouts, retries, etc...
     */
    'job' => Spatie\SlackAlerts\Jobs\SendToSlackChannelJob::class,
];
