<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoralSeeder extends Seeder
{
    public function run()
    {
        $corals = [
            ['nama' => 'Acanthastrea sp.'],
            ['nama' => 'Acanthophyllia deshayesiana'],
            ['nama' => 'Acropora spp.'],
            ['nama' => 'Alveopora sp.'],
            ['nama' => 'Base rock (unidentified scleractinian)'],
            ['nama' => 'Blastomussa wellsi'],
            ['nama' => 'Catalaphyllia jardinei'],
            ['nama' => 'Caulastrea sp.'],
            ['nama' => 'Cycloseris sp.'],
            ['nama' => 'Cynarina lacrymalis'],
            ['nama' => 'Cyphastrea serailia'],
            ['nama' => 'Diploastrea heliopora'],
            ['nama' => 'Distichopora spp.'],
            ['nama' => 'Echinophyllia sp.'],
            ['nama' => 'Echinopora lamellosa'],
            ['nama' => 'Eguchipsammia fistula (syn. Dendrophyllia fistula)'],
            ['nama' => 'Euphyllia ancora'],
            ['nama' => 'Euphyllia cristata'],
            ['nama' => 'Euphyllia divisa'],
            ['nama' => 'Euphyllia glabrescens'],
            ['nama' => 'Euphyllia paraancora'],
            ['nama' => 'Euphyllia paradivisa'],
            ['nama' => 'Favia sp.'],
            ['nama' => 'Favites sp.'],
            ['nama' => 'Fungia distorta (syn. Cycloseris distorta)'],
            ['nama' => 'Fungia fragilis (syn. Cycloseris fragilis)'],
            ['nama' => 'Fungia spp.'],
            ['nama' => 'Galaxea astreata'],
            ['nama' => 'Galaxea fascicularis'],
            ['nama' => 'Goniastrea sp.'],
            ['nama' => 'Goniopora lobata'],
            ['nama' => 'Goniopora sp.'],
            ['nama' => 'Goniopora stokesi'],
            ['nama' => 'Heliofungia actiniformis'],
            ['nama' => 'Heliopora coerulea'],
            ['nama' => 'Herpolitha limax'],
            ['nama' => 'Hydnophora exesa'],
            ['nama' => 'Hydnophora microconos'],
            ['nama' => 'Lobophyllia corymbosa'],
            ['nama' => 'Lobophyllia sp.'],
            ['nama' => 'Merulina ampliata'],
            ['nama' => 'Millepora spp.'],
            ['nama' => 'Montastrea sp.'],
            ['nama' => 'Montipora spp.'],
            ['nama' => 'Mycedium elephantotus'],
            ['nama' => 'Mycedium robokaki'],
            ['nama' => 'Oxypora sp.'],
            ['nama' => 'Pectinia sp.'],
            ['nama' => 'Physogyra lichtensteini'],
            ['nama' => 'Plerogyra sinuosa'],
            ['nama' => 'Plerogyra turbida (syn. Nemenzophyllia turbida)'],
            ['nama' => 'Polyphyllia talpina'],
            ['nama' => 'Porites spp.'],
            ['nama' => 'Scolymia vitiensis'],
            ['nama' => 'Substrat (unidentified scleractinian)'],
            ['nama' => 'Symphyllia sp.'],
            ['nama' => 'Trachyphyllia geoffroyi (syn. Wellsophyllia radiata)'],
            ['nama' => 'Tubastrea sp.'],
            ['nama' => 'Tubipora musica'],
            ['nama' => 'Turbinaria peltata'],
            ['nama' => 'Turbinaria sp.'],
        ];

        DB::table('corals')->insert($corals);
    }
}
