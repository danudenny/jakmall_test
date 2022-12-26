<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;

class ReviewSummaryCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'review:summary';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Summary list of review';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $reviews = json_decode(file_get_contents(base_path(). "/database/reviews.json"), true);
        $avg = array_sum(array_column($reviews, 'rating'))/count($reviews);
        $star5 = array_filter($reviews, function ($rev) {
           return $rev['rating'] === 5;
        });

        $star4 = array_filter($reviews, function ($rev) {
            return $rev['rating'] === 4;
        });

        $star3 = array_filter($reviews, function ($rev) {
            return $rev['rating'] === 3;
        });

        $star2 = array_filter($reviews, function ($rev) {
            return $rev['rating'] === 2;
        });

        $star1 = array_filter($reviews, function ($rev) {
            return $rev['rating'] === 1;
        });

        print_r([
            "total_reviews" => count($reviews),
            "average_ratings" => number_format((float)$avg, 2, '.', ''),
            "5_star" => count($star5),
            "4_star" => count($star4),
            "3_star" => count($star3),
            "2_star" => count($star2),
            "1_star" => count($star1)
        ]);
    }
}
