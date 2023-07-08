<?php

use





 $formlol = new SimpleForm(function (Player $player, $data){
            $result = $data;
            if ($result !== null) {
        
                switch ($result) {
                    case 0:
                  
    
                    
                      
                    break;
                }
            }
        });
        $formtitle = $this->getConfig()->get("Admin");
        $formcontent = $this->getConfig()->get("Select your module");
    
       
        $formlol->setTitle($formtitle);
        $formlol->setContent($formcontent);
        $formlol->addButton("§d§lSubmit!");
        $formlol->addButton("§d§lColorMode");
        $player->sendForm($formlol);
    }
