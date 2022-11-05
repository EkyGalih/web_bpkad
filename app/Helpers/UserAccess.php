<?php

namespace App\Helpers;

use App\Models\Rule;
use Illuminate\Support\Facades\Auth;

class UserAccess
{
    public static function getRule()
    {
        $rule = Rule::where('user_id', '=', Auth::user()->id)
            ->where('aplikasi', '=', 'website')
            ->first();
        if ($rule)
            return $rule->nama_rule;
    }

    public static function getAplikasi()
    {
        return Rule::where('user_id', '=', Auth::user()->id)
            ->where('aplikasi', '=', 'website')
            ->first()->nama_rule;
    }

    public static function showAplikasi()
    {
        return Rule::where('user_id', '=', Auth::user()->id)->get();
    }
}