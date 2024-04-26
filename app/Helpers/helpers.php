<?php

use App\Models\User\UserPermission;

function Permission($excerpt)
{
    $permission = new UserPermission();

    return !empty($permission->where([
        'role' => auth()->user()->role,
        'permission_excerpt' => $excerpt
    ])->first());
}
