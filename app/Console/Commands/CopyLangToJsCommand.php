<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class CopyLangToJsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:copy {--lang=} {--file=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'trans lang folder from php to js';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $all_lang = ['ar','en'];
        $options=$this->options();
        $command_lang=data_get($options,'lang');
        if($command_lang && in_array($command_lang,$all_lang)){
            $all_lang=[$command_lang];
        }
        $trans_files=[
            'message.php','enums.php',
            'abilities.php','column.php', 'template.php',
        ];
        $command_file=data_get($options,'file');
        if($command_file && in_array($command_file,$trans_files)){
            $trans_files=[$command_file];
        }
        $this->output->progressStart(count($all_lang));
        foreach($all_lang as $lang)
        {
            App::setLocale($lang);
            $path = lang_path($lang);
            collect(File::allFiles($path))->flatMap(function ($file) use ($trans_files,$lang) {
                if (in_array( $file->getBasename(''),$trans_files)){
                    $data='export default '.json_encode([
                                ($translation = $file->getBasename('.php')) => trans($translation,array(),$lang),
                            ]);
                    file_put_contents(
                        resource_path('js/Lang').'/'.$lang.'/'.
                        str_replace('.','_',$file->getBasename('')) .'.js',
                        $data
                    );
                }
            });
            $this->output->progressAdvance();
        }
        $this->output->progressFinish();
    }
}
