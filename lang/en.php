<?php

return array(

    'sec'   => array('1 second', '|:count| seconds'),
    'min'   => array('1 minute', '|:count| minutes'),
    'h'     => array('1 hour',   '|:count| hours'),
    'd'     => array('1 day',    '|:count| days'),
    'w'     => array('1 week',   '|:count| weeks'),
    'm'     => array('1 month',  '|:count| months'),
    'y'     => array('1 year',   '|:count| years'),

    'meta'  => array(
                'after_now'     => '|:phrase| from now',
                'before_now'    => '|:phrase| ago',
                'next'          => 'next |:reference|',
                'last'          => 'last |:reference|',
                ),

    'fuzzy' => array(
                'today' => 'today',
                '1day'  => array('tomorrow','yesterday'),

                'Mon'   => 'Monday',
                'Tue'   => 'Tuesday',
                'Wed'   => 'Wednesday',
                'Thu'   => 'Thursday',
                'Fri'   => 'Friday',
                'Sat'   => 'Saturday',
                'Sun'   => 'Sunday',

                'week'  => 'week',
                'month' => 'month',
                ),

    'supports' => 1.0,
    'author'   => 'distantnative (https://github.com/distantnative)'
);
