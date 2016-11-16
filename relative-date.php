<?php

require 'core.php';

/**
 *  Helpfer function relativeDate()
 */

function relativeDate($date, $args = array()) {
  // default for $args
  $defaults = array(
    'lang'      => (count(site()->languages()) >= 1) ? site()->language()->code() : c::get('relativedate.lang', 'en'),
    'length'    => c::get('relativedate.length', 2),
    'threshold' => c::get('relativedate.threshold', false),
    'fuzzy'     => c::get('relativedate.fuzzy', true),
    'format'    => c::get('relativedate.format', 'd.m.Y')
  );
  $args = array_merge($defaults, $args);

  // check if $date is a timestamp
  if (RelativeDate::isTimestamp($date)) {
    $date = date(DATE_ATOM, $date);
  }


  // only convert to relative if time difference no exceeds threshold
  if ($args['threshold'] === false or
      abs(strtotime($date) - time()) <= $args['threshold']) {
    try {
      $relative = new RelativeDate($date, $args);
      $result = $relative->get($args['length']);
    } catch (Exception $e) {
      $result = $date;
    }
  } else {
    $result = $date;
  }

  // if we had no change to date due to any bug or exceeding threshold
  if($result === $date){
    $date   = new Datetime($date);
    $result = $date->format($args['format']);
  }

  return $result;
}


/**
 *  Field method '->relative($lang|$length)'
 */

field::$methods['relative'] = function($field, $args = null) {
    // check for shorthand $args
    if (is_string($args) and strlen($args) >= 2 and strlen($args) <= 5) {
      $args = array('lang' => $args);
    } elseif (is_int($args)) {
      $args = array('length' => $args);
    } else {
      $args = array();
    }

    $field->value = relativeDate($field->value, $args);
    return $field;
};


/**
 *  Kirbytext tag '(relativedate: $date)'
 */

kirbytext::$tags['relativedate'] = array(
  'attr' => array(
      'lang',
      'length',
      'threshold',
      'fuzzy',
      'format'
    ),

  'html' => function($tag) {
    $args = array(
      'lang'      => $tag->attr('lang', (count(site()->languages()) >= 1) ? site()->language()->code() : c::get('relativedate.lang', 'en')),
      'length'    => $tag->attr('length', c::get('relativedate.length', 2)),
      'threshold' => $tag->attr('threshold', c::get('relativedate.threshold', false)),
      'fuzzy'     => $tag->attr('fuzzy', c::get('relativedate.fuzzy', true) === 'false' ? false : true),
      'format'    => $tag->attr('format', c::get('relativedate.format', 'd.m.Y'))
    );

    return relativeDate($tag->attr('relativedate'), $args);
  }
);
