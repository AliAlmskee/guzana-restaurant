<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Seeder;

class ContentTableSeeder extends Seeder
{
    public function run()
    {
        Content::updateOrCreate(
            ['key' => 'ABOUT'],
            ['translations' => [
                'ar' => "يأخذك مطعم غوزانا التقليدي في رحلة طهي غير عادية تجمع بشكل مثالي بين الأصالة والحداثة. مع سحر أطباقنا والجمال الذي لا يضاهى لأجواءنا، نأخذك في رحلة مباشرة إلى دمشق. دع نفسك تسحر بالروائح اللذيذة والضيافة الدافئة والأجواء الفريدة. مرحبا بك في غوزانا، المكان الذي يلتقي فيه التقليد بالابتكار وكل لدغة تحكي قصة.",
                'de' => "Das traditionelle Restaurant Guzana entführt Sie auf eine außergewöhnliche kulinarische Reise, die Authentizität und Moderne perfekt vereint. Mit der Magie unserer Gerichte und der unvergleichlichen Schönheit unseres Ambientes nehmen wir Sie mit auf eine direkte Reise nach Damaskus. Lassen Sie sich von den köstlichen Aromen, der herzlichen Gastfreundschaft und der einzigartigen Atmosphäre verzaubern. Willkommen bei Guzana, einem Ort, an dem Tradition auf Innovation trifft und jeder Bissen eine Geschichte erzählt.",
            ]]
        );

        Content::updateOrCreate(
            ['key' => 'MENU'],
            ['translations' => [
                'ar' => "قائمتنا تقدم مزيجاً رائعاً من النكهات الشامية الأصيلة مع لمسات عصرية مبتكرة. اكتشف أطباقنا المعدة بعناية من أفضل المكونات الطازجة، حيث يجتمع التراث والحداثة في كل وجبة. من المقبلات الشهية إلى الحلويات اللذيذة، كل طبق في غوزانا يحكي قصة من التقاليد والابتكار.",
                'de' => "Unsere Speisekarte bietet eine wunderbare Mischung aus authentischen levantischen Aromen mit modernen, innovativen Akzenten. Entdecken Sie unsere sorgfältig zubereiteten Gerichte aus den besten frischen Zutaten, wo Tradition und Moderne in jedem Gericht zusammentreffen. Von köstlichen Vorspeisen bis hin zu verführerischen Desserts - jedes Gericht in Guzana erzählt eine Geschichte aus Tradition und Innovation.",
            ]]
        );

        Content::updateOrCreate(
            ['key' => 'HOME'],
            ['translations' => [
                'ar' => "مرحبًا بكم في مطعم غوزانا، حيث تلتقي النكهات الشامية الأصيلة باللمسات العصرية. نقدم لكم تجربة طعام فريدة تعكس تراثنا الغني وابتكاراتنا الطهوية.",
                'de' => "Willkommen im Restaurant Guzana, wo authentische levantische Aromen auf moderne Akzente treffen. Wir bieten Ihnen ein einzigartiges kulinarisches Erlebnis, das unser reiches Erbe und unsere kulinarischen Innovationen widerspiegelt.",
            ]]
        );

        Content::updateOrCreate(
            ['key' => 'CONTACT'],
            ['translations' => [
                'ar' => "للاستفسارات والحجوزات، يرجى التواصل معنا عبر الهاتف أو البريد الإلكتروني. نحن نتطلع لخدمتكم وتقديم تجربة لا تُنسى في مطعم غوزانا.",
                'de' => "Für Anfragen und Reservieren erreichen Sie uns telefonisch oder per E-Mail. Wir freuen uns darauf, Sie im Restaurant Guzana zu verwöhnen und Ihnen ein unvergessliches Erlebnis zu bieten.",
            ]]
        );
        Content::updateOrCreate(
            ['key' => 'FOOTER'],
            ['translations' => [
                'ar' => "معلومات الاتصال\nالهاتف: 0176 41512034\nالعنوان: مطعم غوزانا، شارع بفورتنر 13A، 07545 جيرا\nمطعم غوزانا. جميع الحقوق محفوظة.",
                'de' => "Kontaktinformationen\nTelefon: 0176 41512034\nAdresse: Guzana Restaurant, Pfortener Straße 13A, 07545 Gera\nGuzana Restaurant. Alle Rechte vorbehalten.",
            ]]
        );
    }
}