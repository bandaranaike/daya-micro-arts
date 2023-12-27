<?php

namespace App\Config;

enum PermissionEnum: string
{
    case CREATE_ART = 'create-art';
    case EDIT_ART = 'edit-art';
    case DELETE_ART = 'delete-art';
}
