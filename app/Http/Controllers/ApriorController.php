<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApriorController extends Controller
{
    static $numOfUsers = 10;
    const min_supp_count = 5;
    const min_supp = 0.5;
    const min_conf = 0.8;
    static $supportcounts = [];
    function index()
    {
        return view('frontend.aprior');
    }
    function suggested()
    {
        // $suggested_movies = Cache::remember('suggested_movies', 120, function () {
        //     $suggestions =  $this->sugget(self::$numOfUsers);
        //     return   Movie::whereIn('movieId', $suggestions)->simplePaginate(6);
        // });
        $suggestions =  $this->sugget(self::$numOfUsers);
        $suggested_movies =       Movie::whereIn('movieId', $suggestions)->paginate(6);
        $sum = count($suggested_movies);
        return view('frontend.suggested', compact('suggested_movies','sum'));
    }
    function process(Request $request)
    {
        $num = $request->numOfTransactions ? $request->numOfTransactions : self::$numOfUsers ;
        $min_supp_count = $request->min_supp_count ? $request->min_supp_count : self::min_supp_count;
        $min_supp = $request->min_supp ? $request->min_supp : self::min_supp;
        $min_conf = $request->min_conf ? $request->min_conf : self::min_conf;
        $suggestions =  $this->sugget($num, $min_supp_count, $min_supp, $min_conf);
        $suggested_movies = Movie::whereIn('movieId', $suggestions)->simplePaginate(6);
        return view('frontend.suggested', compact('suggested_movies'));
    }
    /**
     * returns the transaction ,each trasactoin represent the id's of
     * the geners that included in the rated movies from the user.
     * - numOfUsers respresents the number of trasactions.
     * @param integer $numOfUsers
     * @return array
     */
    function getTransactions($numOfUsers)
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

    /**
     * Generates the frequent items in level 1 => c1 then l1
     * ans also store the support_count for each element in
     * the static supportcounts array
     * @param array $transactions
     * @param int $min_supp_count
     * @return array
     */
    function level_1($transactions, $min_supp_count = self::min_supp_count)
    {
        $trans = $transactions;
        $result = [];
        $frequency = array_fill(0, 19, 0);
        // join:
        foreach ($trans as $row) {
            foreach ($row as $element) {
                $frequency[$element]++;
                $arr = array($element);
                $arrayKey = serialize($arr);
                self::$supportcounts[$arrayKey] = isset(self::$supportcounts[$arrayKey]) ? self::$supportcounts[$arrayKey] + 1 : 1;
            }
        }
        // prune :
        foreach ($frequency as $key => $f) {
            if ($f >= $min_supp_count)
                $result[] = $key;
        }
        return $result;
    }
    /**
     * Generates the frequent items in level 2 => c2 then l2
     * ans also store the support_count for each item in
     * the static supportcounts array
     * @param array $transactions
     * @param array $frequentItems
     * @param int $min_supp_count
     * @return array
     */
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
            $arrayKey = serialize($arr);
            self::$supportcounts[$arrayKey] = isset(self::$supportcounts[$arrayKey]) ? self::$supportcounts[$arrayKey] + 1 : $realCounter;
            if ($realCounter >= ($min_supp_count))
                $result[] = $arr;
        }

        return $result;
    }

    /**
     * Generates the frequent items in level $k => c$k then l$k
     * ans also store the support_count for each item in
     * the static supportcounts array
     * @param array $transactions
     * @param array $groups
     * @param integer $min_supp_count
     * @param integer $k
     * @return array
     */
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
            $arrayKey = serialize($arr);
            self::$supportcounts[$arrayKey] = isset(self::$supportcounts[$arrayKey]) ? self::$supportcounts[$arrayKey] + 1 : $realCounter;
            if ($realCounter >= ($min_supp_count)) {
                $result[] = $arr;
            }
        }
        return $result;
    }
    /**
     * Generat frequent items in max possible level
     *
     * @param array $transactions
     * @param integer $min_supp_count
     * @return array
     */
    function getFinalLevelArrays($transactions, $min_supp_count = self::min_supp_count)
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
        return [];
    }

    /**
     * Return  array of the support_counts of
     * each frequent item ,and this was calculated
     * during getting those items.
     *
     * @return array
     */
    function getSupportCounts()
    {
        return self::$supportcounts;
    }

    /**
     * Generates association rules depending on
     * the frequent items returned from
     * "getFinalLevelArrays" function.
     *
     * @param array $itemsets
     * @return array
     */
    function generate_rules(array $itemsets): array
    {
        $rules = [];
        foreach ($itemsets as $itemset) {
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
        }
        return $rules;
    }

    /**
     * Returns The strong rules
     *
     * @param array $rules
     * @param int $numOfUsers
     * @param int $min_supp
     * @param int $min_conf
     * @return array
     */
    function getAcceptedRules($rules, $numOfUsers, $min_supp = self::min_supp, $min_conf = self::min_conf)
    {
        $accepted = [];
        foreach ($rules as $rule) {
            $antecedent = $rule['antecedent'];
            $consequent = $rule['consequent'];
            $union = array_merge($antecedent, $consequent);
            sort($union);

            if (isset(self::$supportcounts[serialize($antecedent)]) &&  isset(self::$supportcounts[serialize($union)])) {
                $left_frequent = self::$supportcounts[serialize($antecedent)];
                $sup = self::$supportcounts[serialize($union)];

                $support = $sup / $numOfUsers;
                $confidence = $sup / $left_frequent;

                if ($support >= $min_supp && $confidence >= $min_conf)
                    $accepted[] = $rule;
            }
        }
        return $accepted;
    }

    function run($numOfUsers, $min_supp_count = self::min_supp_count, $min_supp = self::min_supp, $min_conf = self::min_conf)
    {
        $transactions  = $this->getTransactions($numOfUsers);
        $result = $this->getFinalLevelArrays($transactions, $min_supp_count);
        $supps = $this->getSupportCounts();
        $rules = $this->generate_rules($result);
        $accepted = $this->getAcceptedRules($rules, $numOfUsers, $min_supp, $min_conf);

        return $accepted;
    }

    function sugget($numOfUsers, $min_supp_count = self::min_supp_count, $min_supp = self::min_supp, $min_conf = self::min_conf)
    {
        $suggestions = [];
        $association_rules = $this->run($numOfUsers, $min_supp_count, $min_supp, $min_conf);
        $userFavourites = [];
        $user = Auth()->user();
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

        $matchFound = false;
        $result = [];
        // Loop until there's only one item left in the search array
        while (count($userFavourites) > 1) {
            // Try to find a match
            foreach ($association_rules as $ruleItem) {
                if (array_diff($userFavourites, $ruleItem['antecedent']) === []) {
                    $matchFound = true;
                    $result = $ruleItem['consequent'];
                    break 2; // Break out of both loops if a match is found
                }
            }
            // No match found, remove the last item
            array_pop($userFavourites);
        }

        // For now we are working on 1000 movies to choose from
        // but we will optimize the algorithm .
        if ($matchFound) {
            $num = count($result);
            $movies = Movie::orderByDesc('rate')->orderByDesc('numOfRatings')->take(1000)->get();
            foreach ($movies as $movie) {
                $geners = $movie->geners()->pluck('name');
                $numericGeners = $this->NumericMapping($geners);
                $diff = array_diff($result, $numericGeners);
                if (count($diff) < $num) {
                    $suggestions[] = $movie->movieId;
                }
            }
        }

        return $suggestions;
    }

    /**
     *Run The algorithm depending on the user's parameters :
     * @param Request $request
     * @return \Illuminate\View\View
     */




    // Helper Functinos :

    /**
     * Generates all possible combinations of elements
     * depending on "Bitwise Operations":
     * @param array $set
     * @return array
     */
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
    /**
     * we suppose that the number of movie's geners is
     * final and equals 18.
     * @param [array] $geners
     * @return array
     */

    function NumericMapping($geners)
    {
        // echo " geners : " ; dd($geners); echo"<br>";
        $numericGeners = [];
        foreach ($geners as $gener) {
            if ($gener == "Action") {
                $numericGeners[] = 1;
            } elseif ($gener == "Adventure") {
                $numericGeners[] = 2;
            } elseif ($gener == "Animation") {
                $numericGeners[] = 3;
            } elseif ($gener == "Children's") {
                $numericGeners[] = 4;
            } elseif ($gener == "Comedy") {
                $numericGeners[] = 5;
            } elseif ($gener == "Crime") {
                $numericGeners[] = 6;
            } elseif ($gener == "Documentary") {
                $numericGeners[] = 7;
            } elseif ($gener == "Drama") {
                $numericGeners[] = 8;
            } elseif ($gener == "Fantasy") {
                $numericGeners[] = 9;
            } elseif ($gener == "Film-Noir") {
                $numericGeners[] = 10;
            } elseif ($gener == "Horror") {
                $numericGeners[] = 11;
            } elseif ($gener == "Musical") {
                $numericGeners[] = 12;
            } elseif ($gener == "Mystery") {
                $numericGeners[] = 13;
            } elseif ($gener == "Romance") {
                $numericGeners[] = 14;
            } elseif ($gener == "Sci-Fi") {
                $numericGeners[] = 15;
            } elseif ($gener == "Thriller") {
                $numericGeners[] = 16;
            } elseif ($gener == "War") {
                $numericGeners[] = 17;
            } elseif ($gener == "Western") {
                $numericGeners[] = 18;
            }
        }
        return $numericGeners;
    }
}
