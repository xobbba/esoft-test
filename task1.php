<?php

class ObjectUtils
{
    /**
     * @param array $a
     * @param array $b
     * @return int
     */
    private static function comparePrice($a, $b)
    {
        $priceForSquareA = $a['price'] / $a['area'];
        $priceForSquareB = $b['price'] / $b['area'];

        if ($priceForSquareA > $priceForSquareB) {
            return 1;
        } elseif ($priceForSquareA === $priceForSquareB) {
            return 0;
        } else {
            return -1;
        }
    }

    /**
     * @param array $objects
     * @return array
     */
    public static function getLiquidObject($objects)
    {
        $result = [];
        foreach ($objects as $object) {
            if ($object['floor'] === 1 || $object['floor'] === $object['floors']) {
                continue;
            }

            $rooms = $object['rooms'];
            $top = !empty($result[$rooms]) ? $result[$rooms] : [];
            $top[] = $object;

            $result[$rooms] = $top;
        }

        foreach ($result as $key => $value) {
            $tmp = $value;
            usort($tmp, 'comparePrice');
            $result[$key] = $tmp;
        }

        return $result;
    }
}


print_r(ObjectUtils::getLiquidObject([
    [
        'id' => 1,
        'floor' => 4,
        'floors' => 4,
        'rooms' => 2,
        'area' => 55.25,
        'price' => 5000,
    ], [
        'id' => 2,
        'floor' => 3,
        'floors' => 4,
        'rooms' => 2,
        'area' => 45.25,
        'price' => 5000,
    ], [
        'id' => 3,
        'floor' => 3,
        'floors' => 4,
        'rooms' => 2,
        'area' => 65.25,
        'price' => 5000,
    ]

]));

