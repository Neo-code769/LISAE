<?php

    class Collaborator extends User {
        
        public function subscribe() {
            //TODO
        }

        public function unsubscribe() {
            //TODO
        }

        public function get_role(){
            return get_class($this);
        }
    }

?>