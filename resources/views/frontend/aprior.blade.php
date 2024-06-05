@php

    // foreach ($transactions as $tran) {
    //     echo ' Start of trans...... <br>';
    //     foreach ($tran as $t) {
    //         echo $t . '   ';
    //     }
    //     echo '<br> End of trans......<br>';
    // }
    dd($result);
    
@endphp

@extends('frontend.layouts.layout')
@section('content')
    <div class="container mt-5 ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-red-600">
                    <div class="card-header">
                        <h2> Choose Apriori Parameters</h2>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('apriori.process') }}">
                            @csrf

                            <div class="form-group">
                                <h5 class="d-inline">Number Of Transactions: </h5>
                                <label for="numOfTransactions"> <span id="numOfTransactionsValue">1</span></label>
                                <input type="range" class="form-control" id="numOfTransactions" name="numOfTransactions"
                                    min="10" max="1000" step="10"
                                    oninput="numOfTransactionsValue.value = numOfTransactions.value">
                            </div>

                            <div class="form-group">
                                <h5 class="d-inline">Minimum Support Count: </h5>
                                <label for="min_supp_count"> <span id="min_supp_countValue">1</span></label>
                                <input type="range" class="form-control" id="min_supp_count" name="min_supp_count"
                                    min="1" max="50" step="1"
                                    oninput="min_supp_countValue.value = min_supp_count.value">
                            </div>

                            <div class="form-group">
                                <h5 class="d-inline">Minimum Support: </h5>
                                <label for="min_supp"> <span id="min_suppValue">0.1</span></label>
                                <input type="range" class="form-control" id="min_supp" name="min_supp" min="0.1"
                                    max="1" step="0.1" oninput="min_suppValue.value = min_supp.value">
                            </div>

                            <div class="form-group">
                                <h5 class="d-inline">Minimum Confidence: </h5>
                                <label for="min_conf"> <span id="min_confValue">0.1</span></label>
                                <input type="range" class="form-control" id="min_conf" name="min_conf" min="0.1"
                                    max="1" step="0.1" oninput="min_confValue.value = min_conf.value">
                            </div>

                            <button type="submit" class="btn btn-red-black">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Add event listeners for the input elements
                document.querySelectorAll('input[type=range]').forEach(function(input) {
                    input.addEventListener('input', function() {
                        // Update the corresponding variable values
                        if (input.id === 'min_supp_count') {
                            min_supp_countValue = input.value;
                        } else if (input.id === 'numOfTransactions') {
                            numOfTransactionsValue = input.value;
                        } else if (input.id === 'min_supp') {
                            min_suppValue = input.value;
                        } else if (input.id === 'min_conf') {
                            min_confValue = input.value;
                        }

                        // Update the label text
                        const label = input.parentElement.querySelector('label');
                        if (label) {
                            label.innerHTML = input.value;
                        } else {
                            console.error('Label element not found for input:', input);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
