<?php

use Illuminate\Database\Seeder;
Use Carbon\Carbon;


class CmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Eloquent::unguard();

        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        \App\Cms::truncate();
        $Data = [
            [
                'id' => '1',
                'title'=>'about_us',
                'content' => '<hr />
                                <h1><strong>ABOUT US</strong></h1>
                                
                                <hr />
                                <h1>The standard Lorem Ipsum passage, used since the 1500s</h1>
                                
                                <p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>
                                
                                <p><em><strong>Section 1.10.32 of &quot; de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</strong></em></p>
                                
                                <p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>
                                
                                <p><strong><em>1914 translation by H. Rackham</em></strong></p>
                                
                                <p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete</p>
                                
                                <hr />
                                <h3><strong>THANK YOU</strong></h3>
                                
                                <hr />
                                <p>&nbsp;</p>',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '2',
                'title'=>'help',
                'content' => '<h2>Clear all cookies</h2>

                                <p>If you remove cookies, you&#39;ll be signed out of websites and your saved preferences could be deleted.</p>
                                
                                <ol>
                                    <li>On your computer, open Chrome.</li>
                                    <li>At the top-right, click More&nbsp;<img alt="More" src="https://storage.googleapis.com/support-kms-prod/5C6FB52C8BBB2C12DC89B5F42F16B9B5E9CF" style="height:18px; width:18px" />&nbsp;<img alt="and then" src="https://lh3.googleusercontent.com/V4BkhmsXF3x2aXZBf_t6tWCaHbxK6ZcARN7s0gTt-voI9WcIkhe9R36jyDlD9hJZZw=w13-h18" style="height:18px; width:13px" />&nbsp;<strong>Settings</strong>.</li>
                                    <li>At the bottom, click&nbsp;<strong>Show advanced settings</strong>.</li>
                                    <li>In the &#39;Privacy&#39; section, click&nbsp;<strong>Content settings</strong>.</li>
                                    <li>Under &#39;Cookies&#39;, click&nbsp;<strong>All cookies and site data</strong>.</li>
                                    <li>At the top-right, click&nbsp;<strong>Remove all</strong>.</li>
                                    <li>At the bottom-right, click&nbsp;<strong>Done</strong>.</li>
                                </ol>
                                
                                <h3>Delete specific cookies</h3>
                                
                                <p>Delete cookies from a period of timeChange your cookie settings</p>
                                
                                <p>You can allow or block cookies saved by websites.</p>
                                
                                <p><strong><em>Note</em>:</strong>&nbsp;If you don&#39;t allow sites to save cookies, most sites that require you to sign in won&#39;t work.</p>',
                'created_at' => Carbon::now(),
            ],
        ];

        DB::table("cms")->insert($Data);



    }
}
