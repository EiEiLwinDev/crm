<?php

use App\Models\User;

if (!function_exists('generateUniqueId')) {
  function generateUniqueId($prefix)
  {
      $latestRecord = User::where('customer_id', 'like', "{$prefix}_" . date('Y') . "_%")
          ->orderBy('customer_id', 'desc')
          ->first();
      if ($latestRecord) {
          [$prefix, $year, $number] = explode('_', $latestRecord->customer_id);
          $nextNumber = str_pad(((int) $number) + 1, 5, '0', STR_PAD_LEFT);
          return "{$prefix}_{$year}_{$nextNumber}";
      }else {
        $latestId = "{$prefix}_" . date('Y') . "_00000";
        return $latestId;
      }
  }
}