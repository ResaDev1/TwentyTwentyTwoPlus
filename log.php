<?php

/**
 * Impl log system to plugin
 * version: 1.0.0
 */
class Log {

    /**
     * Messages Array
     * Stores all Logs
     * 
     * Cant be a null.
     */
    public array $messages = array();

    /**
     * Push message to log
     */
    public function push(string $status, string $message): void {
        // Generate message an push to messages array
        $new_message = "[ " . $status . " ] : " . $message;

        array_push($this->messages, $new_message);
    }
}

?>