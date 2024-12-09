<?php
interface IMessenger{
    
    public function send(string $destinataire,string $body, string $subject) : bool;
} 