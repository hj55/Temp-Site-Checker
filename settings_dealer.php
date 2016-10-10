<?php

if (!isset($_GET['ip']) || !isset($_GET['path'])) die ();

$ip = $_GET['ip'];
$path = $_GET['path'];


$default['skipDirectories'] = array_filter(file ('directoriesToSkipFromControl.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES ),'removeComments');

$default['skipFiles'] = array_filter(file ('filesToSkipFromControl.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES ),'removeComments');

$default['skipExtensions'] = array_filter(file ('extensionsToSkipFromControl.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES ),'removeComments');

$default['dangerousPatterns'] = array_filter(file ('dangerousPatterns.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES ),'removeComments');

$default['path'] = '';

$default['checkFile'] = 'check.txt';

$default['logFile'] = 'logs.txt';

$default['emailAddress'] = 'your@mail.com';

$default['emailSubject'] = "Check integrity at - ". $default['path'];

$default['sendDebugEmail'] = true;

$default['debugEmailAddress'] = 'your@mail.com';

$default['setQuarantine'] = false;

$default['extQuarantine'] = 'quarantine';

$settings = array (

    'default' => $default,
   

    '123.123.123.123' => array (


        'path-1' => array (

            'skipDirectories' => array (
                'directory-1',
                'directory-2/directory-3'
            ),

            'skipFiles' => array (
                'file-1',
                'dir/file-2'
            ),

            'skipExtensions' => array (

                'ext1',
                'ext2'

            ),

            'dangerousPatterns' => $default['dangerousPatterns'],

            'path' => '',

            'checkFile' => '',

            'logFile' => '',

            'emailAddress' => '',

            'emailSubject' => '',

            'sendDebugEmail' => false,

            'debugEmailAddress' => '',

            'setQuarantine' => true,

            'extQuarantine' => '.quarantine'
        ),


        'path-2' => array ()
    ),



    '321.321.321.321' => array ()
);

echo json_encode (array_key_exists($path, $settings[$ip]) ? $settings[$ip][$path] : $settings['default']);


function removeComments($string) {
  return strpos($string, '#') === false;
}
