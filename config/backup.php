<?php

return [
    'backup' => [
        /*
         * The name of this application. You can use this name to monitor
         * the backups.
         */
        'name' => env('APP_NAME', 'laravel-backup'),

        'source' => [
            'files' => [
                /*
                 * The list of directories and files that will be included in the backup.
                 */
                'include' => [
                    storage_path('app/public'),
                ],

                /*
                 * These directories and files will be excluded from the backup.
                 *
                 * Directories used by the backup process will automatically be excluded.
                 */
                'exclude' => [],

                /*
                 * Determines if symlinks should be followed.
                 */
                'follow_links' => false,

                /*
                 * Determines if it should avoid unreadable folders.
                 */
                'ignore_unreadable_directories' => false,

                /*
                 * This path is used to make directories in resulting zip-file relative
                 * Set to `null` to include complete absolute path
                 * Example: base_path()
                 */
                'relative_path' => null,
            ],

            /*
             * The names of the connections to the databases that should be backed up
             * MySQL, PostgreSQL, SQLite and Mongo databases are supported.
             *
             * The content of the database dump may be customized for each connection
             * by adding a 'dump' key to the connection settings in config/database.php.
             * E.g.
             * 'mysql' => [
             *     ...
             *     'dump' => [
             *         'excludeTables' => [
             *             'table_to_exclude_from_backup',
             *             'another_table_to_exclude'
             *         ]
             *     ],
             * ],
             *
             * If you are using only InnoDB tables on a MySQL server, you can
             * also supply the useSingleTransaction option to avoid table locking.
             *
             * E.g.
             * 'mysql' => [
             *     ...
             *     'dump' => [
             *         'useSingleTransaction' => true,
             *     ],
             * ],
             *
             * For a complete list of available customization options, see https://github.com/spatie/db-dumper
             */
            'databases' => [
                env('DB_CONNECTION', 'mysql'),
            ],
        ],

        /*
         * The database dump can be compressed to decrease disk space usage.
         *
         * Out of the box Laravel-backup supplies
         * Spatie\DbDumper\Compressors\GzipCompressor::class.
         *
         * You can also create custom compressor. More info on that here:
         * https://github.com/spatie/db-dumper#using-compression
         *
         * If you do not want any compression, set it to null.
         */
        'database_dump_compressor' => null,

        /*
         * The file extension used for the database dump files.
         *
         * If not specified, the file extension will be .sql for all databases
         * except for MongoDB which will use .archive.
         */
        'database_dump_file_extension' => '',

        /*
         * The file name of the database dump.
         *
         * If not specified, a base name will be generated from the database name.
         */
        'database_dump_filename_base' => null,

        'destination' => [
            /*
             * The filename prefix used for the backup zip file.
             */
            'filename_prefix' => 'backup-',

            /*
             * The disk names on which the backups will be stored.
             */
            'disks' => [
                'local',
            ],
        ],

        /*
         * You can get notified when specific events occur. Out of the box you can use 'mail' and 'slack'.
         * For Slack you need to install `laravel/slack-notification-channel`.
         *
         * You can also use your own notification classes, just make sure the class is named after one of
         * the `Spatie\Backup\Events` classes.
         */
        'notifications' => [
            'notifications' => [
                \Spatie\Backup\Notifications\Notifications\BackupHasFailedNotification::class => ['mail'],
                \Spatie\Backup\Notifications\Notifications\UnhealthyBackupWasFoundNotification::class => ['mail'],
                \Spatie\Backup\Notifications\Notifications\CleanupHasFailedNotification::class => ['mail'],
                \Spatie\Backup\Notifications\Notifications\BackupWasSuccessfulNotification::class => ['mail'],
                \Spatie\Backup\Notifications\Notifications\HealthyBackupWasFoundNotification::class => ['mail'],
                \Spatie\Backup\Notifications\Notifications\CleanupWasSuccessfulNotification::class => ['mail'],
            ],

            /*
             * Here you can specify the notifiable to which the notifications should be sent. The default
             * notifiable will use the variables specified in this config file.
             */
            'notifiable' => \Spatie\Backup\Notifications\Notifiable::class,

            'mail' => [
                'to' => 'your@example.com',

                'from' => [
                    'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
                    'name' => env('MAIL_FROM_NAME', 'Example'),
                ],
            ],

            'slack' => [
                'webhook_url' => '',

                /*
                 * If this is set to null the default channel of the webhook will be used.
                 */
                'channel' => null,

                'username' => null,

                'icon' => null,
            ],
        ],

        /*
         * Here you can specify which backups should be monitored.
         * If a backup does not meet the required criteria the
         * UnHealthyBackupWasFound event will be fired.
         */
        'monitor_backups' => [
            [
                'name' => env('APP_NAME', 'laravel-backup'),
                'disks' => ['local'],
                'health_checks' => [
                    \Spatie\Backup\Tasks\Monitor\HealthChecks\MaximumAgeInDays::class => 1,
                    \Spatie\Backup\Tasks\Monitor\HealthChecks\MaximumStorageInMegabytes::class => 5000,
                ],
            ],
        ],

        'cleanup' => [
            /*
             * The strategy that will be used to clean up old backups. The default strategy
             * will keep all backups for a certain amount of days. After that period only
             * a daily backup will be kept. After that period only weekly backups will
             * be kept and so on.
             *
             * No matter how you configure it the default strategy will never
             * delete the newest backup.
             */
            'strategy' => \Spatie\Backup\Tasks\Cleanup\Strategies\DefaultStrategy::class,

            'default_strategy' => [
                /*
                 * The number of days for which backups must be kept.
                 */
                'keep_all_backups_for_days' => 0,

                /*
                 * The number of days for which daily backups must be kept.
                 */
                'keep_daily_backups_for_days' => 16,

                /*
                 * The number of weeks for which weekly backups must be kept.
                 */
                'keep_weekly_backups_for_weeks' => 8,

                /*
                 * The number of months for which monthly backups must be kept.
                 */
                'keep_monthly_backups_for_months' => 4,

                /*
                 * The number of years for which yearly backups must be kept.
                 */
                'keep_yearly_backups_for_years' => 2,

                /*
                 * After cleaning up the backups remove the oldest backup until
                 * this amount of megabytes has been reached.
                 */
                'delete_oldest_backups_when_using_more_megabytes_than' => 5000,
            ],
        ],
    ],
];
