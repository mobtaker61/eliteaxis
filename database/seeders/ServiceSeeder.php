<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'slug' => 'general-check',
                'name' => [
                    'en' => 'General Check',
                    'ar' => 'فحص عام',
                ],
                'title' => [
                    'en' => 'Complete General Vehicle Inspection',
                    'ar' => 'فحص شامل للمركبة',
                ],
                'description' => [
                    'en' => 'A full health check of your vehicle systems before major failures.',
                    'ar' => 'فحص شامل لأنظمة السيارة قبل حدوث أعطال كبيرة.',
                ],
                'content' => [
                    'en' => '<h2>General Check</h2><p>We inspect engine, brakes, suspension, fluids, battery and safety points.</p>',
                    'ar' => '<h2>فحص عام</h2><p>نقوم بفحص المحرك والفرامل والتعليق والسوائل والبطارية ونقاط السلامة.</p>',
                ],
                'features' => [
                    'en' => ['Computerized diagnostics', 'Inspection report', 'Preventive maintenance advice'],
                    'ar' => ['تشخيص كمبيوتر', 'تقرير فحص مفصل', 'توصيات صيانة وقائية'],
                ],
                'icon' => 'fa fa-clipboard-check',
                'image' => 'carserv/img/service-1.jpg',
                'avatar' => null,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'slug' => 'mechanical',
                'name' => [
                    'en' => 'Mechanical',
                    'ar' => 'ميكانيك',
                ],
                'title' => [
                    'en' => 'Mechanical Repair & Maintenance',
                    'ar' => 'إصلاح وصيانة ميكانيكية',
                ],
                'description' => [
                    'en' => 'Mechanical diagnosis and repair for engine, suspension and drivetrain.',
                    'ar' => 'تشخيص وإصلاح ميكانيكي للمحرك والتعليق ونظام نقل الحركة.',
                ],
                'content' => [
                    'en' => '<h2>Mechanical Services</h2><p>From noise troubleshooting to complete part replacement.</p>',
                    'ar' => '<h2>الخدمات الميكانيكية</h2><p>من تشخيص الأصوات إلى استبدال القطع بالكامل.</p>',
                ],
                'features' => [
                    'en' => ['Engine repair', 'Suspension service', 'Transmission check'],
                    'ar' => ['إصلاح المحرك', 'خدمة نظام التعليق', 'فحص ناقل الحركة'],
                ],
                'icon' => 'fa fa-tools',
                'image' => 'carserv/img/service-2.jpg',
                'avatar' => null,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'slug' => 'oil-change',
                'name' => [
                    'en' => 'Oil Change',
                    'ar' => 'تغيير الزيت',
                ],
                'title' => [
                    'en' => 'Engine Oil and Filter Service',
                    'ar' => 'خدمة زيت المحرك والفلتر',
                ],
                'description' => [
                    'en' => 'Fast oil and filter replacement for better performance and engine lifespan.',
                    'ar' => 'تغيير سريع للزيت والفلتر لتحسين الأداء وإطالة عمر المحرك.',
                ],
                'content' => [
                    'en' => '<h2>Oil Change</h2><p>Includes premium oil, filter replacement and service reminder.</p>',
                    'ar' => '<h2>تغيير الزيت</h2><p>يشمل زيت ممتاز وتبديل فلتر مع تذكير الخدمة القادمة.</p>',
                ],
                'features' => [
                    'en' => ['Premium oils', 'Filter replacement', 'Quick turnaround'],
                    'ar' => ['زيوت ممتازة', 'استبدال الفلتر', 'إنجاز سريع'],
                ],
                'icon' => 'fa fa-oil-can',
                'image' => 'carserv/img/service-4.jpg',
                'avatar' => null,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'slug' => 'electrical',
                'name' => [
                    'en' => 'Electrical',
                    'ar' => 'كهرباء',
                ],
                'title' => [
                    'en' => 'Auto Electrical Diagnostics',
                    'ar' => 'تشخيص كهرباء السيارة',
                ],
                'description' => [
                    'en' => 'Repair and diagnostics for battery, alternator, lights and wiring.',
                    'ar' => 'إصلاح وتشخيص البطارية والدينمو والإنارة والتمديدات الكهربائية.',
                ],
                'content' => [
                    'en' => '<h2>Electrical Service</h2><p>Accurate electrical troubleshooting with advanced tools.</p>',
                    'ar' => '<h2>خدمة الكهرباء</h2><p>تشخيص دقيق للأعطال الكهربائية بأجهزة حديثة.</p>',
                ],
                'features' => [
                    'en' => ['Battery test', 'Starter/alternator check', 'Wiring diagnostics'],
                    'ar' => ['فحص البطارية', 'فحص الدينمو والسلف', 'تشخيص التمديدات'],
                ],
                'icon' => 'fa fa-bolt',
                'image' => 'carserv/img/service-2.jpg',
                'avatar' => null,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'slug' => 'carwash',
                'name' => ['en' => 'Carwash', 'ar' => 'غسيل السيارة'],
                'title' => ['en' => 'Exterior and Interior Car Wash', 'ar' => 'غسيل خارجي وداخلي'],
                'description' => ['en' => 'Professional washing and interior cleaning service.', 'ar' => 'خدمة غسيل احترافية وتنظيف داخلي للسيارة.'],
                'content' => ['en' => '<h2>Carwash</h2><p>Quick clean and premium detailing packages available.</p>', 'ar' => '<h2>غسيل السيارة</h2><p>متوفر غسيل سريع وباقات تنظيف احترافية.</p>'],
                'features' => ['en' => ['Exterior wash', 'Interior vacuum', 'Detailing options'], 'ar' => ['غسيل خارجي', 'تنظيف داخلي', 'خيارات تلميع']],
                'icon' => 'fa fa-soap',
                'image' => 'carserv/img/service-3.jpg',
                'avatar' => null,
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'slug' => 'body-paint',
                'name' => ['en' => 'Body Paint', 'ar' => 'صبغ الهيكل'],
                'title' => ['en' => 'Body Paint and Refinishing', 'ar' => 'صبغ الهيكل وإعادة التشطيب'],
                'description' => ['en' => 'Professional paint matching and body refinishing.', 'ar' => 'مطابقة احترافية للون وإعادة تشطيب الهيكل.'],
                'content' => ['en' => '<h2>Body Paint</h2><p>From minor touch-ups to full-panel repaint.</p>', 'ar' => '<h2>صبغ الهيكل</h2><p>من تعديل الخدوش البسيطة إلى إعادة صبغ كاملة.</p>'],
                'features' => ['en' => ['Color matching', 'Paint booth quality', 'Protective finish'], 'ar' => ['مطابقة اللون', 'جودة غرفة الصبغ', 'طبقة حماية']],
                'icon' => 'fa fa-paint-roller',
                'image' => 'carserv/img/service-1.jpg',
                'avatar' => null,
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'slug' => 'air-condition',
                'name' => ['en' => 'Air Condition', 'ar' => 'تكييف'],
                'title' => ['en' => 'A/C Service and Gas Refill', 'ar' => 'خدمة التكييف وتعبئة الغاز'],
                'description' => ['en' => 'Cooling diagnostics, maintenance and refrigerant refill.', 'ar' => 'تشخيص نظام التبريد وصيانته وتعبئة غاز المكيف.'],
                'content' => ['en' => '<h2>Air Condition</h2><p>We fix cooling performance and unusual AC noises.</p>', 'ar' => '<h2>التكييف</h2><p>نقوم بتحسين التبريد ومعالجة أصوات المكيف غير الطبيعية.</p>'],
                'features' => ['en' => ['Gas refill', 'Leak detection', 'Compressor check'], 'ar' => ['تعبئة الغاز', 'كشف التسريب', 'فحص الكمبروسر']],
                'icon' => 'fa fa-snowflake',
                'image' => 'carserv/img/service-2.jpg',
                'avatar' => null,
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'slug' => 'car-denting',
                'name' => ['en' => 'Car Denting', 'ar' => 'سمكرة'],
                'title' => ['en' => 'Dent Repair and Body Alignment', 'ar' => 'إصلاح الانبعاجات وضبط الهيكل'],
                'description' => ['en' => 'Repair dents, panel damage and body misalignment.', 'ar' => 'إصلاح الانبعاجات وأضرار الألواح وعدم استقامة الهيكل.'],
                'content' => ['en' => '<h2>Car Denting</h2><p>Professional panel reshaping and body correction.</p>', 'ar' => '<h2>السمكرة</h2><p>تعديل احترافي للألواح وتصحيح استقامة الهيكل.</p>'],
                'features' => ['en' => ['Dent pull', 'Panel repair', 'Body alignment'], 'ar' => ['سحب الانبعاج', 'إصلاح الألواح', 'ضبط الهيكل']],
                'icon' => 'fa fa-hammer',
                'image' => 'carserv/img/service-3.jpg',
                'avatar' => null,
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'slug' => 'tire-service',
                'name' => ['en' => 'Tire Service', 'ar' => 'خدمة الإطارات'],
                'title' => ['en' => 'Tire Replacement and Wheel Care', 'ar' => 'تبديل الإطارات والعناية بالعجلات'],
                'description' => ['en' => 'Tire replacement, balancing and wheel inspection.', 'ar' => 'تبديل الإطارات والترصيص وفحص العجلات.'],
                'content' => ['en' => '<h2>Tire Service</h2><p>Safe tire installation with alignment recommendations.</p>', 'ar' => '<h2>خدمة الإطارات</h2><p>تركيب آمن للإطارات مع توصيات لضبط الزوايا.</p>'],
                'features' => ['en' => ['Tire fitting', 'Wheel balancing', 'Pressure check'], 'ar' => ['تركيب الإطار', 'ترصيص العجلات', 'فحص الضغط']],
                'icon' => 'fa fa-circle-notch',
                'image' => 'carserv/img/service-4.jpg',
                'avatar' => null,
                'sort_order' => 9,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(
                ['slug' => $service['slug']],
                $service
            );
        }
    }
}
