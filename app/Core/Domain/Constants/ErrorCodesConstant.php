<?php

namespace App\Core\Domain\Constants;
enum ErrorCodesConstant: string
{
    case SESSION_MISSING = 'SESSION_MISSING';
    case USER_NOT_FOUND = 'USER_NOT_FOUND';
    case INVALID_CREDENTIALS = 'INVALID_CREDENTIALS';
}
