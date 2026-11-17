<?php
/**
 * VAANAKAM COMPREHENSIVE COLOR FIX
 * Replaces ALL old Arigato amber/gold colors with Vaanakam Navy/Green palette
 * across every PHP, CSS file in the project.
 *
 * Color mapping:
 *   OLD AMBER/GOLD → NEW VAANAKAM
 *   #E0A810 (amber primary)        → #16A34A  (green primary)
 *   #D49A0A (amber dark)           → #15803D  (green dark)
 *   #C48A0A (amber darker)         → #166534  (green darker)
 *   #E5A91A (amber accent)         → #22C55E  (green bright)
 *   #D4A017 (amber product)        → #16A34A  (green primary)
 *   #c9a96e (warm tan star)        → #F59E0B  (amber star — keep for stars only)
 *   #c9a96e → actually replace with #FBBF24 (yellow star rating - fine to keep)
 *   #FFF3D6 (amber light bg)       → #F0FDF4  (green soft bg)
 *   #FFE8A8 (amber lighter bg)     → #DCFCE7  (green light bg)
 *   #FFF8E6 (amber soft bg)        → #F0FDF4  (green soft bg)
 *   var(--purple-lavender, #FFE8A8) → keep but update value
 *   #FFE8A8 in var fallback        → #DCFCE7
 *   #FFF3D6 in var fallback        → #F0FDF4
 *
 * For grocery theme:
 *   Stars rating color stays warm (#FBBF24 / amber-yellow) — that's intentional
 *   Deal/sale/badge red (#ef4444) stays — discount badges
 */

$root = 'D:/Chandila/XAMP/htdocs/Vaanakam';

// Files to process (PHP views, CSS, admin PHP)
$patterns = [
    $root . '/assets/css/*.css',
    $root . '/views/*.php',
    $root . '/views/partials/*.php',
    $root . '/admin/*.php',
    $root . '/admin/partials/*.php',
];

// Color replacements — ORDER MATTERS (longest/most specific first)
$replacements = [
    // === OLD AMBER COLORS → VAANAKAM GREEN ===
    '#E0A810'           => '#16A34A',
    '#E0a810'           => '#16A34A',
    '#d4a810'           => '#16A34A',
    '#D4A017'           => '#16A34A',
    '#d4a017'           => '#16A34A',
    '#E5A91A'           => '#22C55E',
    '#e5a91a'           => '#22C55E',
    '#D49A0A'           => '#15803D',
    '#d49a0a'           => '#15803D',
    '#C48A0A'           => '#166534',
    '#c48a0a'           => '#166534',
    '#8A6508'           => '#14532D',
    '#B8860B'           => '#16A34A',
    '#b8860b'           => '#16A34A',
    // Warm tan (product stars) — keep as proper star yellow
    '#c9a96e'           => '#FBBF24',
    // === OLD AMBER BACKGROUND TINTS → VAANAKAM GREEN TINTS ===
    '#FFF3D6'           => '#F0FDF4',
    '#fff3d6'           => '#F0FDF4',
    '#FFE8A8'           => '#DCFCE7',
    '#ffe8a8'           => '#DCFCE7',
    '#FFF8E6'           => '#F0FDF4',
    '#fff8e6'           => '#F0FDF4',
    '#FFFBEB'           => '#F0FDF4',
    '#fffbeb'           => '#F0FDF4',
    // Map amber in CSS variable fallback values
    "var(--purple-lavender, #FFE8A8)" => "var(--vaanakam-green-light, #DCFCE7)",
    "var(--purple-lavender, #FFF3D6)" => "var(--vaanakam-green-soft, #F0FDF4)",
    // === FOOTER MAP BUTTON (amber) → GREEN ===
    // Already using #E0A810 above
    // === SUBSCRIBE MODAL BUTTON (amber) → NAVY/GREEN ===
    // Already using #E0A810 above
    // Inline style amber occurrences
    'color: #E0A810'    => 'color: #16A34A',
    'color:#E0A810'     => 'color:#16A34A',
    'background: #E0A810' => 'background: #16A34A',
    'background:#E0A810'  => 'background:#16A34A',
    'color: #D4A017'    => 'color: #16A34A',
    'color:#D4A017'     => 'color:#16A34A',
    'background: #D4A017' => 'background: #16A34A',
    'background:#D4A017'  => 'background:#16A34A',
];

$totalFiles = 0;
$modifiedFiles = 0;
$totalReplacements = 0;

foreach ($patterns as $pattern) {
    foreach (glob($pattern) as $file) {
        $totalFiles++;
        $original = file_get_contents($file);
        $content = $original;
        $count = 0;

        foreach ($replacements as $old => $new) {
            $before = $content;
            $content = str_replace($old, $new, $content);
            if ($content !== $before) {
                $count += substr_count($before, $old);
            }
        }

        if ($content !== $original) {
            file_put_contents($file, $content);
            $modifiedFiles++;
            $totalReplacements += $count;
            echo "  ✓ " . basename($file) . " ($count replacements)\n";
        }
    }
}

echo "\n=== DONE ===\n";
echo "Files scanned:   $totalFiles\n";
echo "Files modified:  $modifiedFiles\n";
echo "Total replacements: $totalReplacements\n";
