<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Generation;
use App\Models\Type;
use App\Models\Pokemon;
use App\Models\PokemonDetail;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        //GENERAZIONI-

        $gen1 = new Generation();
        $gen1->number = 1;
        $gen1->region = 'Kanto';
        $gen1->save();

        $gen2 = new Generation();
        $gen2->number = 2;
        $gen2->region = 'Johto';
        $gen2->save();

        $gen3 = new Generation();
        $gen3->number = 3;
        $gen3->region = 'Hoenn';
        $gen3->save();

        //TIPI

        $typesList = [
            'Erba' => 'Efficace contro Acqua',
            'Fuoco' => 'Efficace contro Erba',
            'Acqua' => 'Efficace contro Fuoco',
            'Elettro' => 'Efficace contro Volante',
            'Psico' => 'Efficace contro Lotta',
            'Veleno' => 'Efficace contro Erba',
            'Volante' => 'Efficace contro Lotta',
            'Terra' => 'Efficace contro Elettro',
            'Folletto' => 'Efficace contro Drago',
            'Normale' => 'Tipo bilanciato',
            'Roccia' => 'Efficace contro Fuoco',
            'Acciaio' => 'Efficace contro Folletto',
            'Drago' => 'Efficace contro Drago',
            'Buio' => 'Efficace contro Psico',
            'Lotta' => 'Efficace contro Normale'
        ];

