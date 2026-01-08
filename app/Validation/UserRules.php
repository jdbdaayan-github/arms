<?php

namespace App\Validation;

use App\Models\User;

class UserRules
{
    /**
     * Check if email exists in database
     *
     * @param string $str     The value of the field
     * @param string|null $fields  The field name (nullable)
     * @param array $data    All form data
     * @return bool
     */
    public function email_exists(string $str, ?string $fields = null, array $data = []): bool
    {
        $user = new User();
        return $user->where('email', $str)->first() ? true : false;
    }
}
