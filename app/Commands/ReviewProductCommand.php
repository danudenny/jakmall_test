<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;

class ReviewProductCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'review:product {productId : Id for product}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'List review of product';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $reviews = json_decode(file_get_contents(base_path(). "/database/reviews.json"), true);
        $args = (int)$this->argument('productId');

        $allRevs = array_filter($reviews, function ($rev) use ($args) {
            return $rev['product_id'] === $args;
        });

        $avg = array_sum(array_column($allRevs, 'rating'))/count($allRevs);

        $star5 = array_filter($reviews, function ($rev) use ($args) {
            return ($rev['rating'] === 5 && $rev['product_id'] === $args);
        });

        $star4 = array_filter($reviews, function ($rev) use ($args) {
            return ($rev['rating'] === 4 && $rev['product_id'] === $args);
        });

        $star3 = array_filter($reviews, function ($rev) use ($args) {
            return ($rev['rating'] === 3 && $rev['product_id'] === $args);
        });

        $star2 = array_filter($reviews, function ($rev) use ($args) {
            return ($rev['rating'] === 2 && $rev['product_id'] === $args);
        });

        $star1 = array_filter($reviews, function ($rev) use ($args) {
            return ($rev['rating'] === 1 && $rev['product_id'] === $args);
        });

        print_r([
            "total_reviews" => count($allRevs),
            "average_ratings" => number_format((float)$avg, 2, '.', ''),
            "5_star" => count($star5),
            "4_star" => count($star4),
            "3_star" => count($star3),
            "2_star" => count($star2),
            "1_star" => count($star1)
        ]);
    }
}
