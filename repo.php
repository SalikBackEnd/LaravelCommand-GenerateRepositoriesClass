<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class repo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic repositories structure for your Elqounet';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('What is your repo name?');
        // $this->info("Display this on the screen ");
        // $this->info($name);
        $pathDir="app/Repositories/$name";
        if (!file_exists($pathDir)) {
            mkdir($pathDir, 0777, true);
        }
        //Creating Interface Class 
        $Filename="/$name"."Interface.php";
        $Interfacefile = fopen($pathDir.$Filename, 'w');
        $InterfaceText = "<?php \nnamespace App\\Repositories\\".$name.";\n".
        "\ninterface ".$name.'Interface {'.
            "\n\n\tpublic function getAll();\n\n\tpublic function find(".'$id'.");\n\n\tpublic function delete(".'$id'.");
        \n}";
        fwrite($Interfacefile, $InterfaceText);
        //Creating Repositories Class 
        $Filename="/$name"."Repositories.php";
        $RepoFile=fopen($pathDir.$Filename, 'w');
        $RepoText="<?php \nnamespace App\\Repositories\\".$name.";\n".
        "\nuse App\Repositories\\$name\\".$name."Interface as ".$name."Interface;".
        "\nuse App\Model\\$name;".
        "\n\n".
        "class ".$name."Repository implements ".$name."Interface\n{".
            "\n\n\tpublic $".strtolower($name).";".
            "\n\n\tfunction __construct($name $".strtolower($name).")\n\t{".
                "\n\t\t$"."this->".strtolower($name)." = $".strtolower($name).";".
            "\n\t}".
            "\n".
            "\n\n\tpublic function getAll()".
            "\n\t{".
            "\n\n\t\t//Implementation".
            "\n\t}".
            "\n\n\tpublic function find($"."id)".
            "\n\t{".
            "\n\n\t\t //Implementation".
            "\n\t}".
            "\n\n\tpublic function delete($"."id)".
            "\n\t{".
            "\n\n\t\t //Implementation".
            "\n\t}".
        "\n}";
        fwrite($RepoFile, $RepoText);

        //Creating RepoServiceProvide Class 
        $Filename="/$name"."RepoServiceProvider.php";
        $ServiceFile=fopen($pathDir.$Filename, 'w');
        $ServiceText="<?php \nnamespace App\\Repositories\\".$name.";\n".
        "\n\nuse Illuminate\Support\ServiceProvider;".
        "\n\n".
        "class ".$name."RepoServiceProvide extends ServiceProvider\n{".
        "\n".
        "\t/**".
        "\n\t* Bootstrap the application services.".
        "\n\t*".
        "\n\t* @return void".
        "\n\t*/".
        "\n\tpublic function boot()".
        "\n\t{".
        "\n\t\t".
        "\n\t}".
        "\n\t/**".
        "\n\t* Register the application services.".
        "\n\t*".
        "\n\t* @return void".
        "\n\t*/".
        "\n\tpublic function register()".
        "\n\t{".
        "\n\t\t$"."this->app->bind('App\Repositories\\$name\\".$name."Interface', 'App\Repositories\\$name\\".$name."Repository');".
        "\n\t}".
        "\n}";
        fwrite($ServiceFile, $ServiceText);
        $this->info($name." Repositories file created!");
        $this->info("Remember to add ".$name."RepoServiceProvider class to config/app.php in providers array.");
        return 0;
    }
}
