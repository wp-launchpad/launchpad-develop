<?php

namespace LaunchpadAjax;

use LaunchpadCore\Container\PrefixAware;
use LaunchpadCore\Container\PrefixAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareTrait;
use ReflectionClass;

class Subscriber implements PrefixAwareInterface, DispatcherAwareInterface
{
    use PrefixAware, DispatcherAwareTrait;

    /**
     * @hook $prefixcore_subscriber_events
     */
    public function parse_ajax_annotations($events, $classname) {

        if(! is_array($events)) {
            return $events;
        }

        $methods          = get_class_methods( $classname );
        $reflection_class = new ReflectionClass( $classname );

        foreach ( $methods as $method ) {
            $method_reflection   = $reflection_class->getMethod( $method );
            $doc_comment         = $method_reflection->getDocComment();
            if ( ! $doc_comment ) {
                continue;
            }
            $pattern = '#@ajax\s(?<name>[a-zA-Z\\\-_$/]+)(\s(?<priority>[0-9]+))?(\s(?<private>no-private))?#';

            preg_match_all( $pattern, $doc_comment, $matches, PREG_PATTERN_ORDER );
            if ( ! $matches ) {
                continue;
            }


            foreach ( $matches[0] as $index => $match ) {

                $base_hook = $matches['private'][$index] ? 'wp_ajax_nopriv_': 'wp_ajax_';

                $hook = "{$base_hook}{$matches['name'][ $index ]}";
                $hook = str_replace( '$prefix', $this->prefix, $hook );
                $hook = $this->dispatcher->apply_string_filters("{$this->prefix}core_subscriber_event_hook", $hook, $classname);

                $events[ $hook ][] = [
                    $method,
                    key_exists( 'priority', $matches ) && key_exists( $index, $matches['priority'] ) && '' !== $matches['priority'][ $index ] ? (int) $matches['priority'][ $index ] : 10,
                    $method_reflection->getNumberOfParameters(),
                ];
            }
        }

        return $events;
    }
}