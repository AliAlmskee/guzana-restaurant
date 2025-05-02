<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentController extends Controller
{
    private $content = [
        'ABOUT' => [
            'ar' => "يأخذك مطعم غوزانا التقليدي في رحلة طهي غير عادية تجمع بشكل مثالي بين الأصالة والحداثة. مع سحر أطباقنا والجمال الذي لا يضاهى لأجواءنا، نأخذك في رحلة مباشرة إلى دمشق. دع نفسك تسحر بالروائح اللذيذة والضيافة الدافئة والأجواء الفريدة. مرحبا بك في غوزانا، المكان الذي يلتقي فيه التقليد بالابتكار وكل لدغة تحكي قصة.",
            'de' => "Das traditionelle Restaurant Guzana entführt Sie auf eine außergewöhnliche kulinarische Reise, die Authentizität und Moderne perfekt vereint. Mit der Magie unserer Gerichte und der unvergleichlichen Schönheit unseres Ambientes nehmen wir Sie mit auf eine direkte Reise nach Damaskus. Lassen Sie sich von den köstlichen Aromen, der herzlichen Gastfreundschaft und der einzigartigen Atmosphäre verzaubern. Willkommen bei Guzana, einem Ort, an dem Tradition auf Innovation trifft und jeder Bissen eine Geschichte erzählt."
        ],
        'MENU' => [
            'ar' => "قائمتنا تقدم مزيجاً رائعاً من النكهات الشامية الأصيلة مع لمسات عصرية مبتكرة. اكتشف أطباقنا المعدة بعناية من أفضل المكونات الطازجة، حيث يجتمع التراث والحداثة في كل وجبة. من المقبلات الشهية إلى الحلويات اللذيذة، كل طبق في غوزانا يحكي قصة من التقاليد والابتكار.",
            'de' => "Unsere Speisekarte bietet eine wunderbare Mischung aus authentischen levantischen Aromen mit modernen, innovativen Akzenten. Entdecken Sie unsere sorgfältig zubereiteten Gerichte aus den besten frischen Zutaten, wo Tradition und Moderne in jedem Gericht zusammentreffen. Von köstlichen Vorspeisen bis hin zu verführerischen Desserts - jedes Gericht in Guzana erzählt eine Geschichte aus Tradition und Innovation."
        ]
    ];

    public function about(Request $request)
    {
        return $this->getContent($request, 'ABOUT');
    }

    public function menu(Request $request) 
    {
        return $this->getContent($request, 'MENU');
    }

    private function getContent(Request $request, string $type)
    {
        $lang = $request->attributes->get('validated_lang', 'de');
        return response()->json([
            'content' => $this->content[$type][$lang] ?? $this->content[$type]['de']
        ]);
    }

    private function getTextContent(string $type, string $lang): string
    {
        return $this->content[$type][$lang] ?? $this->content[$type]['de'] ?? '';
    }
}