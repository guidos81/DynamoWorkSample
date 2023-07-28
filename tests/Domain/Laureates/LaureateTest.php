<?php

declare(strict_types=1);

namespace Tests\Domain\Laureates;

use App\Domain\Laureates\Laureate;
use Tests\TestCase;

class LaureateTest extends TestCase
{
    public function testGetters(): void
    {
        $laureate = new Laureate('Full Name', 'Birth Date', 'Native Country', 'Category', 'Awarded Date');

        $this->assertEquals('Full Name', $laureate->getFullName());
        $this->assertEquals('Birth Date', $laureate->getBirthDate());
        $this->assertEquals('Native Country', $laureate->getNativeCountry());
        $this->assertEquals('Category', $laureate->getCategory());
        $this->assertEquals('Awarded Date', $laureate->getAwardedDate());
    }

    public function testJsonSerialize(): void
    {
        $laureate = new Laureate('Full Name', 'Birth Date', 'Native Country', 'Category', 'Awarded Date');

        $this->assertJson(json_encode([
            'full-name' => 'Full Name',
            'birth-date' => 'Birth Date',
            'native-country' => 'Native Country',
            'category' => 'Category',
            'date-awarded' => 'Date Awarded',
        ]), json_encode($laureate));
    }

    public function testFromJson(): void
    {
        $json = json_decode('{"id":"259","knownName":{"en":"Aaron Klug","se":"Aaron Klug"},"givenName":{"en":"Aaron","se":"Aaron"},"familyName":{"en":"Klug","se":"Klug"},"fullName":{"en":"Aaron Klug","se":"Aaron Klug"},"fileName":"klug","gender":"male","birth":{"date":"1926-08-11","place":{"city":{"en":"Zelvas","no":"Zelvas","se":"Zelvas"},"country":{"en":"Lithuania","no":"Litauen","se":"Litauen"},"cityNow":{"en":"Zelvas","no":"Zelvas","se":"Zelvas","sameAs":["https://www.wikidata.org/wiki/Q691679","https://www.wikipedia.org/wiki/%C5%BDelva"]},"countryNow":{"en":"Lithuania","no":"Litauen","se":"Litauen","sameAs":["https://www.wikidata.org/wiki/Q37"]},"continent":{"en":"Europe","no":"Europa","se":"Europa"},"locationString":{"en":"Zelvas, Lithuania","no":"Zelvas, Litauen","se":"Zelvas, Litauen"}}},"death":{"date":"2018-11-20","place":{"locationString":{"en":"","no":"","se":""}}},"wikipedia":{"slug":"Aaron_Klug","english":"https://en.wikipedia.org/wiki/Aaron_Klug"},"wikidata":{"id":"Q190626","url":"https://www.wikidata.org/wiki/Q190626"},"sameAs":["https://www.wikidata.org/wiki/Q190626","https://en.wikipedia.org/wiki/Aaron_Klug"],"links":[{"rel":"laureate","href":"https://api.nobelprize.org/2/laureate/259","action":"GET","types":"application/json"},{"rel":"external","href":"https://www.nobelprize.org/laureate/259","title":"Aaron Klug - Facts","action":"GET","types":"text/html","class":["laureate facts"]}],"nobelPrizes":[{"awardYear":"1982","category":{"en":"Chemistry","no":"Kjemi","se":"Kemi"},"categoryFullName":{"en":"The Nobel Prize in Chemistry","no":"Nobelprisen i kjemi","se":"Nobelpriset i kemi"},"sortOrder":"1","portion":"1","dateAwarded":"1982-10-18","prizeStatus":"received","motivation":{"en":"for his development of crystallographic electron microscopy and his structural elucidation of biologically important nucleic acid-protein complexes","se":"för hans utveckling av kristallografisk elektronmikroskopi och hans klarläggande av strukturen hos biologiskt viktiga nukleinsyra-proteinkomplex"},"prizeAmount":1150000,"prizeAmountAdjusted":3158777,"affiliations":[{"name":{"en":"MRC Laboratory of Molecular Biology","no":"MRC Laboratory of Molecular Biology","se":"MRC Laboratory of Molecular Biology"},"nameNow":{"en":"MRC Laboratory of Molecular Biology"},"city":{"en":"Cambridge","no":"Cambridge","se":"Cambridge"},"country":{"en":"United Kingdom","no":"Storbritannia","se":"Storbritannien"},"cityNow":{"en":"Cambridge","no":"Cambridge","se":"Cambridge","sameAs":["https://www.wikidata.org/wiki/Q350","https://www.wikipedia.org/wiki/Cambridge"]},"countryNow":{"en":"United Kingdom","no":"Storbritannia","se":"Storbritannien","sameAs":["https://www.wikidata.org/wiki/Q145"]},"locationString":{"en":"Cambridge, United Kingdom","no":"Cambridge, Storbritannia","se":"Cambridge, Storbritannien"}}],"links":[{"rel":"nobelPrize","href":"https://api.nobelprize.org/2/nobelPrize/che/1982","action":"GET","types":"application/json"},{"rel":"external","href":"https://www.nobelprize.org/prizes/chemistry/1982/klug/facts/","title":"Aaron Klug - Facts","action":"GET","types":"text/html","class":["laureate facts"]},{"rel":"external","href":"https://www.nobelprize.org/prizes/chemistry/1982/summary/","title":"The Nobel Prize in Chemistry 1982","action":"GET","types":"text/html","class":["prize summary"]}]}]}', true);

        $laureate = Laureate::fromJson($json);

        $this->assertEquals('Aaron Klug', $laureate->getFullName());
        $this->assertEquals('1926-08-11', $laureate->getBirthDate());
        $this->assertEquals('Lithuania', $laureate->getNativeCountry());
        $this->assertEquals('Chemistry', $laureate->getCategory());
        $this->assertEquals('1982-10-18', $laureate->getAwardedDate());
    }
}
