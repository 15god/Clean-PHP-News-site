<?php

use Models\Profile;

class ProfileController {
    
    public function show() {

        view("profile.view.php", [
            "siteTitle" => "Профиль",
        ]);
    }
    
    public function update() {

        Profile::changeProfilePic();
        
        header("Location: /profile");
   }
}
