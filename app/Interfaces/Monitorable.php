<?php

namespace App\Interfaces;

interface Monitorable {
    public function getStatusLabel(); 
    public function getStatusColor();
}