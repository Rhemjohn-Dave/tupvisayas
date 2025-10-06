<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TIPTTOPost;
use App\Models\User;

class TIPTTOPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first admin user or create a default one
        $admin = User::where('is_admin', true)->first();

        if (!$admin) {
            $admin = User::create([
                'name' => 'TIPTTO Admin',
                'email' => 'tiptto@tupv.edu.ph',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]);
        }

        $samplePosts = [
            [
                'title' => 'Innovative Solar-Powered Water Purification System',
                'excerpt' => 'A breakthrough technology that combines solar energy with advanced filtration to provide clean drinking water in remote areas.',
                'content' => '<h2>Revolutionary Water Purification Technology</h2>
                <p>Our research team has developed an innovative solar-powered water purification system that addresses the critical need for clean drinking water in remote and underserved communities.</p>
                
                <h3>Key Features:</h3>
                <ul>
                    <li>Solar-powered operation with battery backup</li>
                    <li>Multi-stage filtration system</li>
                    <li>Portable and easy to install</li>
                    <li>Low maintenance requirements</li>
                    <li>Cost-effective solution for communities</li>
                </ul>
                
                <h3>Technology Transfer Opportunities:</h3>
                <p>This technology is available for licensing and commercialization. We are seeking partners in the water treatment industry to bring this innovation to market.</p>
                
                <h3>Intellectual Property Status:</h3>
                <p>Patent application filed and pending approval. Utility model protection also available.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Smart Agricultural Monitoring System',
                'excerpt' => 'An IoT-based solution for real-time crop monitoring and precision agriculture using advanced sensors and data analytics.',
                'content' => '<h2>Precision Agriculture Innovation</h2>
                <p>Our Smart Agricultural Monitoring System represents a significant advancement in precision agriculture, helping farmers optimize crop yields while reducing resource consumption.</p>
                
                <h3>System Components:</h3>
                <ul>
                    <li>Wireless sensor network for soil and weather monitoring</li>
                    <li>Mobile application for real-time data access</li>
                    <li>Machine learning algorithms for predictive analytics</li>
                    <li>Automated irrigation control system</li>
                    <li>Cloud-based data storage and analysis</li>
                </ul>
                
                <h3>Benefits for Farmers:</h3>
                <ul>
                    <li>Increased crop yields by up to 30%</li>
                    <li>Reduced water usage by 25%</li>
                    <li>Early detection of plant diseases</li>
                    <li>Optimized fertilizer application</li>
                    <li>Real-time decision support</li>
                </ul>
                
                <h3>Commercialization Status:</h3>
                <p>Ready for technology transfer and licensing. Seeking agricultural technology companies and farming cooperatives as potential partners.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Biodegradable Food Packaging Material',
                'excerpt' => 'An eco-friendly alternative to plastic packaging made from agricultural waste, providing sustainable packaging solutions for the food industry.',
                'content' => '<h2>Sustainable Packaging Innovation</h2>
                <p>Our research has led to the development of a revolutionary biodegradable food packaging material that addresses the global plastic waste crisis while providing superior protection for food products.</p>
                
                <h3>Material Properties:</h3>
                <ul>
                    <li>100% biodegradable and compostable</li>
                    <li>Excellent barrier properties against moisture and oxygen</li>
                    <li>Heat-sealable and printable</li>
                    <li>Made from agricultural waste materials</li>
                    <li>Cost-competitive with traditional plastics</li>
                </ul>
                
                <h3>Environmental Impact:</h3>
                <p>This innovation significantly reduces plastic waste in landfills and oceans while utilizing agricultural waste that would otherwise be burned or left to decompose.</p>
                
                <h3>Market Applications:</h3>
                <ul>
                    <li>Food packaging for retail and restaurants</li>
                    <li>Single-use containers and utensils</li>
                    <li>Agricultural product packaging</li>
                    <li>Pharmaceutical packaging</li>
                </ul>
                
                <h3>IP Protection:</h3>
                <p>Patent granted and trademark registered. Technology available for licensing to packaging manufacturers worldwide.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(15),
                'author_id' => $admin->id,
            ],
        ];

        foreach ($samplePosts as $postData) {
            TIPTTOPost::create($postData);
        }
    }
}