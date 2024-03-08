<?php

/**
 * Calculate the total price of items in a shopping cart.
 *
 * @param array<array{name: string, price: float}> $items An array of items, each with a name and price property.
 * @return float The total price of the items.
 */
function calculate_total_price(array $items): float
{
    $total = 0;
    foreach ($items as $item) {
        $total += $item['price'];
    }
    return $total;
}

/**
 * Modify a string by removing spaces and converting it to lowercase.
 *
 * @param string $string The string to modify.
 * @return string The modified string.
 */
function modify_string(string $string): string
{
    // Remove spaces and convert to lowercase
    $string = str_replace(' ', '', $string);
    $string = strtolower($string);
    return $string;
}

/**
 * Check if a number is even or odd.
 *
 * @param int $number The number to check.
 * @return bool True if the number is even, false otherwise.
 */
function check_even_odd(int $number): bool
{
    if ($number % 2 == 0) {
        return true;
    } else {
        return false;
    }
}

//usage examples:
$items = [
    ['name' => 'Widget A', 'price' => 10],
    ['name' => 'Widget B', 'price' => 15],
    ['name' => 'Widget C', 'price' => 20],
];

$totalPrice = calculate_total_price($items);
echo "Total price: $" . $totalPrice;

$string = "This is a poorly written program with little
structure and readability.";

$modifiedString = modify_string($string);
echo "\nModified string: " . $modifiedString;

$number = 42;

if (check_even_odd($number)) {
    echo "\nThe number " . $number . " is even.";
} else {
    echo "\nThe number " . $number . " is odd.";
}