<?php

namespace App\Enums;

enum UserRole: string {
    case INSTRUCTOR = 'INSTRUCTOR';
    case ADMIN = 'ADMIN';
    case USER = 'USER';
}
