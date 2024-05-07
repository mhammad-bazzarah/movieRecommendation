
@extends('frontend.layouts.layout')
@section('content')

@endsection
<?php
    use Carbon\Carbon;
    $csv = array('str_getcsv', file(storage_path('csvs/ratings.csv')));
    $c =1;
    foreach ($csv as $row) {
                $data = Carbon::createFromTimestamp($row[4]);
                echo $data->toDateTimeString();
                echo "\n";
                $c++;
                // if($c == 20)
                //     break;
        }

?>
