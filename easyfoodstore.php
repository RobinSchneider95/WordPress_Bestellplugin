<?php
/*
Plugin Name: Easy Food Store
Beschreibung: Ein Plugin zur Einbindung einer Bestelloberfläche für fertige Gerichte
Version: 0.1
Autor: Robin Schneider
*/

defined('ASPATH') or die ('Are you ok?' );

$start_store = new StoreOrder();

class StoreOrder{
  public function __construct() {
  
  }  
}

register_activation_hook(__FILE__, array($this, 'StoreOrder_activate'));

public function StoreOrder_activate(){
  if (!wp_next_scheduled('StoreOrderEvent')){
      wp_schedule_event(time(), 'daily', 'StoreOrderEvent');
  }
}

?>