$typeModels = [];
foreach ($typesList as $name => $desc) {
    $t = new Type();
    $t->name = $name;
    $t->description = $desc;
    $t->image = 'types_img/' . $name . '.jpg';

    $t->save();
    $typeModels[$name] = $t;
}

        //DATASET POKEMON(45)
    $pokemonData = [
        // Kanto
        ['gen' => $gen1->id, 'name' => 'Bulbasaur', 'types' => ['Erba', 'Veleno'], 'h' => 0.7, 'w' => 6.9, 'desc' => 'Dalla nascita ha un seme sulla schiena che cresce insieme a lui.', 'image' => 'pokemon_img/Bulbasaur.png'],
        ['gen' => $gen1->id, 'name' => 'Ivysaur', 'types' => ['Erba', 'Veleno'], 'h' => 1.0, 'w' => 13.0, 'desc' => 'Quando il bulbo sulla schiena si gonfia, emana un dolce profumo: è segno che fiorirà presto.', 'image' => 'pokemon_img/Ivysaur.png'],
        ['gen' => $gen1->id, 'name' => 'Venusaur', 'types' => ['Erba', 'Veleno'], 'h' => 2.0, 'w' => 100.0, 'desc' => 'Il grande fiore sulla schiena assorbe i raggi solari per convertirli in energia.', 'image' => 'pokemon_img/Venusaur.png'],
        ['gen' => $gen1->id, 'name' => 'Charmander', 'types' => ['Fuoco'], 'h' => 0.6, 'w' => 8.5, 'desc' => 'La fiamma sulla punta della coda indica la sua forza vitale: se è debole, anche lui sta male.', 'image' => 'pokemon_img/Charmander.png'],
        ['gen' => $gen1->id, 'name' => 'Charmeleon', 'types' => ['Fuoco'], 'h' => 1.1, 'w' => 19.0, 'desc' => 'Pokémon molto aggressivo; se si eccita durante la lotta, sputa fiamme bianco-azzurre.', 'image' => 'pokemon_img/Charmeleon.png'],
        ['gen' => $gen1->id, 'name' => 'Charizard', 'types' => ['Fuoco', 'Volante'], 'h' => 1.7, 'w' => 90.5, 'desc' => 'Vola nel cielo alla ricerca di avversari forti. Il suo soffio può sciogliere i ghiacciai.', 'image' => 'pokemon_img/Charizard.png'],
        ['gen' => $gen1->id, 'name' => 'Squirtle', 'types' => ['Acqua'], 'h' => 0.5, 'w' => 9.0, 'desc' => 'Dopo la nascita la schiena gli si indurisce formando un guscio. Sputa schiuma dalla bocca.', 'image' => 'pokemon_img/Squirtle.jpg'],
        ['gen' => $gen1->id, 'name' => 'Wartortle', 'types' => ['Acqua'], 'h' => 1.0, 'w' => 22.5, 'desc' => 'È considerato un simbolo di longevità. La sua coda folta è ricoperta di una soffice pelliccia.', 'image' => 'pokemon_img/Wartortle.jpg'],
        ['gen' => $gen1->id, 'name' => 'Blastoise', 'types' => ['Acqua'], 'h' => 1.6, 'w' => 85.5, 'desc' => 'I cannoni sul suo guscio sparano getti d’acqua capaci di perforare l’acciaio.', 'image' => 'pokemon_img/Blastoise.png'],
        ['gen' => $gen1->id, 'name' => 'Pikachu', 'types' => ['Elettro'], 'h' => 0.4, 'w' => 6.0, 'desc' => 'Immagazzina elettricità nelle sacche sulle guance. Se si arrabbia, la rilascia all’istante.', 'image' => 'pokemon_img/Pikachu.jpg'],
        ['gen' => $gen1->id, 'name' => 'Raichu', 'types' => ['Elettro'], 'h' => 0.8, 'w' => 30.0, 'desc' => 'Se accumula troppa elettricità diventa aggressivo. Usa la coda per scaricare l’eccesso a terra.', 'image' => 'pokemon_img/Raichu.png'],
        ['gen' => $gen1->id, 'name' => 'Sandshrew', 'types' => ['Terra'], 'h' => 0.6, 'w' => 12.0, 'desc' => 'Vive in zone aride. Se minacciato si appallottola per proteggersi e rotolare via.', 'image' => 'pokemon_img/Sandshrew.jpg'],
        ['gen' => $gen1->id, 'name' => 'Vulpix', 'types' => ['Fuoco'], 'h' => 0.6, 'w' => 9.9, 'desc' => 'All’interno del corpo ha una fiamma perenne. Nasce con una sola coda bianca che poi si divide.', 'image' => 'pokemon_img/Vulpix.jpg'],
        ['gen' => $gen1->id, 'name' => 'Jigglypuff', 'types' => ['Normale', 'Folletto'], 'h' => 0.5, 'w' => 5.5, 'desc' => 'I suoi grandi occhi incantano il nemico mentre intona una melodia che addormenta chiunque.', 'image' => 'pokemon_img/Jigglypuff.png'],
        ['gen' => $gen1->id, 'name' => 'Abra', 'types' => ['Psico'], 'h' => 0.9, 'w' => 19.5, 'desc' => 'Dorme 18 ore al giorno. Riesce a usare il teletrasporto anche mentre sta dormendo.', 'image' => 'pokemon_img/Abra.png'],

        // Johto
        ['gen' => $gen2->id, 'name' => 'Chikorita', 'types' => ['Erba'], 'h' => 0.9, 'w' => 6.4, 'desc' => 'La foglia sulla testa emana un aroma dolce che calma i Pokémon che lottano.', 'image' => 'pokemon_img/Chikorita.jpg'],
        ['gen' => $gen2->id, 'name' => 'Bayleef', 'types' => ['Erba'], 'h' => 1.2, 'w' => 15.8, 'desc' => 'Il profumo speziato che emana dal collo ha un effetto rinvigorente su chi lo annusa.', 'image' => 'pokemon_img/Bayleef.jpg'],
        ['gen' => $gen2->id, 'name' => 'Meganium', 'types' => ['Erba'], 'h' => 1.8, 'w' => 100.5, 'desc' => 'Il suo fiato ha il potere magico di ridare vita alle piante e ai fiori appassiti.', 'image' => 'pokemon_img/Meganium.png'],
        ['gen' => $gen2->id, 'name' => 'Cyndaquil', 'types' => ['Fuoco'], 'h' => 0.5, 'w' => 7.9, 'desc' => 'Timido e schivo, emette fiammate dal dorso quando è spaventato o si arrabbia.', 'image' => 'pokemon_img/Cyndaquil.png'],
        ['gen' => $gen2->id, 'name' => 'Quilava', 'types' => ['Fuoco'], 'h' => 0.9, 'w' => 19.0, 'desc' => 'Prima della lotta intimidisce i nemici con l’intensità delle sue fiamme e folate d’aria calda.', 'image' => 'pokemon_img/Quilava.jpg'],
        ['gen' => $gen2->id, 'name' => 'Typhlosion', 'types' => ['Fuoco'], 'h' => 1.7, 'w' => 79.5, 'desc' => 'Se la sua rabbia esplode, diventa così caldo da incendiare tutto ciò che lo circonda.', 'image' => 'pokemon_img/Typhlosion.png'],
        ['gen' => $gen2->id, 'name' => 'Totodile', 'types' => ['Acqua'], 'h' => 0.6, 'w' => 9.5, 'desc' => 'Piccolo ma vivace. Tende a mordere tutto ciò che vede muoversi con le sue potenti mascelle.', 'image' => 'pokemon_img/Totodile.png'],
        ['gen' => $gen2->id, 'name' => 'Croconaw', 'types' => ['Acqua'], 'h' => 1.1, 'w' => 25.0, 'desc' => 'Una volta che ha morso un nemico, non molla la presa grazie alle sue zanne ricurve.', 'image' => 'pokemon_img/Croconaw.png'],
        ['gen' => $gen2->id, 'name' => 'Feraligatr', 'types' => ['Acqua'], 'h' => 2.3, 'w' => 88.8, 'desc' => 'Imponente predatore che azzanna la preda e la scuote con violenza per lacerarla.', 'image' => 'pokemon_img/Feraligatr.png'],
        ['gen' => $gen2->id, 'name' => 'Togepi', 'types' => ['Folletto'], 'h' => 0.3, 'w' => 1.5, 'desc' => 'Si dice che il suo guscio sia pieno di felicità e che porti fortuna se trattato con gentilezza.', 'image' => 'pokemon_img/Togepi.png'],
        ['gen' => $gen2->id, 'name' => 'Mareep', 'types' => ['Elettro'], 'h' => 0.6, 'w' => 7.8, 'desc' => 'La sua lana soffice accumula elettricità statica. Più energia ha, più la lampadina sulla coda brilla.', 'image' => 'pokemon_img/Mareep.jpg'],
        ['gen' => $gen2->id, 'name' => 'Marill', 'types' => ['Acqua', 'Folletto'], 'h' => 0.4, 'w' => 8.5, 'desc' => 'La sua coda funge da galleggiante, permettendogli di nuotare in correnti forti senza affondare.', 'image' => 'pokemon_img/Marill.png'],
        ['gen' => $gen2->id, 'name' => 'Sudowoodo', 'types' => ['Roccia'], 'h' => 1.2, 'w' => 38.0, 'desc' => 'Si mimetizza da albero per evitare attacchi. Poiché odia l’acqua, scompare se inizia a piovere.', 'image' => 'pokemon_img/Sudowoodo.png'],
        ['gen' => $gen2->id, 'name' => 'Espeon', 'types' => ['Psico'], 'h' => 0.9, 'w' => 26.5, 'desc' => 'È molto leale al suo allenatore. Usa il pelo sottile per percepire le correnti d’aria e prevedere il futuro.', 'image' => 'pokemon_img/Espeon.png'],
        ['gen' => $gen2->id, 'name' => 'Umbreon', 'types' => ['Buio'], 'h' => 1.0, 'w' => 27.0, 'desc' => 'I cerchi sul suo corpo brillano quando si espone alla luce lunare o quando scende in battaglia.', 'image' => 'pokemon_img/Umbreon.png'],

        // Hoenn
        ['gen' => $gen3->id, 'name' => 'Treecko', 'types' => ['Erba'], 'h' => 0.5, 'w' => 5.0, 'desc' => 'Possiede piccoli uncini sotto le zampe che gli permettono di camminare sui muri e sui soffitti.', 'image' => 'pokemon_img/Treecko.png'],
        ['gen' => $gen3->id, 'name' => 'Grovyle', 'types' => ['Erba'], 'h' => 0.9, 'w' => 21.6, 'desc' => 'Vive nelle foreste fitte. Salta da un ramo all’altro con estrema agilità e velocità.', 'image' => 'pokemon_img/Grovyle.jpg'],
        ['gen' => $gen3->id, 'name' => 'Sceptile', 'types' => ['Erba'], 'h' => 1.7, 'w' => 52.2, 'desc' => 'Le foglie sulle sue braccia sono affilate come spade. È considerato il re della giungla.', 'image' => 'pokemon_img/Sceptile.png'],
        ['gen' => $gen3->id, 'name' => 'Torchic', 'types' => ['Fuoco'], 'h' => 0.4, 'w' => 2.5, 'desc' => 'Sotto il suo piumaggio nasconde una sacca di fuoco. Se lo abbracci, scotta come una borsa dell’acqua calda.', 'image' => 'pokemon_img/Torchic.png'],
        ['gen' => $gen3->id, 'name' => 'Combusken', 'types' => ['Fuoco', 'Lotta'], 'h' => 0.9, 'w' => 19.5, 'desc' => 'Si allena sferrando calci rapidissimi. È molto rumoroso e combattivo durante l’evoluzione.', 'image' => 'pokemon_img/Combusken.png'],
        ['gen' => $gen3->id, 'name' => 'Blaziken', 'types' => ['Fuoco', 'Lotta'], 'h' => 1.9, 'w' => 52.0, 'desc' => 'Può saltare sopra palazzi altissimi. I suoi pugni emettono fiamme che bruciano l’avversario.', 'image' => 'pokemon_img/Blaziken.png'],
        ['gen' => $gen3->id, 'name' => 'Mudkip', 'types' => ['Acqua'], 'h' => 0.4, 'w' => 7.6, 'desc' => 'La pinna sulla testa funge da radar sensibile, permettendogli di percepire i movimenti nell’acqua.', 'image' => 'pokemon_img/Mudkip.png'],
        ['gen' => $gen3->id, 'name' => 'Marshtomp', 'types' => ['Acqua', 'Terra'], 'h' => 0.7, 'w' => 28.0, 'desc' => 'Si muove più velocemente nel fango che nell’acqua. Vive sulle spiagge paludose.', 'image' => 'pokemon_img/Marshtomp.png'],
        ['gen' => $gen3->id, 'name' => 'Swampert', 'types' => ['Acqua', 'Terra'], 'h' => 1.5, 'w' => 81.9, 'desc' => 'Ha una forza mostruosa: può trascinare massi che pesano più di una tonnellata.', 'image' => 'pokemon_img/Swampert.jpg'],
        ['gen' => $gen3->id, 'name' => 'Ralts', 'types' => ['Psico', 'Folletto'], 'h' => 0.4, 'w' => 6.6, 'desc' => 'Percepisce le emozioni delle persone. Se avverte ostilità, si nasconde immediatamente.', 'image' => 'pokemon_img/Ralts.jpg'],
        ['gen' => $gen3->id, 'name' => 'Gardevoir', 'types' => ['Psico', 'Folletto'], 'h' => 1.6, 'w' => 48.4, 'desc' => 'È pronto a dare la vita per proteggere il suo allenatore. Può vedere il futuro grazie ai suoi poteri.', 'image' => 'pokemon_img/Gardevoir.png'],
        ['gen' => $gen3->id, 'name' => 'Slakoth', 'types' => ['Normale'], 'h' => 0.8, 'w' => 24.0, 'desc' => 'Passa quasi tutta la giornata a poltrire. Il suo battito cardiaco è estremamente lento.', 'image' => 'pokemon_img/Slakoth.png'],
        ['gen' => $gen3->id, 'name' => 'Aron', 'types' => ['Acciaio', 'Roccia'], 'h' => 0.4, 'w' => 60.0, 'desc' => 'Si nutre di ferro per costruire la sua corazza. A volte mangia anche i binari ferroviari.', 'image' => 'pokemon_img/Aron.png'],
        ['gen' => $gen3->id, 'name' => 'Aggron', 'types' => ['Acciaio', 'Roccia'], 'h' => 2.1, 'w' => 360.0, 'desc' => 'Rivendica un’intera montagna come suo territorio e la protegge ferocemente da ogni intruso.', 'image' => 'pokemon_img/Aggron.png'],
        ['gen' => $gen3->id, 'name' => 'Flygon', 'types' => ['Terra', 'Drago'], 'h' => 2.0, 'w' => 82.0, 'desc' => 'È chiamato "lo spirito del deserto" perché il battito delle sue ali suona come un canto umano.', 'image' => 'pokemon_img/Flygon.png'],
];


        foreach ($pokemonData as $data) {

            $p = new Pokemon();
            $p->name = $data['name'];
            $p->image =  $data['image'];
            $p->generation_id = $data['gen'];
            $p->save(); // Salviamo nel database

            $d = new PokemonDetail();
            $d->height = $data['h'];
            $d->weigth = $data['w'];
            $d->description = $data['desc'];
            $d->pokemon_id = $p->id;
            $d->save();


            foreach ($data['types'] as $typeName) {
                $typeId = $typeModels[$typeName]->id;
                $p->types()->attach($typeId);
            }
        }
    }
}