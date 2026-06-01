<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\LearningPath;
use App\Models\Module;
use Illuminate\Database\Seeder;

class SwahiliTitleSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedPaths();
        $this->seedModules();
        $this->seedLessons();
    }

    private function seedPaths(): void
    {
        $translations = [
            1  => ['title_sw' => 'Misingi ya Piano',              'subtitle_sw' => 'Jifunza kibodi na ujuzi wa msingi wa piano'],
            2  => ['title_sw' => 'Kusoma Muziki',                  'subtitle_sw' => 'Soma maandiko ya muziki kwa ufasaha'],
            3  => ['title_sw' => 'Mipigo na Mbinu',                'subtitle_sw' => 'Kuendeleza mbinu na ustadi wa piano'],
            4  => ['title_sw' => 'Akodi na Maelewano',             'subtitle_sw' => 'Elewa jinsi muziki unavyojengwa'],
            5  => ['title_sw' => 'Kucheza kwa Sikio',              'subtitle_sw' => 'Sikia na piga muziki bila maandiko'],
            6  => ['title_sw' => 'Piano ya Ibada na Kuandamana',   'subtitle_sw' => 'Piga kwa waimbaji, kanisani, harusi na matukio'],
            7  => ['title_sw' => 'Gospel na Maelewano ya Kina',    'subtitle_sw' => 'Bwana lugha ya akodi tajiri ya gospel'],
            8  => ['title_sw' => 'Kucheza Kwa Uhuru na Ubunifu',  'subtitle_sw' => 'Unda muziki wako mwenyewe kwa uhuru'],
            9  => ['title_sw' => 'Maktaba ya Nyimbo',              'subtitle_sw' => 'Piga nyimbo za kweli — rahisi hadi ngumu'],
            10 => ['title_sw' => 'Chuo cha Nadharia ya Muziki',   'subtitle_sw' => 'Uelewa wa kina wa jinsi muziki unavyofanya kazi'],
            11 => ['title_sw' => 'Mpiga Kibodi wa Kitaalamu',      'subtitle_sw' => 'Fanya hadharani, piga katika bendi, rekodi na fundisha'],
        ];

        foreach ($translations as $order => $data) {
            LearningPath::where('order', $order)->update($data);
        }
    }

    private function seedModules(): void
    {
        $translations = [
            'PF-M1' => ['title_sw' => 'Kukutana na Piano Yako',           'description_sw' => 'Jifunza mpangilio wa kibodi, majina ya noti, na kupata C ya Kati'],
            'PF-M2' => ['title_sw' => 'Udhibiti wa Vidole na Mkao wa Mkono', 'description_sw' => 'Jenga mkao sahihi, nambari za vidole, na uhuru wa vidole'],
            'PF-M3' => ['title_sw' => 'Misingi ya Mdundo',                'description_sw' => 'Elewa mapigo, thamani za noti, na mazoezi ya metronome'],
            'PF-M4' => ['title_sw' => 'Nyimbo za Kwanza',                 'description_sw' => 'Geuza noti na mdundo kuwa muziki wa kweli'],
            'RM-M1' => ['title_sw' => 'Msururu wa Treble',                'description_sw' => 'Mistari ya msururu, nafasi, na noti za treble'],
            'RM-M2' => ['title_sw' => 'Msururu wa Bass',                  'description_sw' => 'Mistari ya msururu wa bass, nafasi, na noti za bass'],
            'RM-M3' => ['title_sw' => 'Ufasaha wa Kusoma',                'description_sw' => 'Kutambua noti, kusoma maandiko, na kusoma mdundo'],
            'RM-M4' => ['title_sw' => 'Kusoma Nyimbo',                    'description_sw' => 'Tumia ujuzi wa kusoma kwenye nyimbo'],
            'ST-M1' => ['title_sw' => 'Mipigo ya Kibara (Major)',         'description_sw' => 'Mipigo ya C, G, D, A, E, F ya kibara'],
            'ST-M2' => ['title_sw' => 'Mipigo Midogo (Minor)',            'description_sw' => 'Mipigo midogo ya kawaida, ya harmonic, na ya melodic'],
            'ST-M3' => ['title_sw' => 'Mazoezi ya Mbinu',                 'description_sw' => 'Mazoezi ya vidole, kasi, usahihi, na uratibu'],
            'CH-M1' => ['title_sw' => 'Vipande vya Sauti (Intervals)',    'description_sw' => 'Elewa vipande vya sauti vikubwa na vidogo'],
            'CH-M2' => ['title_sw' => 'Akodi Kubwa (Major Chords)',       'description_sw' => 'Jenga akodi tatu na uzimudu katika nafasi ya msingi'],
            'CH-M3' => ['title_sw' => 'Akodi Ndogo (Minor Chords)',       'description_sw' => 'Akodi tatu ndogo na mazoezi'],
            'CH-M4' => ['title_sw' => 'Mabadiliko ya Akodi',              'description_sw' => 'Mabadiliko ya kwanza na pili, mwendo laini wa sauti'],
            'CH-M5' => ['title_sw' => 'Mfululizo wa Akodi',               'description_sw' => 'I-IV-V, I-V-vi-IV, ii-V-I na nyimbo za mazoezi'],
            'BE-M1' => ['title_sw' => 'Msingi wa Mafunzo ya Sikio',       'description_sw' => 'Juu vs chini, sawa vs tofauti, kutambua vipande'],
            'BE-M2' => ['title_sw' => 'Kutambua Akodi kwa Sikio',         'description_sw' => 'Akodi kubwa, ndogo, na za saba kwa sikio'],
            'BE-M3' => ['title_sw' => 'Kutambua Wimbo kwa Sikio',         'description_sw' => 'Nyimbo rahisi na vipande vya nyimbo kwa sikio'],
            'BE-M4' => ['title_sw' => 'Kucheza kwa Sikio',                'description_sw' => 'Pata wimbo, ongeza akodi, piga nyimbo kamili'],
            'WP-M1' => ['title_sw' => 'Mfumo wa Nambari',                 'description_sw' => 'Viwango vya mipigo, akodi ya 1, ya 4, ya 5'],
            'WP-M2' => ['title_sw' => 'Mifululizo ya Kawaida ya Akodi',   'description_sw' => '1-4-5, 1-5-6-4, 6-2-5-1 katika tonali zote'],
            'WP-M3' => ['title_sw' => 'Mitindo ya Ibada',                 'description_sw' => 'Ibada ya polepole, mtindo wa sifa, ibada ya kisasa'],
            'WP-M4' => ['title_sw' => 'Mifumo ya Kuandamana',             'description_sw' => 'Akodi za kuzuia, akodi za kuvunjwa, mifumo ya mdundo'],
            'WP-M5' => ['title_sw' => 'Kucheza na Waimbaji',              'description_sw' => 'Kumfuata mwimbaji, kubadilisha tonali, kumaliza wimbo'],
            'GA-M1' => ['title_sw' => 'Akodi za Saba',                    'description_sw' => 'Akodi kubwa 7, ndogo 7, na za dominant 7'],
            'GA-M2' => ['title_sw' => 'Akodi Zilizopanuliwa',             'description_sw' => 'Akodi za 9, 11, na 13'],
            'GA-M3' => ['title_sw' => 'Akodi za Kupita',                  'description_sw' => 'Akodi za kupita za chromatic na diatonic'],
            'GA-M4' => ['title_sw' => 'Kubadilisha Maelewano',            'description_sw' => 'Akodi mbadala na ubadilishaji wa kina wa maelewano'],
            'GA-M5' => ['title_sw' => 'Mifululizo ya Gospel',             'description_sw' => 'Mwendo wa kawaida wa akodi za gospel'],
            'IC-M1' => ['title_sw' => 'Msingi wa Kucheza Kwa Uhuru',      'description_sw' => 'Mipigo, nia, na mwitikio wa pande zote'],
            'IC-M2' => ['title_sw' => 'Mipigo ya Pentatonic',             'description_sw' => 'Pentatonic kubwa na ndogo kwa kucheza kwa uhuru'],
            'IC-M3' => ['title_sw' => 'Dhana za Blues',                   'description_sw' => 'Mipigo ya blues, hisia ya shuffle, blues ya baa 12'],
            'IC-M4' => ['title_sw' => 'Kuunda Mapambo ya Muziki',         'description_sw' => 'Riffs, runs, na mapambo kati ya mishororo'],
            'IC-M5' => ['title_sw' => 'Solo ya Muziki',                   'description_sw' => 'Ujenzi kamili wa solo juu ya mifululizo ya akodi'],
            'SL-M1' => ['title_sw' => 'Nyimbo za Wanafunzi Wapya',        'description_sw' => 'Nyimbo rahisi kwa wachezaji wapya'],
            'SL-M2' => ['title_sw' => 'Muziki wa Kiswahili wa Jadi',     'description_sw' => 'Vipande vya classical vilivyopangwa kwa kujifunza'],
            'SL-M3' => ['title_sw' => 'Nyimbo za Ibada na Gospel',        'description_sw' => 'Nyimbo za kanisa na viwango vya gospel'],
            'SL-M4' => ['title_sw' => 'Nyimbo za Kiafrika',               'description_sw' => 'Nyimbo za Afrika Mashariki na Kiswahili'],
            'SL-M5' => ['title_sw' => 'Nyimbo za Pop na Harusi',          'description_sw' => 'Nyimbo maarufu na muziki wa harusi'],
            'MT-M1' => ['title_sw' => 'Tonali na Alama za Tonali',        'description_sw' => 'Tonali kubwa na ndogo, sharps na flats'],
            'MT-M2' => ['title_sw' => 'Mzunguko wa Tano',                 'description_sw' => 'Mzunguko wa tano na uhusiano wa tonali'],
            'MT-M3' => ['title_sw' => 'Kazi za Akodi',                    'description_sw' => 'Kazi za tonic, subdominant, na dominant'],
            'MT-M4' => ['title_sw' => 'Uchambuzi wa Nyimbo',              'description_sw' => 'Changanua nyimbo za kweli kwa kutumia dhana za nadharia'],
            'MT-M5' => ['title_sw' => 'Msingi wa Kutunga Muziki',         'description_sw' => 'Andika nyimbo na mifululizo ya akodi yako mwenyewe'],
            'PK-M1' => ['title_sw' => 'Kucheza katika Bendi',             'description_sw' => 'Kucheza na ngoma, besi, na waimbaji'],
            'PK-M2' => ['title_sw' => 'Kupanga Muziki',                   'description_sw' => 'Kupanga nyimbo kwa kibodi na ensembles'],
            'PK-M3' => ['title_sw' => 'Onyesho la Hadharani',             'description_sw' => 'Mwelekeo wa jukwaa, nguvu, na kujieleza kihisia'],
            'PK-M4' => ['title_sw' => 'Kubadilisha Tonali',               'description_sw' => 'Piga nyimbo katika tonali yoyote inapoombwa'],
            'PK-M5' => ['title_sw' => 'Mpangilio wa Kibodi',              'description_sw' => 'Sauti, tabaka, mgawanyo, na matumizi ya pedal'],
            'PK-M6' => ['title_sw' => 'Msingi wa MIDI',                   'description_sw' => 'MIDI, DAWs, na vidhibiti vya kibodi'],
            'PK-M7' => ['title_sw' => 'Kurekodi Muziki',                  'description_sw' => 'Kurekodi nyumbani, loops, na misingi ya uzalishaji'],
        ];

        foreach ($translations as $code => $data) {
            Module::where('module_code', $code)->update($data);
        }
    }

    private function seedLessons(): void
    {
        $translations = [
            1 => ['title_sw' => 'Kukutana na C ya Kati',         'description_sw' => 'Tafuta na piga noti yako ya kwanza'],
            2 => ['title_sw' => 'Kukutana na Vitufe vya Nyeupe', 'description_sw' => 'Jifunza C, D, E, F na G'],
            3 => ['title_sw' => 'Wimbo Wako wa Kwanza',          'description_sw' => 'Piga wimbo rahisi wa noti 3'],
            4 => ['title_sw' => 'Noti za Juu',                   'description_sw' => 'Chunguza A, B na C ya juu'],
            5 => ['title_sw' => 'Oktava Kamili',                 'description_sw' => 'Piga noti zote 8 za gamut ya C'],
        ];

        foreach ($translations as $order => $data) {
            Lesson::where('order', $order)->update($data);
        }
    }
}
