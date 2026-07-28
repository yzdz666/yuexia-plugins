<?php
/**
 * Plugin Name: Hello World Test
 * Description: AI auto review test plugin - safe example
 * Version: 1.0.0
 */

function hello_world_test_msg($params, $event) {
    $name = isset($params["name"]) ? $params["name"] : "World";
    $safe_name = htmlspecialchars($name, ENT_QUOTES, "UTF-8");
    reply_message("Hello, " . $safe_name . "!");
}

function hello_world_test_admin($params, $event) {
    $role = isset($event["sender"]["role"]) ? $event["sender"]["role"] : "";
    if ($role !== "admin") {
        reply_message("Permission denied");
        return;
    }
    $msg = isset($params["message"]) ? trim($params["message"]) : "";
    if ($msg === "") {
        reply_message("Message cannot be empty");
        return;
    }
    reply_message("Admin: " . htmlspecialchars($msg, ENT_QUOTES, "UTF-8"));
}

plugin_register("hello", "hello_world_test_msg");
plugin_register("hello_admin", "hello_world_test_admin");
