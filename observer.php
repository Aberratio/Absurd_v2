<?php

        class SetObserver implements SplObserver {    
            public function update(SplSubject $subject) {        
                echo "Dodano nowy set";    
            }
        }
        
        class TestObserver implements SplObserver {   
            public function update(SplSubject $subject) {
                echo "Rozwiązano test";    
            }
        }
                         
        class RankingObserver implements SplObserver {    
            public function update(SplSubject $subject) {       
                echo "Zmiana w rankingu graczy";
            }   
        }     

        class News implements SplSubject {    
            private $observers = array();    
            public function attach(SplObserver $observer) {        
                $this->observers[spl_object_hash($observer)] = $observer;    
            }   
            
            public function detach(SplObserver $observer) {        
                unset($this->observers[spl_object_hash($observer)]);    
            }    
            
            public function notify() {        
                foreach ($this->observers as $observer) {            
                    $observer->update($this);        
                }    
            }    
            
            public function add($data) {        
                echo 'Dodaje news do bazy';        
                $this->notify();
            }
        }
        
        $news = new News();
        $news->attach(new SetObserver());
        $news->attach(new TestObserver());
        $news->attach(new RankingObserver());
?>

