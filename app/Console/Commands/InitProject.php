<?php

namespace App\Console\Commands;

use App\Models\Archivelocation;
use App\Models\Artefact;
use App\Models\Artefacttype;
use App\Models\Attribute;
use App\Models\Listvalue;
use App\Models\User;
use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Faker\Factory as Faker;

class InitProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init the project';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->info("Performing initial migration:");
        Artisan::call('migrate:refresh');

        $this->info("Creating Admin User : " . PHP_EOL);
        $user = new User();
        $user->name = 'Poovarasan';
        $user->email = 'poosan9@gmail.com';
        $user->password = md5('password');
        $user->avatar = '';
        $user->save();

        $this->info("Creating Fake User : " . PHP_EOL);
        $bar = $this->output->createProgressBar(100);
        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            $user = new User();
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->password = md5('password');
            $user->avatar = $faker->imageUrl();
            $user->save();

            $bar->advance();
        }

        $bar->finish();
        $this->line("" . PHP_EOL);
        $this->info("Creating Artefact types : " . PHP_EOL);
        $types = DB::connection('mysqlgas')->select("SELECT * FROM artefacttype WHERE ArtefactTypePID is NULL");

        $bar = $this->output->createProgressBar(count($types));
        $para = $faker->paragraph;
        foreach ($types as $type) {
            $at = $this->getArtefactName($type->ArtefactTypeCode);
            if ($at) {
                $t = new Artefacttype();
                $t->artefact_type = strtolower($at);
                $t->artefact_type_description = $at;
                $t->artefact_type_long_description = $para;
                $t->created_by = 1;
                $t->save();
            }
            $bar->advance();
        }
        $bar->finish();
        $this->line("" . PHP_EOL);

        $this->info("Creating Archive Location : " . PHP_EOL);
        $loc = array("Chennai", 'Hyderabad', 'Indore', "Delhi");

        foreach ($loc as $lo) {
            $l = new Archivelocation();
            $l->archive_location_name = strtolower($lo);
            $l->archive_location_desc = $lo;
            $l->save();
        }


        $this->info("Creating Parent Artefacts : " . PHP_EOL);

        $parent = DB::connection('mysqlgas')->select("SELECT * FROM artefact WHERE ArtefactPID is null or ArtefactPID=''");
        $bar = $this->output->createProgressBar(count($parent));
        foreach ($parent as $par) {
            $artefact = new Artefact();
            $artefact->old_id = $par->ArtefactCode;
            $artefact->artefact_name = $par->ArtefactName;
            $artefact->artefact_type = Artefacttype::where('artefact_type', '=', strtolower($this->getArtefactName($par->ArtefactTypeCode)))->first()->id;
            $artefact->artefact_parent = null;
            $artefact->created_by = 1;
            $artefact->save();
            $bar->advance();
        }
        $bar->finish();
        $this->line("" . PHP_EOL);
        $this->info("Creating Child Artefacts : " . PHP_EOL);
        $child = DB::connection('mysqlgas')->select("SELECT *
FROM artefact
WHERE ArtefactTypeCode NOT IN ('Audio','ATrack','LFile','LBox')
AND ArtefactPID IS NOT NULL");
        $bar = $this->output->createProgressBar(count($child));
        foreach ($child as $par) {
            if ($this->getArtefactName($par->ArtefactTypeCode) != 'Letters') {

                $artefact = new Artefact();
                $artefact->old_id = $par->ArtefactCode;
                $artefact->artefact_name = $par->ArtefactName;
                $artefact->artefact_type = Artefacttype::where('artefact_type', '=', strtolower($this->getArtefactName($par->ArtefactTypeCode)))->first()->id;
                $artefact->artefact_parent = Artefact::where('artefact_name', '=', $par->ArtefactPID)->first()->id;
                $artefact->created_by = 1;
                $artefact->save();
            }
            $bar->advance();
        }
        $bar->finish();
        $this->line("" . PHP_EOL);

        $this->info("Creating artefact Attributes List and Artefact" . PHP_EOL);
        $attributes = DB::connection('mysqlgas')->select("SELECT * FROM attributes");
        $bar = $this->output->createProgressBar(count($attributes));

        foreach ($attributes as $attribute) {
            $attr = new Attribute();
            $attr->attrcode = $attribute->AttributeCode;
            $attr->artefact_type = Artefacttype::where('artefact_type', '=', strtolower($this->getArtefactName($attribute->ArtefactTypeCode)))->first()->id;
            if ($attribute->PickFlag == 'y') {
                $attr->pickflag = true;

                $attributelists = DB::connection('mysqlgas')->select("SELECT * FROM attributelist WHERE AlistCode = ?", [$attribute->AListCode]);
                $listcode = strtolower($attribute->ArtefactTypeCode) . "_" . strtolower($attribute->AListCode) . "_" . rand(1000, 9999);
                $subbar = $this->output->createProgressBar(count($attributelists));
                foreach ($attributelists as $attributelist) {
                    $listval = new Listvalue();
                    $listval->list_code = $listcode;
                    $listval->list_desc = $attributelist->AlistCode;
                    $listval->list_value = $attributelist->AlistValue;
                    $listval->save();
                    $subbar->advance();
                }
                $attr->list_code = $listcode;
                $subbar->finish();
            }
            $attr->attr_value = $attribute->Attributes;
            $attr->html_type = $attribute->htmltype;
            $attr->save();
            $bar->advance();
        }
        $bar->finish();
        $this->line("" . PHP_EOL);

    }

    function getArtefactName($name)
    {
        $artefactname = array(
            'ATrack' => 'Audios',
            'Audio' => 'Audios',
            'Bbox' => 'Books',
            'BBox' => 'Books',
            'Book' => 'Books',
            'Brochure' => 'Books',
            'LBox' => 'Letters',
            'Letter' => 'Letters',
            'LFile' => 'Letters',
            'LBox' => 'Letters',
            'PhotoBox' => 'Photos',
            'Photos' => 'Photos',
            'Souvenir' => 'Books',
            'Video' => 'Videos',
            'VTrack' => 'Videos',
        );

        return $artefactname[$name] == null ? null : $artefactname[$name];
    }
}
