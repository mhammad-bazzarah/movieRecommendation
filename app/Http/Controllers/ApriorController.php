<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApriorController extends Controller
{
    public static $numOfUsers = 10;
    const min_supp_count = 5;
    function index()
    {


        // $transactions = Cache::remember('transactions', 300, function () use($numOfUsers) {
        //     return $this->getTransactions($numOfUsers);
        // });
        $transactions = Cache::remember('transactions', 10, function () {
            return $this->getTransactions(10);
        });
        // $l1 = $this->level_1($transactions);
        // $l2 = $this->level_2($transactions, $l1);
        // $l3 = $this->generateJoins($transactions, $l2, self::min_supp_count, 3);
        // $l4 = $this->generateJoins($transactions, $l3, self::min_supp_count, 4);
        // $l5 = $this->generateJoins($transactions, $l4, self::min_supp_count, 5);
        // $l6 = $this->generateJoins($transactions, $l5, self::min_supp_count, 6);
        // $l7 = $this->generateJoins($transactions, $l6, self::min_supp_count, 7);
        // $l8 = $this->generateJoins($transactions, $l7, self::min_supp_count, 8);
        // $l9 = $this->generateJoins($transactions, $l8, self::min_supp_count, 9);
        // $l10 = $this->generateJoins($transactions, $l9, self::min_supp_count, 10);
        // $l11 = $this->generateJoins($transactions, $l10, self::min_supp_count, 11);
        // $l12 = $this->generateJoins($transactions, $l11, self::min_supp_count, 12);

        $result = $this->getRulesArray($transactions);

        return view('frontend.aprior', compact('transactions', 'result'));
    }
    function getTransactions(int $numOfUsers)
    {
        $users = User::take($numOfUsers)->get();
        $transactions = [];
        foreach ($users as $user) {
            $userFavourites = [];
            $ratings  = $user->ratings;
            foreach ($ratings as $rate) {
                if ($rate->rating == 5) {
                    $movie_id = $rate->movieId;
                    $movie = Movie::findOrFail($movie_id);
                    $geners = $movie->geners()->pluck('name');
                    $numericGeners = $this->NumericMapping($geners);
                    $diff = collect($numericGeners)->diff($userFavourites);
                    $userFavourites = array_merge($userFavourites, $diff->toArray());
                }
            }
            sort($userFavourites);
            $transactions[] = $userFavourites;
        }
        return $transactions;
    }
    //
    function level_1($transactions, $min_supp_count = self::min_supp_count)
    {
        $trans = $transactions;
        $result = [];
        $frequency = array_fill(0, 18, 0);
        // join:
        foreach ($trans as $row) {
            foreach ($row as $element) {
                $frequency[$element]++;
            }
        }
        // prune :
        foreach ($frequency as $key => $f) {
            if ($f >= $min_supp_count)
                $result[] = $key;
        }
        return $result;
    }

    function level_2($transactions, $frequentItems, $min_supp_count = self::min_supp_count)
    {
        $result = [];
        $trans = $transactions;
        $items = $frequentItems;
        // join:
        $joins = [];
        for ($i = 0; $i < count($items) - 1; $i++) {
            for ($j = $i + 1; $j < count($items); $j++) {
                $first = $items[$i];
                $second = $items[$j];
                $joins[] = array($first, $second);
            }
        }
        //prune:
        foreach ($joins as $arr) {
            $realCounter = 0;
            foreach ($trans as $row) {
                $counter = 0;
                foreach ($arr as $item) {
                    if (in_array($item, $row))
                        $counter++;
                }
                if ($counter == 2)
                    $realCounter++;
            }
            if ($realCounter >= ($min_supp_count))
                $result[] = $arr;
        }

        return $result;
    }
    // function generateJoins($transactions, $groups, $min_supp_count, int $k)
    // {
    //     $result = [];
    //     $joins = [];

    //     // Pre-compute differences
    //     $right_differences = [];
    //     foreach ($groups as $j => $right) {
    //         if ($j > 0) {
    //             $tempo = $groups[$j - 1]; // Previous group
    //             $right_differences[$j] = array_diff($right, $tempo);
    //         }
    //     }

    //     // Use a hash table for efficient element checks
    //     for ($i = 0; $i < count($groups) - 1; $i++) {
    //         $left = $groups[$i];
    //         for ($j = $i + 1; $j < count($groups); $j++) {
    //             $tempo = $left;
    //             $right = $groups[$j];
    //             $l = array_pop($tempo);
    //             $r = array_pop($right);

    //             // Check if the last elements are different
    //             if (
    //                 $l < $r && !isset($right_differences[$j]) ||
    //                 isset($right_differences[$j]) && !in_array($r, $right_differences[$j])
    //             ) {
    //                 $halo = array($r);
    //                 $accepted = array_merge($left, $halo);
    //                 $joins[] = $accepted;
    //             }
    //         }
    //     }

    //     // Prune
    //     foreach ($joins as $arr) {
    //         $realCounter = 0;
    //         foreach ($transactions as $row) {
    //             $counter = 0;
    //             foreach ($arr as $item) {
    //                 if (in_array($item, $row)) {
    //                     $counter++;
    //                 }
    //             }
    //             if ($counter == $k) {
    //                 $realCounter++;
    //             }
    //         }
    //         if ($realCounter >= ($min_supp_count)) {
    //             $result[] = $arr;
    //         }
    //     }
    //     return $result;
    // }

    function generateJoins($transactions, $groups, $min_supp_count, int $k)
    {
        $result = [];
        $joins = [];
        //join :
        for ($i = 0; $i < count($groups) - 1; $i++) {
            $left = $groups[$i];
            for ($j = $i + 1; $j < count($groups); $j++) {
                $tempo = $left;
                $right = $groups[$j];
                $l = array_pop($tempo);
                $r = array_pop($right);
                $diff = array_diff($right, $tempo);
                if (count($diff) == 0 && $l < $r) {
                    $halo = array($r);
                    $accepted = array_merge($left, $halo);
                    $joins[] = $accepted;
                }
            }
        }
        // Prune :
        foreach ($joins as $arr) {
            $realCounter = 0;
            foreach ($transactions as $row) {
                $counter = 0;
                foreach ($arr as $item) {
                    if (in_array($item, $row))
                        $counter++;
                }
                if ($counter == $k)
                    $realCounter++;
            }
            if ($realCounter >= ($min_supp_count))
                $result[] = $arr;
        }
        return $result;
    }
    function getRulesArray($transactions, $min_supp_count = self::min_supp_count)
    {
        $checkLevel = true;
        $k = 3;
        $l1 = $this->level_1($transactions, $min_supp_count);
        $l2 = $this->level_2($transactions, $l1, $min_supp_count);
        $result = $l2;
        while ($checkLevel) {
            $safty = $result;
            $result = $this->generateJoins($transactions, $result, $min_supp_count, $k);

            if (!empty($result)) {
                $k++;
            } else {
                $checkLevel = false;
                return $safty;
            }
        }
    }
    function powerset(array $set): array
    {
        $powerSet = [];
        $count = count($set);
        for ($i = 0; $i < 1 << $count; $i++) {
            $subset = [];
            for ($j = 0; $j < $count; $j++) {
                if ($i & (1 << $j)) {
                    $subset[] = $set[$j];
                }
            }
            $powerSet[] = $subset;
        }
        return $powerSet;
    }

    function generate_rules(array $itemset): array
    {
        $rules = [];
        $power_set = $this->powerset($itemset);
        foreach ($power_set as $subset) {
            if (!empty($subset) && $subset !== $itemset) {
                $antecedent = $subset;
                $consequent = array_diff($itemset, $subset);
                $rules[] = [
                    'antecedent' => $antecedent,
                    'consequent' => $consequent,
                ];
            }
        }
        return $rules;
    }



    function process(Request $request)
    {
        dd($request);
    }

    // we suppose that the number of movie's geners is
    // final and equals 18.
    function NumericMapping($geners)
    {
        $numericGeners = [];
        foreach ($geners as $gener) {
            if ($gener == "Action") {
                $numericGeners[] = 0;
            } elseif ($gener == "Adventure") {
                $numericGeners[] = 1;
            } elseif ($gener == "Animation") {
                $numericGeners[] = 2;
            } elseif ($gener == "Children's") {
                $numericGeners[] = 3;
            } elseif ($gener == "Comedy") {
                $numericGeners[] = 4;
            } elseif ($gener == "Crime") {
                $numericGeners[] = 5;
            } elseif ($gener == "Documentary") {
                $numericGeners[] = 6;
            } elseif ($gener == "Drama") {
                $numericGeners[] = 7;
            } elseif ($gener == "Fantasy") {
                $numericGeners[] = 8;
            } elseif ($gener == "Film-Noir") {
                $numericGeners[] = 9;
            } elseif ($gener == "Horror") {
                $numericGeners[] = 10;
            } elseif ($gener == "Musical") {
                $numericGeners[] = 11;
            } elseif ($gener == "Mystery") {
                $numericGeners[] = 12;
            } elseif ($gener == "Romance") {
                $numericGeners[] = 13;
            } elseif ($gener == "Sci-Fi") {
                $numericGeners[] = 14;
            } elseif ($gener == "Thriller") {
                $numericGeners[] = 15;
            } elseif ($gener == "War") {
                $numericGeners[] = 16;
            } elseif ($gener == "Western") {
                $numericGeners[] = 17;
            }
        }
        return $numericGeners;
    }
}
