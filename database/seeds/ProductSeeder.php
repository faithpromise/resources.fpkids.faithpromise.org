<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('products')->truncate();

        $vol_shirt_options = json_decode('{"names":["Size","Color"],"values":[{"Adult Small":["Gray w/ Orange","Green w/ Orange","Blue w/ White","Red w/ White"]},{"Adult Medium":["Gray w/ Orange","Green w/ Orange","Blue w/ White","Red w/ White"]},{"Adult Large":["Gray w/ Orange","Green w/ Orange","Blue w/ White","Red w/ White"]},{"Adult X-Large":["Gray w/ Orange","Green w/ Orange","Blue w/ White","Red w/ White"]},{"Adult 2X-Large":["Gray w/ Orange","Green w/ Orange","Blue w/ White","Red w/ White"]},{"Adult 3X-Large":["Gray w/ Orange","Green w/ Orange","Blue w/ White","Red w/ White"]}]}');
        $kidrave_shirt_options = json_decode('{"names":["Size"],"values":["Youth Small","Youth Medium","Youth Large","Adult Small","Adult Medium","Adult Large","Adult X-Large"]}');
        $security_shirt_options = json_decode('{"names":["Size"],"values":["Adult Small","Adult Medium","Adult Large","Adult X-Large","Adult 2X-Large","Adult 3X-Large"]}');
        $childcare_shirt_options = json_decode('{"names":["Size"],"values":["Adult Small","Adult Medium","Adult Large","Adult X-Large","Adult 2X-Large"]}');

        $products = [
            [
                'category' => Category::where('name', '=', 'Family Registration Resources')->first(),
                'products' => [
                    ['name' => 'fpKIDS Informational Brochure', 'description' => '8.5x5, high-gloss document displayed at Family Registration desk & lobby information centers', 'quantities' => ['250', '500', '1,000']],
                    ['name' => '"Hello Again" Postcards', 'description' => '5"x7" postcards sent to kids attending fpKIDS for the first time', 'quantities' => ['250', '500', '1,000']],
                    ['name' => 'Family Registration Name Tag Labels', 'description' => 'Name Tags to fit label printers at Family Registration. 6 rolls per case.', 'quantities' => ['1 Case', '2 Cases', '3 Cases', '6 Cases', '12 Cases']],
                    ['name' => 'New Family Registration Form', 'quantities' => ['250', '500', '1,000']],
                    ['name' => 'fpKIDS Coloring Books', 'quantities' => ['50', '100', '150', '1 Case']],
                    ['name' => 'Keytags', 'description' => 'Barcode tags. Order in multiples of 100.', 'quantities' => ['100', '200', '300', '500']],
                    ['name' => 'Back Up Tags', 'description' => 'Name tags used for Emergency Back Up plan.', 'quantities' => ['100', '200', '500']],
                ]
            ],
            [
                'category' => Category::where('name', '=', 'SGL Contact Tools')->first(),
                'products' => [
                    ['name' => 'fpKIDS Birthday Card', 'description' => '4"x6" postcard sent to kids to celebrate birthdays', 'quantities' => ['250', '500', '1,000']],
                    ['name' => 'fpKIDS Postcards', 'description' => 'Notecards for fpKIDS Volunteers (i.e. SGLs) to "show up randomly" in a kids\' mailbox', 'quantities' => ['250', '500', '1,000']],
                    ['name' => 'fpKIDS Notecard Envelopes', 'description' => '4"x6" envelopes to fit fpKIDS Notecards', 'quantities' => ['250', '500', '1,000']],
                ]
            ],
            [
                'category' => Category::where('name', '=', 'Baptism Class Resources')->first(),
                'products' => [
                    ['name' => 'Baptism Class Workbooks - Younger Elementary', 'description' => 'Recommended for K-2nd Grade', 'quantities' => ['10', '20', '30', '40']],
                    ['name' => 'Baptism Class Workbook - Older Elementary', 'description' => 'Recommended for 3rd-5th Grade', 'quantities' => ['10', '20', '30', '40']],
                ]
            ],
            [
                'category' => Category::where('name', '=', 'Volunteer & KidRave T-shirts')->first(),
                'products' => [
                    ['name' => 'KidRave Tees', 'description' => 'Tees for KidRave participants.', 'quantities' => ['2', '4', '6', '8', '10'], 'options' => $kidrave_shirt_options],
                    ['name' => 'Volunteer Tees', 'quantities' => ['2', '4', '6', '8', '10'], 'options' => $vol_shirt_options],
                    ['name' => 'Security Tees', 'description' => 'Black w/ white print.', 'quantities' => ['2', '4', '6', '8', '10'], 'options' => $security_shirt_options],
                ]
            ],
            [
                'category' => Category::where('name', '=', 'Volunteer Resources')->first(),
                'products' => [
                    ['name' => 'Volunteer Recruitment Card', 'quantities' => ['50', '100', '150', '200']],
                    ['name' => 'Volunteer Handbook', 'description' => 'Black & white, double-sided, stapled document defining policies & procedures of fpKIDS ministry.', 'quantities' => ['10', '20', '30', '40', '50']],
                    ['name' => 'Volunteer Role Descriptions', 'description' => 'Color copy of document listing all fpKIDS Volunteer Roles. Used for recruiting pushes & Next Step workshops.', 'quantities' => ['20', '30', '40']],
                    ['name' => 'New Volunteer Folder_Preschool', 'quantities' => ['5', '10', '15']],
                    ['name' => 'New Volunteer Folder_Elementary', 'quantities' => ['5', '10', '15']],
                    ['name' => 'New Volunteer Folder_Support Team', 'quantities' => ['5', '10', '15']],
                    ['name' => 'New Volunteer Folder_Security Team', 'quantities' => ['5', '10', '15']],
                ]
            ],
            [
                'category' => Category::where('name', '=', 'Environment Needs')->first(),
                'products' => [
                    ['name' => 'Diaper Bag Tags', 'quantities' => ['50', '100', '200', '500']],
                    ['name' => 'fpKIDS Coins', 'description' => 'aka "fpKIDS Coin" - wooden nickel with fpKIDS logo. Order in increments of 250.', 'quantities' => ['250', '500', '1,000']],
                    ['name' => '"Changed in Love" Diaper Stickers', 'quantities' => ['500', '1,000', '2,000']],
                    ['name' => '"My Day in fpKids" Forms', 'quantities' => ['200', '300', '500']],
                    ['name' => 'New family Check-in Tags', 'quantities' => ['200', '300', '500']],
                    ['name' => 'Sick Policy Sticker', 'quantities' => ['5', '15', '25', '30']],
                ]
            ],
            [
                'category' => Category::where('name', '=', 'Childcare Team Needs')->first(),
                'products' => [
                    ['name' => 'Childcare Team Tees', 'quantities' => ['2', '4', '6', '8', '10'], 'options' => $childcare_shirt_options],
                    ['name' => 'Childcare Team Manual', 'quantities' => ['10', '20', '30', '40', '50']],
                ]
            ],
            [
                'category' => Category::where('name', '=', 'Promotional Tools')->first(),
                'products' => [
                    ['name' => 'Banner Stand (32"x72")', 'quantities' => ['1 Stand', '2 Stands', '3 Stands', '4 Stands']],
                    ['name' => 'Wacky Weekend Banner', 'quantities' => ['1', '2', '3', '4']],
                    ['name' => '"Do You Serve" Banner', 'description' => 'Designed for fpStudent Ministry promotion.', 'quantities' => ['1', '2', '3', '4']],
                    ['name' => 'Black "fpKIDS" stretch table cloth', 'description' => 'Ordered annually. Cost per tablecloth approx. $150 plain black, $350 black w/ fpKIDS logo.', 'quantities' => ['1', '2', '3'], 'options' => json_decode('{"names":["Size"],"values":["6 Foot","8 Foot"]}')],
                ]
            ]
        ];

        foreach ($products as $group) {
            foreach ($group['products'] as $product) {
                $record = new Product();
                $record->name = $product['name'];
                $record->description = array_key_exists('description', $product) ? $product['description'] : null;
                $record->quantities = array_key_exists('quantities', $product) ? $product['quantities'] : null;
                $record->options = array_key_exists('options', $product) ? $product['options'] : null;
                $record->save();
                $record->category()->associate($group['category']);
                $record->save();
            }
        }

    }
}