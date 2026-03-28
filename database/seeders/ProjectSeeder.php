<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'size' => '3',
                'title' => 'Neo-Glow Identity',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC5vdOzTnNRzmfPzdCoyKzg1W9rzTm8kRzkxbq5BFAebev6_oDRO-6DlQqxQuhau9MdtH3tIvifHDjuDLTgiM2m4G7xsSM1R4XBrrCH2IC1WXRtuvxLOD3RNH8zkzh45ckTXL_wAs5Y6rnbFnX-7jXQHOVz9R6TptSPNOgmrNiZWst0eAvonXThEQHFZHCPfp852NeU-sfbqAZVvpwBfoP6itam4o1maFbHaozRY0scJD0bk7CbFKeymVQgkaSvxG6avDExRvwJAWg0',
            ],
            [
                'size' => '1',
                'title' => 'Tech Legacy',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCRnmskudL9AdnStX3CN3gmoEtZa-3fz2jwLz2wu1I4N6LbjVmKi---U7aeTfFlfn4Ulys4zXbkkRrLv7suzAnandazrYPGfsylxT1V9rb7IFzvurh2jLEl75jTEgn7788UaYbR_7E1THhfnGEFwomUcYv21rdOUzCjK-q34Go-fc9d_NlyWjbV_Lq_9pcXfKJnONuZX5sc1a_y_mDOm6ITZKSWG7r59OMhxCyt2kQDQ_zp5CGnYOC8E0WKsX_ZU2TVDn3lnNqn9lRI',
            ],
            [
                'size' => '2',
                'title' => 'Vibe Shift',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCHR7GDmTZJpq_bZCwb_SZToptgqm_1yT1zQG7duPOCDYH3f5idNqeAoBCQnYVTut4Y7i15vFdTva8i9jyaNHZNohrP4cyYKxis66a0ntyIQu4iaq73OSVhnL0Of7CcAOk8iPmhRU5SaZxZX46BveiunPnpU71L1JJAhb37LOCV5TFYeQf4Yw5p-7k4hku9OKKgkMON5wbYa60oo3WLeXDrilnr1R5Em7W-haKD4mRpTnqQSUsgXPFqNk8fImz1MEGjLT1w9nCzZHys',
            ],
            [
                'size' => '2',
                'title' => 'Luminal App',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA1MZo6sCcIw06gfThgaLKwecvp4arfGY3Qf4dfJKfx_VD_g6jGz7B7PG3pUw88H9WIjEqcCK6zv0aGYI0oCv8aYivBmMOn5wCh0Yg0X1ozLGtvBO7ZzRZIucC0CJGloQjtNFPNCzs5DotbsSLPCV7RDYogNtW-IhHjke1bcg7nyt5qEavR9ZckLTzxTun2pzHbHVMQYJDRj9B65dqdb6faJsbtEQhgsxN2EGhVUplJDrDIa5KgVKz_IcT7jxIXZo2lEFBK31tDs_2M',
            ],
            [
                'size' => '3',
                'title' => 'Void Space',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB_cqKKv6TNjl2lZzYmw-qMVS4cNvApnegzQOSLGbbzUA4IRhvKToGYvOOlEkIIF6EIv9piRghI0T0fBtL6gQ6WFoHGJMbtyUre6sQIROGGdhpY0Xn66X3Ll2A-NToAGxPca7AEq56jaDVGO7idrrqfqX1mtqMUe_gTbIX_JfInBBmV8OjZHkaTVB0YYfz6KqdcvxvzHEybTZdAZ8mqpqlODmuyoY3cOylyZbDtiZLIpocxgBLxFwVsINpt7G9gCznYQ7h-xIsEjTdA',
            ],
            [
                'size' => '1',
                'title' => 'Monolith Studio',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDRGewAh8EVDQ56-CNX7lENAkQUDyx6_BEGaydMU82UW1SxejwSppOjgb2IbcmmK7l5UnDPNEOzbJlkyMI4eIKE57Sg1iRKyrP-jHHWNm-1Ry7HK75ayrgOqvJWLR9hpWSwOVG7DrYeCcjT38uj1KU9Me1sFxfVS5XBLv4baFebq9J7ETVOw7snGV6WYENK0C2XONXlDsDXNS9fJ1KAA-cQtA_U8ubA7WS6yeG4o-WhGp7G7fCBVcHOMWuElSSHYoLQDdCJ-pNS1PRL',
            ],
        ];

        foreach ($projects as $project) {
            DB::table('projects')->updateOrInsert(
                ['title' => $project['title']],

                [
                    'description' => 'Proyecto administrable desde CMS.',
                    'image_carousel' => $project['image'],
                    'grid_image' => $project['image'],
                    'grid_image_size' => $project['size'],
                ]
            );
        }
    }
}
