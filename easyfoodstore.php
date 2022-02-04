<?php
/*
Plugin Name: Easy Food Store
description: Der Easy Food Store bietet einem die Möglichkeit über die eigene Webseite eine Interaktive Speisekarte einzubinden. Sie bietet ein Bestellformular für Kunden, mit Login zur Beschleunigung des Bestellvorganges durch speichern von Favoriten, Lieferadressen und Bezahloptionen. Die Verwaltung bietet die Möglichkeit Bestellungen einzusehen, sowie Speisekarte und Bezahloptionen zu verwalten.
Version: DEV-0.2
Autor: Robin Schneider
*/
//Erstmal ein Testcode zum üben

//Grundgerüst des Plugins, ohne Bereichsbezogene Funktionen
//ABSPATH muss in der wp-config.php gesetzt sein - Sicherheit, Datei kann nicht auserhalb einer WordPress Instanz ausgefürt werden
defined( 'ABSPATH' ) or die ( 'Are you ok?' );

$start_reminder = new UpdateReminder();

class UpdateReminder{
	public function __construct(){
		register_activation_hook( __FILE__, array( $this, 'updateReminder_activate' ));
		register_deactivation_hook( __FILE__, array( $this, 'updateReminder_deactivation' ));
		add_action( 'updateReminderEvent', array( $this, 'getUpdateStatus' ));
	}
}

public function getUpdateStatus(){
	$status = wp_get_update_date();
}

//WordPress Cron Event Aktivieren
public function updateReminder_activate(){
	if (! wp_next_scheduled ( 'updateReminderEvent' ) ) {
		wp_schedule_event(time(), 'daily', 'updateReminderEvent');
	}
}

//WordPress Cron Event Deaktivieren
public function updateReminder_deactivation(){
	if( wp_next_scheduled( 'updateReminderEvent' )){
		wp_clear_scheduled_hook( 'updateReminderEvent' );
	}
}
//Funktionsgerüst des Plugins



?>