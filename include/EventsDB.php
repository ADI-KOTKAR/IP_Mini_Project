<?php 
    $response = file_get_contents("https://adi-kotkar.github.io/DummyData/techvents-events.json");
    $eventsData = json_decode($response);
    
    $types = array();
    $domains = array();
    
    foreach($eventsData as $event){
        if(!in_array($event->type1, $types)){
            array_push($types, $event->type1);
        }
        if(!in_array($event->type2, $types)){
            array_push($types, $event->type2);
        }
        if(!in_array($event->doamin1, $domains)){
            array_push($domains, $event->doamin1);
        }
        if(!in_array($event->domain2, $domains)){
            array_push($domains, $event->domain2);
        }
    }
    
?>