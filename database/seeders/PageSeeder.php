<?php

namespace Database\Seeders;

use App\Filament\Fabricator\Layouts\DefaultLayout;
use App\Filament\Fabricator\PageBlocks\TextBlock;
use App\Models\Overrides\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * @var Page $home
         */
        $home = Page::create([
            'parent_id' => null,
            'layout' => DefaultLayout::NAME,
            'title' => [
                'fr' => 'FR: Home',
                'en' => 'EN: Home',
                'es' => 'ES: Home',
            ],
            'slug' => [
                'fr' => '/fr',
                'en' => '/',
                'es' => '/es',
            ],
            'blocks' => [
                'fr' => [],
                'en' => [],
                'es' => [],
            ],
        ]);

        $home->seo()->create([
            'title' => [
                'fr' => 'FR: Meta title',
                'en' => 'EN: Meta title',
                'es' => 'ES: Meta title',
            ],
            'description' => [
                'fr' => 'FR: Meta description',
                'en' => 'EN: Meta description',
                'es' => 'ES: Meta description',
            ],
        ]);

        $loremIpsum = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquet non magna eu mattis. Morbi a vehicula est, vel ultricies diam.';

        /**
         * @var Page $page
         */
        $page = Page::create([
            'parent_id' => $home->id,
            'layout' => DefaultLayout::NAME,
            'title' => [
                'fr' => 'Français',
                'en' => 'English',
                'es' => 'Español',
            ],
            'slug' => [
                'fr' => 'francais',
                'en' => 'english',
                'es' => 'espanol',
            ],
            'blocks' => [
                'fr' => [
                    [
                        'type' => TextBlock::ID,
                        'data' => [
                            'admin_title' => 'Bloc texte',
                            'title' => 'Français',
                            'content' => $loremIpsum,
                        ],
                    ],
                ],
                'en' => [
                    [
                        'type' => TextBlock::ID,
                        'data' => [
                            'admin_title' => 'Text block',
                            'title' => 'English',
                            'content' => $loremIpsum,
                        ],
                    ],
                ],
                'es' => [
                    [
                        'type' => TextBlock::ID,
                        'data' => [
                            'admin_title' => 'Bloque texto',
                            'title' => 'Español',
                            'content' => $loremIpsum,
                        ],
                    ],
                ],
            ],
        ]);

        $page->seo()->create([
            'title' => [
                'fr' => 'FR: Meta title',
                'en' => 'EN: Meta title',
                'es' => 'ES: Meta title',
            ],
            'description' => [
                'fr' => 'FR: Meta description',
                'en' => 'EN: Meta description',
                'es' => 'ES: Meta description',
            ],
        ]);
    }
}
