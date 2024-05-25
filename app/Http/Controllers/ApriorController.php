<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class ApriorController extends Controller
{

    public  $minSupport = 0.05;
    public  $frequentItemsets = apriori($transactions, $minSupport);
    protected $transactions = $this->getTransactoins();
    public function getTransactoins()
    {

        $userId = Auth()->user()->id;
        $userRatings = Rating::where('userId', $userId)->get();

        // Example assuming you want a transaction for each user
        $userTransactions = [];
        foreach ($userRatings as $rating) {
            $userTransactions[$rating->userId][] = $rating->movieId;
        }
        return $userTransactions;
    }

    function apriori($transactions, $minSupport) {

        // 1. Data Preparation
        $items = $this->getUniqueItems($transactions);
        $frequentItemsets = []; // To store frequent itemsets

        // 2. Candidate Generation and Support Counting
        for ($k = 1; $k <= count($items); $k++) {
            $candidateItemsets = $this->generateCandidateItemsets($items, $k);
            $supportCounts = $this->countItemsetsSupport($transactions, $candidateItemsets);

            // 3. Prune and Add Frequent Itemsets
            $frequentItemsets[$k] = []; // Store frequent itemsets of size k
            foreach ($supportCounts as $itemset => $count) {
                if ($count / count($transactions) >= $minSupport) {
                    $frequentItemsets[$k][] = $itemset;
                }
            }
        }

        // 4. Association Rule Generation (Add this part after frequent itemsets are found)
        //  ...

        return $frequentItemsets; // Return the frequent itemsets
    }

    // Helper functions (You'll need to implement these)
    function getUniqueItems($transactions) {
        //  ... (Combine all items into a single array, remove duplicates) ...
    }

    function generateCandidateItemsets($items, $k) {
        //  ... (Generate candidate itemsets of size k) ...
    }

    function countItemsetsSupport($transactions, $candidateItemsets) {
        //  ... (Count occurrences of each itemset in transactions) ...
    }


    public function index(){
        $trans = $this->getTransactoins();
        return view('frontend.aprior',compact('trans'));
    }

}
