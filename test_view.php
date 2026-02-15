<?php

// Test if view exists
$viewPath = resource_path('views/filament/member/resources/programs/view.blade.php');
echo 'File exists: '.(file_exists($viewPath) ? 'YES' : 'NO')."\n";
echo 'File size: '.filesize($viewPath)." bytes\n";
echo 'First 100 chars: '.substr(file_get_contents($viewPath), 0, 100)."\n";
